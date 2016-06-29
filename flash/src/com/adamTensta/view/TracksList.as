package com.adamTensta.view{
/*
	responsible for adding tracks and laoding/syncing  sound files
*/
	
	import com.adamTensta.commands.Constants;
	import com.adamTensta.commands.Model;
	import com.adamTensta.commands.WebService;
	import com.adamTensta.events.ModelEvent;
	import com.adamTensta.events.WeborbEvents;
	import com.carlcalderon.arthropod.Debug;
	import com.greensock.TweenMax;
	import com.greensock.easing.Expo;
	import com.greensock.events.LoaderEvent;
	import com.greensock.loading.LoaderMax;
	import com.greensock.loading.MP3Loader;
	
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.events.TimerEvent;
	import flash.utils.Timer;
	
	public class TracksList extends Sprite{
		private var _model:Model;
		private var track:TrackItem;
		private var trackItem:EmptyTrackItem;
		private var _weborb:WebService;
		private var sound:MP3Loader;
		private var sound1:MP3Loader;
		private var queue:LoaderMax;
		
		private var tracksUnlocked:uint = 0;
		public var addTrack_btn:Intro;
		private var timer:Timer;
		private var trackLoaded:uint =0;
		
		
		public var strip_mc:MovieClip;
		public var share_mc:MovieClip;
		
		
		
		public function TracksList(){
			_model = Model.getInstance();
			_weborb = WebService.getInstance();
			
//checking for differnet users 
//TODO run by socket.io
			timer = new Timer(5000);
			this.addEventListener(Event.ADDED_TO_STAGE, addedToStage);
		}
		
		private function addedToStage(e:Event):void{
			removeEventListener(Event.ADDED_TO_STAGE, addedToStage);
			addListeners();
			_model.l("tracklist:adddedTostage");
			
			showTracks();
			init();
		}

//jsut the view of the amount of tracks		
		private function showTracks():void{
		 	
			
			stripe_mc.x = 0;
			stripe_mc.y = -stripe_mc.height;
			stripe_mc.width = _model.StageWidth;
			stripe_mc.alpha = 0;
			var i:uint = 0 ;
			
			share_mc.x = _model.StageWidth - share_mc.width;
			share_mc.y = stripe_mc.y - share_mc.height - 10;
			
			share_mc.visible = false;
			
			while(i<_model.TOTAL_TRACKS){
				trackItem = new EmptyTrackItem(i+1);
				addChildAt(trackItem, this.getChildIndex(stripe_mc));
				
				var marg = (_model.StageWidth - ((trackItem.width +3)*_model.TOTAL_TRACKS))/2;
				trackItem.x = marg + (trackItem.width + 3) * i;
				//trackItem.alpha = 0.5;
				TweenMax.from(trackItem, 0.4,{alpha:0,delay:1+(i/10)});
				i++
			}
			
		}
		
		private function addListeners():void{
			trace("TrackList:AddListener");
			_model.addEventListener(ModelEvent.RESIZE_STAGE, resizeHandler)
			_model.addEventListener(ModelEvent.ROOM_UPDATE, unlockEvent);
			_model.addEventListener(ModelEvent.ROOM_RECEIVED,unlockEvent);
			_model.addEventListener(ModelEvent.ROOM_CREATED, unlockEvent);
			 timer.addEventListener(TimerEvent.TIMER, checkforUsers);
			 share_mc.addEventListener(MouseEvent.CLICK, clickHandler);
			 
			 
			 _model.addEventListener(ModelEvent.SHOW_TEST2, function(){
				 var tracko = LoaderMax.getLoader("audio0");
				 tracko.playSound();
				 tracko.volume =1;
				 trace('playVideo');
				 
				 
			 });
			 _model.addEventListener(ModelEvent.SHOW_TESTEND, function(){
				 
				 TweenMax.to(this, 1,{autoAlpha:0, ease:Expo.easeOut});
				 
			 });
		}
		
		private function clickHandler(e:MouseEvent):void{
			_model.sendEvent(new ModelEvent(ModelEvent.SHOW_SHAREBOX));
		}
		
		
		private function checkforUsers(e:TimerEvent):void{
			_weborb.checkforUsers()
		};
		
		private function unlockEvent(e:ModelEvent):void{
			if(e.type != ModelEvent.ROOM_UPDATE)timer.start();
			var arr:Array = new Array();
			arr = _model.currentTracks;
			//trace("unlocked"+tracksUnlocked);
			trace("UnlockEvent:length:"+arr.length);
			
			for(var i:uint = tracksUnlocked ; i<arr.length ; i++){
				var trackNr = arr[i][3];
				trace("ulockEvent:track	#:"+trackNr);
				track = new TrackItem();
				track.init(arr[i]);
				addChild(track);
				track.x = (track.width + 3) * i;
				LoaderMax.getLoader("audio"+i).volume = Constants.DEFAULT_VOLUME;
				tracksUnlocked++;
			}
	
		}
		
		
		private function addLoadComplete(e:LoaderEvent):void{
			Debug.log("addedLoaderCompleteEvent:");
			Debug.log(LoaderMax.getContent("audio1"));
		
			//Debug.log("progress of audio 1:"+ sound1.playProgress);
			
		}
		
		
		private function init(e:ModelEvent=null):void{
			trace("TRACKLIST INIT");
			_model.l("http://prototypes.mingcompany.com/multitrack/index.php?id="+_model.ROOMID);
			_model.l("tracks # =" + _model.currentTracks.length);
			
			var total:uint;
			total = Constants.TOTAL_TRACKS;
			queue = new LoaderMax({name:"tracks", onProgress:progressHandler, onChildComplete:childCompleteHandler, onComplete:completeHandler, onError:errorHandler,maxConnections:3});
			for( var i:uint = 0 ; i<total; i++){
				var s:uint = i+1;
				sound = new MP3Loader(Constants._BasePath+s+".mp3",{name:'audio'+i,autoPlay:false,repeat:0});
				//sound = new MP3Loader(Constants._BasePath+s+".mp3",{name:'audio'+i,autoPlay:false,repeat:-1});
				
				queue.append(sound);
			}
			queue.load();
		
		}
		
		private function childCompleteHandler(e:LoaderEvent):void{
			
			Debug.log(e.target + " loaded");
			_model.l(e.target+" loaded");
			
			trackLoaded ++;
			var totalTracks:uint = _model.TOTAL_TRACKS;
			var prog:Number = trackLoaded / totalTracks;
			_model.sendEvent(new ModelEvent(ModelEvent.LOADING_PROGRESS, prog));
		}
		
		
		private function progressHandler(event:LoaderEvent):void {
			//Debug.log("progress: " + event.target.progress);
			
			_model.sendEvent(new ModelEvent(ModelEvent.LOADING_PROGRESS, event.target.progress));
		}
		
		private function completeHandler(event:LoaderEvent):void {
			Debug.log(event.currentTarget + " is complete!");
			var tracks:Array;
			tracks = _model.currentTracks;
			var totalUnlocked = _model.currentTracks.length;
			var i:uint=0;
			while(i<Constants.TOTAL_TRACKS){
				trace("playing:"+i);
				var tracko = LoaderMax.getLoader("audio"+i);
				tracko.playSound();
				tracko.volume = 0;
				
			/*	
				if(i<totalUnlocked){
					track = new TrackItem();
					track.init(tracks[i]);
					addChild(track);
					track.x = (track.width +3)*i;
					tracko.volume = Constants.DEFAULT_VOLUME;
				}else{
					tracko.volume = 0;
				}
			*/	
				i++
			};
			
			//Debug.log(LoaderMax.getContent("audio0"));
			//Debug.log(LoaderMax.getLoader("audio1").playProgress);
			
		}
		
		private function resizeHandler(e:ModelEvent):void{
			stripe_mc.width = _model.StageWidth;
			
			share_mc.x = _model.StageWidth - share_mc.width;
			share_mc.y = stripe_mc.y - share_mc.height - 10;
		}
		
		private function errorHandler(event:LoaderEvent):void {
			Debug.log("error occured with " + event.target + ": " + event.text);
		}

	}



}