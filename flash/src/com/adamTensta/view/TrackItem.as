 package com.adamTensta.view
{
	import com.adamTensta.commands.Model;
	import com.adamTensta.events.ModelEvent;
	import com.carlcalderon.arthropod.Debug;
	import com.greensock.TweenMax;
	
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.media.Sound;
	import flash.media.SoundChannel;
	import flash.media.SoundTransform;
	import flash.text.TextField;
	
	public class TrackItem extends MovieClip
	{
		public var avatar_mc:MovieClip;
		public var name_txt:TextField
		public var fbId_txt:TextField;
		public var ip_txt:TextField;
		public var bar_mc:MovieClip;
		
		
		
		private var _model:Model;
		
		private var sound:Sound;
		private var channel:SoundChannel;
		
		
		public function TrackItem()
		{
			super();
			Debug.log("TrackItem:itemAded");
		}
		
		public function init(trackData:Array ):void{
			
			name_txt.text = trackData[0];
			ip_txt.text = trackData[1];
			fbId_txt.text = trackData[2];
			
			
			_model.sendEvent(new ModelEvent(ModelEvent.LOAD_SOUND,trackData[3]));
			
		}
		
		
	}
}