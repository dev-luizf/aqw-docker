package Loader_fla
{
   import flash.display.*;
   import flash.events.*;
   import flash.net.*;
   import flash.system.*;

   public dynamic class MainTimeline extends MovieClip
   {
      public var mcLoading:MovieClip;
      public var sFile:String;
      public var sTitle:String;
      public var sBG:String;
      public var loader:URLLoader;
      public var sURL:String;
      public var titleDomain:ApplicationDomain;

      public function MainTimeline()
      {
         super();
         addFrameScript(0,this.frame1);
      }

      public function onDataComplete(param1:Event) : void
      {
         var _loc2_:URLVariables = null;
         trace("onDataComplete:" + param1.target.data);
         _loc2_ = new URLVariables(param1.target.data);
         if(_loc2_.status == "success")
         {
            this.sFile = _loc2_.sFile;
            this.sTitle = _loc2_.sTitle;
            this.sBG = _loc2_.sBG;
            this.loadTitle();
            this.loadGame();
         }
         else
         {
            trace(_loc2_.strReason);
         }
      }

      internal function frame1() : *
      {
         Security.allowDomain("*");
         this.titleDomain = new ApplicationDomain();
         this.sURL = this.loaderInfo.url.substring(0,this.loaderInfo.url.lastIndexOf("gamefiles/"));
         trace("sURL: " + this.sURL);
         this.loader = new URLLoader();
         this.loader.addEventListener(Event.COMPLETE,this.onDataComplete);
         this.loader.load(new URLRequest(this.sURL + "getversion.asp"));
      }

      public function loadTitle() : void
      {
         var _loc1_:Loader = null;
         _loc1_ = new Loader();
         _loc1_.contentLoaderInfo.addEventListener(Event.COMPLETE,this.onTitleComplete);
         _loc1_.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR,this.onError);
         _loc1_.load(new URLRequest(this.sURL + "gamefiles/title/" + this.sBG),new LoaderContext(false,this.titleDomain));
      }

      public function onTitleComplete(param1:Event) : void
      {
         trace("Title Loaded");
      }

      public function onError(param1:IOErrorEvent) : void
      {
         trace("Preloader IOError: " + param1);
      }

      public function onProgress(param1:ProgressEvent) : void
      {
         var _loc2_:int = 0;
         _loc2_ = param1.currentTarget.bytesLoaded / param1.currentTarget.bytesTotal * 100;
         this.mcLoading.strLoad.text = "Loading " + _loc2_ + "%";
      }

      public function onComplete(param1:Event) : void
      {
         var _loc2_:* = undefined;
         var _loc3_:* = undefined;
         var _loc4_:* = undefined;
         _loc2_ = stage;
         _loc2_.removeChildAt(0);
         _loc3_ = _loc2_.addChild(MovieClip(Loader(param1.target.loader).content));
         for(_loc4_ in root.loaderInfo.parameters)
         {
            trace(_loc4_ + ": " + root.loaderInfo.parameters[_loc4_]);
            _loc3_.params[_loc4_] = root.loaderInfo.parameters[_loc4_];
         }
         _loc3_.params.sURL = this.sURL;
         _loc3_.params.sTitle = this.sTitle;
         _loc3_.titleDomain = this.titleDomain;
      }

      public function loadGame() : void
      {
         var _loc1_:Loader = null;
         _loc1_ = new Loader();
         _loc1_.contentLoaderInfo.addEventListener(ProgressEvent.PROGRESS,this.onProgress);
         _loc1_.contentLoaderInfo.addEventListener(Event.COMPLETE,this.onComplete);
         _loc1_.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR,this.onError);
         trace(this.loaderInfo.url);
         _loc1_.load(new URLRequest(this.sURL + "gamefiles/" + this.sFile));
         this.mcLoading.strLoad.text = "Loading 0%";
      }
   }
}
