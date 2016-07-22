
// Rename the archive that will be created here
var archiveName = 'multitrack';

// dependencies
var plugins = require('gulp-load-plugins')({
        rename: {
            'gulp-live-server': 'serve'
        }
    });
var notify = require("gulp-notify");
var gulp = require('gulp');
var gutil = require('gulp-util');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var image = require('gulp-image');
var minifyHTML = require('gulp-htmlmin');
var rename = require('gulp-rename');
var del = require('del');
var connect = require('gulp-connect');
var open = require('gulp-open');
var zip = require('gulp-zip');
var runSequence = require('run-sequence');
var header = require('gulp-header');
var filesize = require('gulp-filesize');
var replace = require('gulp-replace');
var spawn = require('child_process').spawn,
    node;
// read in the package file
var pkg = require('./package.json');


// TASKS

// Uglify external JS files
gulp.task('uglify:dist', function() {
    var opt = {
        mangle: true, // make shorter variable names
        compress: {
            drop_debugger: true, // drop debugger messages from code
            drop_console: true // drop console messages from code
        },
        output: {
            beautify: false // make code pretty? default is false
        }
    };
    return gulp.src('src/js/script.js')
        .pipe(uglify(opt))
        .pipe(rename('script.js'))
        .pipe(header(bannerMessageJsCss, {
            pkg: pkg
        }))
        .pipe(gulp.dest('dist/js/'));
});

//images optimalization tool
gulp.task('build-images', function(){
  return gulp.src('src/img/**/*.*')
  // Caching images that ran through imagemin
  .pipe(image({
      pngquant: true,
      optipng: false,
      zopflipng: true,
      advpng: true,
      jpegRecompress: false,
      jpegoptim: true,
      mozjpeg: true,
      gifsicle: true,
      svgo: true
    }))
  .pipe(gulp.dest('dist/img'))
});



// Minify Custom JS: Run manually with: "gulp build-js"
gulp.task('build-js', function () {
    return gulp.src('src/js/*.js')
        
        .pipe(plugins.jshint())
        // Use gulp-notify as jshint reporter 
        .pipe(notify(function (file) {
          if (file.jshint.success) {
            // Don't show something if success 
            return false;
          }
     
          var errors = file.jshint.results.map(function (data) {
            if (data.error) {
              return "(" + data.error.line + ':' + data.error.character + ') ' + data.error.reason;
            }
          }).join("\n");
          return file.relative + " (" + file.jshint.results.length + " errors)\n" + errors;
        }))
        .pipe(plugins.uglify({
            output: {
                'ascii_only': true
            }
        }))
        .pipe(plugins.concat('scripts.min.js'))
        .pipe(gulp.dest('dist/js'));
});

gulp.task('sass:dev', function() {
    return gulp.src('src/scss/style.scss')
        .pipe(sass({
            outputStyle: "expanded"
        }).on('error', sass.logError))
        .pipe(rename('style.css'))
        .pipe(gulp.dest('src/css/'));
});

gulp.task('sass:dist', function() {
    return gulp.src('src/scss/style.scss')
        .pipe(sass({
            outputStyle: "compressed"
        }).on('error', sass.logError))
        .pipe(header(bannerMessageJsCss, {
            pkg: pkg
        }))
        .pipe(rename('style.css'))
        .pipe(gulp.dest('dist/css/'));
});

gulp.task('minify-html', function() {
    var opts = {
        collapseWhitespace: true, // must be true if conservativeCollapse or preserveLineBreaks are used as true
        conservativeCollapse: false, // true: collapse to 1 space (never remove it entirely)
        preserveLineBreaks: false, // true: collapse to 1 line break (never remove it entirely)
        useShortDoctype: true,
        removeScriptTypeAttributes: true,
        removeComments: true,
        removeRedundantAttributes: true,
        minifyJS: true, // minify Javascript in script elements and on* attributes
        minifyCSS: true // minify CSS in style elements and style attributes
    };
    var consoleRegEx = /console\.(clear|count|debug|dir|dirxml|error|group|groupCollapsed|groupEnd|info|profile|profileEnd|time|timeEnd|timeStamp|trace|log|warn) *\(.*\);?/gi;
    return gulp.src('dist/*.html')
        .pipe(replace(consoleRegEx, ''))
        .pipe(minifyHTML(opts))
        .pipe(header(bannerMessageHtml, {
            pkg: pkg
        }))
        .pipe(gulp.dest('./dist/'));
});

gulp.task('del', function() {
    del([
        'dist/*'
    ])
});

gulp.task('connect', function() {
    connect.server({
        root: ['src'],
        port: 3000,
        livereload: true,
        //livereload: { port: '9999' }
    });
});

gulp.task('open', function() {
    var options = {
        uri: 'http://localhost:3000',
        app: 'Google Chrome'
            //app: 'firefox'
    };
    gutil.log('-----------------------------------------');
    gutil.log('Opening browser to:', gutil.colors.yellow('http://localhost:8889'));
    gutil.log('-----------------------------------------');
    gulp.src(__filename)
        .pipe(open(options));
});

gulp.task('copy-to-dist-folder', function() {
    return gulp.src(['src/**/*.*', '!src/scss*'])
        .pipe(gulp.dest('dist'));
});


/**
 * $ gulp server
 * description: launch the server. If there's a server already running, kill it.
 */
gulp.task('server', function() {
  if (node) node.kill()
  node = spawn('node', ['index.js'], {stdio: 'inherit'})
  node.on('close', function (code) {
    if (code === 8) {
      gulp.log('Error detected, waiting for changes...');
    }
  });
})

gulp.task('basic-reload', function() {
    gulp.src('src')
        .pipe(connect.reload());
});

gulp.task('watch-src', function() {
    gulp.watch(['dist/*.html', 'dist/js/*.js','dist/css/*.css'], ['basic-reload']);
    gulp.watch(['src/js/**/*.*'],["js-src"])
    //gulp.watch(['src/scss/*.scss'], ['sass:dev']);
    gulp.watch(['src/scss/*.scss'], ['sass:dist']);
    
});

gulp.task('serve', function(callback) {
    runSequence('sass:dev', 
      //  ['connect'], 
        ['open', 'watch-src'],
        callback);
});


// Shortcut to build and archive all at once
gulp.task('ba', function() {runSequence(['build'], ['archive'])});
gulp.task('default', ['serve']);

// clean up if an error goes unhandled.
process.on('exit', function() {
    if (node) node.kill()
})
