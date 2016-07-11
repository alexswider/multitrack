
// Rename the archive that will be created here
var archiveName = 'multitrack';

// dependencies
var gulp = require('gulp');
var gutil = require('gulp-util');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
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
        'dist/*',
        'archive/*'
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
    return gulp.src(['src/index.html', 'src/css/style.css', 'src/img/*.png', 'src/img/*.jpg', 'src/img/*.gif', 'src/img/*.svg', 'src/js/script.js', '!src/comp*'])
        .pipe(gulp.dest('dist'));
});

gulp.task('compress', function() {
    return gulp.src('dist/*')
        // for quick access, you can change this
        // name at the top of this file
        .pipe(zip(archiveName+'.zip'))
        .pipe(filesize())
        .pipe(gulp.dest('delivery'));
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

gulp.task('archive', function() {
    // make a zip all the files, including dev folder, for archiving the banner
   var success = gulp.src(['gulpfile.js', 'package.json', '*.sublime-project', 'dev/*', 'dist/*', 'backupImage/*', 'delivery/*'], {cwdbase: true})
        // for quick access, you can change this
        // name at the top of this file
        .pipe(zip('archive-'+archiveName+'.zip'))
        .pipe(gulp.dest('archive'));
    gutil.log('--------------------------------');
    gutil.log(pkg.name+' has been archived in');
    gutil.log('archive/'+ gutil.colors.yellow('archive-'+archiveName+'.zip') );
    gutil.log('--------------------------------');
    return success;
});

gulp.task('basic-reload', function() {
    gulp.src('src')
        .pipe(connect.reload());
});

gulp.task('watch-src', function() {
    gulp.watch(['src/*.html', 'src/js/*.js'], ['basic-reload']);
    gulp.watch(['src/scss/*.scss'], ['sass:dev']);
    gulp.watch(['src/css/*.css'], ['basic-reload']);
  //  gulp.watch(['./index.js'], ['server']);
});

// gulp.task('build', function(callback) {
//     runSequence('del', 'copy-to-dist-folder', 'minify-html', 'sass:dist', ['uglify:dist'], ['compress'],
//         callback);
// });

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
