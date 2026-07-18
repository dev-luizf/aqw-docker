package
{
   import fl.motion.*;
   import flash.display.*;
   import flash.events.*;
   import flash.external.*;
   import flash.filters.*;
   import flash.geom.*;
   import flash.media.*;
   import flash.net.*;
   import flash.system.*;
   import flash.text.*;
   import flash.ui.*;
   import flash.utils.*;
   import it.gotoandplay.smartfoxserver.*;
   import liteAssets.draw.*;
   import liteAssets.handlers.*;
   
   public class Game extends MovieClip
   {
      
      public static var root:DisplayObject;
      
      public static var serverName:String;
      
      public static var objLogin:Object;
      
      public static var mcUpgradeWindow:MovieClip;
      
      public static var mcACWindow:MovieClip;
      
      public static var strToken:String;
      
      public static var ISWEB:Boolean = true;
      
      public static var serverPort:int = 5588;
      
      public static var serverIP:String = "";
      
      public static var serverGamePath:String = "";
      
      public static var serverFilePath:String = "";
      
      public static var serverURL:String = "";
      
      public static var cLoginZone:String = "zone_master";
      
      public static var clientToken:String = "SPIDER#0001";
      
      public static var bPTR:Boolean = false;
      
      public static var loginInfo:Object = new Object();
      
      public static const ASSETS_LOADED:String = "main_assets_loaded";
      
      public static var ASSETS_READY:String = "";
      
      public static const FB_APP_NAME:String = "AQW";
      
      public static const FB_APP_URL:String = "127.0.0.1:8081";
      
      public static const FB_APP_ID:String = "51356733862";
      
      public static const FB_APP_SEC:String = "This should never be stored in the client";
      
      MovieClip.prototype.removeAllChildren = function():void
      {
         for(var i:* = this.numChildren - 1; i >= 0; i--)
         {
            this.removeChildAt(i);
         }
      };
      
      public var MsgBox:MovieClip;
      
      public var ctr_watermark:MovieClip;
      
      public var mcAccount:MovieClip;
      
      public var mcExtSWF:MovieClip;
      
      public var mcLogin:MovieClip;
      
      public var ui:MovieClip;
      
      public var loader:mcLoader;
      
      public var csLoader:Loader;
      
      public var fileUrl:String;
      
      public var csbLoaded:Number;
      
      public var csbTotal:Number;
      
      public var clientVersion:Number = 4.2;
      
      public var cVersion:String;
      
      public var sToken:String;
      
      public var failedServers:*;
      
      public var world:World;
      
      public var bagSpace:String = "interface/bagspace_2025.swf";
      
      public var iMaxBagSlots:* = 400;
      
      public var iMaxBankSlots:* = 450;
      
      public var iMaxHouseSlots:* = 250;
      
      public var iMaxFriends:* = 225;
      
      public var iMaxLoadoutSlots:* = 20;
      
      private var swfObj:String = "AQWGame";
      
      private var _colorCache:Dictionary;
      
      public var showFB:Boolean = false;
      
      public var fbL:fbLinkWindow;
      
      public var titleDomain:ApplicationDomain;
      
      public var mcO:MovieClip;
      
      private var rn:RandomNumber;
      
      public var elmType:String;
      
      public var assetsDomain:ApplicationDomain;
      
      public var assetsContext:LoaderContext;
      
      public var handleSessionEvent:Function;
      
      public const EMAIL_REGEX:RegExp;
      
      public var mixer:SoundFX;
      
      public var sfc:SmartFoxClient;
      
      public var chatF:*;
      
      public var sFilePath:String = "";
      
      public var params:Object;
      
      public var userPreference:SharedObject;
      
      public var litePreference:SharedObject;
      
      public var uoPref:Object;
      
      public var litePref:Array;
      
      public var loginLoader:URLLoader;
      
      public var objServerInfo:Object;
      
      public var sfcSocial:Boolean = false;
      
      public var ldrMC:LoaderMC;
      
      public var mcConnDetail:ConnDetailMC;
      
      public var querystring:Object;
      
      public var ts_login_server:Number;
      
      public var ts_login_client:Number;
      
      public var aaaloop:int = 0;
      
      public var totalPingTime:Number = 0;
      
      public var pingCount:int = 0;
      
      public var arrRanks:Vector.<int>;
      
      public var iRankMax:int = 10;
      
      public var arrHP:Vector.<int>;
      
      private var aswc:Apop;
      
      public var hasPreviewed:Boolean;
      
      public var intLevelCap:int;
      
      public var PCstBase:int;
      
      public var PCstRatio:Number;
      
      public var PCstGoal:int;
      
      public var GstBase:int;
      
      public var GstRatio:Number;
      
      public var GstGoal:int;
      
      public var PChpBase1:int;
      
      public var PChpBase100:int;
      
      public var PChpGoal1:int;
      
      public var PChpGoal100:int;
      
      public var PChpDelta:int;
      
      public var intHPperEND:int;
      
      public var intAPtoDPS:int;
      
      public var intSPtoDPS:int;
      
      public var bigNumberBase:int;
      
      public var resistRating:Number;
      
      public var modRating:Number;
      
      public var baseDodge:Number;
      
      public var baseBlock:Number;
      
      public var baseParry:Number;
      
      public var baseCrit:Number;
      
      public var baseHit:Number;
      
      public var baseHaste:Number;
      
      public var baseMiss:Number;
      
      public var baseResist:Number;
      
      public var baseCritValue:Number;
      
      public var baseBlockValue:Number;
      
      public var baseResistValue:Number;
      
      public var baseEventValue:Number;
      
      public var PCDPSMod:Number = 0.85;
      
      public var curveExponent:Number = 0.66;
      
      public var statsExponent:Number = 1.33;
      
      public var stats:Vector.<String>;
      
      public var orderedStats:Vector.<String>;
      
      public var ratiosBySlot:Object;
      
      public var I0pct:Number = 0.8;
      
      public var I2pct:Number = 1.25;
      
      public var classCatMap:Object;
      
      private var coreValues:Object;
      
      private var travelMapData:Object;
      
      private var WorldMapData:worldMap;
      
      private var skipR2:Boolean = false;
      
      private var apop_:apopCore;
      
      public var apopTree:Object;
      
      public var curID:String;
      
      public var serialCmdMode:Boolean = false;
      
      public var serialCmd:Object;
      
      private var conn:*;
      
      public var confirmTime:int = 0;
      
      public var quests:Boolean = false;
      
      public var bits:Vector.<uint>;
      
      private var fbc:MovieClip;
      
      public var mcGameMenu:MovieClip;
      
      public var firstMenu:Boolean = true;
      
      public var bPassword:Boolean = true;
      
      public var pDash:Boolean;
      
      internal var cancelTargetTimer:Timer;
      
      public var keyDict:Dictionary;
      
      private var travelLoaderMC:*;
      
      public var TRAVEL_DATA_READY:Boolean = false;
      
      private var bLoaded:Number = 0;
      
      private var bTotal:Number = 0;
      
      private var weakPass:Array;
      
      public var extCall:ExternalCalls;
      
      public var FBConnectCallback:Function;
      
      public var sBG:String = "generic2.swf";
      
      public var IsEU:Boolean = false;
      
      public var TempLoginName:* = "";
      
      public var TempLoginPass:* = "";
      
      public var mtcidNow:Number;
      
      public var intChatMode:int;
      
      public var serverPath:String;
      
      public var playerPollData:Object;
      
      private var characters:SharedObject;
      
      public var csShowServers:Boolean = false;
      
      public var mcCharSelect:*;
      
      internal var interfaceQueue:Array;
      
      internal var visualLoader:*;
      
      public var interfaceRef:Object;
      
      internal var interfaceLoaded:Number = 0;
      
      internal var interfaceTotal:Number = 0;
      
      public var newInstance:Boolean = false;
      
      public var BOOK_DATA_READY:* = null;
      
      public var bolLoader:Loader;
      
      public var bolContent:MovieClip;
      
      public var equipPotionOnSeia:Boolean;
      
      public var lastPing:Number = 0;
      
      public var lastPingTime:uint = 0;
      
      public var lastPingValues:Array;
      
      public var bankFiltersMC:bankFilters;
      
      public var pLoggerUI:packetlogger;
      
      public var cMenuUI:cellMenu;
      
      public var cDropsUI:customDrops;
      
      public var pAurasUI:playerAuras;
      
      public var tAurasUI:targetAuras;
      
      public var bAnalyzer:battleAnalyzer;
      
      public var cameraToolMC:cameraTool;
      
      internal var petDisable:Timer;
      
      public var portraitsCnt:Array;
      
      public var pinnedQuests:String;
      
      internal var disableTimer:Timer;
      
      public var regExLineSpace:RegExp;
      
      public var showServers:Boolean = false;
      
      public var baseClassStats:Object;
      
      private var statsNewClass:Boolean = false;
      
      private var mcStatsPanel:MovieClip;
      
      public function Game()
      {
         /*
          * Decompilation error
          * Timeout (1 minute) was reached
          * Instruction count: 1517
          */
         throw new flash.errors.IllegalOperationError("Not decompiled due to timeout");
      }
      
      public static function gTrace(str:*) : *
      {
         if(Game.ISWEB)
         {
            if(!ExternalInterface.available)
            {
               return;
            }
            ExternalInterface.call("console.log",str);
         }
         else
         {
            trace(str);
         }
      }
      
      public static function trim(p_string:String) : String
      {
         if(p_string == null)
         {
            return "";
         }
         return p_string.replace(/^\s+|\s+$/g,"");
      }
      
      public static function XMLtoObject(objXML:XML) : *
      {
         var a:* = undefined;
         var o:* = undefined;
         var strChildName:* = undefined;
         var objTarget:* = {};
         for(a in objXML.attributes())
         {
            objTarget[String(objXML.attributes()[a].name())] = String(objXML.attributes()[a]);
         }
         for(o in objXML.children())
         {
            strChildName = objXML.children()[o].name();
            if(objTarget[strChildName] == undefined)
            {
               objTarget[strChildName] = [];
            }
            objTarget[strChildName].push(XMLtoObject(objXML.children()[o]));
         }
         return objTarget;
      }
      
      public static function convertXMLtoObject(objXML:XML) : *
      {
         var a:* = undefined;
         var o:* = undefined;
         var childNode:XML = null;
         var strChildName:* = undefined;
         var objTarget:* = {};
         for(a in objXML.attributes())
         {
            objTarget[String(objXML.attributes()[a].name())] = String(objXML.attributes()[a]);
         }
         for(o in objXML.children())
         {
            childNode = objXML.children()[o];
            if(childNode.nodeKind() == "text")
            {
               if(childNode == parseFloat(childNode).toString())
               {
                  return parseFloat(childNode);
               }
               return childNode;
            }
            if(childNode.nodeKind() == "element")
            {
               strChildName = objXML.children()[o].name();
               if(objTarget[strChildName] == null)
               {
                  objTarget[strChildName] = convertXMLtoObject(objXML.children()[o]);
               }
               else
               {
                  if(!(objTarget[strChildName] is Array))
                  {
                     objTarget[strChildName] = [objTarget[strChildName]];
                  }
                  objTarget[strChildName].push(convertXMLtoObject(objXML.children()[o]));
               }
            }
         }
         return objTarget;
      }
      
      private static function makeGrayscale(clip:DisplayObject, darkenPercent:int = 0, grayLvl:Number = 0.33) : void
      {
         var color:Color = null;
         if(clip == null)
         {
            return;
         }
         var grayScaleMatrix:Array = [grayLvl,grayLvl,grayLvl,0,0,grayLvl,grayLvl,grayLvl,0,0,grayLvl,grayLvl,grayLvl,0,0,grayLvl,grayLvl,grayLvl,1,0];
         var matrix:ColorMatrixFilter = new ColorMatrixFilter(grayScaleMatrix);
         clip.filters = [matrix];
         if(darkenPercent != 0)
         {
            color = new Color();
            color.brightness = -(darkenPercent / 100);
            clip.transform.colorTransform = color;
         }
      }
      
      public function loadAccountCreation(strFilename:String) : *
      {
         this.mcAccount.removeChildAt(0);
         var ldr:Loader = new Loader();
         trace("newchar " + Game.serverFilePath + strFilename);
         ldr.load(new URLRequest(Game.serverFilePath + strFilename),new LoaderContext(false,new ApplicationDomain(null)));
         this.mcAccount.addChild(ldr);
      }
      
      public function onCSComplete(e:Event) : void
      {
         trace("Character select loaded");
         if(e == null || e.currentTarget == null)
         {
            return;
         }
         this.mcCharSelect = e.currentTarget.content as MovieClip;
         if(this.mcCharSelect != null)
         {
            this.addChildAt(this.mcCharSelect,1);
         }
         if(this.csLoader != null && this.csLoader.contentLoaderInfo != null)
         {
            this.csLoader.contentLoaderInfo.removeEventListener(Event.COMPLETE,this.onCSComplete);
            this.csLoader.contentLoaderInfo.removeEventListener(ProgressEvent.PROGRESS,this.onCSProgress);
            this.csLoader.contentLoaderInfo.removeEventListener(IOErrorEvent.IO_ERROR,this.onCSError);
         }
         if(this.loader != null && this.loader.parent != null)
         {
            this.loader.parent.removeChild(this.loader);
            this.loader = null;
         }
      }
      
      public function onCSProgress(event:ProgressEvent) : void
      {
         var percent:int = 0;
         if(event == null)
         {
            return;
         }
         this.csbLoaded = event.bytesLoaded;
         this.csbTotal = event.bytesTotal;
         if(this.csbTotal > 0 && this.loader != null)
         {
            percent = int(this.csbLoaded / this.csbTotal * 100);
            if(this.loader.mcPct != null && this.loader.mcPct.hasOwnProperty("text"))
            {
               this.loader.mcPct.text = percent + "%";
            }
         }
      }
      
      public function onCSError(e:IOErrorEvent) : void
      {
         trace("Charselect load failed: " + (e != null ? String(e) : "unknown error"));
         if(this.csLoader != null && this.csLoader.contentLoaderInfo != null)
         {
            this.csLoader.contentLoaderInfo.removeEventListener(Event.COMPLETE,this.onCSComplete);
            this.csLoader.contentLoaderInfo.removeEventListener(ProgressEvent.PROGRESS,this.onCSProgress);
            this.csLoader.contentLoaderInfo.removeEventListener(IOErrorEvent.IO_ERROR,this.onCSError);
         }
         if(this.loader != null && this.loader.parent != null)
         {
            this.loader.parent.removeChild(this.loader);
            this.loader = null;
         }
         gotoAndPlay("Login");
      }
      
      public function monsterTreeWrite(MonMapID:int, monLeafO:Object, targets:* = null) : void
      {
         var typ:String = null;
         var nam:String = null;
         var val:* = undefined;
         var monAvt:Avatar = null;
         var avtAvt:Avatar = null;
         var Mon:Avatar = null;
         var avt:Avatar = null;
         var pMC:MovieClip = null;
         var intStateO:int = 0;
         var s:String = null;
         var ri:int = 0;
         var aura:Object = null;
         var unm:String = null;
         var stAura:Object = null;
         var tx:* = undefined;
         var ty:* = undefined;
         var i:int = 0;
         var prop:String = "";
         var updated:Object = {};
         var monLeaf:Object = this.world.monTree[MonMapID];
         if(monLeaf != null)
         {
            intStateO = -1;
            if(monLeaf != null && monLeaf.intState != null)
            {
               intStateO = int(monLeaf.intState);
            }
            for(s in monLeafO)
            {
               nam = s;
               val = monLeafO[s];
               updated[nam] = val;
               if(nam.toLowerCase().indexOf("int") > -1)
               {
                  val = Number(val);
               }
               if(nam == "react")
               {
                  val = val.split(",");
                  ri = 0;
                  while(ri < val.length)
                  {
                     val[ri] = Number(val[ri]);
                     ri++;
                  }
               }
               monLeaf[nam] = val;
            }
            prop = "";
            for(prop in updated)
            {
               nam = prop;
               val = updated[prop];
               if(nam.toLowerCase().indexOf("evt:") < 0)
               {
                  Mon = this.world.getMonster(MonMapID);
                  if(Mon != null)
                  {
                     if(nam.toLowerCase().indexOf("hp") > -1)
                     {
                        if(Mon != null && Mon.objData != null)
                        {
                           val = Number(val);
                           Mon.objData[prop] = val;
                           if(this.world.myAvatar.target == Mon)
                           {
                              this.world.updatePortrait(Mon);
                           }
                           if(this.world.objLock != null && (nam == "intHP" && val <= 0))
                           {
                              ++this.world.intKillCount;
                              this.world.updatePadNames();
                           }
                           if(Mon.objData != null && Boolean("boolean"))
                           {
                              if(Mon.objData.strFrame == this.world.strFrame)
                              {
                                 if(val <= 0)
                                 {
                                    if(Boolean(this.bAnalyzer) && (Boolean(targets) || Boolean(updated["targets"].length > 0)))
                                    {
                                       if(Boolean(this.bAnalyzer.isRunning))
                                       {
                                          for each(unm in targets ? targets : updated["targets"])
                                          {
                                             if(this.world.myAvatar.objData.strUsername.toLowerCase() == unm.toLowerCase())
                                             {
                                                this.bAnalyzer.addKill();
                                             }
                                          }
                                       }
                                    }
                                    if(Boolean(this.litePreference.data.bDisSelfMAnim) && Boolean(this.world.myAvatar.target != null) && this.world.myAvatar.target.dataLeaf.intState == 0)
                                    {
                                       this.world.cancelTarget();
                                    }
                                    Mon.pMC.stopWalking();
                                    this.world.removeAuraFX(Mon.pMC,"all");
                                    Mon.pMC.die();
                                    for each(aura in monLeaf.auras)
                                    {
                                       aura.casterType = null;
                                       aura.casterId = null;
                                    }
                                    monLeaf.auras = [];
                                    monLeaf.targets = {};
                                    Mon.target = null;
                                    if("eventTrigger" in MovieClip(this.world.map))
                                    {
                                       this.world.map.eventTrigger({
                                          "cmd":"monDeath",
                                          "args":MonMapID,
                                          "targets":monLeafO.targets
                                       });
                                    }
                                    if(this.world.myAvatar.dataLeaf.targets[Mon.objData.MonMapID] != null)
                                    {
                                       delete this.world.myAvatar.dataLeaf.targets[Mon.objData.MonMapID];
                                    }
                                    if(this.world.strMapName == "trickortreat" && this.world.strFrame == "Enter")
                                    {
                                       this.world.TrickOrTreatMonsterDead = true;
                                       this.world.loadPlayerNPC();
                                    }
                                    if(this.world.strMapName == "caroling" && this.world.strFrame == "Enter")
                                    {
                                       this.world.CarolingMonsterKillCount += 1;
                                       if(this.world.CarolingMonsterKillCount >= 5)
                                       {
                                          this.world.setTarget(null);
                                          this.world.loadPlayerNPC();
                                       }
                                    }
                                 }
                              }
                           }
                        }
                     }
                     if(nam.toLowerCase().indexOf("state") > -1)
                     {
                        if(Mon != null && Mon.objData != null)
                        {
                           val = Number(val);
                           Mon.objData[prop] = val;
                           if(val != 2)
                           {
                              for each(stAura in Mon.dataLeaf.auras)
                              {
                                 stAura.casterType = null;
                                 stAura.casterId = null;
                              }
                              Mon.dataLeaf.auras = [];
                           }
                           if(Mon.objData.strFrame != null && Mon.objData.strFrame == this.world.strFrame)
                           {
                              if(val == 1 && Mon.pMC != null && (Mon.pMC.x != Mon.pMC.ox || Mon.pMC.y != Mon.pMC.oy))
                              {
                                 Mon.pMC.walkTo(Mon.pMC.ox,Mon.pMC.oy,this.world.WALKSPEED);
                              }
                           }
                           if(val != 2)
                           {
                              monLeaf.targets = {};
                           }
                        }
                     }
                     if(nam.toLowerCase().indexOf("dx") > -1)
                     {
                        val = Number(val);
                        if(Mon.objData != null && Mon.objData.strFrame != null && Mon.objData.strFrame == this.world.strFrame)
                        {
                           tx = int(this.world.monTree[MonMapID].dx);
                           ty = int(this.world.monTree[MonMapID].dy);
                           Mon.pMC.walkTo(tx,ty,this.world.WALKSPEED);
                        }
                     }
                  }
               }
            }
         }
      }
      
      public function userTreeWrite(uoName:String, uoLeafO:Object) : void
      {
         var typ:String = null;
         var nam:String = null;
         var val:* = undefined;
         var monAvt:Avatar = null;
         var avtAvt:Avatar = null;
         var Mon:Avatar = null;
         var avt:Avatar = null;
         var pMC:MovieClip = null;
         var s:String = null;
         var intStateO:int = 0;
         var i:int = 0;
         var prop:String = "";
         var updated:Object = {};
         var uoLeafSet:Object = {};
         var uoLeaf:Object = this.world.uoTree[uoName.toLowerCase()];
         avt = this.world.getAvatarByUserName(uoName);
         for(s in uoLeafO)
         {
            nam = s;
            val = uoLeafO[s];
            if(nam.toLowerCase().indexOf("int") > -1 || nam.toLowerCase() == "tx" || nam.toLowerCase() == "ty" || nam.toLowerCase() == "sp" || nam.toLowerCase() == "pvpTeam")
            {
               val = int(val);
            }
            if(this.sfcSocial && uoLeaf != null && this.world.myAvatar.dataLeaf != null && nam.toLowerCase() == "inthp" && uoName.toLowerCase() != this.sfc.myUserName && uoLeaf.strFrame == this.world.myAvatar.dataLeaf.strFrame && (!this.world.bPvP || uoLeaf.pvpTeam == this.world.myAvatar.dataLeaf.pvpTeam) && val > 0 && this.world.getFirstHeal() != null)
            {
               if(val <= uoLeaf.intHP && (uoLeaf.intHP - val >= uoLeaf.intHPMax * 0.15 || val <= uoLeaf.intHPMax * 0.5))
               {
                  try
                  {
                     avt.pMC.showHealIcon();
                  }
                  catch(e:Error)
                  {
                     trace("trees.showHealIcon > " + e);
                  }
               }
               if(val > Math.round(uoLeaf.intHPMax * 0.5))
               {
                  try
                  {
                     if(avt.pMC.getChildByName("HealIconMC") != null)
                     {
                        MovieClip(avt.pMC.getChildByName("HealIconMC")).fClose();
                     }
                  }
                  catch(e:Error)
                  {
                     trace("trees.hideHealIcon > " + e);
                  }
               }
            }
            if(nam.toLowerCase() == "afk")
            {
               val = val == "true";
            }
            updated[nam] = val;
            uoLeafSet[nam] = val;
         }
         intStateO = -1;
         if(this.world.uoTree[uoName.toLowerCase()] != null)
         {
            intStateO = int(this.world.uoTree[uoName.toLowerCase()].intState);
         }
         this.world.uoTreeLeafSet(uoName,uoLeafSet);
         uoLeaf = this.world.uoTree[uoName.toLowerCase()];
         if(this.world.isPartyMember(uoName))
         {
            this.world.updatePartyFrame({"unm":uoLeaf.strUsername});
         }
         prop = "";
         for(prop in updated)
         {
            val = updated[prop];
            if(prop.toLowerCase() == "strframe")
            {
               this.world.manageAreaUser(uoName,"+");
               if(updated[prop] != this.world.strFrame)
               {
                  pMC = this.world.getMCByUserID(this.world.getUserByName(uoName).getId());
                  if(pMC != null && pMC.stage != null)
                  {
                     if(this.world.bPvP)
                     {
                        pMC.px = updated.px;
                        pMC.py = updated.py;
                        pMC.mvtd = updated.mvtd;
                        pMC.mvts = updated.mvts;
                        pMC.sp = updated.sp;
                        pMC.walkTo(updated.tx,updated.ty,updated.sp);
                     }
                     pMC.pAV.hideMC();
                     if(pMC.pAV == this.world.myAvatar.target)
                     {
                        this.world.setTarget(null);
                     }
                  }
               }
               else if(updated.sp != null)
               {
                  pMC = this.world.getMCByUserID(this.world.getUserByName(uoName).getId());
                  if(pMC != null)
                  {
                     pMC.walkTo(updated.tx,updated.ty,updated.sp);
                  }
               }
               else
               {
                  this.world.objectByID(uoLeaf.entID);
               }
            }
            if(prop.toLowerCase() == "sp")
            {
               if(updated.strFrame == this.world.strFrame)
               {
               }
            }
            if(avt != null)
            {
               if(prop.toLowerCase().indexOf("inthp") > -1 || prop.toLowerCase().indexOf("intmp") > -1)
               {
                  val = Number(val);
                  if(avt.objData != null)
                  {
                     avt.objData[prop] = val;
                  }
                  if(avt.isMyAvatar || this.world.myAvatar.target == avt)
                  {
                     this.world.updatePortrait(avt);
                  }
                  if(avt.isMyAvatar)
                  {
                     this.world.updateActBar();
                  }
                  if(avt.pMC != null && this.world.showHPBar)
                  {
                     avt.pMC.updateHPBar();
                  }
               }
               if(avt.isMyAvatar)
               {
                  if(prop.toLowerCase().indexOf("intsp") > -1)
                  {
                     val = Number(val);
                     if(avt.objData != null)
                     {
                        avt.objData[prop] = val;
                     }
                     if(avt.isMyAvatar || this.world.myAvatar.target == avt)
                     {
                        this.world.updatePortrait(avt);
                     }
                     if(avt.isMyAvatar)
                     {
                        this.world.updateActBar();
                     }
                     if(avt.pMC != null && this.world.showHPBar)
                     {
                        avt.pMC.updateHPBar();
                     }
                  }
               }
               if(prop.toLowerCase().indexOf("intlevel") > -1)
               {
                  val = Number(val);
                  if(avt.objData != null)
                  {
                     avt.objData[prop] = val;
                     if(!avt.isMyAvatar && this.world.myAvatar.target == avt)
                     {
                        this.showPortraitBox(avt,this.ui.mcPortraitTarget);
                     }
                  }
               }
               if(prop.toLowerCase().indexOf("intstate") > -1)
               {
                  val = int(val);
                  if(avt.objData != null && this.world.uoTree[uoName.toLowerCase()].strFrame == this.world.strFrame)
                  {
                     if(val == 1 && intStateO == 0)
                     {
                        avt.pMC.gotoAndStop("Idle");
                        avt.pMC.scale(this.world.SCALE);
                     }
                     if(val == 1 && intStateO == 2)
                     {
                        if("eventTrigger" in MovieClip(this.world.map))
                        {
                        }
                     }
                  }
                  if(avt.objData != null)
                  {
                     avt.objData[prop] = val;
                  }
                  if(val == 0 && this.world.uoTree[uoName.toLowerCase()].strFrame == this.world.strFrame && avt.pMC != null)
                  {
                     avt.pMC.stopWalking();
                     avt.pMC.mcChar.gotoAndPlay("Feign");
                     this.world.removeAuraFX(avt.pMC,"all");
                     if(avt.pMC.getChildByName("HealIconMC") != null)
                     {
                        MovieClip(avt.pMC.getChildByName("HealIconMC")).fClose();
                     }
                     if(avt.isMyAvatar)
                     {
                        this.world.cancelAutoAttack();
                        this.world.actionReady = false;
                        this.world.bitWalk = false;
                        this.world.map.transform.colorTransform = this.world.deathCT;
                        this.world.CHARS.transform.colorTransform = this.world.deathCT;
                        avt.pMC.transform.colorTransform = this.world.defaultCT;
                        this.world.showResCounter();
                     }
                  }
                  if(val != 2)
                  {
                     uoLeaf.targets = {};
                  }
               }
               if(prop.toLowerCase().indexOf("afk") > -1)
               {
                  if(avt.pMC != null)
                  {
                     avt.pMC.updateName();
                  }
               }
               if(prop == "showCloak")
               {
                  if(avt.pMC != null)
                  {
                     avt.pMC.setCloakVisibility(val);
                  }
               }
               if(prop == "showHelm")
               {
                  if(avt.pMC != null)
                  {
                     avt.pMC.setHelmVisibility(val);
                  }
               }
               if(prop.toLowerCase().indexOf("cast") > -1)
               {
                  if(avt.pMC != null)
                  {
                     if(val.t > -1)
                     {
                        avt.pMC.stopWalking();
                        avt.pMC.queueAnim("Use");
                     }
                     else
                     {
                        avt.pMC.endAction();
                        if(avt == this.world.myAvatar)
                        {
                           this.ui.mcCastBar.fClose();
                        }
                     }
                  }
               }
            }
         }
      }
      
      public function doAnim(anim:Object, isProc:Boolean = false, dur:* = null) : void
      {
         var anims:Array = null;
         var animIndex:uint = 0;
         var animStr:String = null;
         var pMC:MovieClip = null;
         var cLeaf:Object = null;
         var tLeaf:Object = null;
         var tAvt:Avatar = null;
         var cAvt:Avatar = null;
         var aura:Object = null;
         var buffer:* = undefined;
         var xBuffer:* = undefined;
         var yBuffer:* = undefined;
         var animString:String = null;
         var i:int = 0;
         var cTyp:String = "";
         var cID:int = -1;
         var tTyp:String = "";
         var tID:int = -1;
         var tAvts:Array = [];
         var tInfA:Array = [];
         var strF:String = "";
         cAvt = null;
         tAvt = null;
         var cReg:Point = new Point(0,0);
         var tReg:Point = new Point(0,0);
         if(anim.cInf != null && anim.tInf != null)
         {
            cTyp = String(anim.cInf.split(":")[0]);
            cID = int(anim.cInf.split(":")[1]);
            switch(cTyp)
            {
               case "p":
                  cAvt = this.world.getAvatarByUserID(cID);
                  cLeaf = this.world.getUoLeafById(cID);
                  break;
               case "m":
                  cAvt = this.world.getMonster(cID);
                  cLeaf = this.world.monTree[cID];
                  if(anim.msg != null)
                  {
                     if(anim.msg.indexOf("<mon>") > -1)
                     {
                        anim.msg = anim.msg.split("<mon>").join(cAvt.objData.strMonName);
                     }
                     this.addUpdate(anim.msg);
                  }
            }
            tInfA = anim.tInf.split(",");
            for(i = 0; i < tInfA.length; i++)
            {
               tTyp = String(tInfA[i].split(":")[0]);
               tID = int(tInfA[i].split(":")[1]);
               switch(tTyp)
               {
                  case "p":
                     tAvt = this.world.getAvatarByUserID(tID);
                     tLeaf = this.world.getUoLeafById(tID);
                     break;
                  case "m":
                     tAvt = this.world.getMonster(tID);
                     tLeaf = this.world.monTree[tID];
               }
               tAvts.push(tAvt);
            }
            if(tAvts[0] != null)
            {
               tAvt = tAvts[0];
            }
            if(tAvt != null)
            {
               tLeaf = tAvt.dataLeaf;
            }
            if(cAvt != null && cAvt.pMC != null && tAvt != null && tAvt.pMC != null && cLeaf != null && tLeaf != null)
            {
               aura = {};
               for each(aura in cLeaf.auras)
               {
                  try
                  {
                     if(aura.cat != null)
                     {
                        if(aura.cat == "stun")
                        {
                           return;
                        }
                        if(aura.cat == "stone")
                        {
                           return;
                        }
                        if(aura.cat == "disabled")
                        {
                           return;
                        }
                     }
                  }
                  catch(e:Error)
                  {
                     trace("doAnim > " + e);
                  }
               }
               animStr = anim.animStr;
               switch(cTyp)
               {
                  case "p":
                     if(cAvt.objData != null)
                     {
                        if(cAvt != this.world.myAvatar)
                        {
                           cAvt.target = tAvt;
                        }
                        strF = String(cLeaf.strFrame);
                        if(strF != null && strF == this.world.strFrame && cLeaf.intState > 0)
                        {
                           if(cAvt != tAvt)
                           {
                              if(tAvt.pMC.x - cAvt.pMC.x >= 0)
                              {
                                 cAvt.pMC.turn("right");
                              }
                              else
                              {
                                 cAvt.pMC.turn("left");
                              }
                           }
                           cAvt.pMC.queueSpFX({
                              "strl":anim.strl,
                              "fx":anim.fx,
                              "avts":tAvts
                           });
                           if(!isNaN(dur))
                           {
                              cAvt.pMC.spellDur = dur;
                           }
                           if(animStr != null)
                           {
                              if(animStr.indexOf(",") > -1)
                              {
                                 animStr = animStr.split(",")[Math.round(Math.random() * (animStr.split(",").length - 1))];
                              }
                              if(animStr != "Thrash" || cAvt.pMC.mcChar.currentLabel != "Thrash")
                              {
                                 cAvt.pMC.queueAnim(animStr);
                              }
                              if(isProc && Boolean(cAvt.pMC.mcChar.weapon.mcWeapon.isProc))
                              {
                                 cAvt.pMC.mcChar.weapon.mcWeapon.gotoAndPlay("Proc");
                              }
                           }
                        }
                     }
                     break;
                  case "m":
                     if(cAvt.objData != null)
                     {
                        if(cAvt != this.world.myAvatar)
                        {
                           cAvt.target = tAvt;
                        }
                        strF = String(cLeaf.strFrame);
                        cReg = cAvt.pMC.mcChar.localToGlobal(new Point(0,0));
                        tReg = tAvt.pMC.mcChar.localToGlobal(new Point(0,0));
                        cReg = this.world.CHARS.globalToLocal(cReg);
                        tReg = this.world.CHARS.globalToLocal(tReg);
                        if(strF != null && strF == this.world.strFrame && cLeaf.intState > 0)
                        {
                           if(cAvt != tAvt)
                           {
                              if(tReg.x - cReg.x >= 0)
                              {
                                 cAvt.pMC.turn("right");
                              }
                              else
                              {
                                 cAvt.pMC.turn("left");
                              }
                           }
                           if(anim.fx != "p" && anim.fx != "w" && anim.fx != "" && (Math.abs(cReg.x - tReg.x) * this.world.SCALE > 160 || Math.abs(cReg.y - tReg.y) * this.world.SCALE > 15))
                           {
                              buffer = int(110 + Math.random() * 50);
                              xBuffer = tReg.x - cReg.x >= 0 ? -buffer : buffer;
                              xBuffer = int(xBuffer * this.world.SCALE);
                              if(tReg.x + xBuffer < 0 || tReg.x + xBuffer > 960)
                              {
                                 xBuffer *= -1;
                              }
                              buffer = int(Math.random() * 30 - 15);
                              yBuffer = tReg.y - cReg.y >= 0 ? -buffer : buffer;
                              yBuffer = int(yBuffer * this.world.SCALE);
                              cAvt.pMC.walkTo(tReg.x + xBuffer,tReg.y + yBuffer,32);
                           }
                           if(cAvt.pMC.spFX != null)
                           {
                              cAvt.pMC.spFX.avt = cAvt.target;
                           }
                           cReg = cAvt.pMC.mcChar.localToGlobal(new Point(0,0));
                           tReg = tAvt.pMC.mcChar.localToGlobal(new Point(0,0));
                           if(cAvt != tAvt)
                           {
                              if(tReg.x - cReg.x >= 0)
                              {
                                 cAvt.pMC.turn("right");
                              }
                              else
                              {
                                 cAvt.pMC.turn("left");
                              }
                           }
                           if(this.litePreference.data.bDisMonAnim)
                           {
                              return;
                           }
                           if(animStr.length > 1)
                           {
                              if(animStr.indexOf(",") > -1)
                              {
                                 if(this.world.objExtra["bChar"] == 1)
                                 {
                                    animString = cAvt.pMC.Animation;
                                    MovieClip(cAvt.pMC.getChildAt(1)).gotoAndPlay(animString);
                                 }
                                 else
                                 {
                                    anims = animStr.split(",");
                                    animIndex = Math.round(Math.random() * (anims.length - 1));
                                    MovieClip(cAvt.pMC.getChildAt(1)).gotoAndPlay(anims[animIndex]);
                                 }
                              }
                              else if(this.world.objExtra["bChar"] == 1)
                              {
                                 animString = cAvt.pMC.Animation;
                                 MovieClip(cAvt.pMC.getChildAt(1)).gotoAndPlay(animString);
                              }
                              else
                              {
                                 MovieClip(cAvt.pMC.getChildAt(1)).gotoAndPlay(animStr);
                              }
                           }
                        }
                     }
               }
            }
         }
      }
      
      public function key_StageLogin(e:KeyboardEvent) : *
      {
         if(e.target == stage)
         {
            if(e.keyCode == Keyboard.ENTER)
            {
               stage.focus = this.mcLogin.ni;
            }
         }
      }
      
      public function hasBankItem() : Boolean
      {
         var item:* = undefined;
         for each(item in this.world.myAvatar.items)
         {
            if(item.sMeta != null && item.sMeta.length > 0 && item.sMeta.toLowerCase().indexOf("bank") > -1)
            {
               return true;
            }
         }
         return false;
      }
      
      public function key_StageGame(e:KeyboardEvent) : *
      {
         var mons:Array = null;
         var cacheFrame:String = null;
         var tgt:uint = 0;
         var cameraToolMC:MovieClip = null;
         var worldCameraMC:MovieClip = null;
         var _cd:int = 0;
         if(Boolean(e.target) && e.target.name == "btnSetKeybindActive")
         {
            return;
         }
         if(!(e.target is TextField || e.currentTarget is TextField))
         {
            if(e.keyCode == Keyboard.ENTER || String.fromCharCode(e.charCode) == "/")
            {
               this.chatF.openMsgEntry();
            }
            if(this.isNumpadKey(e.keyCode))
            {
               e.keyCode -= 48;
            }
            if(e.keyCode == this.litePreference.data.keys["Target Random Monster"])
            {
               if(!this.isInputFocused())
               {
                  mons = this.world.getMonstersByCell(this.world.strFrame);
                  cacheFrame = this.world.strFrame;
                  if(mons.length > 0)
                  {
                     tgt = Math.round(Math.random() * (mons.length - 1));
                     while(mons.length > 1 && !mons[tgt] && !mons[tgt].pMC && mons[tgt].dataLeaf.intState == 0 && this.world.myAvatar.target == mons[tgt])
                     {
                        if(this.world.strFrame != cacheFrame)
                        {
                           break;
                        }
                        tgt = Math.round(Math.random() * (mons.length - 1));
                     }
                     if(this.world.strFrame == cacheFrame)
                     {
                        if(Boolean(mons[tgt] && mons[tgt].pMC) && Boolean(mons[tgt].dataLeaf.strFrame == this.world.strFrame) && mons[tgt].dataLeaf.intState != 0)
                        {
                           this.world.setTarget(mons[tgt]);
                        }
                     }
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Travel Menu\'s Travel"])
            {
               if(!this.isInputFocused())
               {
                  if(this.ui.getChildByName("mcTravelMenu"))
                  {
                     (this.ui.getChildByName("mcTravelMenu") as MovieClip).dispatchTravel();
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Camera Tool"])
            {
               if(!this.isInputFocused())
               {
                  if(Boolean(stage.getChildByName("worldCameraMC")) || Boolean(getChildByName("cameraToolMC")))
                  {
                     return;
                  }
                  cameraToolMC = new cameraTool(this);
                  cameraToolMC.name = "cameraToolMC";
                  cameraToolMC.x = -7;
                  addChild(cameraToolMC);
                  this.world.visible = false;
               }
            }
            if(e.keyCode == this.litePreference.data.keys["World Camera"])
            {
               if(!this.isInputFocused())
               {
                  if(Boolean(stage.getChildByName("worldCameraMC")) || Boolean(getChildByName("cameraToolMC")))
                  {
                     if(stage.getChildByName("worldCameraMC"))
                     {
                        MovieClip(stage.getChildByName("worldCameraMC")).dispatchExit();
                     }
                     return;
                  }
                  worldCameraMC = new worldCamera(this);
                  worldCameraMC.name = "worldCameraMC";
                  stage.addChild(worldCameraMC);
               }
            }
            if(String.fromCharCode(e.charCode) == ">")
            {
               if(!this.isInputFocused())
               {
                  if(this.chatF.pmSourceA[0] != null && this.chatF.pmSourceA[0].length >= 1)
                  {
                     this.chatF.openPMsg(this.chatF.pmSourceA[0]);
                     if(this.intChatMode)
                     {
                        this.ui.mcInterface.ncText.text = "> ";
                     }
                     else
                     {
                        this.ui.mcInterface.te.text = "> ";
                     }
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Inventory"])
            {
               if(!this.isInputFocused())
               {
                  this.ui.mcInterface.mcMenu.toggleInventory();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Bank"] && (this.world.myAvatar.isStaff() || this.hasBankItem()))
            {
               if(!this.isInputFocused())
               {
                  this.world.toggleBank();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Quest Log"])
            {
               if(stage.focus != this.ui.mcInterface.te && stage.focus != this.ui.mcInterface.ncText && stage.focus != this.ui.mcInterface.ncText)
               {
                  this.world.toggleQuestLog();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Friends List"])
            {
               if(!this.isInputFocused())
               {
                  if(this.ui.mcOFrame.isOpen)
                  {
                     this.ui.mcOFrame.fClose();
                  }
                  else
                  {
                     this.world.showFriendsList();
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Character Panel"])
            {
               if(!this.isInputFocused())
               {
                  this.toggleCharpanel("overview");
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Player HP Bar"])
            {
               if(!this.isInputFocused())
               {
                  this.world.toggleHPBar();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Options"])
            {
               if(!this.isInputFocused())
               {
                  if(this.ui.mcPopup.currentLabel == "Option")
                  {
                     this.ui.mcPopup.onClose();
                  }
                  else
                  {
                     this.ui.mcPopup.fOpen("Option");
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Area List"])
            {
               if(!this.isInputFocused())
               {
                  if(!this.ui.mcOFrame.isOpen)
                  {
                     this.world.sendWhoRequest();
                  }
                  else
                  {
                     this.ui.mcOFrame.fClose();
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Jump"])
            {
               if(stage.focus != this.ui.mcInterface.te && stage.focus != this.ui.mcInterface.ncText)
               {
                  this.world.myAvatar.pMC.mcChar.gotoAndPlay("Jump");
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Rest"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  this.world.rest();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Hide Monsters"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  this.world.toggleMonsters();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Hide Players"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  optionHandler.cmd(MovieClip(this),"Hide Players");
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Cancel Target"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  if(this.cancelTargetTimer.running)
                  {
                     return;
                  }
                  if(this.world.autoActionTimer != null && this.world.autoActionTimer.running)
                  {
                     this.world.cancelAutoAttack();
                     this.world.myAvatar.pMC.mcChar.gotoAndStop("Idle");
                  }
                  if(this.world.myAvatar.target != null)
                  {
                     this.world.setTarget(null);
                  }
                  if(!this.cancelTargetTimer.hasEventListener(TimerEvent.TIMER))
                  {
                     this.cancelTargetTimer.addEventListener(TimerEvent.TIMER,this.hasCanceledAlready,false,0,true);
                  }
                  _cd = int(parseInt(this.world.getActionByRef(String(this.world.actionMap[0])).cd));
                  this.cancelTargetTimer.delay = _cd < 2000 ? 2000 : _cd;
                  this.cancelTargetTimer.start();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Hide UI"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  optionHandler.cmd(MovieClip(this),"Hide UI");
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Battle Analyzer"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  optionHandler.cmd(MovieClip(this),"Battle Analyzer");
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Decline All Drops"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  optionHandler.cmd(MovieClip(this),"Decline All Drops");
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Stats Overview"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  this.toggleStatspanel();
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Battle Analyzer Toggle"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  if(this.bAnalyzer)
                  {
                     this.bAnalyzer.toggle();
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Custom Drops UI"])
            {
               if(e.target != this.ui.mcInterface.te && e.target != this.ui.mcInterface.ncText)
               {
                  if(Boolean(this.ui.mcPortrait.iconDrops) && Boolean(this.ui.mcPortrait.iconDrops.visible))
                  {
                     this.ui.mcPortrait.iconDrops.dispatchEvent(new MouseEvent(MouseEvent.CLICK));
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["@ Debugger - Cell Menu"])
            {
               if(Boolean(this.ui && this.ui.mcInterface && this.ui.mcInterface.te) && Boolean(e.target != this.ui.mcInterface.te) && e.target != this.ui.mcInterface.ncText)
               {
                  if(this.cMenuUI)
                  {
                     this.cMenuUI.toggle();
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["@ Debugger - Packet Logger"])
            {
               if(Boolean(this.ui && this.ui.mcInterface && this.ui.mcInterface.te) && Boolean(e.target != this.ui.mcInterface.te) && e.target != this.ui.mcInterface.ncText)
               {
                  if(Boolean(this.pLoggerUI) && Boolean(this.litePreference.data.dOptions["debugPacket"]))
                  {
                     this.pLoggerUI.visible = !this.pLoggerUI.visible;
                     this.pLoggerUI.toggle();
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Dash"])
            {
               if(Boolean(this.ui && this.ui.mcInterface && this.ui.mcInterface.te) && Boolean(e.target != this.ui.mcInterface.te) && e.target != this.ui.mcInterface.ncText)
               {
                  if(!this.world.uoTree[this.world.myAvatar.pnm].sta.$dsh)
                  {
                     this.world.uoTree[this.world.myAvatar.pnm].sta.$dsh = 100;
                  }
                  if(this.world.myAvatar.dataLeaf.intSP >= this.world.uoTree[this.world.myAvatar.pnm].sta.$dsh)
                  {
                     this.pDash = true;
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Outfits"])
            {
               if(Boolean(this.ui && this.ui.mcInterface && this.ui.mcInterface.te) && Boolean(e.target != this.ui.mcInterface.te) && e.target != this.ui.mcInterface.ncText)
               {
                  if(!this.getInterface("outfitSets"))
                  {
                     this.toggleOutfits();
                  }
               }
            }
            if(e.keyCode == this.litePreference.data.keys["Friendships UI"])
            {
               if(Boolean(this.ui && this.ui.mcInterface && this.ui.mcInterface.te) && Boolean(e.target != this.ui.mcInterface.te) && e.target != this.ui.mcInterface.ncText)
               {
                  if(!this.getInterface("Friendships UI"))
                  {
                     this.showFriendshipUI();
                  }
               }
            }
         }
      }
      
      private function hasCanceledAlready(e:TimerEvent) : void
      {
         this.cancelTargetTimer.removeEventListener(TimerEvent.TIMER,this.hasCanceledAlready);
         stage.focus = null;
      }
      
      public function key_TextLogin(e:KeyboardEvent) : *
      {
         if(e.target != stage)
         {
            if(e.keyCode == Keyboard.ENTER)
            {
               this.onLoginClick(null);
            }
         }
      }
      
      public function key_ChatEntry(e:KeyboardEvent) : *
      {
         if(e.keyCode == Keyboard.ENTER)
         {
            this.chatF.submitMsg(this.intChatMode ? this.ui.mcInterface.ncText.text : this.ui.mcInterface.te.text,this.chatF.chn.cur.typ,this.chatF.pmNm);
         }
         if(e.keyCode == Keyboard.ESCAPE)
         {
            this.chatF.closeMsgEntry();
         }
      }
      
      public function talk(params:*) : *
      {
         if(params.accept)
         {
            this.chatF.submitMsg(params.emote1,"emote",this.sfc.myUserName);
         }
         else
         {
            this.chatF.submitMsg(params.emote2,"emote",this.sfc.myUserName);
         }
      }
      
      public function isNumpadKey(code:uint) : Boolean
      {
         return code >= 96 && code <= 105;
      }
      
      public function key_actBar(e:KeyboardEvent) : *
      {
         var actMapID:int = 0;
         var action:String = null;
         var actionObj:* = undefined;
         if(Boolean(e.target) && e.target.name == "btnSetKeybindActive")
         {
            return;
         }
         if(!this.isInputFocused())
         {
            if(this.isNumpadKey(e.keyCode))
            {
               e.keyCode -= 48;
            }
            switch(e.keyCode)
            {
               case this.litePreference.data.keys["Auto Attack"]:
                  actMapID = 0;
                  if(this.world.actionMap[actMapID] != null)
                  {
                     actionObj = this.world.getActionByRef(String(this.world.actionMap[actMapID]));
                     if(actionObj.auto != null && actionObj.auto == true)
                     {
                        this.world.approachTarget();
                     }
                     else
                     {
                        this.world.testAction(actionObj);
                     }
                  }
                  return;
               case this.litePreference.data.keys["Skill 1"]:
                  actMapID = 1;
                  if(this.world.actionMap[actMapID] != null)
                  {
                     actionObj = this.world.getActionByRef(String(this.world.actionMap[actMapID]));
                     if(actionObj.isOK)
                     {
                        this.world.testAction(actionObj);
                     }
                  }
                  break;
               case this.litePreference.data.keys["Skill 2"]:
                  actMapID = 2;
                  if(this.world.actionMap[actMapID] != null)
                  {
                     actionObj = this.world.getActionByRef(String(this.world.actionMap[actMapID]));
                     if(actionObj.isOK)
                     {
                        this.world.testAction(actionObj);
                     }
                  }
                  break;
               case this.litePreference.data.keys["Skill 3"]:
                  actMapID = 3;
                  if(this.world.actionMap[actMapID] != null)
                  {
                     actionObj = this.world.getActionByRef(String(this.world.actionMap[actMapID]));
                     if(actionObj.isOK)
                     {
                        this.world.testAction(actionObj);
                     }
                  }
                  break;
               case this.litePreference.data.keys["Skill 4"]:
                  actMapID = 4;
                  if(this.world.actionMap[actMapID] != null)
                  {
                     actionObj = this.world.getActionByRef(String(this.world.actionMap[actMapID]));
                     if(actionObj.isOK)
                     {
                        this.world.testAction(actionObj);
                     }
                  }
                  break;
               case this.litePreference.data.keys["Skill 5"]:
                  actMapID = 5;
                  if(this.world.actionMap[actMapID] != null)
                  {
                     actionObj = this.world.getActionByRef(String(this.world.actionMap[actMapID]));
                     if(actionObj.isOK)
                     {
                        this.world.testAction(actionObj);
                     }
                  }
            }
         }
      }
      
      public function isInputFocused() : Boolean
      {
         return stage.focus != null && "text" in stage.focus;
      }
      
      public function getKeyboardDict() : Dictionary
      {
         var updateName:String = null;
         var keyDescription:XML = describeType(Keyboard);
         var keyNames:XMLList = keyDescription.constant.@name;
         var keyboardDict:Dictionary = new Dictionary();
         var len:int = keyNames.length();
         for(var i:int = 0; i < len; i++)
         {
            updateName = keyNames[i];
            if(keyNames[i].indexOf("NUMBER_") > -1 || keyNames[i].indexOf("STRING_") > -1 || keyNames[i].indexOf("KEYNAME_") > -1)
            {
               updateName = keyNames[i].split("_")[1];
            }
            keyboardDict[Keyboard[keyNames[i]]] = updateName;
         }
         return keyboardDict;
      }
      
      public function decHex(val:*) : *
      {
         return val.toString(16);
      }
      
      public function hexDec(val:*) : *
      {
         return parseInt(val,16);
      }
      
      public function modColor(col:*, amt:*, op:*) : String
      {
         var a:* = undefined;
         var b:* = undefined;
         var c:* = undefined;
         var out:* = "";
         for(var i:* = 0; i < 3; i++)
         {
            a = this.hexDec(col.substr(i * 2,2));
            b = this.hexDec(amt.substr(i * 2,2));
            switch(op)
            {
               case "-":
               case "+":
                  c = a + b;
                  if(c > 255)
                  {
                     c = 255;
                  }
                  c = this.decHex(c);
            }
            c = a - b;
            if(c < 0)
            {
               c = 0;
            }
            c = this.decHex(c);
            out += String(c.length < 2 ? "0" + c : c);
         }
         return out;
      }
      
      internal function replaceString(str:String, find:String, replace:String) : String
      {
         var startIndex:Number = 0;
         var oldIndex:Number = 0;
         var newString:String = "";
         while(true)
         {
            startIndex = str.indexOf(find,startIndex);
            if(startIndex == -1)
            {
               break;
            }
            newString += str.substring(oldIndex,startIndex) + replace;
            oldIndex = startIndex = startIndex + find.length;
         }
         return newString == "" ? str : newString;
      }
      
      public function stripWhite(str:String) : String
      {
         str = str.split("\r").join("");
         str = str.split("\t").join("");
         return str.split(" ").join("");
      }
      
      public function stripWhiteStrict(str:String) : String
      {
         str = this.stripWhite(str);
         for(var i:int = 0; i < this.chatF.strictComparisonChars.length; i++)
         {
            str = str.split(this.chatF.strictComparisonChars.substr(i,1)).join("");
         }
         return str;
      }
      
      public function stripWhiteStrictB(str:String) : String
      {
         str = this.stripWhite(str);
         for(var i:int = 0; i < this.chatF.strictComparisonCharsB.length; i++)
         {
            str = str.split(this.chatF.strictComparisonCharsB.substr(i,1)).join("");
         }
         return str;
      }
      
      public function stripMarks(str:String) : String
      {
         for(var i:int = 0; i < this.chatF.markChars.length; i++)
         {
            str = str.split(this.chatF.markChars.substr(i,1)).join("");
         }
         return str;
      }
      
      public function stripDuplicateVowels(s:String) : String
      {
         s = s.replace(this.chatF.regExpA,"a");
         s = s.replace(this.chatF.regExpE,"e");
         s = s.replace(this.chatF.regExpI,"i");
         s = s.replace(this.chatF.regExpO,"o");
         s = s.replace(this.chatF.regExpU,"u");
         return s.replace(this.chatF.regExpSPACE," ");
      }
      
      public function maskStringBetween(input:String, indeces:Array) : String
      {
         var j:int = 0;
         var i:int = 0;
         var s:String = "";
         if(indeces.length > 0 && indeces.length % 2 == 0)
         {
            j = 0;
            for(i = 0; i < input.length; i++)
            {
               if(i >= indeces[j] && i <= indeces[j + 1])
               {
                  if(input.charAt(i) == " ")
                  {
                     s += " ";
                  }
                  else
                  {
                     s += "*";
                  }
                  if(i == indeces[j + 1])
                  {
                     j += 2;
                  }
               }
               else
               {
                  s += input.charAt(i);
               }
            }
         }
         else
         {
            trace("");
            trace("Utility.maskStringBetween() > Malformed indeces array.  Must be in format [start,end, start,end, etc]");
            trace("");
         }
         return s;
      }
      
      public function arraySort(a:String, b:String) : int
      {
         if(a > b)
         {
            return 1;
         }
         if(a < b)
         {
            return -1;
         }
         return 0;
      }
      
      public function convertBubbleText(str:String) : String
      {
         var s:String = null;
         s = this.world.myAvatar.objData.strUsername;
         if(str.indexOf("@name"))
         {
            str = str.split("@name").join(s);
         }
         s = String(this.world.myAvatar.objData.intLevel);
         if(str.indexOf("@level"))
         {
            str = str.split("@level").join(s);
         }
         s = this.world.myAvatar.objData.strClassName;
         if(str.indexOf("@class"))
         {
            str = str.split("@class").join(s);
         }
         s = this.world.myAvatar.objData.strGender.toLowerCase() == "m" ? "Mr." : "Mrs.";
         if(str.indexOf("@prefix"))
         {
            str = str.split("@prefix").join(s);
         }
         s = this.world.myAvatar.objData.strGender.toLowerCase() == "m" ? "He" : "She";
         if(str.indexOf("@He"))
         {
            str = str.split("@prefix").join(s);
         }
         s = this.world.myAvatar.objData.strGender.toLowerCase() == "m" ? "Him" : "Her";
         if(str.indexOf("@Him"))
         {
            str = str.split("@prefix").join(s);
         }
         s = this.world.myAvatar.objData.strGender.toLowerCase() == "m" ? "His" : "Her";
         if(str.indexOf("@His"))
         {
            str = str.split("@prefix").join(s);
         }
         s = this.world.myAvatar.objData.strGender.toLowerCase() == "m" ? "he" : "she";
         if(str.indexOf("@he"))
         {
            str = str.split("@prefix").join(s);
         }
         s = this.world.myAvatar.objData.strGender.toLowerCase() == "m" ? "him" : "her";
         if(str.indexOf("@him"))
         {
            str = str.split("@prefix").join(s);
         }
         s = this.world.myAvatar.objData.strGender.toLowerCase() == "m" ? "his" : "her";
         if(str.indexOf("@his"))
         {
            str = str.split("@prefix").join(s);
         }
         return str;
      }
      
      public function strToProperCase(str:String) : String
      {
         return str.slice(0,1).toUpperCase() + str.slice(1,str.length).toLowerCase();
      }
      
      public function strSetCharAt(str:String, index:int, strChar:String) : String
      {
         return str.substring(0,index) + strChar + str.substring(index + 1,str.length);
      }
      
      public function strNumWithCommas(num:Number) : String
      {
         var s:String = "";
         var n:String = num.toString();
         var i:* = 0;
         var j:int = 0;
         for(i = int(n.length - 1); i > -1; i--)
         {
            if(j == 3)
            {
               j = 0;
               s = n.charAt(i) + "," + s;
            }
            else
            {
               s = n.charAt(i) + s;
            }
            j++;
         }
         return s;
      }
      
      public function numToStr(n:Number, decimals:int = 2) : String
      {
         var s:String = n.toString();
         if(s.indexOf(".") == -1)
         {
            s += ".";
         }
         for(var a:Array = s.split("."); a[1].length < decimals; )
         {
            a[1] += "0";
         }
         if(a[1].length > decimals)
         {
            a[1] = a[1].substr(0,decimals);
         }
         if(decimals > 0)
         {
            s = a[0] + "." + a[1];
         }
         else
         {
            s = a[0];
         }
         return s;
      }
      
      public function copyObj(obj:Object) : Object
      {
         var objB:ByteArray = new ByteArray();
         objB.writeObject(obj);
         objB.position = 0;
         return objB.readObject();
      }
      
      public function copyConstructor(obj:*) : *
      {
         var objB:ByteArray = new ByteArray();
         objB.writeObject(obj);
         objB.position = 0;
         return objB.readObject() as Class;
      }
      
      public function distanceO(oa:*, ob:*) : Number
      {
         return Math.sqrt(Math.pow(int(ob.x - oa.x),2) + Math.pow(int(ob.y - oa.y),2));
      }
      
      public function distanceP(ax:*, ay:*, bx:*, by:*) : Number
      {
         return Math.sqrt(Math.pow(bx - ax,2) + Math.pow(by - ay,2));
      }
      
      public function distanceXY(ax:*, ay:*, bx:*, by:*) : Object
      {
         return {
            "dx":bx - ax,
            "dy":by - ay
         };
      }
      
      public function isHouseItem(obj:Object) : Boolean
      {
         return obj.sType == "House" || obj.sType == "Floor Item" || obj.sType == "Wall Item";
      }
      
      internal function validateArmor(item:*) : *
      {
         var i:uint = 0;
         var j:uint = 0;
         var reqIDs:Array = [];
         var reqClass:Object = {};
         var classRank:int = 0;
         var maxRank:int = 10;
         var classOK:Boolean = true;
         var doCheck:Boolean = false;
         var orCheck:Boolean = false;
         var itemID:int = int(item.ItemID);
         switch(itemID)
         {
            case 319:
            case 2083:
               doCheck = true;
               reqIDs = [16,15654,407,20,15651,409];
               break;
            case 409:
               orCheck = true;
               reqIDs = [20,15651];
               break;
            case 408:
               orCheck = true;
               reqIDs = [17,15653];
               break;
            case 410:
               orCheck = true;
               reqIDs = [18,15652];
               break;
            case 407:
               orCheck = true;
               reqIDs = [16,15654];
         }
         if(doCheck)
         {
            for(i = 0; i < reqIDs.length; i++)
            {
               if(this.world.myAvatar.getCPByID(reqIDs[i]) < 302500)
               {
                  classOK = false;
               }
               else
               {
                  classOK = true;
                  if(i < 2)
                  {
                     i = 2;
                  }
                  if(i < 5 && i > 2)
                  {
                     break;
                  }
               }
            }
            return classOK;
         }
         if(orCheck)
         {
            for(j = 0; j < reqIDs.length; j++)
            {
               if(this.world.myAvatar.getCPByID(reqIDs[j]) >= item.iReqCP)
               {
                  return true;
               }
            }
            return false;
         }
         return !(Number(item.iClass) > 0 && this.world.myAvatar.getCPByID(item.iClass) < item.iReqCP);
      }
      
      public function getItemInfoString(obj:Object) : String
      {
         var iRank:int = 0;
         var iSpillCP:* = undefined;
         var iRankRep:int = 0;
         var iSpillRep:* = undefined;
         var HPTgt:* = undefined;
         var TTD:* = undefined;
         var iDPS:* = undefined;
         var iRng:* = undefined;
         var wSPD:* = undefined;
         var wDPS:* = undefined;
         var wDMG:* = undefined;
         var wDMN:* = undefined;
         var wDMX:* = undefined;
         var strItemInfo:* = "<font size=\'14\'><b>" + obj.sName + "</b></font><br>";
         if(!this.validateArmor(obj) && obj.iClass > 0)
         {
            strItemInfo += "<font size=\'11\' color=\'#CC0000\'>";
            iRank = this.getRankFromPoints(obj.iReqCP);
            iSpillCP = obj.iReqCP - this.arrRanks[iRank - 1];
            if(iSpillCP > 0)
            {
               strItemInfo += "Requires " + iSpillCP + " Class Points on " + obj.sClass + ", Rank " + iRank + ".";
            }
            else
            {
               strItemInfo += "Requires " + obj.sClass + ", Rank " + iRank + ".";
            }
            strItemInfo += "</font><br>";
         }
         if(obj.FactionID > 1 && this.world.myAvatar.getRep(obj.FactionID) < obj.iReqRep)
         {
            strItemInfo += "<font size=\'11\' color=\'#CC0000\'>";
            iRankRep = this.getRankFromPoints(obj.iReqRep);
            iSpillRep = obj.iReqRep - this.arrRanks[iRank - 1];
            if(iSpillRep > 0)
            {
               strItemInfo += "Requires " + iSpillRep + " Reputation on " + obj.sFaction + ", Rank " + iRankRep + ".";
            }
            else
            {
               strItemInfo += "Requires " + obj.sFaction + ", Rank " + iRankRep + ".";
            }
            strItemInfo += "</font><br>";
         }
         if(obj.iQSindex >= 0 && this.world.getQuestValue(obj.iQSindex) < int(obj.iQSvalue))
         {
            strItemInfo += "<font size=\'11\' color=\'#CC0000\'>Requires completion of quest \"" + obj.sQuest + "\".</font><br>";
         }
         strItemInfo += "<font color=\'#009900\'><b>" + this.getDisplaysType(obj);
         if(obj.sES != "None" && obj.sES != "co" && obj.sES != "mi")
         {
            if(obj.EnhID > 0)
            {
               strItemInfo += ", Lvl " + obj.EnhLvl;
               if(obj.sES == "Weapon")
               {
                  HPTgt = this.getBaseHPByLevel(obj.EnhLvl);
                  TTD = 20;
                  iDPS = 1;
                  iRng = obj.iRng / 100;
                  wSPD = 2;
                  wDPS = Math.round(HPTgt / TTD * iDPS);
                  wDMG = Math.round(wDPS * wSPD);
                  wDMN = Math.floor(wDMG - wDMG * iRng);
                  wDMX = Math.ceil(wDMG + wDMG * iRng);
                  strItemInfo += "<br>" + wDMN + " - " + wDMX + " " + obj.sElmt;
               }
            }
            else
            {
               strItemInfo += " Design";
            }
         }
         obj.sDesc = obj.sDesc.replace(this.regExLineSpace,"\n");
         return strItemInfo + ("</b></font>" + (this.litePreference.data.bDebugger ? "Item ID: " + obj.ItemID + "<br>" : "") + "<br>" + obj.sDesc + "<br>");
      }
      
      public function getItemInfoStringB(obj:Object) : String
      {
         var iRank:int = 0;
         var iSpillCP:* = undefined;
         var iRankRep:int = 0;
         var iSpillRep:* = undefined;
         var strItemInfo:* = "<font size=\'12\'><b>" + obj.sName + "</b></font><br>";
         if(!this.validateArmor(obj) && obj.iClass > 0)
         {
            strItemInfo += "<font size=\'10\' color=\'#CC0000\'>";
            iRank = this.getRankFromPoints(obj.iReqCP);
            iSpillCP = obj.iReqCP - this.arrRanks[iRank - 1];
            if(iSpillCP > 0)
            {
               strItemInfo += "Requires " + iSpillCP + " Class Points on " + obj.sClass + ", Rank " + iRank + ".";
            }
            else
            {
               strItemInfo += "Requires " + obj.sClass + ", Rank " + iRank + ".";
            }
            strItemInfo += "</font><br>";
         }
         if(obj.FactionID > 1 && this.world.myAvatar.getRep(obj.FactionID) < obj.iReqRep)
         {
            strItemInfo += "<font size=\'10\' color=\'#CC0000\'>";
            iRankRep = this.getRankFromPoints(obj.iReqRep);
            iSpillRep = obj.iReqRep - this.arrRanks[iRank - 1];
            if(iSpillRep > 0)
            {
               strItemInfo += "Requires " + iSpillRep + " Reputation on " + obj.sFaction + ", Rank " + iRankRep + ".";
            }
            else
            {
               strItemInfo += "Requires " + obj.sFaction + ", Rank " + iRankRep + ".";
            }
            strItemInfo += "</font><br>";
         }
         if(obj.iQSindex >= 0 && this.world.getQuestValue(obj.iQSindex) < int(obj.iQSvalue))
         {
            strItemInfo += "<font size=\'11\' color=\'#CC0000\'>Requires completion of quest \"" + obj.sQuest + "\".</font><br>";
         }
         if(obj.sMeta != null && this.getDisplaysType(obj) == "Pet" && obj.sMeta.indexOf("Necromancer") > -1)
         {
            strItemInfo += "<font color=\'#00CCFF\'><b>Battle " + this.getDisplaysType(obj);
         }
         else
         {
            strItemInfo += "<font color=\'#00CCFF\'><b>" + this.getDisplaysType(obj);
         }
         if(obj.sType.toLowerCase() == "enhancement")
         {
            strItemInfo += ", Level " + obj.iLvl;
         }
         if(obj.sES != "None" && obj.sES != "co" && obj.sES != "pe" && obj.sES != "mi")
         {
            if(obj.EnhID > 0)
            {
               strItemInfo += ", Level " + obj.EnhLvl;
               if(obj.sES == "ar")
               {
                  strItemInfo += "<br>Rank " + this.getRankFromPoints(obj.iQty);
               }
            }
            else if(obj.sType.toLowerCase() != "enhancement")
            {
               strItemInfo += " Design";
            }
         }
         if(obj.iStk > 1)
         {
            strItemInfo += " - " + obj.iQty + "/" + obj.iStk;
         }
         if(obj.sES == "Weapon" || obj.sES == "co" || obj.sES == "he" || obj.sES == "ba" || obj.sES == "pe" || obj.sES == "am" || obj.sES == "mi" || obj.sES == "hi" || obj.sES == "ho")
         {
            if(obj.sType.toLowerCase() != "enhancement")
            {
               strItemInfo += "<br>" + this.getRarityString(obj.iRty) + " Rarity";
            }
         }
         if(obj.sType.toLowerCase() != "enhancement")
         {
            obj.sDesc = obj.sDesc.replace(this.regExLineSpace,"\n");
            strItemInfo += "</b></font><br><font size=\'10\' color=\'#FFFFFF\'>" + (this.litePreference.data.bDebugger ? "Item ID: " + obj.ItemID + "<br>" : "") + obj.sDesc + "<br></font>";
         }
         else
         {
            strItemInfo += "</b></font><br><font size=\'10\' color=\'#FFFFFF\'>";
            strItemInfo += "Enhancements are special items which can apply stats to your weapons and armor. Select a weapon or armor item from the list on the right, and click the <font color=\'#00CCFF\'>\"Enhancements\"</font> button that appears below its preview.";
         }
         return strItemInfo;
      }
      
      public function getIconByType(sType:String) : String
      {
         var iconStr:String = "";
         switch(sType.toLowerCase())
         {
            case "axe":
            case "bow":
            case "dagger":
            case "gun":
            case "mace":
            case "polearm":
            case "staff":
            case "sword":
            case "wand":
            case "armor":
               iconStr = "iw" + sType.toLowerCase();
               break;
            case "cape":
            case "helm":
            case "pet":
            case "class":
               iconStr = "ii" + sType.toLowerCase();
               break;
            default:
               iconStr = "iibag";
         }
         return iconStr;
      }
      
      public function getIconBySlot(slot:String) : String
      {
         var iconStr:String = "";
         switch(slot.toLowerCase())
         {
            case "weapon":
               iconStr = "iwsword";
               break;
            case "back":
            case "ba":
               iconStr = "iicape";
               break;
            case "head":
            case "he":
               iconStr = "iihelm";
               break;
            case "armor":
            case "ar":
               iconStr = "iiclass";
               break;
            case "class":
               iconStr = "iiclass";
               break;
            case "pet":
            case "pe":
               iconStr = "iipet";
               break;
            default:
               iconStr = "iibag";
         }
         return iconStr;
      }
      
      public function getDisplaysType(item:Object) : *
      {
         var s:String = item.sType != null ? item.sType : "Unknown";
         var t:String = s.toLowerCase();
         if(t == "clientuse" || t == "serveruse")
         {
            s = "Item";
         }
         if(t == "misc")
         {
            s = "Ground";
         }
         return s;
      }
      
      public function stringToDate(strODBC:String) : Date
      {
         var numYear:* = Number(strODBC.substr(0,4));
         var numMonth:* = Number(strODBC.substr(5,2)) - 1;
         var numDate:* = Number(strODBC.substr(8,2));
         var numHour:* = Number(strODBC.substr(11,2));
         var numMins:* = Number(strODBC.substr(14,2));
         var numSecs:* = Number(strODBC.substr(17));
         return new Date(numYear,numMonth,numDate,numHour,numMins,numSecs);
      }
      
      internal function traceObject(obj:*, n:* = 1) : *
      {
         var i:* = undefined;
         var v:* = undefined;
         for(var s:* = ""; s.length < n; )
         {
            s += " ";
         }
         n++;
         if(typeof obj == "object" && obj.length != null)
         {
            for(i = 0; i < obj.length; i++)
            {
               trace(s + i + ": " + obj[i]);
            }
         }
         else
         {
            for(v in obj)
            {
               trace(s + v + ": " + obj[v]);
               if(typeof obj[v] == "object")
               {
                  this.traceObject(obj[v],n);
               }
            }
         }
      }
      
      public function max(num1:int, num2:int) : int
      {
         if(num1 > num2)
         {
            return num1;
         }
         return num2;
      }
      
      public function clamp(val:Number, mn:Number, mx:Number) : Number
      {
         if(val < mn)
         {
            return mn;
         }
         if(val > mx)
         {
            return mx;
         }
         return val;
      }
      
      public function isValidEmail(email:String) : Boolean
      {
         return Boolean(email.match(this.EMAIL_REGEX));
      }
      
      public function closeToolTip() : void
      {
         var tt:* = undefined;
         try
         {
            tt = MovieClip(stage.getChildAt(0)).ui.ToolTip;
            tt.close();
         }
         catch(e:Error)
         {
         }
      }
      
      public function updateIcons(actIcons:Array, iconArray:Array, item:Object = null) : *
      {
         var actIconMC:MovieClip = null;
         var iconShapeClass:Class = null;
         var iconShape:* = undefined;
         var iconShapeMC:* = undefined;
         var aw:* = undefined;
         var ah:* = undefined;
         var bw:* = undefined;
         var bh:* = undefined;
         var i:int = 0;
         var j:int = 0;
         for(i = 0; i < actIcons.length; i++)
         {
            actIconMC = actIcons[i];
            actIconMC.cnt.removeChildAt(0);
            actIconMC.item = item;
            if(actIconMC.item == null)
            {
               actIconMC.tQty.visible = false;
            }
            while(j < iconArray.length)
            {
               iconShapeClass = this.world.getClass(iconArray[j]) as Class;
               iconShape = new iconShapeClass();
               iconShapeMC = actIconMC.cnt.addChild(iconShape);
               aw = int(42 - 8 + 4 * j);
               ah = int(39 - 8 + 4 * j);
               bw = iconShapeMC.width;
               bh = iconShapeMC.height;
               if(bw > bh)
               {
                  iconShapeMC.scaleX = iconShapeMC.scaleY = aw / bw;
               }
               else
               {
                  iconShapeMC.scaleX = iconShapeMC.scaleY = ah / bh;
               }
               iconShapeMC.x = actIconMC.bg.width / 2 - iconShapeMC.width / 2;
               iconShapeMC.y = actIconMC.bg.height / 2 - iconShapeMC.height / 2;
               j++;
            }
         }
      }
      
      public function updateItemSkill() : void
      {
         for(var ai:int = 0; ai < this.world.actions.active.length; ai++)
         {
            if(Boolean(this.world.actions.active[ai]) && this.world.actions.active[ai].ref == "i1")
            {
               this.updateActionObjIcon(this.world.actions.active[ai]);
               break;
            }
         }
      }
      
      public function updateActionObjIcon(actionObj:Object) : void
      {
         var icon1:MovieClip = null;
         var item:Object = null;
         var iQty:int = 0;
         var i:int = 0;
         var actIcons:Array = this.world.getActIcons(actionObj);
         for(var j:* = 0; j < actIcons.length; j++)
         {
            icon1 = actIcons[j];
            item = icon1.item;
            if(item != null)
            {
               for(iQty = 0; i < this.world.myAvatar.items.length; )
               {
                  if(this.world.myAvatar.items[i].ItemID == item.ItemID)
                  {
                     iQty = int(this.world.myAvatar.items[i].iQty);
                  }
                  i++;
               }
               if(iQty > 0)
               {
                  icon1.tQty.visible = true;
                  icon1.tQty.text = iQty;
               }
               else
               {
                  this.world.unequipUseableItem(item);
               }
            }
         }
      }
      
      public function drawChainsSmooth(entities:Array, c:int, spfxMC:MovieClip) : void
      {
         var pSrc:Point = null;
         var pTgt:Point = null;
         var ei:int = 0;
         var steps:Array = null;
         var i:int = 0;
         var j:int = 0;
         var n:int = 0;
         var p:Point = null;
         var fxArr:Array = null;
         var mc:MovieClip = null;
         var sign:int = 0;
         var b:int = 0;
         for(ei = 1; ei < entities.length; ei++)
         {
            pSrc = new Point(0,0);
            pTgt = new Point(0,0);
            pSrc = entities[ei - 1].localToGlobal(pSrc);
            pTgt = entities[ei].localToGlobal(pTgt);
            steps = [];
            i = 0;
            j = 0;
            n = Math.ceil(Point.distance(pSrc,pTgt) / c);
            if(n % 2 == 1)
            {
               n += 1;
            }
            p = new Point();
            fxArr = [spfxMC.fx0,spfxMC.fx1,spfxMC.fx2];
            sign = -1;
            for(i = 0; i < fxArr.length; i++)
            {
               steps = [];
               sign = Math.random() > 0.5 ? 1 : -1;
               b = 0;
               for(j = 1; j < n; j++)
               {
                  p = Point.interpolate(pSrc,pTgt,1 - j / n);
                  if(++b % 2 == 1)
                  {
                     p.x += sign * Math.round(Math.random() * 30);
                     p.y += sign * Math.round(Math.random() * 30);
                     sign = -sign;
                  }
                  steps.push(p);
               }
               steps.push(pTgt);
               mc = fxArr[i];
               mc.graphics.lineStyle(2,16777215,1);
               mc.graphics.moveTo(pSrc.x,pSrc.y);
               for(j = 0; j < steps.length; j += 2)
               {
                  mc.graphics.curveTo(steps[j].x,steps[j].y,steps[j + 1].x,steps[j + 1].y);
               }
            }
         }
      }
      
      public function drawChainsLinear(entities:Array, c:int, spfxMC:MovieClip) : void
      {
         var pSrc:Point = null;
         var pTgt:Point = null;
         var sMC:MovieClip = null;
         var tMC:MovieClip = null;
         var ei:int = 0;
         var steps:Array = null;
         var i:int = 0;
         var j:int = 0;
         var n:int = 0;
         var p:Point = null;
         var fxArr:Array = null;
         var mc:MovieClip = null;
         for(ei = 1; ei < entities.length; ei++)
         {
            sMC = entities[ei - 1];
            tMC = entities[ei];
            pSrc = new Point(0,-sMC.height * 0.5);
            pTgt = new Point(0,-tMC.height * 0.5);
            pSrc = sMC.localToGlobal(pSrc);
            pTgt = tMC.localToGlobal(pTgt);
            steps = [];
            i = 0;
            j = 0;
            n = Math.ceil(Point.distance(pSrc,pTgt) / c);
            p = new Point();
            fxArr = [spfxMC.fx0,spfxMC.fx1,spfxMC.fx2];
            for(i = 0; i < fxArr.length; i++)
            {
               steps = [];
               for(j = 1; j < n; j++)
               {
                  p = Point.interpolate(pSrc,pTgt,1 - j / (n + 1));
                  p.x += Math.round(Math.random() * 25 - 13);
                  p.y += Math.round(Math.random() * 25 - 13);
                  steps.push(p);
               }
               mc = fxArr[i];
               mc.graphics.clear();
               mc.graphics.lineStyle(5,16777215,1);
               mc.graphics.moveTo(pSrc.x,pSrc.y);
               for(j = 0; j < steps.length; j++)
               {
                  mc.graphics.lineTo(steps[j].x,steps[j].y);
               }
               mc.graphics.lineTo(pTgt.x,pTgt.y);
            }
         }
      }
      
      public function drawFunnel(targetMCs:Array, cnt:MovieClip) : void
      {
         var g:MovieClip = null;
         cnt.numLines = 3;
         cnt.lineThickness = 3;
         cnt.lineColors = [10027178,0,2228326];
         cnt.glowColors = [0];
         cnt.glowStrength = 4;
         cnt.glowSize = 4;
         cnt.dur = 500;
         cnt.del = 100;
         cnt.p1StartingValue = 0.12;
         cnt.p2StartingValue = 0.24;
         cnt.p3StartingValue = 0.36;
         cnt.p1EndingValue = 0.66;
         cnt.p2EndingValue = 0.825;
         cnt.p3EndingValue = 0.99;
         cnt.p1ScaleFactor = 0.5;
         cnt.p3ScaleFactor = 0.5;
         cnt.easingExponent = 1.5;
         cnt.targetMCs = targetMCs;
         cnt.filterArr = [];
         cnt.fxArr = [];
         cnt.ts = new Date().getTime();
         var glowI:int = 0;
         var lineI:int = 0;
         for(glowI = 0; glowI < cnt.glowColors.length; glowI++)
         {
            cnt.filterArr.push([new GlowFilter(cnt.glowColors[glowI],1,cnt.glowSize,cnt.glowSize,cnt.glowStrength,1,false,false)]);
         }
         glowI = 0;
         lineI = 0;
         for(var fi:int = 0; fi < cnt.numLines; fi++)
         {
            g = cnt.addChild(new MovieClip()) as MovieClip;
            g.filters = cnt.filterArr[glowI];
            if(++glowI >= cnt.glowColors.length)
            {
               glowI = 0;
            }
            g.lineColor = cnt.lineColors[lineI];
            if(++lineI >= cnt.lineColors.length)
            {
               lineI = 0;
            }
            cnt.fxArr.push(g);
         }
         cnt.addEventListener(Event.ENTER_FRAME,this.funnelEF,false,0,true);
      }
      
      internal function funnelEF(e:Event) : void
      {
         var mc:MovieClip = null;
         var fakeNow:Number = NaN;
         var fakeTS:Number = NaN;
         var pMid1o:Point = null;
         var pMid1t:Point = null;
         var pMid2o:Point = null;
         var pMid2t:Point = null;
         var pMid3o:Point = null;
         var pMid3t:Point = null;
         var lineColor:Number = NaN;
         var d:Number = NaN;
         var m:Number = NaN;
         var cnt:MovieClip = MovieClip(e.currentTarget);
         var now:Number = new Date().getTime();
         var p1:Point = new Point();
         var p2:Point = new Point();
         var p3:Point = new Point();
         var sign:int = 1;
         var sMC:MovieClip = cnt.targetMCs[0];
         var tMC:MovieClip = cnt.targetMCs[1];
         var pSrc:Point = sMC.localToGlobal(new Point(0,-sMC.height / 2));
         var pTgt:Point = tMC.localToGlobal(new Point(0,-tMC.height / 2));
         var pTgtW:* = tMC.width;
         var pTgtH:* = tMC.height;
         var dir:int = -1;
         var glowI:int = 0;
         var lineI:int = 0;
         var angle:Number = Math.atan2(pSrc.y - pTgt.y,pSrc.x - pTgt.x);
         angle -= Math.PI / 2;
         for(var i:int = 0; i < cnt.fxArr.length; i++)
         {
            mc = cnt.fxArr[i];
            fakeTS = Number(cnt.ts);
            fakeNow = now - i * cnt.del;
            if(fakeNow > fakeTS + cnt.dur)
            {
               if(mc.visible)
               {
                  mc.visible = false;
                  mc.graphics.clear();
               }
               if(i == cnt.fxArr.length - 1)
               {
                  cnt.removeEventListener(Event.ENTER_FRAME,this.funnelEF);
                  if(cnt.parent != null)
                  {
                     cnt.parent.removeChild(cnt);
                  }
               }
            }
            else if(fakeNow >= cnt.ts)
            {
               d = (fakeNow - fakeTS) / cnt.dur;
               d = Math.pow(1 - d,cnt.easingExponent);
               sign = i % 2 == 0 ? 1 : -1;
               pMid1o = new Point(Point.interpolate(pSrc,pTgt,cnt.p1StartingValue).x + Point.polar(sign * (tMC.height / cnt.p1ScaleFactor),angle).x,Point.interpolate(pSrc,pTgt,cnt.p1StartingValue).y + Point.polar(sign * (tMC.height / cnt.p1ScaleFactor),angle).y);
               pMid1t = new Point(Point.interpolate(pSrc,pTgt,cnt.p1EndingValue).x,Point.interpolate(pSrc,pTgt,cnt.p1EndingValue).y);
               pMid2o = new Point(Point.interpolate(pSrc,pTgt,cnt.p2StartingValue).x,pTgt.y);
               pMid2t = new Point(Point.interpolate(pSrc,pTgt,cnt.p2EndingValue).x,Point.interpolate(pSrc,pTgt,cnt.p2EndingValue).y);
               pMid3o = new Point(Point.interpolate(pSrc,pTgt,cnt.p3StartingValue).x + Point.polar(-sign * (tMC.height / cnt.p3ScaleFactor),angle).x,Point.interpolate(pSrc,pTgt,cnt.p3StartingValue).y + Point.polar(-sign * (tMC.height / cnt.p3ScaleFactor),angle).y);
               pMid3t = new Point(Point.interpolate(pSrc,pTgt,cnt.p3EndingValue).x,Point.interpolate(pSrc,pTgt,cnt.p3EndingValue).y);
               p1 = Point.interpolate(pMid1o,pMid1t,d);
               p2 = Point.interpolate(pMid2o,pMid2t,d);
               p3 = Point.interpolate(pMid3o,pMid3t,d);
               lineColor = Number(mc.lineColor);
               mc.graphics.clear();
               mc.graphics.lineStyle(cnt.lineThickness,lineColor,1);
               mc.graphics.moveTo(pTgt.x,pTgt.y);
               mc.graphics.curveTo(p1.x,p1.y,p2.x,p2.y);
               mc.graphics.curveTo(p3.x,p3.y,pSrc.x,pSrc.y);
               m = Math.cos((fakeNow - fakeTS) / cnt.dur * Math.PI * 2);
               m = m / 2 + 0.5;
               m = 1 - m;
               mc.alpha = m;
            }
         }
      }
      
      public function updateCoreValues(o:Object) : void
      {
         if(o.intLevelCap != null)
         {
            this.intLevelCap = o.intLevelCap;
         }
         if(o.PCstBase != null)
         {
            this.PCstBase = o.PCstBase;
         }
         if(o.PCstRatio != null)
         {
            this.PCstRatio = o.PCstRatio;
         }
         if(o.PCstGoal != null)
         {
            this.PCstGoal = o.PCstGoal;
         }
         if(o.GstBase != null)
         {
            this.GstBase = o.GstBase;
         }
         if(o.GstRatio != null)
         {
            this.GstRatio = o.GstRatio;
         }
         if(o.GstGoal != null)
         {
            this.GstGoal = o.GstGoal;
         }
         if(o.PChpBase1 != null)
         {
            this.PChpBase1 = o.PChpBase1;
         }
         if(o.PChpBase100 != null)
         {
            this.PChpBase100 = o.PChpBase100;
         }
         if(o.PChpGoal1 != null)
         {
            this.PChpGoal1 = o.PChpGoal1;
         }
         if(o.PChpGoal100 != null)
         {
            this.PChpGoal100 = o.PChpGoal100;
         }
         if(o.PChpDelta != null)
         {
            this.PChpDelta = o.PChpDelta;
         }
         if(o.intHPperEND != null)
         {
            this.intHPperEND = o.intHPperEND;
         }
         if(o.intAPtoDPS != null)
         {
            this.intAPtoDPS = o.intAPtoDPS;
         }
         if(o.intSPtoDPS != null)
         {
            this.intSPtoDPS = o.intSPtoDPS;
         }
         if(o.bigNumberBase != null)
         {
            this.bigNumberBase = o.bigNumberBase;
         }
         if(o.resistRating != null)
         {
            this.resistRating = o.resistRating;
         }
         if(o.modRating != null)
         {
            this.modRating = o.modRating;
         }
         if(o.baseDodge != null)
         {
            this.baseDodge = o.baseDodge;
         }
         if(o.baseBlock != null)
         {
            this.baseBlock = o.baseBlock;
         }
         if(o.baseParry != null)
         {
            this.baseParry = o.baseParry;
         }
         if(o.baseCrit != null)
         {
            this.baseCrit = o.baseCrit;
         }
         if(o.baseHit != null)
         {
            this.baseHit = o.baseHit;
         }
         if(o.baseHaste != null)
         {
            this.baseHaste = o.baseHaste;
         }
         if(o.baseMiss != null)
         {
            this.baseMiss = o.baseMiss;
         }
         if(o.baseResist != null)
         {
            this.baseResist = o.baseResist;
         }
         if(o.baseCritValue != null)
         {
            this.baseCritValue = o.baseCritValue;
         }
         if(o.baseBlockValue != null)
         {
            this.baseBlockValue = o.baseBlockValue;
         }
         if(o.baseResistValue != null)
         {
            this.baseResistValue = o.baseResistValue;
         }
         if(o.baseEventValue != null)
         {
            this.baseEventValue = o.baseEventValue;
         }
         if(o.PCDPSMod != null)
         {
            this.PCDPSMod = o.PCDPSMod;
         }
         if(o.curveExponent != null)
         {
            this.curveExponent = o.curveExponent;
         }
         if(o.statsExponent != null)
         {
            this.statsExponent = o.statsExponent;
         }
      }
      
      internal function spaceBy(i:int, n:int) : String
      {
         for(var s:String = String(i); s.length < n; )
         {
            s += " ";
         }
         return s;
      }
      
      internal function spaceNumBy(i:Number, n:int) : String
      {
         var s:String = i.toString();
         for(s = s.substr(0,n); s.length < n; )
         {
            s += " ";
         }
         return s;
      }
      
      internal function showRatings() : void
      {
         var b:* = undefined;
         var c:* = undefined;
         var bias1:* = undefined;
         var bias2:* = undefined;
         var bias3:* = undefined;
         var val:* = undefined;
         var cat:* = undefined;
         var o:* = undefined;
         var hpTgt:* = undefined;
         var tDPS:* = undefined;
         var sp1pc:* = undefined;
         trace("showRatings >");
         var cLeaf:* = this.world.myAvatar.dataLeaf;
         var stat:* = "";
         var lvl:* = 1;
         var i:* = 0;
         var j:* = 0;
         for(lvl = 1; lvl <= 35; lvl += 1)
         {
            if(lvl == 0)
            {
               lvl = 1;
            }
            b = this.getInnateStats(lvl);
            c = this.getIBudget(lvl,1);
            bias1 = -1;
            bias2 = -1;
            bias3 = -1;
            val = -1;
            cat = cLeaf.sCat;
            o = this.copyObj(cLeaf.sta);
            this.resetTableValues(o);
            hpTgt = this.getBaseHPByLevel(lvl);
            tDPS = hpTgt / 20 * 0.7;
            sp1pc = 2.25 * tDPS / (100 / this.intAPtoDPS) / 2;
            trace("Level " + lvl);
            for(i = 0; i < this.stats.length; i++)
            {
               stat = this.stats[i];
               val = o["$" + stat];
               switch(stat)
               {
                  case "STR":
                     bias1 = sp1pc;
                     o.$ap += val * 2;
                     o.$tcr += val / bias1 / 100 * 0.4;
                     trace("  " + this.spaceBy(hpTgt,5) + "  |  " + this.spaceBy(val,4) + "  |  " + this.spaceNumBy(bias1,4) + "  |  " + this.spaceNumBy(b,6) + "  |  " + this.spaceNumBy(c,6) + "  |  " + this.spaceNumBy(o.$tcr,6));
               }
            }
            trace("");
         }
      }
      
      public function applyCoreStatRatings(o:Object, uoLeaf:Object) : void
      {
         var wLvl:int = 1;
         var iDPS:* = 100;
         var wItem:Object = this.world.myAvatar.getEquippedItemBySlot("Weapon");
         if(wItem != null)
         {
            if(wItem.EnhLvl != null)
            {
               wLvl = int(wItem.EnhLvl);
            }
            if(wItem.EnhDPS != null)
            {
               iDPS = Number(wItem.EnhDPS);
            }
            if(iDPS == 0)
            {
               iDPS = 100;
            }
         }
         iDPS /= 100;
         var iLvl:int = int(uoLeaf.intLevel);
         var stat:String = "";
         var b:int = this.getInnateStats(iLvl);
         var bias1:Number = -1;
         var bias2:Number = -1;
         var bias3:Number = -1;
         var val:int = -1;
         var cat:String = this.world.myAvatar.objData.sClassCat;
         var hpTgt:int = this.getBaseHPByLevel(iLvl);
         var TTD:int = 20;
         var tDPS:* = hpTgt / 20 * 0.7;
         var sp1pc:Number = 2.25 * tDPS / (100 / this.intAPtoDPS) / 2;
         this.resetTableValues(o);
         for(var i:int = 0; i < this.stats.length; i++)
         {
            stat = this.stats[i];
            val = o["_" + stat] + o["^" + stat];
            switch(stat)
            {
               case "STR":
                  bias1 = sp1pc;
                  if(cat == "M1")
                  {
                     o.$sbm -= val / bias1 / 100 * 0.3;
                  }
                  if(cat == "S1")
                  {
                     o.$ap += Math.round(val * 1.4);
                  }
                  else
                  {
                     o.$ap += val * 2;
                  }
                  if(cat == "M1" || cat == "M2" || cat == "M3" || cat == "M4" || cat == "S1")
                  {
                     if(cat == "M4")
                     {
                        o.$tcr += val / bias1 / 100 * 0.7;
                     }
                     else
                     {
                        o.$tcr += val / bias1 / 100 * 0.4;
                     }
                  }
                  break;
               case "INT":
                  bias1 = sp1pc;
                  o.$cmi -= val / bias1 / 100;
                  if(cat.substr(0,1) == "C" || cat == "M3")
                  {
                     o.$cmo += val / bias1 / 100;
                  }
                  if(cat == "S1")
                  {
                     o.$sp += Math.round(val * 1.4);
                  }
                  else
                  {
                     o.$sp += val * 2;
                  }
                  if(cat == "C1" || cat == "C2" || cat == "C3" || cat == "M3" || cat == "S1")
                  {
                     if(cat == "C2")
                     {
                        o.$tha += val / bias1 / 100 * 0.5;
                     }
                     else
                     {
                        o.$tha += val / bias1 / 100 * 0.3;
                     }
                  }
                  break;
               case "DEX":
                  bias1 = sp1pc;
                  if(cat == "M1" || cat == "M2" || cat == "M3" || cat == "M4" || cat == "S1")
                  {
                     if(cat.substr(0,1) != "C")
                     {
                        o.$thi += val / bias1 / 100 * 0.2;
                     }
                     if(cat == "M2" || cat == "M4")
                     {
                        o.$tha += val / bias1 / 100 * 0.5;
                     }
                     else
                     {
                        o.$tha += val / bias1 / 100 * 0.3;
                     }
                     if(cat == "M1")
                     {
                        if(o._tbl > 0.01)
                        {
                           o.$tbl += val / bias1 / 100 * 0.5;
                        }
                     }
                  }
                  if(cat != "M2" && cat != "M3")
                  {
                     o.$tdo += val / bias1 / 100 * 0.3;
                  }
                  else
                  {
                     o.$tdo += val / bias1 / 100 * 0.5;
                  }
                  break;
               case "WIS":
                  bias1 = sp1pc;
                  if(cat == "C1" || cat == "C2" || cat == "C3" || cat == "S1")
                  {
                     if(cat == "C1")
                     {
                        o.$tcr += val / bias1 / 100 * 0.7;
                     }
                     else
                     {
                        o.$tcr += val / bias1 / 100 * 0.4;
                     }
                     o.$thi += val / bias1 / 100 * 0.2;
                  }
                  o.$tdo += val / bias1 / 100 * 0.3;
                  break;
               case "LCK":
                  bias1 = sp1pc;
                  o.$sem += val / bias1 / 100 * 2;
                  if(cat == "S1")
                  {
                     o.$ap += Math.round(val * 1);
                     o.$sp += Math.round(val * 1);
                     o.$tcr += val / bias1 / 100 * 0.3;
                     o.$thi += val / bias1 / 100 * 0.1;
                     o.$tha += val / bias1 / 100 * 0.3;
                     o.$tdo += val / bias1 / 100 * 0.25;
                     o.$scm += val / bias1 / 100 * 2.5;
                  }
                  else
                  {
                     if(cat == "M1" || cat == "M2" || cat == "M3" || cat == "M4")
                     {
                        o.$ap += Math.round(val * 0.7);
                     }
                     if(cat == "C1" || cat == "C2" || cat == "C3" || cat == "M3")
                     {
                        o.$sp += Math.round(val * 0.7);
                     }
                     o.$tcr += val / bias1 / 100 * 0.2;
                     o.$thi += val / bias1 / 100 * 0.1;
                     o.$tha += val / bias1 / 100 * 0.1;
                     o.$tdo += val / bias1 / 100 * 0.1;
                     o.$scm += val / bias1 / 100 * 5;
                  }
            }
         }
         o.wDPS = Math.round(this.getBaseHPByLevel(wLvl) / TTD * iDPS * this.PCDPSMod) + Math.round(o.$ap / this.intAPtoDPS);
         o.mDPS = Math.round(this.getBaseHPByLevel(wLvl) / TTD * iDPS * this.PCDPSMod) + Math.round(o.$sp / this.intSPtoDPS);
      }
      
      public function coeffToPct(c:Number) : String
      {
         return Number(c * 100).toFixed(2);
      }
      
      public function getIBudget(lvl:int, iRty:int) : int
      {
         if(lvl < 1)
         {
            lvl = 1;
         }
         if(lvl > this.intLevelCap)
         {
            lvl = this.intLevelCap;
         }
         if(iRty < 1)
         {
            iRty = 1;
         }
         lvl = Math.round(lvl + iRty - 1);
         return int(Math.round(this.GstBase + Math.pow((lvl - 1) / (this.intLevelCap - 1),this.statsExponent) * (this.GstGoal - this.GstBase)));
      }
      
      public function getInnateStats(lvl:int) : int
      {
         if(lvl < 1)
         {
            lvl = 1;
         }
         if(lvl > this.intLevelCap)
         {
            lvl = this.intLevelCap;
         }
         return Math.round(this.PCstBase + Math.pow((lvl - 1) / (this.intLevelCap - 1),this.statsExponent) * (this.PCstGoal - this.PCstBase));
      }
      
      public function getBaseHPByLevel(lvl:*) : *
      {
         if(lvl < 1)
         {
            lvl = 1;
         }
         if(lvl > this.intLevelCap)
         {
            lvl = this.intLevelCap;
         }
         return Math.round(this.PChpBase1 + Math.pow((lvl - 1) / (this.intLevelCap - 1),this.curveExponent) * this.PChpDelta);
      }
      
      public function catCodeToName(cat:String) : String
      {
         switch(cat)
         {
            case "M1":
               return "Fighter";
            case "M2":
               return "Thief";
            case "M3":
               return "Hybrid";
            case "M4":
               return "Armsman";
            case "C1":
               return "Wizard";
            case "C2":
               return "Healer";
            case "C3":
               return "spellbreaker";
            case "S1":
               return "Lucky";
            default:
               return null;
         }
      }
      
      public function resetTableValues(o:Object) : void
      {
         o._ap = 0;
         o.$ap = 0;
         o._sp = 0;
         o.$sp = 0;
         o._tbl = 0;
         o._tpa = 0;
         o._tdo = 0;
         o._tcr = 0;
         o._thi = 0;
         o._tha = 0;
         o._tre = 0;
         o.$tbl = this.baseBlock;
         o.$tpa = this.baseParry;
         o.$tdo = this.baseDodge;
         o.$tcr = this.baseCrit;
         o.$thi = this.baseHit;
         o.$tha = this.baseHaste;
         o.$tre = this.baseResist;
         o._cpo = 1;
         o._cpi = 1;
         o._cao = 1;
         o._cai = 1;
         o._cmo = 1;
         o._cmi = 1;
         o._cdo = 1;
         o._cdi = 1;
         o._cho = 1;
         o._chi = 1;
         o._cmc = 1;
         o.$cpo = 1;
         o.$cpi = 1;
         o.$cao = 1;
         o.$cai = 1;
         o.$cmo = 1;
         o.$cmi = 1;
         o.$cdo = 1;
         o.$cdi = 1;
         o.$cho = 1;
         o.$chi = 1;
         o.$cmc = 1;
         o._scm = this.baseCritValue;
         o._sbm = this.baseBlockValue;
         o._srm = this.baseResistValue;
         o._sem = this.baseEventValue;
         o.$scm = this.baseCritValue;
         o.$sbm = this.baseBlockValue;
         o.$srm = this.baseResistValue;
         o.$sem = this.baseEventValue;
         o._shb = 0;
         o._smb = 0;
         o.$shb = 0;
         o.$smb = 0;
      }
      
      public function getCategoryStats(cat:String, lvl:int) : Object
      {
         var ist:* = this.getInnateStats(lvl);
         var ratios:* = this.classCatMap[cat].ratios;
         var o:* = {};
         var stat:* = "";
         for(var i:int = 0; i < this.stats.length; i++)
         {
            stat = this.stats[i];
            o[stat] = Math.round(ratios[i] * ist);
         }
         return o;
      }
      
      public function applyAuraEffect(e:*, o:*) : *
      {
         switch(e.typ)
         {
            case "+":
               o["$" + e.sta] += Number(e.val);
               break;
            case "-":
               o["$" + e.sta] -= Number(e.val);
               break;
            case "*":
               o["$" + e.sta] = Math.round(o["$" + e.sta] * Number(e.val));
         }
      }
      
      public function removeAuraEffect(e:*, o:*) : *
      {
         switch(e.typ)
         {
            case "+":
               o["$" + e.sta] -= Number(e.val);
               break;
            case "-":
               o["$" + e.sta] += Number(e.val);
               break;
            case "*":
               o["$" + e.sta] = Math.round(o["$" + e.sta] / Number(e.val));
         }
      }
      
      public function getStatsA(item:Object, slot:String) : Object
      {
         var iEnhTemplate:Object = null;
         var lvl:int = item.sType.toLowerCase() == "enhancement" ? int(item.iLvl) : int(item.EnhLvl);
         var rty:int = item.sType.toLowerCase() == "enhancement" ? int(item.iRty) : int(item.EnhRty);
         var iBudget:int = Math.round(this.getIBudget(lvl,rty) * this.ratiosBySlot[slot]);
         var val:* = -1;
         var statBufferOrder:* = ["iEND","iSTR","iINT","iDEX","iWIS","iLCK"];
         var statJ:* = 0;
         var statName:* = "";
         var statVals:* = {};
         var valTotal:* = 0;
         var i:int = 0;
         var o:Object = {};
         this.world.initPatternTree();
         if(item.PatternID != null)
         {
            iEnhTemplate = this.world.enhPatternTree[item.PatternID];
         }
         if(item.EnhPatternID != null)
         {
            iEnhTemplate = this.world.enhPatternTree[item.EnhPatternID];
         }
         if(iEnhTemplate != null)
         {
            for(i = 0; i < this.stats.length; i++)
            {
               statName = "i" + this.stats[i];
               if(iEnhTemplate[statName] != null)
               {
                  statVals[statName] = Math.round(iBudget * iEnhTemplate[statName] / 100);
                  valTotal += statVals[statName];
               }
            }
            statJ = 0;
            while(valTotal < iBudget)
            {
               statName = statBufferOrder[statJ];
               if(statVals[statName] != null)
               {
                  ++statVals[statName];
                  valTotal++;
               }
               statJ++;
               if(statJ > statBufferOrder.length - 1)
               {
                  statJ = 0;
               }
            }
            for(i = 0; i < this.stats.length; i++)
            {
               val = statVals["i" + this.stats[i]];
               if(val != null && val != "0")
               {
                  o["$" + this.stats[i]] = val;
               }
            }
         }
         return o;
      }
      
      public function getDisplayEnhName(e:Object) : String
      {
         if(!(Boolean(e) && e.hasOwnProperty("DIS")))
         {
            if(e)
            {
               return e.sName;
            }
            return "";
         }
         switch(e.sName)
         {
            case "Vim":
            case "Examen":
            case "Pneuma":
            case "Anima":
               return e.sName;
            case "Hearty":
               return "Grimskull";
            default:
               return "Forge";
         }
      }
      
      public function getDisplayEnhTraitName(e:Object) : String
      {
         switch(e.sName)
         {
            case "Vim":
            case "Examen":
               return "Ether";
            case "Pneuma":
            case "Anima":
               return "Clairvoyance";
            default:
               return e.sName;
         }
      }
      
      public function getFullStatName(s:String) : String
      {
         var statName:String = "";
         s = s.toLowerCase();
         if(s.indexOf("str") > -1)
         {
            statName = "Strength";
         }
         if(s.indexOf("int") > -1)
         {
            statName = "Intellect";
         }
         if(s.indexOf("dex") > -1)
         {
            statName = "Dexterity";
         }
         if(s.indexOf("wis") > -1)
         {
            statName = "Wisdom";
         }
         if(s.indexOf("end") > -1)
         {
            statName = "Endurance";
         }
         if(s.indexOf("lck") > -1)
         {
            statName = "Luck";
         }
         if(s.indexOf("tha") > -1)
         {
            statName = "Haste";
         }
         if(s.indexOf("thi") > -1)
         {
            statName = "Hit";
         }
         if(s.indexOf("tcr") > -1)
         {
            statName = "Critcal Hit";
         }
         if(s.indexOf("tcm") > -1)
         {
            statName = "Crit Value";
         }
         if(s.indexOf("tdo") > -1)
         {
            statName = "Evasion";
         }
         return statName;
      }
      
      public function getRarityString(n:int) : String
      {
         var o:Object = null;
         var aRarity:Array = [{
            "val":0,
            "sName":"Unknown"
         },{
            "val":10,
            "sName":"Unknown"
         },{
            "val":11,
            "sName":"Common"
         },{
            "val":12,
            "sName":"Weird"
         },{
            "val":13,
            "sName":"Awesome"
         },{
            "val":14,
            "sName":"1% Drop"
         },{
            "val":15,
            "sName":"5% Drop"
         },{
            "val":16,
            "sName":"Boss Drop"
         },{
            "val":17,
            "sName":"Secret"
         },{
            "val":18,
            "sName":"Junk"
         },{
            "val":19,
            "sName":"Impossible"
         },{
            "val":20,
            "sName":"Artifact"
         },{
            "val":21,
            "sName":"Limited Time Drop"
         },{
            "val":68,
            "sName":"New Collection Chest"
         },{
            "val":23,
            "sName":"Crazy"
         },{
            "val":24,
            "sName":"Expensive"
         },{
            "val":30,
            "sName":"Rare"
         },{
            "val":35,
            "sName":"Epic"
         },{
            "val":40,
            "sName":"Import Item"
         },{
            "val":50,
            "sName":"Seasonal Item"
         },{
            "val":55,
            "sName":"Seasonal Rare"
         },{
            "val":60,
            "sName":"Event Item"
         },{
            "val":65,
            "sName":"Event Rare"
         },{
            "val":70,
            "sName":"Limited Rare"
         },{
            "val":75,
            "sName":"Collector\'s Rare"
         },{
            "val":80,
            "sName":"Promotional Item"
         },{
            "val":90,
            "sName":"Ultra Rare"
         },{
            "val":95,
            "sName":"Super Mega Ultra Rare"
         },{
            "val":100,
            "sName":"Legendary Item"
         }];
         for(var i:* = int(aRarity.length - 1); i > -1; i--)
         {
            o = aRarity[i];
            if(n >= o.val)
            {
               return o.sName;
            }
         }
         return "Common";
      }
      
      public function toggleItemEquip(item:Object) : Boolean
      {
         var uoLeaf:* = this.world.getUoLeafById(this.world.myAvatar.uid);
         var isOK:Boolean = false;
         if(uoLeaf.intState != 1)
         {
            this.MsgBox.notify("Action cannot be performed during combat!");
         }
         else if(this.world.bPvP)
         {
            this.MsgBox.notify("Items may not be equipped or unequipped during a PvP match!");
         }
         else if(item.bEquip == 1)
         {
            if(item.sES == "Weapon" || item.sES == "ar")
            {
               this.MsgBox.notify("Selected Item cannot be unequipped!");
            }
            else
            {
               isOK = true;
               if(item.sType.toLowerCase() != "item")
               {
                  this.world.sendUnequipItemRequest(item);
               }
               else
               {
                  this.world.unequipUseableItem(item);
               }
            }
         }
         else if(item.bUpg == 1 && !this.world.myAvatar.isUpgraded())
         {
            this.showUpgradeWindow();
         }
         else if(int(item.EnhLvl) > int(this.world.myAvatar.objData.intLevel))
         {
            this.MsgBox.notify("Level requirement not met!");
         }
         else if(item.sType.toLowerCase() != "item" && (item.sES != "mi" && item.sES != "co" && item.sES != "pe" && item.sES != "am" && item.EnhID <= 0))
         {
            this.MsgBox.notify("Selected item requires enhancement!");
         }
         else if(item.sType.toLowerCase() != "item")
         {
            isOK = this.world.sendEquipItemRequest(item);
         }
         else
         {
            isOK = true;
            this.world.equipUseableItem(item);
         }
         return isOK;
      }
      
      public function tryEnhance(item:Array, enh:Object, shopRequest:Boolean = false) : void
      {
         if(item != null && enh != null)
         {
            if(enh.iLvl > this.world.myAvatar.objData.intLevel)
            {
               this.MsgBox.notify("Level requirement not met!");
            }
            else if(item.EnhID == enh.ItemID)
            {
               this.MsgBox.notify("Selected Enhancement already applied to item!");
            }
            else if(shopRequest)
            {
               this.world.sendEnhItemRequestShop(item,enh);
            }
            else
            {
               this.world.sendEnhItemRequestLocal(item,enh);
            }
         }
      }
      
      public function doIHaveEnhancements() : Boolean
      {
         var item:Object = null;
         for each(item in this.world.myAvatar.items)
         {
            if(item.sType.toLowerCase() == "enhancement")
            {
               return true;
            }
         }
         return false;
      }
      
      public function isItemEnhanceable(item:Object) : Boolean
      {
         return ["Weapon","he","ba","pe","ar"].indexOf(item.sES) >= 0;
      }
      
      public function resetInvTreeByItemID(ItemID:int) : *
      {
         var item:Object = null;
         try
         {
            item = this.world.invTree[ItemID];
            if("EnhID" in item)
            {
               item.EnhID = -1;
            }
            if("EnhRty" in item)
            {
               item.EnhRty = -1;
            }
            if("EnhDPS" in item)
            {
               item.EnhDPS = -1;
            }
            if("EnhRng" in item)
            {
               item.EnhRng = -1;
            }
            if("EnhLvl" in item)
            {
               item.EnhLvl = -1;
            }
            if("EnhPatternID" in item)
            {
               item.EnhPatternID = -1;
            }
         }
         catch(e:Error)
         {
            trace(e);
         }
      }
      
      public function isMergeShop(shopInfo:Object) : Boolean
      {
         var item:Object = null;
         for each(item in shopInfo.items)
         {
            if("turnin" in item)
            {
               return true;
            }
         }
         return false;
      }
      
      public function recursiveStop(mc:MovieClip) : void
      {
         var current:MovieClip = null;
         var i:int = 0;
         var child:DisplayObject = null;
         var childMC:MovieClip = null;
         var stack:Array = [mc];
         while(stack.length > 0)
         {
            current = stack.pop();
            for(i = 0; i < current.numChildren; i++)
            {
               child = current.getChildAt(i);
               if(child is MovieClip)
               {
                  childMC = MovieClip(child);
                  if(childMC.totalFrames > 1)
                  {
                     childMC.gotoAndStop(childMC.totalFrames);
                  }
                  else
                  {
                     childMC.stop();
                  }
                  stack.push(childMC);
               }
            }
         }
      }
      
      public function getTravelMapData() : void
      {
         if(this.ui.getChildByName("travelLoaderMC"))
         {
            return;
         }
         this.travelLoaderMC = new (this.world.getClass("mcLoader") as Class)();
         this.travelLoaderMC.x = 400;
         this.travelLoaderMC.y = 211;
         this.travelLoaderMC.name = "travelLoaderMC";
         this.ui.addChild(this.travelLoaderMC);
         var strUrl:String = "api/data/travelmap?v=" + this.world.objInfo["sVersion"];
         var mapLoader:URLLoader = new URLLoader();
         if(this.loaderInfo.url.toLowerCase().indexOf("file://") >= 0 || this.loaderInfo.url.toLowerCase().indexOf("127.0.0.1:8081") >= 0 || this.loaderInfo.url.toLowerCase().indexOf("127.0.0.1:8081") >= 0)
         {
            strUrl = "http://127.0.0.1:8081/game/" + strUrl;
         }
         else
         {
            strUrl = this.params.sURL + strUrl;
         }
         var request:URLRequest = new URLRequest(strUrl);
         request.method = URLRequestMethod.GET;
         mapLoader.addEventListener(Event.COMPLETE,this.onTravelMapComplete,false,0,true);
         mapLoader.addEventListener(ProgressEvent.PROGRESS,this.onTravelMapProgress,false,0,true);
         mapLoader.addEventListener(IOErrorEvent.IO_ERROR,this.onTravelError,false,0,true);
         mapLoader.load(request);
      }
      
      private function onTravelMapComplete(e:Event) : void
      {
         var strData:String = String(e.target.data);
         var jso:Object = JSON.parse(strData);
         this.travelMapData = jso;
         this.WorldMapData = new worldMap(this.travelMapData);
         this.TRAVEL_DATA_READY = true;
         this.ui.mcPopup.mcMap.removeChildAt(0);
         var ldr:Loader = new Loader();
         ldr.load(new URLRequest(serverFilePath + this.world.objInfo.sMap),new LoaderContext(false,ApplicationDomain.currentDomain));
         this.ui.mcPopup.mcMap.addChild(ldr);
      }
      
      private function onTravelMapProgress(event:ProgressEvent) : void
      {
         this.bLoaded = event.bytesLoaded;
         this.bTotal = event.bytesTotal;
         var percent:int = this.bLoaded / this.bTotal * 100;
         var barProg:Number = this.bLoaded / this.bTotal;
         this.travelLoaderMC.mcPct.text = percent + "%";
         if(this.bLoaded >= this.bTotal)
         {
            this.travelLoaderMC.parent.removeChild(this.travelLoaderMC);
            this.travelLoaderMC = null;
         }
      }
      
      private function onTravelError(e:IOErrorEvent) : void
      {
         trace("travel map load failed: " + e);
         if(this.travelLoaderMC)
         {
            this.travelLoaderMC.parent.removeChild(this.travelLoaderMC);
            this.travelLoaderMC = null;
         }
      }
      
      public function checkPasswordStrength(pwd:String) : int
      {
         var bits:Number = 0;
         var pwdArr:Array = pwd.split("");
         var charsSeen:Array = [];
         var nonAlpha:uint = 0;
         var prevChar:String = pwdArr[0];
         var distinct:Boolean = false;
         var pass:String = pwd.toLowerCase();
         for(var k:uint = 0; k < this.weakPass.length; k++)
         {
            if(pass == this.weakPass[k])
            {
               return -1;
            }
         }
         for(var i:uint = 0; i < pwdArr.length; i++)
         {
            if(!distinct && prevChar != pwdArr[i])
            {
               distinct = true;
            }
            if(i == 0)
            {
               bits += 4;
               charsSeen.push(pwdArr[i]);
            }
            else if(i < 8)
            {
               if(!this.isRepeat(charsSeen,pwdArr[i]))
               {
                  charsSeen.push(pwdArr[i]);
                  bits += 2;
               }
               else
               {
                  bits += 2;
               }
            }
            else if(i < 21)
            {
               if(!this.isRepeat(charsSeen,pwdArr[i]))
               {
                  charsSeen.push(pwdArr[i]);
                  bits += 1.5;
               }
               else
               {
                  bits += 1.5;
               }
            }
            else if(!this.isRepeat(charsSeen,pwdArr[i]))
            {
               charsSeen.push(pwdArr[i]);
               bits += 1;
            }
            else
            {
               bits += 1;
            }
            if(nonAlpha < 6 && !this.isAlphaChar(pwdArr[i]))
            {
               bits++;
               nonAlpha++;
            }
         }
         return distinct ? int(bits) : -1;
      }
      
      private function isAlphaChar(c:String) : Boolean
      {
         var charCode:uint = c.charCodeAt(0);
         return charCode >= 65 && charCode < 123 || charCode >= 48 && charCode < 58 ? true : false;
      }
      
      private function isRepeat(chars:Array, c:String) : Boolean
      {
         for(var i:uint = 0; i < chars.length; i++)
         {
            if(chars[i] == c)
            {
               return true;
            }
         }
         return false;
      }
      
      public function loadGameMenu() : void
      {
         var ldr:Loader = new Loader();
         var urlReq:URLRequest = new URLRequest(serverFilePath + this.world.objInfo.gMenu);
         trace(serverFilePath + "gameMenu/" + this.world.objInfo.gMenu);
         ldr.contentLoaderInfo.addEventListener(Event.COMPLETE,this.gameMenuCallBack,false,0,true);
         ldr.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR,this.gameMenuErrorHandler,false,0,true);
         ldr.load(urlReq,this.assetsContext);
      }
      
      public function MenuShow() : void
      {
         try
         {
            if(!this.mcGameMenu)
            {
               return;
            }
            if(this.mcGameMenu.currentLabel == "Open")
            {
               this.mcGameMenu.gotoAndPlay("Close");
            }
            else
            {
               this.mcGameMenu.gotoAndStop("Open");
            }
         }
         catch(e:Error)
         {
            trace("gameMenu.MenuShow > " + e);
         }
      }
      
      private function gameMenuCallBack(e:Event) : void
      {
         var menuClass:*;
         try
         {
            this.ui.removeChild(this.mcGameMenu);
         }
         catch(e:Error)
         {
            trace("gameMenu.gameMenuCallBack.removeChild > " + e);
         }
         this.mcGameMenu = null;
         menuClass = this.assetsDomain.getDefinition("GameMenu") as Class;
         this.mcGameMenu = MovieClip(new menuClass());
         this.mcGameMenu.name = "gameMenu";
         this.mcGameMenu.visible = this.world.strMapName != "reenstest";
         this.mcGameMenu.x = 750;
         this.ui.addChild(this.mcGameMenu);
      }
      
      private function gameMenuErrorHandler(e:IOErrorEvent) : void
      {
         trace("menu loading error");
         trace(e);
      }
      
      public function menuClose() : void
      {
         try
         {
            if(this.firstMenu)
            {
               this.firstMenu = false;
            }
            else if(this.mcGameMenu.currentLabel != "Close")
            {
               this.mcGameMenu.gotoAndPlay("Close");
            }
         }
         catch(e:Error)
         {
            trace("gameMenu.menuClose > " + e);
         }
      }
      
      public function openMenu() : void
      {
         try
         {
            if(this.mcGameMenu.currentLabel != "Open")
            {
               this.mcGameMenu.gotoAndPlay("Open");
            }
         }
         catch(e:Error)
         {
            trace("gameMenu.openMenu > " + e);
         }
      }
      
      public function getFilePath() : String
      {
         return serverFilePath;
      }
      
      public function getGamePath() : String
      {
         return serverGamePath;
      }
      
      public function initWorld() : void
      {
         if(this.world != null)
         {
            this.world.killTimers();
            this.world.killListeners();
            this.removeChild(this.world);
            this.world = null;
         }
         this.world = new World(MovieClip(this));
         this.addChildAt(this.world,getChildIndex(this.ui));
      }
      
      public function grayAll(content:DisplayObjectContainer) : void
      {
         var child:DisplayObjectContainer = null;
         var i:int = 0;
         var n:int = 0;
         if(content == null)
         {
            return;
         }
         if(content is MovieClip && content != this)
         {
            (content as MovieClip).stop();
         }
         if(content.numChildren)
         {
            for(n = content.numChildren; i < n; i++)
            {
               if(content.getChildAt(i) is DisplayObjectContainer)
               {
                  child = content.getChildAt(i) as DisplayObjectContainer;
                  if(child.numChildren)
                  {
                     makeGrayscale(child);
                  }
                  else if(child is MovieClip)
                  {
                     makeGrayscale(child as MovieClip);
                  }
               }
            }
         }
      }
      
      public function testJSCallback() : void
      {
         trace("callback recieved from webpage");
      }
      
      public function onAddedToStage(e:Event) : void
      {
         Game.root = this;
         this.stage.showDefaultContextMenu = false;
         stage.stageFocusRect = false;
         this.mcConnDetail = new ConnDetailMC(this);
         serverFilePath = this.loaderInfo.url.substring(0,this.loaderInfo.url.lastIndexOf("/") + 1);
         serverGamePath = serverFilePath.slice(0,serverFilePath.lastIndexOf("/gamefiles")) + "/";
         this.sFilePath = serverFilePath;
         trace("serverFilePath: " + serverFilePath);
         gotoAndPlay(this.charCount() > 0 && Boolean(this.litePreference.data.bCharSelect) ? "Select" : "Login");
         if(this.userPreference.data.quality != "AUTO")
         {
            stage.quality = this.userPreference.data.quality;
         }
      }
      
      public function init() : void
      {
         var v:* = undefined;
         ISWEB = this.params.isWeb;
         this.extCall = new ExternalCalls(true,this.params.strSourceID,this as MovieClip);
         for(v in this.params)
         {
            trace("params[" + v + "]= " + this.params[v]);
         }
         if(this.MsgBox)
         {
            this.MsgBox.visible = false;
         }
         this.IsEU = this.params.isEU;
         trace("isEU = " + this.IsEU);
         this.readQueryString();
         if(Boolean(this.mcLogin) && Boolean(this.mcLogin.fbConnect))
         {
            this.mcLogin.fbConnect.visible = this.showFB;
         }
         this.extCall.setGameObject(this.swfObj);
         if(this.params.sURL == null)
         {
            this.params.sURL = "http://127.0.0.1:8081/";
         }
         this.serverPath = this.params.sURL;
         FacebookConnect.RegisterGame(this);
         if(this.params.doSignup)
         {
            this.params.doSignup = false;
            gotoAndPlay("Account");
         }
      }
      
      public function FBMessage(cmd:*, retVal:*) : *
      {
         trace("sendMessage: " + cmd + " --- retVal: " + retVal);
         FacebookConnect.handleFBMessage(cmd,retVal);
      }
      
      public function SendMessage(cmd:*, retVal:*) : *
      {
         trace("got callback");
      }
      
      public function FB_showFeedDialog(header:String, job:String, image:String) : void
      {
         if(ISWEB)
         {
            this.extCall.showFeedDialog(header,job,image);
         }
      }
      
      public function toggleFullScreen() : void
      {
         var screenRectangle:Rectangle = null;
         if(stage["displayState"] == StageDisplayState.NORMAL)
         {
            screenRectangle = new Rectangle(0,0,960,550);
            try
            {
               stage["fullScreenSourceRect"] = screenRectangle;
               stage["displayState"] = StageDisplayState.FULL_SCREEN;
            }
            catch(error:Error)
            {
            }
         }
         else
         {
            stage["displayState"] = StageDisplayState.NORMAL;
         }
      }
      
      public function showBallyhooAd(sZone:String) : void
      {
         stage["displayState"] = StageDisplayState.NORMAL;
         this.extCall.showIt(sZone);
      }
      
      public function callJSFunction(sFunc:String) : void
      {
         this.extCall.callJSFunction(sFunc);
      }
      
      private function readQueryString() : *
      {
         var _queryString:* = undefined;
         var v:* = undefined;
         var allParams:Array = null;
         var i:* = undefined;
         var index:* = undefined;
         var keyValuePair:String = null;
         var paramKey:String = null;
         var paramValue:String = null;
         try
         {
            _queryString = "";
            if(ISWEB)
            {
               _queryString = this.extCall.getQueryString();
            }
            if(_queryString)
            {
               allParams = _queryString.split("&");
               i = 0;
               index = -1;
               while(i < allParams.length)
               {
                  keyValuePair = allParams[i];
                  index = keyValuePair.indexOf("=");
                  if(index > 0)
                  {
                     paramKey = keyValuePair.substring(0,index);
                     paramValue = keyValuePair.substring(index + 1);
                     this.querystring[paramKey] = paramValue;
                  }
                  i++;
               }
            }
            for(v in this.querystring)
            {
               trace(v + ": " + this.querystring[v]);
            }
         }
         catch(e:Error)
         {
         }
      }
      
      public function initLogin() : void
      {
         var curTS:Number = NaN;
         var iDiff:Number = NaN;
         stage.removeEventListener(KeyboardEvent.KEY_DOWN,this.key_StageLogin);
         this.mcLogin.ni.tabIndex = 1;
         this.mcLogin.pi.tabIndex = 2;
         this.mcLogin.ni.removeEventListener(FocusEvent.FOCUS_IN,this.onUserFocus);
         this.mcLogin.ni.removeEventListener(KeyboardEvent.KEY_DOWN,this.key_TextLogin);
         this.mcLogin.pi.removeEventListener(KeyboardEvent.KEY_DOWN,this.key_TextLogin);
         this.mcLogin.btnLogin.removeEventListener(MouseEvent.CLICK,this.onLoginClick);
         this.mcLogin.btnFBLogin.removeEventListener(MouseEvent.CLICK,this.onFBLoginClick);
         this.mcLogin.mcForgotPassword.removeEventListener(MouseEvent.CLICK,this.onForgotPassword);
         stage.addEventListener(KeyboardEvent.KEY_DOWN,this.key_StageLogin);
         this.mcLogin.ni.addEventListener(FocusEvent.FOCUS_IN,this.onUserFocus);
         this.mcLogin.ni.addEventListener(KeyboardEvent.KEY_DOWN,this.key_TextLogin);
         this.mcLogin.pi.addEventListener(KeyboardEvent.KEY_DOWN,this.key_TextLogin);
         this.mcLogin.btnLogin.addEventListener(MouseEvent.CLICK,this.onLoginClick);
         this.mcLogin.btnFBLogin.addEventListener(MouseEvent.CLICK,this.onFBLoginClick);
         this.mcLogin.mcForgotPassword.addEventListener(MouseEvent.CLICK,this.onForgotPassword);
         this.mcLogin.mcManageAccount.addEventListener(MouseEvent.CLICK,this.onManageClick);
         this.loadUserPreference();
         this.mcLogin.warning.s = String("Sorry! You have been disconnected. \n You will be able to login after $s seconds.");
         this.mcLogin.warning.visible = false;
         this.mcLogin.warning.alpha = 0;
         if(this.params.sURL != null)
         {
            this.mcLogin.mcLogo.txtTitle.htmlText = "<font color=\"#FFB231\">New Release:</font> " + this.params.sTitle;
         }
         if("logoutWarningTS" in this.userPreference.data)
         {
            curTS = new Date().getTime();
            iDiff = this.userPreference.data.logoutWarningTS + this.userPreference.data.logoutWarningDur * 1000 - curTS;
            if(iDiff > 60000)
            {
               this.userPreference.data.logoutWarningDur = 60;
               this.userPreference.data.logoutWarningTS = curTS;
               try
               {
                  this.userPreference.flush();
               }
               catch(e:Error)
               {
                  trace(e.message);
               }
            }
            if(iDiff > 1000)
            {
               this.initLoginWarning();
            }
         }
      }
      
      public function onBtnDn(e:MouseEvent) : void
      {
         var urlNotes:String = null;
         urlNotes = this.params.test ? "https://www.aq.com/gamedesignnotes/AQW-Spider-OMGClient-PatchNotess-8456" : "https://www.aq.com/gamedesignnotes/AQW-Spider-AQWClient2-PatchNotes-8484";
         navigateToURL(new URLRequest(urlNotes),"_blank");
      }
      
      public function loadTitle() : void
      {
         var strBG:String = null;
         var sTitle:String = null;
         var sURL:String = null;
         strBG = "Generic2.swf";
         sTitle = "The Skyguard";
         sURL = "http://127.0.0.1:8081/";
         if(this.params.sURL != null)
         {
            sURL = this.params.sURL;
            strBG = this.params.sBG;
            sTitle = this.params.sTitle;
         }
         else
         {
            this.params.sURL = sURL;
         }
         trace("sURL: " + sURL + " --- sBG:" + strBG);
         BGLoader.LoadBG(sURL,this.mcLogin,strBG,sTitle);
         this.mcLogin.testClientAssets.visible = false;
         this.mcLogin.testClientAssets.cVersion.text = "Version " + this.cVersion;
         this.mcLogin.testClientAssets.dnBtn.addEventListener(MouseEvent.CLICK,this.onBtnDn,false,0,true);
         this.mcLogin.testClientAssets.banner.visible = this.params.test as Boolean;
      }
      
      private function initLoginWarning() : void
      {
         var mc:MovieClip = null;
         var ts:Number = NaN;
         var lts:Number = NaN;
         var ldur:Number = NaN;
         mc = this.mcLogin.warning as MovieClip;
         mc.visible = true;
         mc.alpha = 100;
         this.mcLogin.btnLogin.visible = false;
         this.mcLogin.mcOr.visible = false;
         this.mcLogin.btnFBLogin.visible = false;
         this.mcLogin.mcForgotPassword.visible = false;
         this.mcLogin.mcPassword.visible = false;
         ts = new Date().getTime();
         lts = Number(this.userPreference.data.logoutWarningTS);
         ldur = Number(this.userPreference.data.logoutWarningDur);
         mc.n = Math.round((lts + ldur * 1000 - ts) / 1000);
         mc.ti.text = mc.s.split("$s")[0] + mc.n + mc.s.split("$s")[1];
         mc.timer = new Timer(1000);
         mc.timer.addEventListener(TimerEvent.TIMER,this.loginWarningTimer,false,0,true);
         mc.timer.start();
      }
      
      private function loginWarningTimer(e:TimerEvent) : void
      {
         var mc:MovieClip = null;
         mc = this.mcLogin.warning as MovieClip;
         if(mc.n-- < 1)
         {
            mc.visible = false;
            mc.alpha = 0;
            this.mcLogin.mcPassword.visible = true;
            this.mcLogin.btnLogin.visible = true;
            this.mcLogin.mcOr.visible = true;
            this.mcLogin.btnFBLogin.visible = true;
            this.mcLogin.mcForgotPassword.visible = true;
            mc.timer.removeEventListener(TimerEvent.TIMER,this.loginWarningTimer);
         }
         else
         {
            mc.ti.text = mc.s.split("$s")[0] + mc.n + mc.s.split("$s")[1];
            mc.timer.reset();
            mc.timer.start();
         }
      }
      
      private function onStageLeave(e:Event) : void
      {
         stage.focus = null;
      }
      
      private function initInterface() : *
      {
         var i:int = 0;
         var txtKey:* = undefined;
         this.updateCoreValues(this.coreValues);
         if(this.ctr_watermark != null)
         {
            this.ctr_watermark.visible = false;
            this.ctr_watermark.mouseEnabled = this.ctr_watermark.mouseChildren = false;
         }
         if(this.ui == null)
         {
            trace("Warning: ui is null in initInterface");
            return;
         }
         if(this.ui.mcFPS != null)
         {
            this.ui.mcFPS.visible = false;
         }
         if(this.ui.mcRes != null)
         {
            this.ui.mcRes.visible = false;
         }
         if(this.ui.mcPopup != null)
         {
            this.ui.mcPopup.visible = false;
         }
         if(this.ui.mcPortrait != null)
         {
            this.ui.mcPortrait.visible = false;
            if(this.ui.mcPortrait.iconBoostXP != null)
            {
               this.ui.mcPortrait.iconBoostXP.visible = false;
            }
            if(this.ui.mcPortrait.iconBoostG != null)
            {
               this.ui.mcPortrait.iconBoostG.visible = false;
            }
            if(this.ui.mcPortrait.iconBoostRep != null)
            {
               this.ui.mcPortrait.iconBoostRep.visible = false;
            }
            if(this.ui.mcPortrait.iconBoostCP != null)
            {
               this.ui.mcPortrait.iconBoostCP.visible = false;
            }
         }
         this.hidePortraitTarget();
         this.ui.visible = false;
         if(this.ui.mcInterface != null)
         {
            if(this.ui.mcInterface.mcXPBar != null && this.ui.mcInterface.mcXPBar.mcXP != null)
            {
               this.ui.mcInterface.mcXPBar.mcXP.scaleX = 0;
            }
            if(this.ui.mcInterface.mcRepBar != null && this.ui.mcInterface.mcRepBar.mcRep != null)
            {
               this.ui.mcInterface.mcRepBar.mcRep.scaleX = 0;
            }
         }
         if(this.ui.mcUpdates != null)
         {
            if(this.ui.mcUpdates.uproto != null)
            {
               this.ui.mcUpdates.uproto.visible = false;
               this.ui.mcUpdates.uproto.y = -400;
            }
            this.ui.mcUpdates.mouseChildren = this.ui.mcUpdates.mouseEnabled = false;
         }
         this.hideMCPVPQueue();
         if(stage != null)
         {
            stage.removeEventListener(Event.MOUSE_LEAVE,this.onStageLeave);
            stage.removeEventListener(KeyboardEvent.KEY_UP,this.key_actBar);
            stage.removeEventListener(KeyboardEvent.KEY_DOWN,this.key_StageGame);
         }
         if(this.ui.mcInterface != null)
         {
            if(this.ui.mcInterface.mcXPBar != null)
            {
               this.ui.mcInterface.mcXPBar.removeEventListener(MouseEvent.MOUSE_OVER,this.xpBarMouseOver);
               this.ui.mcInterface.mcXPBar.removeEventListener(MouseEvent.MOUSE_OUT,this.xpBarMouseOut);
            }
            if(this.ui.mcInterface.mcRepBar != null)
            {
               this.ui.mcInterface.mcRepBar.removeEventListener(MouseEvent.MOUSE_OVER,this.onRepBarMouseOver);
               this.ui.mcInterface.mcRepBar.removeEventListener(MouseEvent.MOUSE_OUT,this.onRepBarMouseOut);
            }
         }
         if(this.ui.mcPortraitTarget != null)
         {
            this.ui.mcPortraitTarget.removeEventListener(MouseEvent.CLICK,this.portraitClick);
         }
         if(this.ui.mcPortrait != null)
         {
            this.ui.mcPortrait.removeEventListener(MouseEvent.CLICK,this.portraitClick);
            if(this.ui.mcPortrait.iconBoostXP != null)
            {
               this.ui.mcPortrait.iconBoostXP.removeEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostXPOver);
               this.ui.mcPortrait.iconBoostXP.removeEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut);
            }
            if(this.ui.mcPortrait.iconBoostG != null)
            {
               this.ui.mcPortrait.iconBoostG.removeEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostGoldOver);
               this.ui.mcPortrait.iconBoostG.removeEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut);
            }
            if(this.ui.mcPortrait.iconBoostRep != null)
            {
               this.ui.mcPortrait.iconBoostRep.removeEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostRepOver);
               this.ui.mcPortrait.iconBoostRep.removeEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut);
            }
            if(this.ui.mcPortrait.iconBoostCP != null)
            {
               this.ui.mcPortrait.iconBoostCP.removeEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostCPOver);
               this.ui.mcPortrait.iconBoostCP.removeEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut);
            }
         }
         if(this.ui.btnTargetPortraitClose != null)
         {
            this.ui.btnTargetPortraitClose.removeEventListener(MouseEvent.CLICK,this.onTargetPortraitCloseClick);
         }
         if(this.ui.btnMonster != null)
         {
            this.ui.btnMonster.removeEventListener(MouseEvent.CLICK,this.onBtnMonsterClick);
         }
         if(this.ui.mcPVPQueue != null)
         {
            this.ui.mcPVPQueue.removeEventListener(MouseEvent.CLICK,this.onMCPVPQueueClick);
         }
         if(this.ui.mcInterface != null && this.ui.mcInterface.tl != null)
         {
            this.ui.mcInterface.tl.mouseEnabled = false;
         }
         if(this.chatF != null)
         {
            this.chatF.init();
         }
         if(stage != null)
         {
            stage.addEventListener(Event.MOUSE_LEAVE,this.onStageLeave,false,0,true);
            stage.addEventListener(KeyboardEvent.KEY_UP,this.key_actBar,false,0,true);
         }
         if(this.ui.mcInterface != null)
         {
            if(this.ui.mcInterface.mcXPBar != null)
            {
               if(this.ui.mcInterface.mcXPBar.strXP != null)
               {
                  this.ui.mcInterface.mcXPBar.strXP.visible = false;
               }
               this.ui.mcInterface.mcXPBar.addEventListener(MouseEvent.MOUSE_OVER,this.xpBarMouseOver,false,0,true);
               this.ui.mcInterface.mcXPBar.addEventListener(MouseEvent.MOUSE_OUT,this.xpBarMouseOut,false,0,true);
            }
            if(this.ui.mcInterface.mcRepBar != null)
            {
               if(this.ui.mcInterface.mcRepBar.strRep != null)
               {
                  this.ui.mcInterface.mcRepBar.strRep.visible = false;
               }
               this.ui.mcInterface.mcRepBar.addEventListener(MouseEvent.MOUSE_OVER,this.onRepBarMouseOver,false,0,true);
               this.ui.mcInterface.mcRepBar.addEventListener(MouseEvent.MOUSE_OUT,this.onRepBarMouseOut,false,0,true);
            }
         }
         if(this.ui.mcPortraitTarget != null)
         {
            this.ui.mcPortraitTarget.addEventListener(MouseEvent.CLICK,this.portraitClick,false,0,true);
         }
         if(this.ui.mcPortrait != null)
         {
            this.ui.mcPortrait.addEventListener(MouseEvent.CLICK,this.portraitClick,false,0,true);
            if(this.ui.mcPortrait.iconBoostXP != null)
            {
               this.ui.mcPortrait.iconBoostXP.addEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostXPOver,false,0,true);
               this.ui.mcPortrait.iconBoostXP.addEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut,false,0,true);
            }
            if(this.ui.mcPortrait.iconBoostG != null)
            {
               this.ui.mcPortrait.iconBoostG.addEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostGoldOver,false,0,true);
               this.ui.mcPortrait.iconBoostG.addEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut,false,0,true);
            }
            if(this.ui.mcPortrait.iconBoostRep != null)
            {
               this.ui.mcPortrait.iconBoostRep.addEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostRepOver,false,0,true);
               this.ui.mcPortrait.iconBoostRep.addEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut,false,0,true);
            }
            if(this.ui.mcPortrait.iconBoostCP != null)
            {
               this.ui.mcPortrait.iconBoostCP.addEventListener(MouseEvent.MOUSE_OVER,this.oniconBoostCPOver,false,0,true);
               this.ui.mcPortrait.iconBoostCP.addEventListener(MouseEvent.MOUSE_OUT,this.oniconBoostOut,false,0,true);
            }
         }
         if(this.ui.btnTargetPortraitClose != null)
         {
            this.ui.btnTargetPortraitClose.addEventListener(MouseEvent.CLICK,this.onTargetPortraitCloseClick,false,0,true);
         }
         if(this.ui.btnMonster != null)
         {
            this.ui.btnMonster.addEventListener(MouseEvent.CLICK,this.onBtnMonsterClick,false,0,true);
         }
         if(this.ui.mcPVPQueue != null)
         {
            this.ui.mcPVPQueue.addEventListener(MouseEvent.CLICK,this.onMCPVPQueueClick,false,0,true);
         }
         if(this.ui.iconQuest != null)
         {
            this.ui.iconQuest.visible = false;
            this.ui.iconQuest.buttonMode = true;
            this.ui.iconQuest.addEventListener(MouseEvent.CLICK,this.oniconQuestClick,false,0,true);
         }
         if(this.ui.mcInterface != null)
         {
            if(this.ui.mcInterface.tl != null)
            {
               this.ui.mcInterface.tl.mouseEnabled = false;
            }
            if(this.ui.mcInterface.areaList != null)
            {
               this.ui.mcInterface.areaList.mouseEnabled = false;
               if(this.ui.mcInterface.areaList.title != null)
               {
                  this.ui.mcInterface.areaList.title.mouseEnabled = false;
                  if(this.ui.mcInterface.areaList.title.bMinMax != null)
                  {
                     this.ui.mcInterface.areaList.title.bMinMax.addEventListener(MouseEvent.CLICK,this.areaListClick,false,0,true);
                  }
               }
            }
         }
         if(this.litePreference.data.bCustomDrops)
         {
            if(this.cDropsUI)
            {
               this.cDropsUI.cleanup();
            }
            this.cDropsUI = new customDrops(this);
         }
         if(this.litePreference.data.bDebugger)
         {
            if(this.cMenuUI)
            {
               this.cMenuUI.cleanup();
            }
            this.cMenuUI = new cellMenu(this);
            if(this.pLoggerUI)
            {
               this.pLoggerUI.cleanup();
            }
            if(this.litePreference.data.dOptions["debugPacket"])
            {
               this.pLoggerUI = new packetlogger(this);
            }
         }
         if(Boolean(this.litePreference.data.bAuras) && !this.ui.mcInterface.getChildByName("playerAuras"))
         {
            this.pAurasUI = new playerAuras(this);
            this.ui.mcPortrait.addChild(this.pAurasUI);
            this.tAurasUI = new targetAuras(this);
            this.ui.mcPortraitTarget.addChild(this.tAurasUI);
         }
         if(this.intChatMode)
         {
            this.ui.mcInterface.bMinMax.visible = false;
            this.ui.mcInterface.bShortTall.visible = false;
            this.ui.mcInterface.bCannedChat.visible = false;
            this.ui.mcInterface.tt.visible = false;
            this.ui.mcInterface.tebg.visible = false;
            this.ui.mcInterface.bsend.visible = false;
            this.ui.nc.visible = true;
            this.ui.mcInterface.ncModeChat.visible = true;
            this.ui.mcInterface.ncCannedChat.visible = true;
            this.ui.mcInterface.ncHistory.visible = true;
            this.ui.mcInterface.ncTxtBG.visible = true;
            this.ui.mcInterface.ncPrefix.visible = true;
            this.ui.mcInterface.ncText.visible = true;
            this.ui.mcInterface.ncSendText.visible = true;
         }
         else
         {
            this.ui.mcInterface.bMinMax.visible = true;
            this.ui.mcInterface.bShortTall.visible = true;
            this.ui.mcInterface.bCannedChat.visible = true;
            this.ui.mcInterface.tt.visible = true;
            this.ui.mcInterface.tebg.visible = true;
            this.ui.mcInterface.bsend.visible = true;
            this.ui.nc.visible = false;
            this.ui.mcInterface.ncModeChat.visible = false;
            this.ui.mcInterface.ncCannedChat.visible = false;
            this.ui.mcInterface.ncHistory.visible = false;
            this.ui.mcInterface.ncTxtBG.visible = false;
            this.ui.mcInterface.ncPrefix.visible = false;
            this.ui.mcInterface.ncText.visible = false;
            this.ui.mcInterface.ncSendText.visible = false;
         }
         this.keyDict = this.getKeyboardDict();
         for(i = 0; i < 6; i++)
         {
            txtKey = this.ui.mcInterface.getChildByName("keyA" + i);
            trace(this.litePreference.data.keys["Auto Attack"]);
            trace(this.keyDict[this.litePreference.data.keys["Auto Attack"]]);
            if(i == 0)
            {
               txtKey.text = !this.litePreference.data.keys["Auto Attack"] ? " " : this.keyDict[this.litePreference.data.keys["Auto Attack"]];
            }
            else
            {
               txtKey.text = !this.litePreference.data.keys["Skill " + i] ? " " : this.keyDict[this.litePreference.data.keys["Skill " + i]];
            }
            txtKey.mouseEnabled = false;
         }
      }
      
      public function traceHack(msg:String) : void
      {
         this.chatF.pushMsg("server",msg,"SERVER","",0);
      }
      
      private function onUserFocus(event:FocusEvent) : *
      {
         if(this.mcLogin.ni.text == "click here")
         {
            this.mcLogin.ni.text = "";
         }
      }
      
      private function loadUserPreference() : *
      {
         if(this.userPreference.data.bitCheckedUsername)
         {
            this.mcLogin.ni.text = this.TempLoginName != "" ? this.TempLoginName : this.userPreference.data.strUsername;
            this.mcLogin.chkUserName.bitChecked = true;
         }
         if(this.userPreference.data.bitCheckedPassword)
         {
            this.mcLogin.pi.text = this.TempLoginPass != "" ? this.TempLoginPass : this.userPreference.data.strPassword;
            this.mcLogin.chkPassword.bitChecked = true;
         }
         this.mcLogin.chkUserName.checkmark.visible = this.mcLogin.chkUserName.bitChecked;
         this.mcLogin.chkPassword.checkmark.visible = this.mcLogin.chkPassword.bitChecked;
      }
      
      private function saveUserPreference() : *
      {
         this.userPreference.data.bitCheckedUsername = this.mcLogin.chkUserName.bitChecked;
         this.userPreference.data.bitCheckedPassword = this.mcLogin.chkPassword.bitChecked;
         if(this.mcLogin.chkUserName.bitChecked)
         {
            this.userPreference.data.strUsername = this.mcLogin.ni.text;
         }
         else
         {
            this.userPreference.data.strUsername = "";
         }
         if(this.mcLogin.chkPassword.bitChecked)
         {
            this.userPreference.data.strPassword = this.mcLogin.pi.text;
         }
         else
         {
            this.userPreference.data.strPassword = "";
         }
         try
         {
            this.userPreference.flush();
         }
         catch(e:Error)
         {
            trace(e.message);
         }
      }
      
      private function onCreateNewAccount(event:MouseEvent) : void
      {
         this.mixer.playSound("Click");
         gotoAndPlay("Account");
      }
      
      private function onForgotPassword(event:MouseEvent) : void
      {
         navigateToURL(new URLRequest("https://account.aq.com/Login/Forgot"));
      }
      
      private function onManageClick(e:MouseEvent) : void
      {
         navigateToURL(new URLRequest("http://127.0.0.1:8081/"));
      }
      
      private function onAccountRecovery(event:MouseEvent) : void
      {
         this.mixer.playSound("Click");
         navigateToURL(new URLRequest("https://www.aq.com/help/aw-account-recovery.asp"));
      }
      
      private function onLoginClick(event:MouseEvent) : void
      {
         if("btnLogin" in this.mcLogin && Boolean(this.mcLogin.btnLogin.visible))
         {
            if(this.mcLogin.ni.text != "" && this.mcLogin.pi.text != "")
            {
               try
               {
                  this.saveUserPreference();
               }
               catch(e:*)
               {
               }
               if(FacebookConnect.isLoggedIn)
               {
                  FacebookConnect.Logout();
               }
               this.login(this.mcLogin.ni.text.toLowerCase(),this.mcLogin.pi.text);
            }
         }
      }
      
      public function CallFBConnect(callback:Function) : void
      {
         this.addEventListener(FacebookConnectEvent.ONCONNECT,this.FBLoginCreate);
         trace("======> Setting FBConnectCallback <======");
         this.FBConnectCallback = callback;
         FacebookConnect.RequestFBConnect();
      }
      
      public function GetFBMe() : Object
      {
         return FacebookConnect.Me;
      }
      
      public function isFBLoggedIn() : Boolean
      {
         return FacebookConnect.isLoggedIn;
      }
      
      public function FBIP() : String
      {
         return FacebookConnect.IPAddr;
      }
      
      public function GetFBToken() : String
      {
         return FacebookConnect.AccessToken;
      }
      
      private function onFBLoginClick(e:MouseEvent) : void
      {
         if("btnLogin" in this.mcLogin && Boolean(this.mcLogin.btnLogin.visible))
         {
            this.mcConnDetail.showConn("Connecting to Facebook");
            this.addEventListener(FacebookConnectEvent.ONCONNECT,this.FBLogin);
            FacebookConnect.RequestFBConnect();
         }
      }
      
      public function FBLogin(fbevt:FacebookConnectEvent) : void
      {
         var rand:Number = NaN;
         var request:URLRequest = null;
         var variables:URLVariables = null;
         var loader:URLLoader = null;
         this.removeEventListener(FacebookConnectEvent.ONCONNECT,this.FBLogin);
         if(fbevt.params.success)
         {
            this.params.FBID = FacebookConnect.Me.id;
            this.params.token = FacebookConnect.AccessToken;
            rand = Number(this.rn.rand());
            this.mcConnDetail.showConn("Loading Server List...");
            request = new URLRequest(this.params.loginURL);
            variables = new URLVariables();
            variables.fbid = FacebookConnect.Me.id;
            variables.fbtoken = FacebookConnect.AccessToken;
            FacebookConnect.isLoggedIn = true;
            request.data = variables;
            request.method = URLRequestMethod.POST;
            loader = new URLLoader();
            loader.addEventListener(Event.COMPLETE,this.onLoginComplete);
            loader.load(request);
         }
         else
         {
            this.mcConnDetail.showError(fbevt.params.message);
         }
      }
      
      public function FBLoginCreate(fbevt:FacebookConnectEvent) : void
      {
         this.removeEventListener(FacebookConnectEvent.ONCONNECT,this.FBLoginCreate);
         if(this.FBConnectCallback != null)
         {
            trace("======> Game:  FBConnectCallback <======");
            try
            {
               this.FBConnectCallback();
            }
            catch(e:Error)
            {
               trace("Error FBConnectCallback: " + e.message);
            }
         }
         trace("======> Game: FBConnectCallback Null <======");
         this.FBConnectCallback = null;
      }
      
      public function getFBUser() : void
      {
         if(ISWEB)
         {
            this.extCall.getFBUser();
         }
      }
      
      public function login(strUsername:String, strPassword:String) : *
      {
         var rand:Number = NaN;
         var url:String = null;
         var request:URLRequest = null;
         var variables:URLVariables = null;
         var arrAllowLocal:Array = new Array("zhoom","ztest00","ztest01","ztest02","iterator","zdhz","yorumi");
         this.mcConnDetail.showConn("Authenticating Account Info...");
         loginInfo.strUsername = strUsername;
         loginInfo.strPassword = strPassword;
         rand = Number(this.rn.rand());
         url = "cf-userlogin.php?ran=" + rand;
         url = this.params.loginURL + "?ran=" + rand;
         trace("LoginURL: " + url);
         request = new URLRequest(url);
         variables = new URLVariables();
         variables.user = strUsername;
         variables.pass = strPassword;
         variables.option = ISWEB ? "0" : "1";
         if(this.checkPasswordStrength(strPassword) < 18)
         {
            this.bPassword = false;
         }
         if(this.params.strSourceID == "FACEBOOK")
         {
            variables.strSourceID = this.params.strSourceID;
            variables.fbid = this.params.FBID;
            variables.fbtoken = this.params.token;
         }
         else if(this.params.strSourceID == "TAGGED")
         {
            variables.strSourceID = this.params.strSourceID;
            variables.SrcUserID = this.params.SrcUserID;
            variables.token = this.params.token;
         }
         trace("Sending: " + variables);
         request.data = variables;
         request.method = URLRequestMethod.POST;
         this.loginLoader.removeEventListener(Event.COMPLETE,this.onLoginComplete);
         this.loginLoader.addEventListener(Event.COMPLETE,this.onLoginComplete);
         this.loginLoader.addEventListener(IOErrorEvent.IO_ERROR,this.onLoginError,false,0,true);
         try
         {
            this.loginLoader.load(request);
         }
         catch(error:Error)
         {
            trace("Unable to load URL");
         }
      }
      
      public function onLoginError(e:Event) : void
      {
         trace("Login Failed!" + e);
      }
      
      public function onLoginComplete(event:Event) : void
      {
         var _obj:Object = null;
         trace("LoginComplete:" + event.target.data);
         try
         {
            _obj = JSON.parse(event.target.data);
            if(_obj.login)
            {
               objLogin = _obj.login;
               objLogin.servers = _obj.servers;
               this.playerPollData = _obj.polldata;
            }
            else
            {
               objLogin = _obj;
            }
            this.loginLoader.removeEventListener(Event.COMPLETE,this.onLoginComplete);
            if(objLogin.bSuccess == 1)
            {
               try
               {
                  loginInfo.strUsername = objLogin.unm.toLowerCase();
               }
               catch(e:*)
               {
                  trace("caught loginInfo.strUsername null");
               }
               if(loginInfo.strUsername != null)
               {
                  if(loginInfo.strUsername.toLowerCase() == "iterator" || loginInfo.strUsername.toLowerCase() == "iterator2" || loginInfo.strUsername.toLowerCase() == "iterator3" || loginInfo.strUsername.toLowerCase() == "iterator4")
                  {
                     this.serialCmdMode = true;
                  }
                  else
                  {
                     this.serialCmdMode = false;
                  }
               }
               else
               {
                  this.serialCmdMode = false;
               }
               if(objLogin.FBID != null)
               {
                  trace("!! LoginComplete found FBInfo !!");
                  if(FacebookConnect.Me == null)
                  {
                     FacebookConnect.Me = new Object();
                  }
                  FacebookConnect.Me.id = objLogin.FBID;
                  if(objLogin.FBName != null)
                  {
                     FacebookConnect.Me.name = objLogin.FBName;
                  }
               }
               if(this.fbL != null)
               {
                  this.fbL.destroy();
               }
               trace("GOT HERE?");
               if(ISWEB)
               {
                  this.extCall.getFBUser();
               }
               this.mcConnDetail.hideConn();
               loginInfo.strToken = objLogin.sToken;
               this.sToken = loginInfo.strToken;
               strToken = loginInfo.strToken;
               if(ISWEB)
               {
                  this.extCall.setToken(loginInfo);
               }
               if(this.serialCmdMode)
               {
                  this.mcLogin.testClientAssets.visible = false;
                  this.mcLogin.gotoAndStop("Iterator");
               }
               else
               {
                  this.mcLogin.gotoAndStop("Servers");
                  trace("This Should work?");
               }
            }
            else if(objLogin.sMsg.indexOf("Facebook") > -1)
            {
               this.mcConnDetail.hideConn();
               this.fbL = new fbLinkWindow(this.mcLogin.fbConnect,this as MovieClip);
               this.mcLogin.fbConnect.visible = true;
            }
            else
            {
               this.mcConnDetail.showError(objLogin.sMsg);
            }
         }
         catch(e:*)
         {
            trace("caught LoginComplete error");
         }
         this.resetsOnNewSession();
      }
      
      public function resetsOnNewSession() : void
      {
         if(Boolean(this.litePreference.data.bDebugger) && objLogin.iAccess < 30)
         {
            optionHandler.cmd(MovieClip(this),"@ Debugger");
         }
      }
      
      public function deepCopy(tgt:*, src:*) : void
      {
         var prop:* = undefined;
         for(prop in src)
         {
            if(typeof (src as Object)[prop] == "object")
            {
               (tgt as Object)[prop] = new Object();
               this.deepCopy((tgt as Object)[prop],(src as Object)[prop]);
            }
            else if((src as Object)[prop])
            {
               (tgt as Object)[prop] = (src as Object)[prop];
            }
         }
      }
      
      public function deepCopyArr(tgt:*, src:*) : void
      {
         var prop:* = undefined;
         for each(prop in src)
         {
            tgt.push(prop);
         }
      }
      
      public function saveChar() : void
      {
         var _objData:Object = null;
         var ctr:int = 0;
         var _:* = undefined;
         var _loginInfo:Object = null;
         if(FacebookConnect.isLoggedIn || !this.litePreference.data.bCharSelect)
         {
            return;
         }
         _objData = new Object();
         _objData["strGender"] = this.world.myAvatar.objData.strGender;
         _objData["strHairFilename"] = this.world.myAvatar.objData.strHairFilename;
         _objData["strHairName"] = this.world.myAvatar.objData.strHairName;
         _objData["eqp"] = {};
         this.deepCopy(_objData["eqp"],this.world.myAvatar.objData.eqp);
         _objData["intGold"] = this.world.myAvatar.objData.intGold;
         _objData["intCoins"] = this.world.myAvatar.objData.intCoins;
         _objData["strClassName"] = this.world.myAvatar.objData.strClassName;
         _objData["iCP"] = this.world.myAvatar.objData.iCP;
         _objData["intLevel"] = this.world.myAvatar.objData.intLevel;
         _objData["strUsername"] = this.world.myAvatar.objData.strUsername;
         _objData["intAccessLevel"] = this.world.myAvatar.objData.intAccessLevel;
         _objData["iUpgDays"] = this.world.myAvatar.objData.iUpgDays;
         _objData["intColorSkin"] = this.world.myAvatar.objData.intColorSkin;
         _objData["intColorHair"] = this.world.myAvatar.objData.intColorHair;
         _objData["intColorEye"] = this.world.myAvatar.objData.intColorEye;
         _objData["intColorBase"] = this.world.myAvatar.objData.intColorBase;
         _objData["intColorTrim"] = this.world.myAvatar.objData.intColorTrim;
         _objData["intColorAccessory"] = this.world.myAvatar.objData.intColorAccessory;
         if(this.world.myAvatar.objData.guild != null)
         {
            _objData["guild"] = {};
            _objData["guild"]["Name"] = this.world.myAvatar.objData.guild.Name;
         }
         _objData["showHelm"] = this.world.myAvatar.dataLeaf.showHelm;
         _objData["showCloak"] = this.world.myAvatar.dataLeaf.showCloak;
         if(Boolean(this.characters.data.users) && Boolean(this.characters.data.users[this.world.myAvatar.pnm.toLowerCase()]))
         {
            (this.characters.data.users[this.world.myAvatar.pnm.toLowerCase()] as Object).data = _objData;
            (this.characters.data.users[this.world.myAvatar.pnm.toLowerCase()] as Object).server = this.objServerInfo.sName;
         }
         else
         {
            ctr = 0;
            for(_ in this.characters.data.users)
            {
               ctr++;
            }
            if(ctr >= 5)
            {
               return;
            }
            (loginInfo as Object).bAsk = false;
            _loginInfo = new Object();
            this.deepCopy(_loginInfo,loginInfo);
            this.characters.data.users[this.world.myAvatar.pnm.toLowerCase()] = {
               "index":-1,
               "data":_objData,
               "server":this.objServerInfo.sName,
               "loginInfo":_loginInfo
            };
         }
         this.characters.flush();
      }
      
      public function charCount() : int
      {
         return 0;
      }
      
      public function retroLowercase() : void
      {
         var notOK:Boolean = false;
         var pname:* = undefined;
         var i:int = 0;
         if(this.charCount() == 0)
         {
            return;
         }
         if(this.characters.data.retro)
         {
            return;
         }
         trace("Retro lowercase");
         notOK = false;
         for(pname in this.characters.data.users)
         {
            for(i = 0; i < pname.length; i++)
            {
               if(pname.charAt(i) != pname.charAt(i).toLowerCase())
               {
                  notOK = true;
                  break;
               }
            }
            if(notOK)
            {
               break;
            }
         }
         if(notOK)
         {
            this.resetChars();
         }
         else
         {
            this.characters.data.retro = true;
         }
      }
      
      public function resetChars() : void
      {
         this.characters.data.users = null;
         delete this.characters.data.users;
         this.characters.flush();
      }
      
      private function loadExternalAssets() : void
      {
         var l:Loader = null;
         var u:* = undefined;
         trace("loadExternalAssets");
         this.mcConnDetail.showConn("Initializing Client...");
         l = new Loader();
         u = new URLRequest(serverFilePath + "interface/Assets/assets_2026.swf");
         l.contentLoaderInfo.addEventListener(Event.COMPLETE,this.assetsLoaderCallback,false,0,true);
         l.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR,this.assetsLoaderErrorHandler,false,0,true);
         l.load(u,this.assetsContext);
      }
      
      private function assetsLoaderCallback(e:Event) : void
      {
         var loaderInfo:LoaderInfo = null;
         trace("assetsLoaderCallback()");
         loaderInfo = e.currentTarget as LoaderInfo;
         if(loaderInfo != null)
         {
            loaderInfo.removeEventListener(Event.COMPLETE,this.assetsLoaderCallback);
            loaderInfo.removeEventListener(IOErrorEvent.IO_ERROR,this.assetsLoaderErrorHandler);
         }
         ASSETS_READY = "assets_2026.swf";
         this.resumeOnLoginResponse();
      }
      
      private function resumeOnLoginResponse() : void
      {
         var i:int = 0;
         this.mcConnDetail.showConn("Joining Lobby..");
         this.sfc.sendXtMessage("zm","firstJoin",[],"str",1);
         if(this.chatF.ignoreList.data.users.length > 0)
         {
            for(i = 0; i < this.chatF.ignoreList.data.users.length; i++)
            {
               if(this.chatF.ignoreList.data.users[i].toLowerCase() == loginInfo.strUsername.toLowerCase())
               {
                  this.chatF.ignoreList.data.users.splice(i,1);
                  break;
               }
            }
            this.sfc.sendXtMessage("zm","cmd",["ignoreList",this.chatF.ignoreList.data.users],"str",1);
         }
         else
         {
            this.sfc.sendXtMessage("zm","cmd",["ignoreList","$clearAll"],"str",1);
         }
      }
      
      private function assetsLoaderErrorHandler(e:IOErrorEvent) : void
      {
         var loaderInfo:LoaderInfo = null;
         loaderInfo = e.currentTarget as LoaderInfo;
         if(loaderInfo != null)
         {
            loaderInfo.removeEventListener(Event.COMPLETE,this.assetsLoaderCallback);
            loaderInfo.removeEventListener(IOErrorEvent.IO_ERROR,this.assetsLoaderErrorHandler);
         }
         trace("[WARNING] External Assets failed to load!");
         trace(e);
         this.mcConnDetail.showError("Client Initialization Failed!");
      }
      
      public function connectTo(strIP:String, iPort:int = 5588) : *
      {
         trace("connecting to:" + strIP);
         serverIP = strIP;
         this.mixer.playSound("ClickBig");
         this.mcConnDetail.showConn("Connecting to game server...");
         if(this.sfc.isConnected)
         {
            this.sfc.disconnect();
         }
         this.sfc.connect(strIP,iPort);
         gotoAndPlay("Game");
      }
      
      public function displayCharPage(unm:String) : void
      {
         var charPage:* = undefined;
         charPage = new charPage(this,unm);
         this.ui.addChild(charPage);
      }
      
      public function togglePolls() : void
      {
         this.requestInterface("polls/pollingsystem.swf","pollingSystem");
      }
      
      public function requestInterface(tInterface:String, nam:String) : void
      {
         this.removeDeadInterfaces();
         this.interfaceQueue.push({
            "nam":nam,
            "intrf":tInterface
         });
         if(this.interfaceQueue.length == 1)
         {
            this.checkInterfaceQueue();
         }
      }
      
      public function checkInterfaceQueue() : void
      {
         var interfaceLoader:Loader = null;
         if(this.interfaceQueue.length < 1)
         {
            return;
         }
         this.visualLoader = new mcLoader();
         this.visualLoader.x = 400;
         this.visualLoader.y = 211;
         this.addChild(this.visualLoader);
         interfaceLoader = new Loader();
         interfaceLoader.contentLoaderInfo.addEventListener(Event.COMPLETE,this.onInterfaceComplete,false,0,true);
         interfaceLoader.contentLoaderInfo.addEventListener(ProgressEvent.PROGRESS,this.onInterfaceProgress,false,0,true);
         interfaceLoader.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR,this.onInterfaceError,false,0,true);
         interfaceLoader.load(new URLRequest(this.getFilePath() + "interface/" + this.interfaceQueue[0].intrf + "?v=" + this.world.objInfo["sVersion"]),new LoaderContext(false,new ApplicationDomain(ApplicationDomain.currentDomain)));
      }
      
      public function onInterfaceComplete(e:Event) : void
      {
         var loaderInfo:LoaderInfo = null;
         var newmc:* = undefined;
         var mc:* = undefined;
         loaderInfo = e.currentTarget as LoaderInfo;
         if(loaderInfo != null)
         {
            loaderInfo.removeEventListener(Event.COMPLETE,this.onInterfaceComplete);
            loaderInfo.removeEventListener(ProgressEvent.PROGRESS,this.onInterfaceProgress);
            loaderInfo.removeEventListener(IOErrorEvent.IO_ERROR,this.onInterfaceError);
         }
         newmc = new MovieClip();
         newmc.addChild(e.currentTarget.content);
         newmc.name = this.interfaceQueue[0].nam;
         mc = this.addChild(newmc);
         if(this.interfaceRef.hasOwnProperty(this.interfaceQueue[0].nam))
         {
            if(this.interfaceRef[this.interfaceQueue[0].nam])
            {
               if(this.interfaceRef[this.interfaceQueue[0].nam].parent)
               {
                  MovieClip(this.interfaceRef[this.interfaceQueue[0].nam].parent).removeChild(this.interfaceRef[this.interfaceQueue[0].nam]);
               }
            }
         }
         this.interfaceRef[this.interfaceQueue[0].nam] = mc;
         this.interfaceQueue.shift();
         this.checkInterfaceQueue();
         this.setChildIndex(this.MsgBox,numChildren - 1);
         if(newmc.name == "pony_engine")
         {
            this.world.myAvatar.swapMorphs(true);
         }
      }
      
      public function cleanupInterfaces() : void
      {
         var intf:* = undefined;
         for each(intf in this.interfaceRef)
         {
            if(intf)
            {
               if(intf.parent)
               {
                  MovieClip(intf.parent).removeChild(intf);
               }
            }
         }
         this.interfaceRef = new Object();
      }
      
      public function removeDeadInterfaces() : void
      {
         var nam:String = null;
         var toDelete:Array = null;
         var intf:* = undefined;
         toDelete = [];
         for(nam in this.interfaceRef)
         {
            intf = this.interfaceRef[nam];
            if(intf)
            {
               if(!intf.parent)
               {
                  toDelete.push(nam);
               }
            }
         }
         for each(nam in toDelete)
         {
            delete this.interfaceRef[nam];
         }
      }
      
      public function getInterface(nam:String) : *
      {
         var intf:* = undefined;
         intf = this.interfaceRef[nam];
         if(intf)
         {
            if(intf.parent)
            {
               return intf;
            }
            delete this.interfaceRef[nam];
         }
         return null;
      }
      
      public function onInterfaceProgress(e:ProgressEvent) : void
      {
         var percent:int = 0;
         this.interfaceLoaded = e.bytesLoaded;
         this.interfaceTotal = e.bytesTotal;
         percent = this.interfaceLoaded / this.interfaceTotal * 100;
         var barProg:Number = this.interfaceLoaded / this.interfaceTotal;
         this.visualLoader.mcPct.text = percent + "%";
         if(this.interfaceLoaded >= this.interfaceTotal)
         {
            this.visualLoader.parent.removeChild(this.visualLoader);
            this.visualLoader = null;
         }
      }
      
      public function onInterfaceError(e:IOErrorEvent) : void
      {
         var loaderInfo:LoaderInfo = null;
         loaderInfo = e.currentTarget as LoaderInfo;
         if(loaderInfo != null)
         {
            loaderInfo.removeEventListener(Event.COMPLETE,this.onInterfaceComplete);
            loaderInfo.removeEventListener(ProgressEvent.PROGRESS,this.onInterfaceProgress);
            loaderInfo.removeEventListener(IOErrorEvent.IO_ERROR,this.onInterfaceError);
         }
         trace("Failed to load interface: " + e);
      }
      
      public function requestAPI(api:String, data:*, completeCallback:*, ioCallback:*, force:Boolean = false) : void
      {
         var loader:URLLoader = null;
         var headers:Array = null;
         var variables:URLVariables = null;
         var request:URLRequest = null;
         var key:* = undefined;
         loader = new URLLoader();
         loader.addEventListener(Event.COMPLETE,completeCallback,false,0,true);
         loader.addEventListener(IOErrorEvent.IO_ERROR,ioCallback,false,0,true);
         headers = [new URLRequestHeader("ccid",this.world.myAvatar.objData.CharID),new URLRequestHeader("token",loginInfo.strToken)];
         variables = new URLVariables();
         if(data != null)
         {
            for(key in data)
            {
               variables[key] = key == "layout" ? JSON.stringify(data[key]) : data[key];
            }
         }
         request = new URLRequest(serverGamePath + "api/char/" + api + (force ? "?v=" + Math.random() : ""));
         request.requestHeaders = headers;
         if(data != null)
         {
            request.data = variables;
         }
         trace(variables);
         request.method = URLRequestMethod.POST;
         loader.load(request);
      }
      
      public function getBank() : void
      {
         this.requestAPI("bank",{"layout":{"cat":"all"}},this.onBankComplete,this.onBankError,true);
      }
      
      public function onBankComplete(e:Event) : void
      {
         trace("Bank load complete");
         this.world.addItemsToBank(JSON.parse(e.target.data) as Array);
      }
      
      public function onBankError(e:IOErrorEvent) : void
      {
         this.mcConnDetail.showConn("Error loading bank information");
      }
      
      public function retrieveInfo(clientvars:Array) : void
      {
         var loader:URLLoader = null;
         var val:* = undefined;
         if(this.world == null)
         {
            this.initWorld();
         }
         if(serverGamePath.indexOf("content.aq") == -1)
         {
            for each(val in clientvars)
            {
               this.world.objInfo[val.split("=")[0]] = val.substr(val.indexOf("=") + 1);
            }
            this.iMaxBagSlots = Number(this.world.objInfo["iMaxBagSlots"]);
            this.iMaxBankSlots = Number(this.world.objInfo["iMaxBankSlots"]);
            this.iMaxHouseSlots = Number(this.world.objInfo["iMaxHouseSlots"]);
            this.iMaxFriends = Number(this.world.objInfo["iMaxFriends"]);
            this.iMaxLoadoutSlots = Number(this.world.objInfo["iMaxLoadoutSlots"]);
            if(ASSETS_READY == clientvars["sAssets"])
            {
               this.BOOK_DATA_READY = null;
               this.resumeOnLoginResponse();
            }
            else
            {
               this.BOOK_DATA_READY = null;
               this.loadExternalAssets();
            }
            return;
         }
         loader = new URLLoader();
         loader.addEventListener(Event.COMPLETE,this.onInfoComplete,false,0,true);
         loader.addEventListener(IOErrorEvent.IO_ERROR,this.onInfoError,false,0,true);
         loader.load(new URLRequest(serverGamePath + "api/data/clientvars?v=" + Math.random()));
      }
      
      public function retrieveBook() : void
      {
         var loader_BoL:URLLoader = null;
         if(this.ui.getChildByName("travelLoaderMC"))
         {
            return;
         }
         this.travelLoaderMC = new (this.world.getClass("mcLoader") as Class)();
         this.travelLoaderMC.x = 400;
         this.travelLoaderMC.y = 211;
         this.travelLoaderMC.name = "travelLoaderMC";
         this.ui.addChild(this.travelLoaderMC);
         loader_BoL = new URLLoader();
         loader_BoL.addEventListener(Event.COMPLETE,this.onBoLComplete,false,0,true);
         loader_BoL.addEventListener(ProgressEvent.PROGRESS,this.onBoLProgress,false,0,true);
         loader_BoL.addEventListener(IOErrorEvent.IO_ERROR,this.onBoLError,false,0,true);
         loader_BoL.load(new URLRequest(serverGamePath + "api/data/booklore?v=" + this.world.objInfo["sVersion"]));
      }
      
      public function onInfoComplete(e:Event) : void
      {
         var loader:URLLoader = null;
         var sInfo:Object = null;
         var i:* = undefined;
         loader = e.target as URLLoader;
         if(loader != null)
         {
            loader.removeEventListener(Event.COMPLETE,this.onInfoComplete);
            loader.removeEventListener(IOErrorEvent.IO_ERROR,this.onInfoError);
         }
         if(this.world == null)
         {
            this.initWorld();
         }
         sInfo = JSON.parse(e.target.data);
         for(i in sInfo)
         {
            this.world.objInfo[i] = sInfo[i];
         }
         this.iMaxBagSlots = Number(sInfo["iMaxBagSlots"]);
         this.iMaxBankSlots = Number(sInfo["iMaxBankSlots"]);
         this.iMaxHouseSlots = Number(sInfo["iMaxHouseSlots"]);
         this.iMaxFriends = Number(sInfo["iMaxFriends"]);
         this.iMaxLoadoutSlots = Number(sInfo["iMaxLoadoutSlots"]);
         if(ASSETS_READY == sInfo["sAssets"])
         {
            this.BOOK_DATA_READY = null;
            this.resumeOnLoginResponse();
         }
         else
         {
            this.BOOK_DATA_READY = null;
            this.loadExternalAssets();
         }
      }
      
      public function onInfoError(e:IOErrorEvent) : void
      {
         var loader:URLLoader = null;
         loader = e.target as URLLoader;
         if(loader != null)
         {
            loader.removeEventListener(Event.COMPLETE,this.onInfoComplete);
            loader.removeEventListener(IOErrorEvent.IO_ERROR,this.onInfoError);
         }
         this.mcConnDetail.showConn("Error loading client vars");
      }
      
      public function onBoLComplete(e:Event) : void
      {
         var loader:URLLoader = null;
         var sInfo:Object = null;
         loader = e.target as URLLoader;
         if(loader != null)
         {
            loader.removeEventListener(Event.COMPLETE,this.onBoLComplete);
            loader.removeEventListener(ProgressEvent.PROGRESS,this.onBoLProgress);
         }
         sInfo = JSON.parse(e.target.data);
         this.world.bookData = sInfo;
         this.BOOK_DATA_READY = sInfo;
         this.ui.mcPopup.mcBook.removeChildAt(0);
         if(this.bolContent)
         {
            if(this.newInstance)
            {
               this.newInstance = false;
               this.bolContent.gotoAndStop("NavMenu");
            }
            this.ui.mcPopup.mcBook.addChild(this.bolContent);
            return;
         }
         this.bolLoader = new Loader();
         this.bolLoader.contentLoaderInfo.addEventListener(Event.COMPLETE,this.onBoLContentComplete,false,0,true);
         this.bolLoader.load(new URLRequest(Game.serverFilePath + this.world.objInfo.sBook),new LoaderContext(false,new ApplicationDomain(ApplicationDomain.currentDomain)));
      }
      
      public function onBoLContentComplete(e:Event) : void
      {
         trace("BoL Completed");
         if(this.bolLoader != null)
         {
            this.bolLoader.contentLoaderInfo.removeEventListener(Event.COMPLETE,this.onBoLContentComplete);
         }
         this.bolContent = e.currentTarget.content;
         this.ui.mcPopup.mcBook.addChild(this.bolContent);
      }
      
      private function onBoLProgress(event:ProgressEvent) : void
      {
         var percent:int = 0;
         this.bLoaded = event.bytesLoaded;
         this.bTotal = event.bytesTotal;
         percent = this.bLoaded / this.bTotal * 100;
         var barProg:Number = this.bLoaded / this.bTotal;
         this.travelLoaderMC.mcPct.text = percent + "%";
         if(this.bLoaded >= this.bTotal)
         {
            this.travelLoaderMC.parent.removeChild(this.travelLoaderMC);
            this.travelLoaderMC = null;
         }
      }
      
      private function onBoLError(e:IOErrorEvent) : void
      {
         trace("BoL load failed: " + e);
         if(this.travelLoaderMC)
         {
            this.travelLoaderMC.parent.removeChild(this.travelLoaderMC);
            this.travelLoaderMC = null;
         }
      }
      
      public function serialCmdInit(cmd:String) : void
      {
         var sl:* = undefined;
         var cmdBar:* = undefined;
         sl = this.mcLogin.il;
         cmdBar = sl.cmd;
         cmdBar.btnUnselectAll.visible = false;
         cmdBar.btnSelectAll.visible = false;
         cmdBar.btnGo.visible = false;
         this.serialCmd.si = 0;
         this.serialCmd.cmd = cmd;
         this.serialCmd.active = true;
         this.serialCmdNext();
      }
      
      private function serialCmdNext() : void
      {
         var date_now:Date = null;
         var sl:* = undefined;
         var prevServer:* = undefined;
         date_now = new Date();
         sl = this.mcLogin.il.iClass;
         var cmdBar:* = this.mcLogin.il.cmd;
         if(this.serialCmd.si > 0)
         {
            prevServer = sl.getServerItemByIP(this.serialCmd.servers[this.serialCmd.si - 1].sIP,this.serialCmd.servers[this.serialCmd.si - 1].iPort);
            if(prevServer != null)
            {
               sl.serverOn(prevServer);
               prevServer.t3.text = (date_now.getTime() - this.serialCmd.ts) / 1000 + " s";
               prevServer.t3.visible = true;
            }
         }
         trace("DEBUG: " + this.serialCmd.si + "\t" + this.serialCmd.servers.length);
         if(this.serialCmd.si < this.serialCmd.servers.length)
         {
            trace("connecting to: " + this.serialCmd.servers[this.serialCmd.si].sName);
            this.sfc.connect(this.serialCmd.servers[this.serialCmd.si].sIP,this.serialCmd.servers[this.serialCmd.si].iPort);
            ++this.serialCmd.si;
            this.serialCmd.ts = date_now.getTime();
         }
         else
         {
            this.serialCmdDone();
         }
      }
      
      private function serialCmdDone() : void
      {
         var sl:* = undefined;
         var cmdBar:* = undefined;
         sl = this.mcLogin.il;
         cmdBar = sl.cmd;
         cmdBar.btnUnselectAll.visible = true;
         cmdBar.btnSelectAll.visible = true;
         cmdBar.btnGo.visible = true;
         this.serialCmd.active = false;
      }
      
      public function readIA1Preferences() : void
      {
         this.uoPref.bCloak = this.world.getAchievement("ia1",0) == 0;
         this.uoPref.bHelm = this.world.getAchievement("ia1",1) == 0;
         this.uoPref.bPet = this.world.getAchievement("ia1",2) == 0;
         this.uoPref.bWAnim = this.world.getAchievement("ia1",3) == 0;
         this.uoPref.bGoto = this.world.getAchievement("ia1",4) == 0;
         this.uoPref.bMusicOn = this.world.getAchievement("ia1",6) == 0;
         this.uoPref.bFriend = this.world.getAchievement("ia1",7) == 0;
         this.uoPref.bParty = this.world.getAchievement("ia1",8) == 0;
         this.uoPref.bGuild = this.world.getAchievement("ia1",9) == 0;
         this.uoPref.bWhisper = this.world.getAchievement("ia1",10) == 0;
         this.uoPref.bTT = this.world.getAchievement("ia1",11) == 0;
         this.uoPref.bFBShare = this.world.getAchievement("ia1",12) == 1;
         this.uoPref.bDuel = this.world.getAchievement("ia1",13) == 0;
         this.world.hideAllCapes = this.world.getAchievement("ia1",14) == 1;
         this.world.hideOtherPets = this.world.getAchievement("ia1",15) == 1;
         this.world.showAnimations = this.world.getAchievement("ia1",17) == 0;
         this.uoPref.bProf = this.world.getAchievement("ia1",18) == 0;
         this.uoPref.bFBShard = false;
         this.mixer.stf = new SoundTransform(this.litePreference.data.dOptions["iSoundFX"] != null ? Number(this.litePreference.data.dOptions["iSoundFX"]) : 1);
         SoundMixer.soundTransform = new SoundTransform(this.litePreference.data.dOptions["iSoundAll"] != null ? Number(this.litePreference.data.dOptions["iSoundAll"]) : 1);
      }
      
      public function inituoPref() : void
      {
         this.uoPref.bCloak = true;
         this.uoPref.bHelm = true;
         this.uoPref.bPet = true;
         this.uoPref.bWAnim = true;
         this.uoPref.bGoto = true;
         this.uoPref.bMusicOn = true;
         this.uoPref.bFriend = true;
         this.uoPref.bParty = true;
         this.uoPref.bGuild = true;
         this.uoPref.bWhisper = true;
         this.uoPref.bTT = true;
         this.uoPref.bFBShare = false;
         this.uoPref.bDuel = true;
      }
      
      public function initKeybindPref(force:Boolean = false) : void
      {
         if(Boolean(this.litePreference.data.keys) && !this.litePreference.data.keys["Dash"])
         {
            this.litePreference.data.keys["Dash"] = 32;
            this.litePreference.data.keys["Jump"] = null;
         }
         if(Boolean(this.litePreference.data.keys) && !force)
         {
            return;
         }
         this.litePreference.data.keys = {};
         this.litePreference.data.keys["Camera Tool"] = 219;
         this.litePreference.data.keys["World Camera"] = 221;
         this.litePreference.data.keys["Target Random Monster"] = 84;
         this.litePreference.data.keys["Inventory"] = 73;
         this.litePreference.data.keys["Bank"] = 66;
         this.litePreference.data.keys["Quest Log"] = 76;
         this.litePreference.data.keys["Friends List"] = 70;
         this.litePreference.data.keys["Character Panel"] = 67;
         this.litePreference.data.keys["Player HP Bar"] = 86;
         this.litePreference.data.keys["Options"] = 79;
         this.litePreference.data.keys["Area List"] = 85;
         this.litePreference.data.keys["Jump"] = null;
         this.litePreference.data.keys["Auto Attack"] = 49;
         this.litePreference.data.keys["Skill 1"] = 50;
         this.litePreference.data.keys["Skill 2"] = 51;
         this.litePreference.data.keys["Skill 3"] = 52;
         this.litePreference.data.keys["Skill 4"] = 53;
         this.litePreference.data.keys["Skill 5"] = 54;
         this.litePreference.data.keys["Travel Menu\'s Travel"] = 89;
         this.litePreference.data.keys["World Camera\'s Hide"] = 72;
         this.litePreference.data.keys["Rest"] = 88;
         this.litePreference.data.keys["Hide Monsters"] = null;
         this.litePreference.data.keys["Hide Players"] = null;
         this.litePreference.data.keys["Cancel Target"] = 27;
         this.litePreference.data.keys["Hide UI"] = null;
         this.litePreference.data.keys["Battle Analyzer"] = null;
         this.litePreference.data.keys["Decline All Drops"] = null;
         this.litePreference.data.keys["Stats Overview"] = null;
         this.litePreference.data.keys["Battle Analyzer Toggle"] = null;
         this.litePreference.data.keys["Custom Drops UI"] = null;
         this.litePreference.data.keys["@ Debugger - Cell Menu"] = 192;
         this.litePreference.data.keys["@ Debugger - Packet Logger"] = null;
         this.litePreference.data.keys["Dash"] = 32;
         this.litePreference.data.keys["Outfits"] = null;
         this.litePreference.data.keys["Friendships UI"] = null;
      }
      
      public function debugMessage(s:String) : void
      {
         if(!this.litePreference.data.bDebugger)
         {
            return;
         }
         this.chatF.pushMsg("warning",s,"SERVER","",0);
      }
      
      public function initlitePref() : void
      {
         if(this.litePreference.data.dOptions == null)
         {
            this.litePreference.data.dOptions = {};
         }
         if(this.litePreference.data.dOptions["termsAgree"] == null)
         {
            this.litePreference.data.dOptions["termsAgree"] = true;
         }
         this.litePref = [{
            "strName":"@ Debugger",
            "bEnabled":this.litePreference.data.bDebugger,
            "sDesc":"Debug Mode!\nPress ` (Changeable in Keybinds) to hide/show the cell & pads menu!",
            "minAccess":30,
            "extra":[{
               "strName":"Disable Linkage Errors",
               "bEnabled":this.litePreference.data.dOptions["debugLinkage"],
               "sDesc":"Avoid receiving linkage error messages"
            },{
               "strName":"Disable Color Coded Items",
               "bEnabled":this.litePreference.data.dOptions["debugColor"],
               "sDesc":"Prevents color coding of item entries\nRed item = costs 0 ac/gold\nRed item = item is AC and > 12k\nYellow item = is staff"
            },{
               "strName":"Packet Logger",
               "bEnabled":this.litePreference.data.dOptions["debugPacket"],
               "sDesc":"View all packets sent to the client.\nMust be enabled to use.\nSet a keybind to hide/show the packet logger window."
            }]
         },{
            "strName":"Allow Quest Log Turn-Ins",
            "bEnabled":this.litePreference.data.bQuestLog,
            "sDesc":"Allows you to turn-in quests using your quest log on the bottom right screen!"
         },{
            "strName":"Auto-Untarget Dead Targets",
            "bEnabled":this.litePreference.data.bUntargetDead,
            "sDesc":"This will untarget targets that are dead."
         },{
            "strName":"Auto-Untarget Self",
            "bEnabled":this.litePreference.data.bUntargetSelf,
            "sDesc":"This will prevent you from targetting yourself."
         },{
            "strName":"Battle Analyzer",
            "extra":"btn",
            "sDesc":"This will allow you to monitor your damage dealt, gold earned, and many more!"
         },{
            "strName":"Battlepets",
            "bEnabled":this.litePreference.data.bBattlepet,
            "sDesc":"Allows your battlepet to fight alongside you without a battlepet class equipped."
         },{
            "strName":"Static Player Art",
            "bEnabled":this.litePreference.data.bCachePlayers,
            "sDesc":"Reduces the graphics of other players. \n!WARNING! Having this enabled may or may not show some of the other player\'s colors. You will not be able to see their equipment changes with this enabled either.\nYou must change rooms after turning this feature off in order for changes to take effect"
         },{
            "strName":"Char Page",
            "special":1,
            "sDesc":"Search Character Pages"
         },{
            "strName":"Character Select Screen",
            "bEnabled":this.litePreference.data.bCharSelect,
            "sDesc":"Allows you to replace the login screen with a character select screen."
         },{
            "strName":"Chat Settings",
            "bEnabled":this.litePreference.data.bChatFilter,
            "sDesc":"Allow the customization of the game\'s chat window with the options below!",
            "extra":[{
               "strName":"Timestamps",
               "bEnabled":this.litePreference.data.dOptions["timeStamps"],
               "sDesc":"Adding timestamps to chat messages (Server Time)\nOnly works on the old chat ui!"
            },{
               "strName":"Disable Red Messages",
               "bEnabled":this.litePreference.data.dOptions["disRed"],
               "sDesc":"Avoid receiving combat warning messages in chat"
            }]
         },{
            "strName":"Chat UI",
            "bEnabled":this.litePreference.data.bChatUI,
            "sDesc":"If enabled, you will switch to the new Chat UI.",
            "extra":[{
               "strName":"Minimal Mode",
               "bEnabled":this.litePreference.data.dOptions["chatMinimal"],
               "sDesc":"Less intrusive on your gameplay!\nHover over the message box to make the messages visible\nScroll over the message box to scroll!"
            },{
               "strName":"Disable AutoScroll to Bottom",
               "bEnabled":this.litePreference.data.dOptions["chatScroll"],
               "sDesc":"The Chat UI will not automatically scroll to the bottom on a new message"
            }]
         },{
            "strName":"Class Actives/Auras UI",
            "bEnabled":this.litePreference.data.bAuras,
            "sDesc":"Work in Progress. No proper stack limit and icons yet.\nAllows you to view your buffs/auras underneath your player portrait and for your enemies as well!",
            "extra":[{
               "strName":"Disable ToolTips",
               "bEnabled":this.litePreference.data.dOptions["disAuraTips"],
               "sDesc":"Prevents you from seeing tooltips when hovering over an aura."
            },{
               "strName":"Disable Aura Text",
               "bEnabled":this.litePreference.data.dOptions["disAuraText"],
               "sDesc":"Prevents you from seeing the yellow aura text on you or other players."
            }]
         },{
            "strName":"Color Sets",
            "bEnabled":this.litePreference.data.bColorSets,
            "sDesc":"Save your colors with this tool that appears when you go customizing your hair or armor colors!"
         },{
            "strName":"Custom Drops UI",
            "bEnabled":this.litePreference.data.bCustomDrops,
            "sDesc":"Shift+Click to block an item drop!\nYour bank items must be loaded to detect if you already have an item",
            "extra":[{
               "strName":"Invert Menu",
               "bEnabled":this.litePreference.data.dOptions["invertMenu"],
               "sDesc":"The drop menu will appear at the top of the screen rather than appearing at the bottom"
            },{
               "strName":"Warn When Declining A Drop",
               "bEnabled":this.litePreference.data.dOptions["warnDecline"],
               "sDesc":"A confirmation box will appear to confirm if you want to decline an item drop"
            },{
               "strName":"Hide Drop Notifications",
               "bEnabled":this.litePreference.data.dOptions["hideDrop"],
               "sDesc":"This will hide regular drop notifications"
            },{
               "strName":"Hide Temporary Drop Notifications",
               "bEnabled":this.litePreference.data.dOptions["hideTemp"],
               "sDesc":"This will hide temporary drop notifications"
            },{
               "strName":"Opened Menu",
               "bEnabled":this.litePreference.data.dOptions["openMenu"],
               "sDesc":"The Custom Drops UI will start up opened rather than closed"
            },{
               "strName":"Draggable Mode",
               "bEnabled":this.litePreference.data.dOptions["dragMode"],
               "sDesc":"The Custom Drops UI will be draggable rather than being attached to the screen"
            },{
               "strName":"Lock Position",
               "bEnabled":this.litePreference.data.dOptions["lockMode"],
               "sDesc":"The draggable Custom Drops UI will not be moved from where it was last placed"
            },{
               "strName":"Reset Position",
               "extra":"btn",
               "sDesc":"If the Drop UI somehow goes off-screen and you can\'t see it, then use this to get it back!\nWorks only for \"Draggable Mode\""
            },{
               "strName":"Quantity Warnings",
               "bEnabled":this.litePreference.data.dOptions["termsAgree"],
               "sDesc":"By disabling this feature you understand help from player support for unaccepted drops will be limited"
            }]
         },{
            "strName":"Disable Chat Scrolling",
            "bEnabled":this.litePreference.data.bDisChatScroll,
            "sDesc":"Prevents you from scrolling the chat\nOnly works on the old chat ui!"
         },{
            "strName":"Disable Damage Numbers",
            "bEnabled":this.litePreference.data.bDisDmgDisplay,
            "sDesc":"Disables all damage numbers from showing as well as the white flash/strobe effect"
         },{
            "strName":"Disable Damage Strobe",
            "bEnabled":this.litePreference.data.bDisDmgStrobe,
            "sDesc":"Prevents the white flash/strobe effect whenever a monster or player is damaged!"
         },{
            "strName":"Disable Monster Animations",
            "bEnabled":this.litePreference.data.bDisMonAnim,
            "sDesc":"Disables monster animations with the benefit of performance"
         },{
            "strName":"Disable Self Animations",
            "bEnabled":this.litePreference.data.bDisSelfMAnim,
            "sDesc":"Disables your player\'s movement animations except for walking for the benefit of performance"
         },{
            "strName":"Disable Skill Animations",
            "bEnabled":this.litePreference.data.bDisSkillAnim,
            "sDesc":"There are two types of animations: Class Skill Animations & Player Movement Animations\nThis feature disables Class Skill Animations only while the regular \"Animations\" setting will disable both Class Skill Animations & Player Movement Animations",
            "extra":[{
               "strName":"Show Your Skill Animations Only",
               "bEnabled":this.litePreference.data.dOptions["animSelf"],
               "sDesc":"Only works if \"Disable Skill Animations\" is enabled!\nAdds an exception to \"Disable Skill Animations\" to show your skill animations only"
            }]
         },{
            "strName":"Disable Quest Popup",
            "bEnabled":this.litePreference.data.bDisQPopup,
            "sDesc":"Prevent the Quest Complete Popup if it becomes too intrusive"
         },{
            "strName":"Disable Quest Tracker",
            "bEnabled":this.litePreference.data.bDisQTracker,
            "sDesc":"Prevent the Quest Tracker from opening"
         },{
            "strName":"Disable Weapon Animations",
            "bEnabled":this.litePreference.data.bDisWepAnim,
            "sDesc":"Disables weapon animations\nYou can disable a specific player\'s weapon animations by targetting them and clicking on their portrait!",
            "extra":[{
               "strName":"Keep Your Weapon Animations Only",
               "bEnabled":this.litePreference.data.dOptions["wepSelf"],
               "sDesc":"Only works if \"Disable Weapon Animation\" is enabled!\nHaving this enabled will allow your weapon animations to continue working while others have theirs disabled"
            }]
         },{
            "strName":"Decline All Drops",
            "extra":"btn",
            "sDesc":"Declines all the drops on your screen"
         },{
            "strName":"Display FPS",
            "extra":"btn",
            "sDesc":"Toggles the Frames Per Second Display"
         },{
            "strName":"Draggable Drops",
            "bEnabled":this.litePreference.data.bDraggable,
            "sDesc":"Allows you to drag, or move around, the drops on your screen\nToggling this on with drops already on your screen will not make those drops draggable\nOnly works if \"Custom Drops UI\" is not enabled"
         },{
            "strName":"Freeze / Lock Monster Position",
            "bEnabled":this.litePreference.data.bFreezeMons,
            "sDesc":"This will freeze monsters on the map in place to prevent players from luring/dragging monsters all over the map"
         },{
            "strName":"Invisible Monsters",
            "bEnabled":this.litePreference.data.bHideMons,
            "sDesc":"Make monsters invisible. You can target them by clicking on their shadow"
         },{
            "strName":"Hide Players",
            "bEnabled":this.litePreference.data.bHidePlayers,
            "sDesc":"This will hide players on the map\nYou can hide specific players by clicking on their portraits (targetting them)!",
            "extra":[{
               "strName":"Show Name Tags",
               "bEnabled":this.litePreference.data.dOptions["showNames"],
               "sDesc":"Only works if \"Hide Players\" is enabled!\nHaving this enabled will allow you to still see name tags of players even though they\'re hidden."
            },{
               "strName":"Show Shadows",
               "bEnabled":this.litePreference.data.dOptions["showShadows"],
               "sDesc":"Only works if \"Hide Players\" is enabled!\nHaving this enabled will allow you to still see player shadows and clicking on the shadows will target them."
            }]
         },{
            "strName":"Hide Player Names",
            "bEnabled":this.litePreference.data.bHideNames,
            "sDesc":"Hides player names\nHover over a player to reveal their name & guild",
            "extra":[{
               "strName":"Hide Guild Names Only",
               "bEnabled":this.litePreference.data.dOptions["hideGuild"],
               "sDesc":"Player names will be visible, and guild names will be hidden"
            },{
               "strName":"Hide Your Name Only",
               "bEnabled":this.litePreference.data.dOptions["hideSelf"],
               "sDesc":"Only your name will be hidden.\nEnabling this setting will not make \"Hide Guild Names Only\" work."
            }]
         },{
            "strName":"Hide UI",
            "bEnabled":this.litePreference.data.bHideUI,
            "sDesc":"Hides player & target portraits located on the top left as well as the map name & area list located on the bottom right"
         },{
            "strName":"Item Drops Block List",
            "extra":"btn",
            "sDesc":"Shift+Click dropped items while using \"Custom Drops UI\" to add items to block!"
         },{
            "strName":"Keybinds",
            "extra":"btn",
            "sDesc":"Customize game keybinds.\nYou can not bind ENTER or /.\nUse BACKSPACE to delete a bind."
         },{
            "strName":"Reaccept Quest After Turn-In",
            "bEnabled":this.litePreference.data.bReaccept,
            "sDesc":"After turning in a quest, it will try to reaccept the quest if possible"
         },{
            "strName":"Show Monster Type",
            "bEnabled":this.litePreference.data.bMonsType,
            "sDesc":"Display the monster\'s type as a tag under their name"
         },{
            "strName":"Travel Menu",
            "extra":"btn",
            "sDesc":"Jump between multiple maps with a press of a button!\nThe keybind to jump maps is rebindable within \"Keybinds\"!"
         },{
            "strName":"Quest Pinner",
            "bEnabled":this.litePreference.data.bQuestPin,
            "sDesc":"1. Open quests from any NPC\n2. Press the \"Pin Quests\" button (left)\n3. You can now access it from anywhere by clicking on the yellow (!) quest log icon at the top left!\nShift+Click the yellow (!) quest log icon to open the Quest Tracker!\nShift+Click the quest pinner icon to clear your pinned quests!"
         },{
            "strName":"Quest Progress Notifications",
            "bEnabled":this.litePreference.data.bQuestNotif,
            "sDesc":"Quest Progress will continue to notify/update you even when you\'ve completed the quest"
         },{
            "strName":"Visual Skill CDs",
            "bEnabled":this.litePreference.data.bSkillCD,
            "sDesc":"Visual skill cooldowns!"
         },{
            "strName":"Hide Ground Items",
            "bEnabled":this.litePreference.data.bDisGround,
            "sDesc":"Hides the item type \'Ground\' from other players",
            "extra":[{
               "strName":"Show Your Ground Item Only",
               "bEnabled":this.litePreference.data.dOptions["groundSelf"],
               "sDesc":"Other players\' ground items will be hidden, while yours remains visible"
            }]
         },{
            "strName":"Hide Healing Bubbles",
            "bEnabled":this.litePreference.data.bDisHealBubble,
            "sDesc":"Hides the green healing bubbles above players when they\'re low on health"
         },{
            "strName":"Disable Aura Animations",
            "bEnabled":this.litePreference.data.bDisAuraAnim,
            "sDesc":"Disables all animations that activate on aura that some classes have from showing",
            "extra":[{
               "strName":"Show Your Aura Animation Only",
               "bEnabled":this.litePreference.data.dOptions["auraAnimSelf"],
               "sDesc":"Other players\' aura animations will be hidden, while yours remains visible. Recommended to leave on."
            }]
         }];
      }
      
      public function isTestClient() : Boolean
      {
         var tServers:Array = null;
         var server:* = undefined;
         tServers = ["Dev Grotto","Dev04"];
         for each(server in tServers)
         {
            if(this.objServerInfo.sName.toLowerCase() == server.toLowerCase())
            {
               return true;
            }
         }
         return false;
      }
      
      public function castSpellFX(param1:*, param2:*, param3:*, param4:*) : *
      {
         this.cameraToolMC.castSpellFX();
      }
      
      public function movieClipStopAll(container:MovieClip) : void
      {
         var i:uint = 0;
         for(i = 0; i < container.numChildren; i++)
         {
            if(container.getChildAt(i) is MovieClip)
            {
               try
               {
                  (container.getChildAt(i) as MovieClip).gotoAndStop(0);
                  this.movieClipStopAll(container.getChildAt(i) as MovieClip);
               }
               catch(exception:*)
               {
               }
            }
         }
      }
      
      public function rasterizePart(avt:DisplayObject) : Bitmap
      {
         var avtMatrix:Matrix = null;
         var avtGBounds:Rectangle = null;
         var avtOffset:Point = null;
         var avtBMD:BitmapData = null;
         var avtBM:Bitmap = null;
         avtMatrix = avt.transform.matrix;
         avtGBounds = avt.getBounds(avt.parent);
         avtOffset = new Point(avt.x - avtGBounds.left,avt.y - avtGBounds.top);
         avtMatrix.tx = avtOffset.x;
         avtMatrix.ty = avtOffset.y;
         avtBMD = new BitmapData(avtGBounds.width,avtGBounds.height,true,0);
         avtBMD.draw(avt,avtMatrix,avt.transform.colorTransform,null,null,true);
         avtBM = new Bitmap(avtBMD);
         avtBM.smoothing = true;
         avtBM.x -= avtOffset.x;
         avtBM.y -= avtOffset.y;
         return avtBM;
      }
      
      public function rasterize(avtDisplay:MovieClip) : void
      {
         this.movieClipRasterizeInner(avtDisplay);
      }
      
      public function movieClipRasterizeInner(container:MovieClip) : void
      {
         var i:uint = 0;
         var toRasterize:MovieClip = null;
         var spriteWrapper:Sprite = null;
         var rasterized:* = undefined;
         for(i = 0; i < container.numChildren; i++)
         {
            if(container.getChildAt(i) is MovieClip)
            {
               try
               {
                  toRasterize = container.getChildAt(i) as MovieClip;
                  if(toRasterize.visible != false)
                  {
                     toRasterize.getChildAt(0).visible = false;
                     spriteWrapper = new Sprite();
                     spriteWrapper.addChild(this.rasterizePart(toRasterize.getChildAt(0)));
                     rasterized = toRasterize.addChildAt(spriteWrapper,0);
                     this.movieClipRasterizeInner(container.getChildAt(i) as MovieClip);
                  }
               }
               catch(exception:*)
               {
               }
            }
         }
      }
      
      public function getQuestValidationString(qData:Object) : String
      {
         var iRank:int = 0;
         var iSpillCP:* = undefined;
         var iFactionRank:int = 0;
         var iSpillRep:* = undefined;
         var strText:String = null;
         var i:int = 0;
         var obj:Object = null;
         var iQty:int = 0;
         var iClassRank:int = 0;
         var iSpillClassPoints:* = undefined;
         if(qData.sField != null && this.world.getAchievement(qData.sField,qData.iIndex) != 0)
         {
            if(qData.sField == "im0")
            {
               return "Monthly Quests are only available once per month.";
            }
            if(qData.sField == "iw0")
            {
               return "Weekly Quests are only available once per week.";
            }
            return "Daily Quests are only available once per day.";
         }
         if(qData.bUpg == 1 && !this.world.myAvatar.isUpgraded())
         {
            return "Upgrade is required for this quest!";
         }
         if(qData.iSlot >= 0 && this.world.getQuestValue(qData.iSlot) < qData.iValue - 1)
         {
            return "Quest has not been unlocked!";
         }
         if(qData.iLvl > this.world.myAvatar.objData.intLevel)
         {
            return "Unlocks at Level " + qData.iLvl + ".";
         }
         if(qData.iClass > 0 && this.world.myAvatar.getCPByID(qData.iClass) < qData.iReqCP)
         {
            iRank = this.getRankFromPoints(qData.iReqCP);
            iSpillCP = qData.iReqCP - this.arrRanks[iRank - 1];
            if(iSpillCP > 0)
            {
               return "Requires " + iSpillCP + " Class Points on " + qData.sClass + ", Rank " + iRank + ".";
            }
            return "Requires " + qData.sClass + ", Rank " + iRank + ".";
         }
         if(qData.FactionID > 1 && this.world.myAvatar.getRep(qData.FactionID) < qData.iReqRep)
         {
            iFactionRank = this.getRankFromPoints(qData.iReqRep);
            iSpillRep = qData.iReqRep - this.arrRanks[iFactionRank - 1];
            if(iSpillRep > 0)
            {
               return "Requires " + iSpillRep + " Reputation for " + qData.sFaction + ", Rank " + iFactionRank + ".";
            }
            return "Requires " + qData.sFaction + ", Rank " + iFactionRank + ".";
         }
         if(qData.reqd != null && !this.hasRequiredItemsForQuest(qData))
         {
            strText = "Required Item(s): ";
            for(i = 0; i < qData.reqd.length; i++)
            {
               obj = this.world.invTree[qData.reqd[i].ItemID];
               iQty = int(qData.reqd[i].iQty);
               if(obj.sES == "ar")
               {
                  iClassRank = this.getRankFromPoints(iQty);
                  iSpillClassPoints = iQty - this.arrRanks[iClassRank - 1];
                  if(iSpillClassPoints > 0)
                  {
                     strText += iSpillClassPoints + " Class Points on ";
                  }
                  strText += obj.sName + ", Rank " + iClassRank;
               }
               else
               {
                  strText += obj.sName;
                  if(iQty > 1)
                  {
                     strText += "x" + iQty;
                  }
               }
               strText += ", ";
            }
            return strText.substr(0,strText.length - 2) + ".";
         }
         return "";
      }
      
      private function hasRequiredItemsForQuest(quest:Object) : Boolean
      {
         var i:int = 0;
         var qItemID:* = undefined;
         var qItemQ:int = 0;
         if(quest.reqd != null && quest.reqd.length > 0)
         {
            for(i = 0; i < quest.reqd.length; i++)
            {
               qItemID = quest.reqd[i].ItemID;
               qItemQ = int(quest.reqd[i].iQty);
               if(this.world.invTree[qItemID] == null || int(this.world.invTree[qItemID].iQty) < qItemQ)
               {
                  return false;
               }
            }
         }
         return true;
      }
      
      public function xTryMe(curItem:Object) : *
      {
         var sES:String = null;
         switch(curItem.sES)
         {
            case "Weapon":
            case "he":
            case "ba":
            case "pe":
            case "ar":
            case "co":
            case "mi":
               sES = curItem.sES;
               sES = sES == "ar" ? "co" : sES;
               if(sES == "pe")
               {
                  if(this.world.myAvatar.objData.eqp["pe"])
                  {
                     this.world.myAvatar.unloadPet();
                  }
               }
               if(!this.world.myAvatar.objData.eqp[sES])
               {
                  this.world.myAvatar.objData.eqp[sES] = {};
                  this.world.myAvatar.objData.eqp[sES].wasCreated = true;
               }
               if(Boolean(this.world.myAvatar.objData.eqp[sES].isPreview) || Boolean(this.world.myAvatar.objData.eqp[sES].wasCreated))
               {
                  if(this.world.myAvatar.objData.eqp[sES].sFile == curItem.sFile && this.world.myAvatar.objData.eqp[sES].sType == curItem.sType)
                  {
                     if(this.world.myAvatar.objData.eqp[sES].wasCreated)
                     {
                        delete this.world.myAvatar.objData.eqp[sES];
                        this.world.myAvatar.unloadMovieAtES(sES);
                     }
                     else if(this.world.myAvatar.objData.eqp[sES].isPreview)
                     {
                        if(sES == "pe")
                        {
                           if(this.world.myAvatar.objData.eqp["pe"])
                           {
                              this.world.myAvatar.unloadPet();
                           }
                        }
                        this.world.myAvatar.objData.eqp[sES].sType = this.world.myAvatar.objData.eqp[sES].oldType;
                        this.world.myAvatar.objData.eqp[sES].sFile = this.world.myAvatar.objData.eqp[sES].oldFile;
                        this.world.myAvatar.objData.eqp[sES].sLink = this.world.myAvatar.objData.eqp[sES].oldLink;
                        this.world.myAvatar.loadMovieAtES(sES,this.world.myAvatar.objData.eqp[sES].oldFile,this.world.myAvatar.objData.eqp[sES].oldLink);
                        this.world.myAvatar.objData.eqp[sES].isPreview = null;
                     }
                     return;
                  }
               }
               if(!this.world.myAvatar.objData.eqp[sES].isPreview)
               {
                  this.world.myAvatar.objData.eqp[sES].isPreview = true;
                  if(!this.world.myAvatar.objData.eqp[sES].isShowable)
                  {
                     if("sType" in curItem)
                     {
                        this.world.myAvatar.objData.eqp[sES].oldType = this.world.myAvatar.objData.eqp[sES].sType;
                     }
                     this.world.myAvatar.objData.eqp[sES].oldFile = this.world.myAvatar.objData.eqp[sES].sFile;
                     this.world.myAvatar.objData.eqp[sES].oldLink = this.world.myAvatar.objData.eqp[sES].sLink;
                  }
               }
               if("sType" in curItem)
               {
                  this.world.myAvatar.objData.eqp[sES].sType = curItem.sType;
               }
               this.world.myAvatar.objData.eqp[sES].sFile = curItem.sFile == "undefined" ? "" : curItem.sFile;
               this.world.myAvatar.objData.eqp[sES].sLink = curItem.sLink;
               this.world.myAvatar.loadMovieAtES(sES,curItem.sFile,curItem.sLink);
               if(sES == "pe" && curItem.sName.indexOf("Bank Pet") != -1)
               {
                  this.petDisable.addEventListener(TimerEvent.TIMER,this.onPetDisable,false,0,true);
                  this.petDisable.start();
               }
               this.hasPreviewed = true;
         }
      }
      
      internal function onPetDisable(e:TimerEvent) : void
      {
         if(!this.world.myAvatar.petMC.mcChar)
         {
            return;
         }
         this.world.myAvatar.petMC.mcChar.mouseEnabled = false;
         this.world.myAvatar.petMC.mcChar.mouseChildren = false;
         this.world.myAvatar.petMC.mcChar.enabled = false;
         this.petDisable.reset();
         this.petDisable.removeEventListener(TimerEvent.TIMER,this.onPetDisable);
      }
      
      public function showPortrait(avt:Avatar) : *
      {
         if(this.litePreference.data.bHideUI)
         {
            return;
         }
         this.showPortraitBox(avt,this.ui.mcPortrait);
         this.world.updatePortrait(avt);
         this.ui.iconQuest.visible = true;
         this.ui.monsterIcon.visible = true;
      }
      
      public function hidePortrait() : void
      {
         this.ui.monsterIcon.visible = false;
         this.ui.mcPortrait.visible = false;
         this.ui.iconQuest.visible = false;
      }
      
      public function showPortraitTarget(avt:Avatar) : *
      {
         if(this.litePreference.data.bHideUI)
         {
            return;
         }
         this.showPortraitBox(Number(this.world.objExtra["bChar"]) == 1 ? this.world.myAvatar : avt,this.ui.mcPortraitTarget);
         this.ui.mcPortraitTarget.pvpIcon.visible = this.world.bPvP;
         this.world.updatePortrait(avt);
         this.ui.btnTargetPortraitClose.visible = true;
      }
      
      public function hidePortraitTarget() : void
      {
         var mc:MovieClip = null;
         var child:DisplayObject = null;
         mc = this.ui.mcPortraitTarget.mcHead as MovieClip;
         child = mc.head.getChildByName("face");
         if(child != null)
         {
            mc.head.removeChild(child);
         }
         while(mc.backhair.numChildren > 0)
         {
            mc.backhair.removeChildAt(0);
         }
         while(mc.head.hair.numChildren > 0)
         {
            mc.head.hair.removeChildAt(0);
         }
         while(mc.head.helm.numChildren > 0)
         {
            mc.head.helm.removeChildAt(0);
         }
         this.ui.mcPortraitTarget.visible = false;
         this.ui.btnTargetPortraitClose.visible = false;
      }
      
      public function showPortraitBox(avt:Avatar, mcPortraitBox:MovieClip) : *
      {
         var AssetClass:Class = null;
         var mc:MovieClip = null;
         var child:DisplayObject = null;
         var bBackHair:Boolean = false;
         var sSkinLink:String = null;
         var AssetClass2:Class = null;
         mc = mcPortraitBox.mcHead as MovieClip;
         bBackHair = false;
         mcPortraitBox.pAV = avt;
         if(avt.npcType == "monster")
         {
            AssetClass = this.world.getClass("mcHead" + avt.objData.strLinkage);
            child = mc.head.getChildByName("face");
            if(child != null)
            {
               mc.head.removeChild(child);
            }
            mc.head.addChildAt(new AssetClass(),0).name = "face";
            mc.head.hair.visible = false;
            mc.head.helm.visible = false;
            mc.backhair.visible = false;
         }
         else
         {
            try
            {
               sSkinLink = avt.objData.eqp.ar.sLink;
               if(avt.objData.eqp.co != null)
               {
                  sSkinLink = avt.objData.eqp.co.sLink;
               }
               AssetClass = this.world.getClass(sSkinLink + avt.objData.strGender + "Head");
               child = mc.head.getChildByName("face");
               if(child != null)
               {
                  mc.head.removeChild(child);
               }
               mc.head.addChildAt(new AssetClass(),0).name = "face";
            }
            catch(err:Error)
            {
               AssetClass = world.getClass("mcHead" + avt.objData.strGender);
               child = mc.head.getChildByName("face");
               if(child != null)
               {
                  mc.head.removeChild(child);
               }
               mc.head.addChildAt(new AssetClass(),0).name = "face";
            }
            for(AssetClass = this.world.getClass(avt.objData.strHairName + avt.objData.strGender + "Hair"); mc.head.hair.numChildren > 0; )
            {
               mc.head.hair.removeChildAt(0);
            }
            try
            {
               mc.head.hair.addChild(new AssetClass());
            }
            catch(e:Error)
            {
            }
            mc.head.hair.visible = true;
            try
            {
               for(AssetClass = this.world.getClass(avt.objData.strHairName + avt.objData.strGender + "HairBack"); mc.backhair.numChildren > 0; )
               {
                  mc.backhair.removeChildAt(0);
               }
               mc.backhair.addChild(new AssetClass());
               mc.backhair.visible = true;
               bBackHair = true;
            }
            catch(err:Error)
            {
               mc.backhair.visible = false;
            }
            if(avt.objData.eqp.he != null && avt.objData.eqp.he.sLink != null)
            {
               try
               {
                  AssetClass = this.world.getClass(avt.objData.eqp.he.sLink);
                  for(AssetClass2 = this.world.getClass(avt.objData.eqp.he.sLink + "_backhair") as Class; mc.head.helm.numChildren > 0; )
                  {
                     mc.head.helm.removeChildAt(0);
                  }
                  mc.head.helm.addChild(new AssetClass());
                  mc.head.helm.visible = avt.dataLeaf.showHelm;
                  mc.head.hair.visible = !mc.head.helm.visible;
                  if(AssetClass2 != null)
                  {
                     if(avt.dataLeaf.showHelm)
                     {
                        if(mc.backhair.numChildren > 0)
                        {
                           mc.backhair.removeChildAt(0);
                        }
                        mc.backhair.visible = true;
                        mc.backhair.addChild(new AssetClass2());
                     }
                  }
                  else
                  {
                     mc.backhair.visible = mc.head.hair.visible && bBackHair;
                  }
               }
               catch(err:Error)
               {
                  mc.head.helm.visible = false;
               }
            }
            else
            {
               mc.head.helm.visible = false;
            }
         }
         mcPortraitBox.visible = true;
         this.ui.mcPortrait.iconDrops.initRoot(this);
         this.ui.mcPortrait.iconDrops.visible = this.litePreference.data.bCustomDrops;
      }
      
      public function oniconQuestClick(e:MouseEvent) : void
      {
         if(this.litePreference.data.bQuestPin)
         {
            if(e.shiftKey)
            {
               this.ui.mcQTracker.toggle();
               return;
            }
            this.world.showQuests(this.pinnedQuests,"q");
         }
         else
         {
            this.ui.mcQTracker.toggle();
         }
      }
      
      public function manageXPBoost(o:Object) : void
      {
         var modal:* = undefined;
         var modalO:* = undefined;
         this.ui.mcPortrait.iconBoostXP.visible = o.op == "+";
         if(o.op == "+")
         {
            this.world.myAvatar.objData.iBoostXP = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostXP.boostTS = new Date().getTime();
            this.ui.mcPortrait.iconBoostXP.iBoostXP = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostXP.bShowShop = o.bShowShop;
            this.addUpdate("You have activated the Experience Boost!  All Experience rewards are doubled while the effect holds.");
            this.chatF.pushMsg("server","You have activated the Experience Boost!  All Experience rewards are doubled while the effect holds. " + Math.ceil(o.iSecsLeft / 60) + " minute(s) remaining.","SERVER","",0);
         }
         else
         {
            delete this.world.myAvatar.objData.iBoostXP;
            delete this.ui.mcPortrait.iconBoostXP.boostTS;
            delete this.ui.mcPortrait.iconBoostXP.iBoostXP;
            this.addUpdate("The Experience Boost has faded!  Experience rewards are no longer doubled.");
            this.chatF.pushMsg("server","The Experience Boost has faded!  Experience rewards are no longer doubled.","SERVER","",0);
            if(this.ui.mcPortrait.iconBoostXP.bShowShop != null && Boolean(this.ui.mcPortrait.iconBoostXP.bShowShop))
            {
               modal = new ModalMC();
               modalO = {};
               modalO.strBody = "Your Experience Boost has faded!\tExperience rewards are no longer doubled.  Would you like to purchase a new Experience Boost?";
               modalO.params = {};
               modalO.callback = this.openExpBoostStore;
               modalO.glow = "red,medium";
               this.ui.ModalStack.addChild(modal);
               modal.init(modalO);
            }
         }
      }
      
      public function manageGBoost(o:Object) : void
      {
         var modal:* = undefined;
         var modalO:* = undefined;
         this.ui.mcPortrait.iconBoostG.visible = o.op == "+";
         if(o.op == "+")
         {
            this.world.myAvatar.objData.iBoostG = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostG.boostTS = new Date().getTime();
            this.ui.mcPortrait.iconBoostG.iBoostG = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostG.bShowShop = o.bShowShop;
            this.addUpdate("You have activated the Gold Boost!  All Gold rewards are doubled while the effect holds.");
            this.chatF.pushMsg("server","You have activated the Gold Boost!  All Gold rewards are doubled while the effect holds. " + Math.ceil(o.iSecsLeft / 60) + " minute(s) remaining.","SERVER","",0);
         }
         else
         {
            delete this.world.myAvatar.objData.iBoostG;
            delete this.ui.mcPortrait.iconBoostG.boostTS;
            delete this.ui.mcPortrait.iconBoostG.iBoostG;
            this.addUpdate("The Gold Boost has faded!  Gold rewards are no longer doubled.");
            this.chatF.pushMsg("server","The Gold Boost has faded!  Gold rewards are no longer doubled.","SERVER","",0);
            if(this.ui.mcPortrait.iconBoostG.bShowShop != null && Boolean(this.ui.mcPortrait.iconBoostG.bShowShop))
            {
               modal = new ModalMC();
               modalO = {};
               modalO.strBody = "Your Gold Boost has faded!  Gold rewards are no longer doubled.  Would you like to purchase a new Gold Boost?";
               modalO.params = {};
               modalO.callback = this.openExpBoostStore;
               modalO.glow = "red,medium";
               this.ui.ModalStack.addChild(modal);
               modal.init(modalO);
            }
         }
      }
      
      public function manageRepBoost(o:Object) : void
      {
         var modal:* = undefined;
         var modalO:* = undefined;
         this.ui.mcPortrait.iconBoostRep.visible = o.op == "+";
         if(o.op == "+")
         {
            this.world.myAvatar.objData.iBoostRep = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostRep.boostTS = new Date().getTime();
            this.ui.mcPortrait.iconBoostRep.iBoostRep = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostRep.bShowShop = o.bShowShop;
            this.addUpdate("You have activated the Reputation Boost!  All Reputation rewards are doubled while the effect holds.");
            this.chatF.pushMsg("server","You have activated the Reputation Boost!  All Reputation rewards are doubled while the effect holds. " + Math.ceil(o.iSecsLeft / 60) + " minute(s) remaining.","SERVER","",0);
         }
         else
         {
            delete this.world.myAvatar.objData.iBoostRep;
            delete this.ui.mcPortrait.iconBoostRep.boostTS;
            delete this.ui.mcPortrait.iconBoostRep.iBoostRep;
            this.addUpdate("The Reputation Boost has faded!  Reputation rewards are no longer doubled.");
            this.chatF.pushMsg("server","The Reputation Boost has faded!  Reputation rewards are no longer doubled.","SERVER","",0);
            if(this.ui.mcPortrait.iconBoostRep.bShowShop != null && Boolean(this.ui.mcPortrait.iconBoostRep.bShowShop))
            {
               modal = new ModalMC();
               modalO = {};
               modalO.strBody = "Your Reputation Boost has faded!\tReputation rewards are no longer doubled.  Would you like to purchase a new Reputation Boost?";
               modalO.params = {};
               modalO.callback = this.openExpBoostStore;
               modalO.glow = "red,medium";
               this.ui.ModalStack.addChild(modal);
               modal.init(modalO);
            }
         }
      }
      
      public function manageCPBoost(o:Object) : void
      {
         var modal:* = undefined;
         var modalO:* = undefined;
         this.ui.mcPortrait.iconBoostCP.visible = o.op == "+";
         if(o.op == "+")
         {
            this.world.myAvatar.objData.iBoostCP = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostCP.boostTS = new Date().getTime();
            this.ui.mcPortrait.iconBoostCP.iBoostCP = o.iSecsLeft;
            this.ui.mcPortrait.iconBoostCP.bShowShop = o.bShowShop;
            this.addUpdate("You have activated the ClassPoint Boost!  All ClassPoint rewards are doubled while the effect holds.");
            this.chatF.pushMsg("server","You have activated the ClassPoint Boost!  All ClassPoint rewards are doubled while the effect holds. " + Math.ceil(o.iSecsLeft / 60) + " minute(s) remaining.","SERVER","",0);
         }
         else
         {
            delete this.world.myAvatar.objData.iBoostCP;
            delete this.ui.mcPortrait.iconBoostCP.boostTS;
            delete this.ui.mcPortrait.iconBoostCP.iBoostCP;
            this.addUpdate("The ClassPoint Boost has faded!  ClassPoint rewards are no longer doubled.");
            this.chatF.pushMsg("server","The ClassPoint Boost has faded!  ClassPoint rewards are no longer doubled.","SERVER","",0);
            if(this.ui.mcPortrait.iconBoostCP.bShowShop != null && Boolean(this.ui.mcPortrait.iconBoostCP.bShowShop))
            {
               modal = new ModalMC();
               modalO = {};
               modalO.strBody = "Your ClassPoint Boost has faded!\tClassPoint rewards are no longer doubled.  Would you like to purchase a new ClassPoint Boost?";
               modalO.params = {};
               modalO.callback = this.openExpBoostStore;
               modalO.glow = "red,medium";
               this.ui.ModalStack.addChild(modal);
               modal.init(modalO);
            }
         }
      }
      
      public function oniconBoostXPOver(e:MouseEvent) : void
      {
         var mc:MovieClip = null;
         var now:Number = NaN;
         var n:Number = NaN;
         var m:int = 0;
         var s:String = null;
         mc = MovieClip(e.currentTarget);
         now = new Date().getTime();
         n = Math.max(mc.boostTS + mc.iBoostXP * 1000 - now,0);
         m = 0;
         s = "All Experience gains are doubled.\n";
         if(n < 120000)
         {
            m = Math.floor(n / 60000);
            s += String(m + " minute(s), ");
            m = Math.round(n % 60000 / 1000);
            s += String(m + " second(s) remaining.");
         }
         else
         {
            m = Math.round(n / 60000);
            s += String(m + " minutes remaining.");
         }
         this.ui.ToolTip.openWith({"str":s});
      }
      
      public function oniconBoostGoldOver(e:MouseEvent) : void
      {
         var mc:MovieClip = null;
         var now:Number = NaN;
         var n:Number = NaN;
         var m:int = 0;
         var s:String = null;
         mc = MovieClip(e.currentTarget);
         now = new Date().getTime();
         n = Math.max(mc.boostTS + mc.iBoostG * 1000 - now,0);
         m = 0;
         s = "All Gold gains are doubled.\n";
         if(n < 120000)
         {
            m = Math.floor(n / 60000);
            s += String(m + " minute(s), ");
            m = Math.round(n % 60000 / 1000);
            s += String(m + " second(s) remaining.");
         }
         else
         {
            m = Math.round(n / 60000);
            s += String(m + " minutes remaining.");
         }
         this.ui.ToolTip.openWith({"str":s});
      }
      
      public function oniconBoostRepOver(e:MouseEvent) : void
      {
         var mc:MovieClip = null;
         var now:Number = NaN;
         var n:Number = NaN;
         var m:int = 0;
         var s:String = null;
         mc = MovieClip(e.currentTarget);
         now = new Date().getTime();
         n = Math.max(mc.boostTS + mc.iBoostRep * 1000 - now,0);
         m = 0;
         s = "All Reputation gains are doubled.\n";
         if(n < 120000)
         {
            m = Math.floor(n / 60000);
            s += String(m + " minute(s), ");
            m = Math.round(n % 60000 / 1000);
            s += String(m + " second(s) remaining.");
         }
         else
         {
            m = Math.round(n / 60000);
            s += String(m + " minutes remaining.");
         }
         this.ui.ToolTip.openWith({"str":s});
      }
      
      public function oniconBoostCPOver(e:MouseEvent) : void
      {
         var mc:MovieClip = null;
         var now:Number = NaN;
         var n:Number = NaN;
         var m:int = 0;
         var s:String = null;
         mc = MovieClip(e.currentTarget);
         now = new Date().getTime();
         n = Math.max(mc.boostTS + mc.iBoostCP * 1000 - now,0);
         m = 0;
         s = "All ClassPoint gains are doubled.\n";
         if(n < 120000)
         {
            m = Math.floor(n / 60000);
            s += String(m + " minute(s), ");
            m = Math.round(n % 60000 / 1000);
            s += String(m + " second(s) remaining.");
         }
         else
         {
            m = Math.round(n / 60000);
            s += String(m + " minutes remaining.");
         }
         this.ui.ToolTip.openWith({"str":s});
      }
      
      public function openExpBoostStore(params:Object) : void
      {
         if(params.accept)
         {
            this.world.sendLoadShopRequest(184);
         }
      }
      
      public function oniconBoostOut(e:MouseEvent) : void
      {
         this.ui.ToolTip.close();
      }
      
      public function updateXPBar() : void
      {
         var overflow:Number = NaN;
         var avo:* = undefined;
         var xc:* = undefined;
         var xm:* = undefined;
         var xp:* = undefined;
         overflow = this.world.myAvatar.objData.intExp / this.world.myAvatar.objData.intExpToLevel;
         this.ui.mcInterface.mcXPBar.mcXP.scaleX = overflow > 1 ? 1 : overflow;
         avo = this.world.myAvatar.objData;
         xc = avo.intExp;
         xm = avo.intExpToLevel;
         xp = int(xc / xm * 100);
         if(xp >= 100)
         {
            xp = 100;
         }
         this.ui.mcInterface.mcXPBar.strXP.text = "Level " + this.world.myAvatar.objData.intLevel + " : " + xc + " / " + xm + "  (" + xp + "%)";
      }
      
      public function xpBarMouseOver(e:MouseEvent) : *
      {
         MovieClip(e.currentTarget).strXP.visible = true;
      }
      
      public function xpBarMouseOut(e:MouseEvent) : *
      {
         MovieClip(e.currentTarget).strXP.visible = false;
      }
      
      public function updateRepBar() : void
      {
         var xc:* = undefined;
         var xm:* = undefined;
         var xp:* = undefined;
         xc = this.world.myAvatar.objData.iCurCP;
         xm = this.world.myAvatar.objData.iCPToRank;
         if(xm <= 0)
         {
            this.ui.mcInterface.mcRepBar.mcRep.scaleX = 0.1;
            this.ui.mcInterface.mcRepBar.mcRep.visible = false;
            this.ui.mcInterface.mcRepBar.strRep.text = this.world.myAvatar.objData.strClassName + ", Rank " + this.world.myAvatar.objData.iRank;
         }
         else
         {
            xp = int(xc / xm * 100);
            if(xp >= 100)
            {
               xp = 100;
            }
            this.ui.mcInterface.mcRepBar.mcRep.scaleX = xc / xm;
            this.ui.mcInterface.mcRepBar.mcRep.visible = true;
            this.ui.mcInterface.mcRepBar.strRep.text = this.world.myAvatar.objData.strClassName + ", Rank " + this.world.myAvatar.objData.iRank + " : " + xc + "/" + xm + "  (" + xp + "%)";
         }
      }
      
      public function onRepBarMouseOver(e:MouseEvent) : *
      {
         MovieClip(e.currentTarget).strRep.visible = true;
      }
      
      public function onRepBarMouseOut(e:MouseEvent) : *
      {
         MovieClip(e.currentTarget).strRep.visible = false;
      }
      
      public function disabledDelay(e:TimerEvent) : void
      {
         trace("50MS SKILL DELAY");
      }
      
      public function actIconClick(e:MouseEvent) : *
      {
         var actObj:* = undefined;
         actObj = MovieClip(e.currentTarget).actObj;
         if(actObj.auto != null && actObj.auto == true)
         {
            this.world.approachTarget();
         }
         else
         {
            this.world.testAction(actObj);
         }
      }
      
      public function determineIndex(supposedPos:Number) : Number
      {
         var relPos:Number = NaN;
         relPos = 10;
         if(supposedPos <= 3)
         {
            relPos = supposedPos;
         }
         else if(supposedPos == 4)
         {
            relPos = 5;
         }
         else if(supposedPos <= 6)
         {
            relPos = 4;
         }
         return relPos;
      }
      
      public function actIconOver(e:MouseEvent) : *
      {
         var mc:MovieClip = null;
         var actObj:* = undefined;
         var s:String = null;
         mc = MovieClip(e.currentTarget);
         if(Boolean(this.uoPref.bTT) || this.world.myAvatar.dataLeaf.intState != 2)
         {
            if(mc.item == null)
            {
               actObj = mc.actObj;
               if(actObj != null)
               {
                  actObj.desc = actObj.desc.replace(this.regExLineSpace,"\n");
                  s = "<b>" + actObj.nam + "</b>\n";
                  if(!actObj.isOK)
                  {
                     s += "<font color=\'#FF0000\'>Unlocks at Rank " + String(this.determineIndex(mc.actionIndex)) + "!</font>\n";
                  }
                  if(actObj.typ != "passive")
                  {
                     if(actObj.mp > 0)
                     {
                        s += "<font color=\'#0033AA\'>" + actObj.mp + "</font> mana, ";
                     }
                     s += "<font color=\'#AA3300\'>" + actObj.cd / 1000 + "</font> sec cooldown" + "\n";
                  }
                  switch(actObj.typ)
                  {
                     case "p":
                     case "ph":
                     case "aa":
                        s += "Physical";
                        break;
                     case "m":
                        s += "Magical";
                        break;
                     case "ma":
                        s += "True Damage";
                        break;
                     case "pm":
                     case "mp":
                        s += "Hybrid";
                        break;
                     case "passive":
                        s += "<font color=\'#0033AA\'>Passive Ability</font>";
                  }
                  s += "\n";
                  if(actObj.typ != "passive")
                  {
                     if(actObj.range <= 301)
                     {
                        s += "A <font color=\'#AA3300\'>short range</font> ";
                     }
                     else if(actObj.range >= 3000)
                     {
                        s += "An <font color=\'#0033AA\'>infinite range</font> ";
                     }
                     else if(actObj.range >= 808)
                     {
                        s += "A <font color=\'#0033AA\'>long range</font> ";
                     }
                     else
                     {
                        s += "A <font color=\'#AA3300\'>medium range</font> ";
                     }
                     if(!actObj.damage)
                     {
                        s += "status skill that applies to ";
                     }
                     else
                     {
                        s += (actObj.damage < 0 ? "skill" : "attack") + " that " + (actObj.damage < 0 ? "heals " : "deals damage to ");
                     }
                     if(actObj.tgt == "f")
                     {
                        s += "<font color=\'#0033AA\'>" + (actObj.tgtMax || 1);
                        s += actObj.tgtMax > 1 ? " friendly targets.</font>" : " target.</font>";
                     }
                     else if(actObj.tgt == "s")
                     {
                        s += "<font color=\'#0033AA\'>yourself.</font>";
                     }
                     else
                     {
                        s += "<font color=\'#AA3300\'>" + (actObj.tgtMax || 1);
                        s += actObj.tgtMax > 1 ? " hostile targets.</font>" : " target.</font>";
                     }
                     s += "\n\n";
                  }
                  if(actObj.sArg2 != "")
                  {
                     s += actObj.sArg2;
                  }
                  else
                  {
                     s += actObj.desc;
                  }
                  this.ui.ToolTip.openWith({
                     "str":s,
                     "lowerright":true
                  });
               }
            }
            else
            {
               this.ui.ToolTip.openWith({
                  "str":mc.item.sName + "\n" + "<font color=\'#AA3300\'>" + mc.actObj.cd / 1000 + "</font> sec cooldown\n" + mc.item.sDesc,
                  "lowerright":true
               });
            }
         }
      }
      
      public function actIconOut(e:MouseEvent) : *
      {
         var tt:* = undefined;
         tt = MovieClip(stage.getChildAt(0)).ui.ToolTip;
         tt.close();
      }
      
      public function portraitClick(e:MouseEvent) : *
      {
         var mc:* = undefined;
         var params:* = undefined;
         mc = MovieClip(e.currentTarget);
         if(mc.pAV.npcType == "player")
         {
            params = {};
            params.ID = mc.pAV.objData.CharID;
            params.strUsername = mc.pAV.objData.strUsername;
            if(mc.pAV != this.world.myAvatar)
            {
               this.ui.cMenu.fOpenWith("user",params);
            }
            else
            {
               this.ui.cMenu.fOpenWith("self",params);
            }
         }
         else if(mc.pAV.npcType == "monster")
         {
            params = {};
            params.ID = mc.pAV.objData.MonMapID;
            params.strUsername = mc.pAV.objData.strMonName;
            params.target = this.world.getMonster(params.ID).pMC;
            this.ui.cMenu.fOpenWith("mons",params);
         }
      }
      
      private function onTargetPortraitCloseClick(evt:MouseEvent) : void
      {
         this.world.cancelTarget();
      }
      
      private function onBtnMonsterClick(evt:MouseEvent) : void
      {
         this.world.toggleMonsters();
      }
      
      public function showMap() : void
      {
         this.ui.mcInterface.mcMenu.mcMenuButtons.visible = true;
         this.ui.mcPopup.fOpen("Map");
      }
      
      public function logout() : void
      {
         if(Boolean(this.intChatMode) && Boolean(this.chatF.bTall))
         {
            this.ui.mcInterface.ncModeChat.dispatchEvent(new MouseEvent(MouseEvent.CLICK));
         }
         if(this.litePreference.data.bCharSelect)
         {
            this.saveChar();
         }
         trace("logout called");
         this.sfc.sendXtMessage("zm","cmd",["logout"],"str",1);
      }
      
      public function showServerList() : void
      {
         if(Boolean(this.intChatMode) && Boolean(this.chatF.bTall))
         {
            this.ui.mcInterface.ncModeChat.dispatchEvent(new MouseEvent(MouseEvent.CLICK));
         }
         if(this.litePreference.data.bCharSelect)
         {
            this.saveChar();
         }
         this.showServers = true;
         this.sfc.sendXtMessage("zm","cmd",["logout"],"str",1);
      }
      
      public function showUpgradeWindow(tempObjData:Object = null) : void
      {
         var mc:MovieClip = null;
         if(mcUpgradeWindow == null)
         {
            mcUpgradeWindow = new MCUpgradeWindow();
         }
         mc = mcUpgradeWindow as MovieClip;
         var objData:* = tempObjData != null ? tempObjData : this.world.myAvatar.objData;
         mc.btnClose.addEventListener(MouseEvent.CLICK,this.hideUpgradeWindow,false,0,true);
         mc.btnClose2.addEventListener(MouseEvent.CLICK,this.hideUpgradeWindow,false,0,true);
         mc.btnBuy.addEventListener(MouseEvent.CLICK,this.onUpgradeClick,false,0,true);
         addChild(mcUpgradeWindow);
         try
         {
            this.ui.mouseChildren = false;
            this.world.mouseChildren = false;
         }
         catch(e:Error)
         {
         }
         try
         {
            this.mcLogin.sl.mouseChildren = false;
         }
         catch(e:Error)
         {
         }
      }
      
      public function hideUpgradeWindow(e:MouseEvent) : void
      {
         removeChild(mcUpgradeWindow);
         try
         {
            this.ui.mouseChildren = true;
            this.world.mouseChildren = true;
         }
         catch(e:Error)
         {
         }
         try
         {
            this.mcLogin.sl.mouseChildren = true;
         }
         catch(e:Error)
         {
         }
      }
      
      public function onUpgradeClick(evt:Event) : void
      {
         var strUpgradeURL:String = null;
         this.mixer.playSound("Click");
         if(ISWEB)
         {
            this.extCall.setUpPayment(this.sToken);
         }
         else
         {
            strUpgradeURL = "https://www.aq.com/order-now/direct/default.asp?cid=" + this.world.myAvatar.objData.CharID + "&token=" + loginInfo.strToken;
            navigateToURL(new URLRequest(strUpgradeURL),"_blank");
         }
      }
      
      public function showACWindow() : void
      {
         var mc:MovieClip = null;
         if(mcACWindow == null)
         {
            mcACWindow = new MCACWindow();
         }
         mc = mcACWindow as MovieClip;
         mc.btnClose.addEventListener(MouseEvent.CLICK,this.hideACWindow,false,0,true);
         mc.btnClose2.addEventListener(MouseEvent.CLICK,this.hideACWindow,false,0,true);
         mc.btnBuy.addEventListener(MouseEvent.CLICK,this.onUpgradeClick,false,0,true);
         mc.btnUpgrade.addEventListener(MouseEvent.CLICK,this.onUpgradeClick,false,0,true);
         addChild(mcACWindow);
         try
         {
            this.ui.mouseChildren = false;
            this.world.mouseChildren = false;
         }
         catch(e:Error)
         {
         }
         try
         {
            this.mcLogin.sl.mouseChildren = false;
         }
         catch(e:Error)
         {
         }
      }
      
      public function hideACWindow(e:MouseEvent) : void
      {
         removeChild(mcACWindow);
         try
         {
            this.ui.mouseChildren = true;
            this.world.mouseChildren = true;
         }
         catch(e:Error)
         {
         }
         try
         {
            this.mcLogin.sl.mouseChildren = true;
         }
         catch(e:Error)
         {
         }
      }
      
      public function initArrHP() : void
      {
         var intLevelCap:int = 0;
         var intHPBase1:int = 0;
         var intHPConst1:int = 0;
         var intScaling1:Number = NaN;
         var intHPBase2:int = 0;
         var intHPConst2:int = 0;
         var intScaling2:Number = NaN;
         var intHPBase3:int = 0;
         var intHPConst3:int = 0;
         var intScaling3:Number = NaN;
         var i:* = undefined;
         intLevelCap = 100;
         intHPBase1 = 550;
         intHPConst1 = 275;
         intScaling1 = 0.8;
         intHPBase2 = 720;
         intHPConst2 = 200;
         intScaling2 = 0.92;
         intHPBase3 = 350;
         intHPConst3 = 3650;
         intScaling3 = 1.1;
         for(i = 0; i < intLevelCap; i++)
         {
            if(i > 19)
            {
               this.arrHP.push(Math.round(intHPBase3 + Math.pow(i / intLevelCap,intScaling3) * intHPConst3));
            }
            else if(i > 7)
            {
               this.arrHP.push(Math.round(intHPBase2 + Math.pow(i / 20,intScaling2) * intHPConst2));
            }
            else
            {
               this.arrHP.push(Math.round(intHPBase1 + Math.pow(i / 8,intScaling1) * intHPConst1));
            }
         }
      }
      
      public function initArrRep() : void
      {
         var iCPToRank:int = 0;
         var i:* = undefined;
         iCPToRank = 0;
         for(i = 1; i < 10; i++)
         {
            iCPToRank = Math.pow(i + 1,3) * 100;
            if(i > 1)
            {
               this.arrRanks.push(iCPToRank + this.arrRanks[i - 1]);
            }
            else
            {
               this.arrRanks.push(iCPToRank + 100);
            }
         }
      }
      
      public function getRankFromPoints(rep:int) : int
      {
         var rank:int = 0;
         var i:* = undefined;
         rank = 1;
         if(rep < 0)
         {
            rep = 0;
         }
         for(i = 1; i < this.arrRanks.length; i++)
         {
            if(rep < this.arrRanks[i])
            {
               return rank;
            }
            rank++;
         }
         return rank;
      }
      
      public function attachOnModalStack(strLinkage:String) : MovieClip
      {
         var mc:MovieClip = null;
         var AssetClass:Class = null;
         var addOK:* = undefined;
         var tempClass:* = undefined;
         AssetClass = this.world.getClass(strLinkage) as Class;
         addOK = true;
         if(this.ui.ModalStack.numChildren)
         {
            mc = MovieClip(this.ui.ModalStack.getChildAt(0));
            tempClass = mc.constructor as Class;
            if(tempClass == AssetClass)
            {
               addOK = false;
            }
         }
         if(addOK)
         {
            this.clearModalStack();
            mc = MovieClip(this.ui.ModalStack.addChild(new AssetClass()));
            this.ui.ModalStack.mouseChildren = true;
         }
         return mc;
      }
      
      public function getInstanceFromModalStack(sClassName:String) : MovieClip
      {
         var i:int = 0;
         for(i = 0; i < this.ui.ModalStack.numChildren; i++)
         {
            if(getQualifiedClassName(this.ui.ModalStack.getChildAt(i) == sClassName))
            {
               return this.ui.ModalStack.getChildAt(i);
            }
         }
         return null;
      }
      
      public function isDialoqueUp() : Boolean
      {
         var i:int = 0;
         var di:* = undefined;
         var nm:* = undefined;
         for(i = 0; i < this.world.FG.numChildren; i++)
         {
            di = this.world.FG.getChildAt(i);
            nm = String(di as MovieClip);
            if(nm.indexOf("dlg_") > -1)
            {
               return true;
            }
         }
         return false;
      }
      
      public function clearModalStack() : Boolean
      {
         var i:int = 0;
         if(this.isGreedyModalInStack())
         {
            return false;
         }
         i = 0;
         while(this.ui.ModalStack.numChildren > 0 && i < 100)
         {
            i++;
            this.ui.ModalStack.removeChildAt(0);
         }
         stage.focus = null;
         return true;
      }
      
      public function closeModalByStrBody(s:String) : void
      {
         var i:int = 0;
         var child:MovieClip = null;
         i = 0;
         for(i = 0; i < this.ui.ModalStack.numChildren; i++)
         {
            child = this.ui.ModalStack.getChildAt(i) as MovieClip;
            if(child.cnt.strBody.htmlText.indexOf(s) > -1 && child.currentLabel != "out")
            {
               child.fClose();
            }
         }
      }
      
      public function isGreedyModalInStack() : Boolean
      {
         var i:int = 0;
         var child:MovieClip = null;
         i = 0;
         for(i = 0; i < this.ui.ModalStack.numChildren; i++)
         {
            child = this.ui.ModalStack.getChildAt(i) as MovieClip;
            if("greedy" in child && child.greedy != null && child.greedy == true)
            {
               return true;
            }
         }
         return false;
      }
      
      public function clearPopups(exemptLabels:Array = null) : void
      {
         if(this.ui.mcPopup.currentLabel == "House")
         {
            this.ui.mcPopup.mcHouseMenu.hideItemHandle();
         }
         if(exemptLabels == null || exemptLabels.indexOf(this.ui.mcPopup.currentLabel) < 0)
         {
            this.ui.mcPopup.onClose();
         }
         this.world.removeMovieFront();
         this.clearModalStack();
      }
      
      public function clearPopupsQ() : void
      {
         if(this.ui.mcPopup.currentLabel != "House" && this.ui.mcPopup.currentLabel != "HouseShop")
         {
            this.ui.mcPopup.onClose();
         }
      }
      
      public function addUpdate(str:String, isBad:Boolean = false) : void
      {
         var mcu:MovieClip = null;
         var mc:MovieClip = null;
         var i:* = 0;
         mcu = this.ui.mcUpdates;
         mc = mcu.addChildAt(new uProto(),1) as MovieClip;
         mc.y = 0;
         mc.x = mcu.uproto.x;
         mc.t1.ti.text = str;
         if(isBad)
         {
            mc.t1.ti.textColor = 16711680;
         }
         mc.gotoAndPlay("in");
         i = 2;
         if(mcu.numChildren > 2)
         {
            for(i = 2; i < mcu.numChildren; i++)
            {
               if(i < 4)
               {
                  mcu.getChildAt(i).y = mcu.getChildAt(i).y - 18;
               }
               else
               {
                  MovieClip(mcu.getChildAt(i)).stop();
                  mcu.removeChildAt(i);
                  i--;
               }
            }
         }
      }
      
      public function clearUpdates() : void
      {
         var mcu:MovieClip = null;
         mcu = this.ui.mcUpdates;
         while(mcu.numChildren > 1)
         {
            mcu.removeChildAt(1);
         }
      }
      
      public function showItemDrop(itemObj:*, isConditional:*) : void
      {
         var dropItem:* = undefined;
         if(Boolean(this.litePreference.data.bCustomDrops) && (Boolean(itemObj.bTemp == 0) && Boolean(isConditional)))
         {
            this.cDropsUI.showItem(itemObj);
            return;
         }
         if(Boolean(this.litePreference.data.dOptions["hideDrop"]) && Boolean(this.litePreference.data.bCustomDrops) && itemObj.bTemp == 0)
         {
            return;
         }
         if(Boolean(this.litePreference.data.dOptions["hideTemp"]) && Boolean(this.litePreference.data.bCustomDrops) && itemObj.bTemp != 0)
         {
            return;
         }
         if(Boolean(this.litePreference.data.bCustomDrops) && (itemObj.bTemp == 0 && !isConditional))
         {
            dropItem = new DFrameMC(itemObj);
            this.ui.dropStack.addChild(dropItem);
            dropItem.init();
            dropItem.fY = dropItem.y = -(dropItem.fHeight + 8);
            dropItem.fX = dropItem.x = -(dropItem.fWidth / 2);
            this.cleanDropStack();
            return;
         }
         if(itemObj.bTemp != 0 || !isConditional)
         {
            dropItem = new DFrameMC(itemObj);
         }
         else
         {
            dropItem = new DFrame2MC(itemObj);
         }
         this.ui.dropStack.addChild(dropItem);
         dropItem.init();
         dropItem.fY = dropItem.y = -(dropItem.fHeight + 8);
         dropItem.fX = dropItem.x = -(dropItem.fWidth / 2);
         this.cleanDropStack();
      }
      
      public function cleanDropStack() : void
      {
         var itemA:MovieClip = null;
         var itemB:MovieClip = null;
         var i:* = undefined;
         itemA = null;
         itemB = null;
         for(i = this.ui.dropStack.numChildren - 2; i > -1; i--)
         {
            itemA = this.ui.dropStack.getChildAt(i) as MovieClip;
            itemB = this.ui.dropStack.getChildAt(i + 1) as MovieClip;
            itemA.fY = itemA.y = itemB.fY - (itemB.fHeight + 8);
         }
      }
      
      public function dropStackBoost() : void
      {
         this.ui.dropStack.y = 438;
      }
      
      public function dropStackReset() : void
      {
         this.ui.dropStack.y = 493;
      }
      
      public function showAchievement(aName:String, aPts:int) : void
      {
         var achievement:mcAchievement = null;
         var mc:MovieClip = null;
         achievement = new mcAchievement();
         mc = this.ui.dropStack.addChild(achievement) as MovieClip;
         mc.cnt.tBody.text = aName;
         mc.cnt.tPts.text = aPts;
         mc.fWidth = 348;
         mc.fHeight = 90;
         mc.fX = mc.x = -(mc.fWidth / 2);
         mc.fY = mc.y = -(mc.fHeight + 8);
         this.cleanDropStack();
      }
      
      public function showQuestpopup(resObj:Object) : void
      {
         var qp:mcQuestpopup = null;
         var mc:MovieClip = null;
         var s:String = null;
         var o:Object = null;
         var rw:int = 0;
         if(this.litePreference.data.bDisQPopup)
         {
            return;
         }
         qp = new mcQuestpopup();
         qp.cnt.mcAC.visible = false;
         mc = this.ui.dropStack.addChild(qp) as MovieClip;
         mc.cnt.tName.text = resObj.sName;
         mc.cnt.rewards.tRewards.htmlText = "";
         s = "";
         o = resObj.rewardObj;
         trace("rewardtype: " + resObj.rewardType);
         if("intCoins" in o && o.intCoins > 0)
         {
            s = "<font color=\'#FFFFFF\'>" + o.intCoins + "</font>";
            s += "<font color=\'#FFCC00\'>ac</font>";
         }
         if("intGold" in o && o.intGold > 0)
         {
            if(s.length > 0)
            {
               s += "<font color=\'#FFFFFF\'>, </font>";
            }
            s += "<font color=\'#FFFFFF\'>" + o.intGold + "</font>";
            s += "<font color=\'#FFCC00\'>g</font>";
         }
         if("intExp" in o && o.intExp > 0)
         {
            if(s.length > 0)
            {
               s += "<font color=\'#FFFFFF\'>, </font>";
            }
            s += "<font color=\'#FFFFFF\'>" + o.intExp + "</font>";
            s += "<font color=\'#FF00FF\'>xp</font>";
         }
         if("iRep" in o && o.iRep > 0)
         {
            if(s.length > 0)
            {
               s += "<font color=\'#FFFFFF\'>, </font>";
            }
            s += "<font color=\'#FFFFFF\'>" + o.iRep + "</font>";
            s += "<font color=\'#00CCFF\'>rep</font>";
         }
         if("guildRep" in o && o.guildRep > 0)
         {
            if(s.length > 0)
            {
               s += "<font color=\'#FFFFFF\'>, </font>";
            }
            s += "<font color=\'#FFFFFF\'>" + o.guildRep + "</font>";
            s += "<font color=\'#00CCFF\'>guild rep</font>";
         }
         mc.cnt.rewards.tRewards.htmlText = s;
         mc.fWidth = 240;
         mc.fHeight = 70;
         rw = mc.cnt.rewards.tRewards.x + mc.cnt.rewards.tRewards.textWidth;
         mc.cnt.rewards.x = Math.round(mc.fWidth / 2 - rw / 2);
         mc.fX = mc.x = -(mc.fWidth / 2);
         mc.fY = mc.y = -(mc.fHeight + 8);
         this.mixer.playSound("Good");
         this.cleanDropStack();
      }
      
      public function toggleCharpanel(typ:String = "") : void
      {
         var mc:MovieClip = null;
         mc = this.ui.mcPopup;
         if(!this.isGreedyModalInStack())
         {
            if(mc.currentLabel != "Charpanel")
            {
               this.clearPopups();
               this.clearPopupsQ();
               mc.fData = {"typ":typ};
               mc.visible = true;
               mc.gotoAndPlay("Charpanel");
            }
            else
            {
               mc.mcCharpanel.fClose();
            }
         }
      }
      
      public function toggleStatspanel(typ:String = "") : void
      {
         if(this.ui.getChildByName("mcStatsPanel"))
         {
            this.mcStatsPanel.cleanup();
            this.mcStatsPanel = null;
            return;
         }
         this.mcStatsPanel = new statsPanel(this);
         this.ui.addChild(this.mcStatsPanel);
         this.mcStatsPanel.name = "mcStatsPanel";
         this.mcStatsPanel.x = 474;
         this.mcStatsPanel.y = 240;
      }
      
      public function toggleOutfits(typ:String = "") : void
      {
         if(this.world.myAvatar.dataLeaf.intState != 1)
         {
            return;
         }
         if(this.world.bPvP)
         {
            return;
         }
         this.requestInterface("OutfitSets/outfitsetsr2.swf","outfitSets");
      }
      
      public function showFriendshipUI(typ:String = "") : void
      {
         if(!this.world.coolDown("friendshipStats"))
         {
            return;
         }
         this.requestInterface("friendship/friendship_ui.swf","friendship_ui");
      }
      
      public function togglePVPPanel(typ:String = "") : void
      {
         var mc:MovieClip = null;
         mc = this.ui.mcPopup;
         if(!this.isGreedyModalInStack())
         {
            if(mc.currentLabel != "PVPPanel")
            {
               this.clearPopups();
               this.clearPopupsQ();
               mc.fData = {"typ":typ};
               mc.visible = true;
               mc.gotoAndPlay("PVPPanel");
            }
            else
            {
               mc.onClose();
            }
         }
      }
      
      public function showPVPScore() : void
      {
         var bar:MovieClip = null;
         var i:int = 0;
         var o:Object = null;
         var a:Array = null;
         var bx:int = 0;
         this.ui.mcPVPScore.visible = true;
         this.ui.mcPVPScore.y = 2;
         i = 0;
         a = [{"sName":"Team A"},{"sName":"Team B"}];
         bx = 200;
         if(this.world.PVPFactions.length > 0)
         {
            a = this.world.PVPFactions;
         }
         for(i = 0; i < a.length; i++)
         {
            o = a[i];
            try
            {
               bar = this.ui.mcPVPScore.getChildByName("bar" + i);
               bar.tTeam.text = o.sName;
               if(bar.tTeam.x + bar.tTeam.width - bar.tTeam.textWidth - 6 < bx)
               {
                  bx = Math.round(bar.tTeam.x + bar.tTeam.width - bar.tTeam.textWidth - 6);
               }
            }
            catch(e:Error)
            {
               trace("*** >");
               trace("*** > PvP Faction data could not be found or set.");
               trace("*** >");
            }
         }
         for(i = 0; i < a.length; i++)
         {
            o = a[i];
            try
            {
               bar = this.ui.mcPVPScore.getChildByName("bar" + i);
               bar.cap.x = bx;
            }
            catch(e:Error)
            {
            }
         }
      }
      
      public function hidePVPScore() : void
      {
         this.ui.mcPVPScore.visible = false;
         this.ui.mcPVPScore.y = -300;
      }
      
      public function showMCPVPQueue() : void
      {
         var w:Object = null;
         w = this.world.getWarzoneByWarzoneName(this.world.PVPQueue.warzone);
         this.ui.mcPVPQueue.t1.text = w.nam;
         this.ui.mcPVPQueue.removeEventListener(Event.ENTER_FRAME,this.MCPVPQueueEF);
         this.ui.mcPVPQueue.t2label.visible = false;
         this.ui.mcPVPQueue.t2.visible = false;
         if(this.world.PVPQueue.avgWait > -1)
         {
            this.ui.mcPVPQueue.t2label.visible = true;
            this.ui.mcPVPQueue.t2.visible = true;
            this.ui.mcPVPQueue.addEventListener(Event.ENTER_FRAME,this.MCPVPQueueEF,false,0,true);
         }
         this.ui.mcPVPQueue.visible = true;
         this.ui.mcPVPQueue.y = 84;
      }
      
      public function hideMCPVPQueue() : void
      {
         this.ui.mcPVPQueue.removeEventListener(Event.ENTER_FRAME,this.MCPVPQueueEF);
         this.ui.mcPVPQueue.visible = false;
         this.ui.mcPVPQueue.y = -300;
      }
      
      public function onMCPVPQueueClick(e:MouseEvent) : void
      {
         var params:* = undefined;
         params = {};
         try
         {
            params.strUsername = this.world.myAvatar.objData.strUsername;
            this.ui.cMenu.fOpenWith("pvpqueue",params);
         }
         catch(e:Error)
         {
         }
      }
      
      public function MCPVPQueueEF(e:Event) : void
      {
         var now:Number = NaN;
         var mins:* = undefined;
         now = new Date().getTime();
         mins = Math.ceil((this.world.PVPQueue.avgWait * 1000 - (now - this.world.PVPQueue.ts)) / 1000 / 60);
         this.ui.mcPVPQueue.t2.htmlText = "<font color=\"#FFFFFF\"" + mins + "</font><font color=\"#999999\"m</font>";
         if(mins <= 1)
         {
            this.ui.mcPVPQueue.t2.htmlText = "<" + this.ui.mcPVPQueue.t2.htmlText;
         }
      }
      
      public function updatePVPScore(a:Array) : void
      {
         var o:Object = null;
         var mc:MovieClip = null;
         var i:int = 0;
         var dx:int = 0;
         o = {};
         for(i = 0; i < a.length; i++)
         {
            o = a[i];
            mc = this.ui.mcPVPScore.getChildByName("bar" + i) as MovieClip;
            if(mc != null)
            {
               mc.ti.text = o.v + "/1000";
               dx = int(o.v / 1000 * mc.bar.width);
               dx = Math.max(Math.min(dx,mc.bar.width),0);
               mc.bar.x = -mc.bar.width + dx;
            }
         }
      }
      
      public function relayPVPEvent(o:Object) : void
      {
         if(o.typ == "kill")
         {
            if(o.team == this.world.myAvatar.dataLeaf.pvpTeam)
            {
               if(o.val == "Restorer")
               {
                  this.addUpdate(this.getPVPMessage(o.val,true));
               }
               if(o.val == "Brawler")
               {
                  this.addUpdate(this.getPVPMessage(o.val,true));
               }
               if(o.val == "Captain")
               {
                  this.addUpdate(this.getPVPMessage(o.val,true));
               }
               if(o.val == "General")
               {
                  this.addUpdate("Victory! The enemy general has been defeated!");
               }
               if(o.val == "Knight")
               {
                  this.addUpdate("A knight of the enemy has fallen! Victory draws closer!");
               }
            }
            else
            {
               if(o.val == "Restorer")
               {
                  this.addUpdate(this.getPVPMessage(o.val,false),true);
               }
               if(o.val == "Brawler")
               {
                  this.addUpdate(this.getPVPMessage(o.val,false),true);
               }
               if(o.val == "Captain")
               {
                  this.addUpdate(this.getPVPMessage(o.val,false),true);
               }
               if(o.val == "General")
               {
                  this.addUpdate("Oh no!  Our general has been defeated!",true);
               }
               if(o.val == "Knight")
               {
                  this.addUpdate("A knight has fallen to the enemy!");
               }
            }
         }
      }
      
      private function getPVPMessage(val:String, isMyTeam:Boolean) : String
      {
         switch(val)
         {
            case "Restorer":
               if(isMyTeam)
               {
                  return this.world.strMapName == "dagepvp" ? "An enemy Blade Master has been defeated! Dage\'s healing powers are waning!" : "An enemy Restorer has been defeated! The Captain\'s healing powers are waning!";
               }
               return this.world.strMapName == "dagepvp" ? "A Blade Master has been defeated!\t Dage\'s healing powers are waning!" : "A Restorer has been defeated!\t Our Captain\'s healing powers are waning!";
               break;
            case "Brawler":
               if(isMyTeam)
               {
                  return this.world.strMapName == "dagepvp" ? "An enemy Legion Guard has been defeated!  Dage\'s attacks grow weaker!" : "An enemy Brawler has been defeated!  The Captain\'s attacks grow weaker!";
               }
               return this.world.strMapName == "dagepvp" ? "A Legion Guard has been defeated!\tRally to Dage\'s defense!" : "A Brawler has been defeated!\tRally to the Captain\'s defense!";
               break;
            case "Captain":
               if(isMyTeam)
               {
                  return this.world.strMapName == "dagepvp" ? "Dage has been defeated!" : "The enemy captain has been defeated!";
               }
               return this.world.strMapName == "dagepvp" ? "Dage has been fallen to the enemy!" : "Our Captain has been fallen to the enemy!";
               break;
            default:
               return "";
         }
      }
      
      public function mcSetColor(oMC:MovieClip, strLocation:String, strShade:String) : *
      {
         var mc:MovieClip = null;
         var typ:String = null;
         var cached:Object = null;
         if(currentLabel == "Select")
         {
            this.mcCharSelect.mcSetColor(oMC,strLocation,strShade);
            return;
         }
         if(this._colorCache[oMC] != null)
         {
            cached = this._colorCache[oMC];
            if(cached.avatarMC != null && cached.avatarMC.pAV != undefined && oMC.parent != null)
            {
               cached.avatarMC.pAV.pMC.setColor(oMC,cached.typ,strLocation,strShade);
               return;
            }
            delete this._colorCache[oMC];
         }
         mc = oMC;
         typ = "none";
         while(mc != null && mc.parent != null && mc.parent != mc.stage)
         {
            if("pAV" in mc)
            {
               if(mc.name.indexOf("previewMC") > -1)
               {
                  typ = "e";
               }
               else if(mc.name.indexOf("Dummy") > -1)
               {
                  typ = "d";
               }
               else if(mc.name.indexOf("mcPortraitTarget") > -1)
               {
                  typ = "c";
               }
               else if(mc.name.indexOf("mcPortrait") > -1)
               {
                  typ = "b";
               }
               else
               {
                  typ = "a";
               }
               break;
            }
            mc = MovieClip(mc.parent);
         }
         if(typ != "none")
         {
            this._colorCache[oMC] = {
               "avatarMC":mc,
               "typ":typ
            };
            if(mc.pAV == undefined)
            {
               this.world.myAvatar.pMC.setColor(oMC,typ,strLocation,strShade);
            }
            else
            {
               mc.pAV.pMC.setColor(oMC,typ,strLocation,strShade);
            }
         }
      }
      
      public function registerAttackFrame(oMC:MovieClip) : *
      {
         var mc:MovieClip = null;
         mc = oMC;
         while(mc != null && mc.parent != null && mc.parent != mc.stage)
         {
            if("pAV" in mc)
            {
               break;
            }
            mc = MovieClip(mc.parent);
         }
         if("pAV" in mc)
         {
            if(!("attackFrames" in mc.pAV.pMC))
            {
               return;
            }
            if(Boolean(mc.pAV.pMC.attackFrames) && mc.pAV.pMC.attackFrames.indexOf(oMC) != -1)
            {
               mc.pAV.pMC.attackFrames.splice(mc.pAV.pMC.attackFrames.indexOf(oMC),1);
            }
            mc.pAV.pMC.attackFrames.push(oMC);
         }
      }
      
      public function areaListClick(e:MouseEvent) : void
      {
         var mc:* = undefined;
         mc = MovieClip(e.currentTarget.parent.parent);
         switch(mc.currentLabel)
         {
            case "init":
               mc.gotoAndPlay("in");
               break;
            case "hold":
               mc.gotoAndPlay("out");
         }
      }
      
      public function updateAreaName() : void
      {
         var strAreaText:String = null;
         strAreaText = String(this.world.areaUsers.length) + " player";
         if(this.world.areaUsers.length > 1)
         {
            strAreaText += "(s)";
         }
         strAreaText += " in <font color =\'#FFFF00\'>";
         if(this.world.strAreaName.indexOf(":") > -1)
         {
            strAreaText += this.world.strAreaName.split(":")[0] + " (party)";
         }
         else
         {
            strAreaText += this.world.strAreaName;
         }
         strAreaText += "</font>";
         this.ui.mcInterface.areaList.title.t1.htmlText = strAreaText;
      }
      
      public function areaListGet() : void
      {
         var ul:Object = null;
         var userList:Object = null;
         var i:String = null;
         var tuoLeaf:* = undefined;
         ul = {};
         userList = this.sfc.getRoom(this.world.curRoom).getUserList();
         for(i in userList)
         {
            tuoLeaf = this.world.uoTree[userList[i].getName()];
            if(tuoLeaf != null)
            {
               ul[i] = {
                  "strUsername":tuoLeaf.strUsername,
                  "intLevel":tuoLeaf.intLevel
               };
            }
         }
         this.areaListShow(ul);
      }
      
      public function areaListNameClick(e:MouseEvent) : void
      {
         var ti:* = undefined;
         var params:* = undefined;
         ti = MovieClip(e.currentTarget);
         params = {};
         params.ID = ti.objData.ID;
         params.strUsername = ti.objData.strUsername;
         if(ti.objData.strUsername == this.world.myAvatar.objData.strUsername)
         {
            this.ui.cMenu.fOpenWith("self",params);
         }
         else
         {
            this.ui.cMenu.fOpenWith("user",params);
         }
      }
      
      public function areaListShow(ul:Object) : void
      {
         var mc:MovieClip = null;
         var ind:int = 0;
         var i:String = null;
         var item:* = undefined;
         mc = this.ui.mcInterface.areaList;
         if(mc.currentLabel == "hold")
         {
            while(mc.cnt.numChildren > 0)
            {
               mc.cnt.removeChildAt(0);
            }
         }
         ind = 0;
         for(i in ul)
         {
            item = mc.cnt.addChild(new aProto());
            item.objData = ul[i];
            item.txtName.text = ul[i].strUsername;
            item.txtLevel.text = ul[i].intLevel;
            item.addEventListener(MouseEvent.CLICK,this.areaListNameClick,false,0,true);
            item.buttonMode = true;
            item.y = -int(ind * 14);
            ind++;
         }
         mc.cnt.iproto.visible = mc.currentLabel == "hold";
         mc.visible = true;
      }
      
      public function showFBShare(o:Object) : void
      {
         var mc:MovieClip;
         var FBShareTabClass:Class;
         var fbTab:FacebookTabMC = null;
         trace("showFBShare > " + o.isActive + ", " + this.uoPref.bFBShare);
         mc = MovieClip(o.parent);
         FBShareTabClass = getDefinitionByName("FacebookTabMC") as Class;
         if(Boolean(this.uoPref.bFBShare) && Boolean(o.isActive))
         {
            trace("  trying to show the tab");
            try
            {
               fbTab = o.parent.getChildByName("fbTab") as FacebookTabMC;
            }
            catch(error:Error)
            {
               trace(error);
            }
            if(fbTab == null)
            {
               fbTab = new FBShareTabClass();
               fbTab.name = "fbTab";
               fbTab.filters = [new GlowFilter(12892822,1,10,10,2,2,false,false)];
               o.parent.addChild(fbTab);
               trace(" tab drawn");
            }
            fbTab.init(o);
            fbTab.visible = true;
            if("position" in o)
            {
               fbTab.positionBy(o);
            }
         }
         else
         {
            try
            {
               o.parent.getChildByName("fbTab").visible = false;
            }
            catch(error:Error)
            {
            }
         }
      }
      
      public function closeFBC() : void
      {
         trace("closeFBC()");
         if(this.fbc != null)
         {
            this.fbc.fClose();
         }
      }
      
      public function getAppName() : String
      {
         return Game.FB_APP_NAME;
      }
      
      public function getAppID() : String
      {
         return Game.FB_APP_ID;
      }
      
      public function getAppSec() : String
      {
         return Game.FB_APP_SEC;
      }
      
      public function getAppURL() : String
      {
         return Game.FB_APP_URL;
      }
      
      public function getUserName() : String
      {
         if(this.world != null && this.world.myAvatar != null && this.world.myAvatar.objData != null && "strUserName" in this.world.myAvatar.objData)
         {
            return this.world.myAvatar.objData.strUserName;
         }
         return "";
      }
      
      public function toggleFaction() : void
      {
         if(this.ui.mcPopup.currentLabel != "Faction")
         {
            this.ui.mcPopup.fOpen("Faction");
         }
         else if("cnt" in MovieClip(this.ui.mcPopup))
         {
            MovieClip(MovieClip(this.ui.mcPopup).cnt).xClick();
         }
      }
      
      public function hideInterface() : void
      {
         this.ui.visible = false;
      }
      
      public function showInterface() : void
      {
         this.ui.visible = true;
      }
      
      public function loadExternalSWF(strFilename:String) : void
      {
         if(strFilename.indexOf("https://") == -1 || strFilename.indexOf("https://") == -1)
         {
            if(strFilename.length > 1 && strFilename.charAt(0) == "/")
            {
               strFilename = strFilename.substr(1,strFilename.length - 1);
            }
            strFilename = "maps/" + strFilename;
         }
         this.ldrMC.loadFile(this.mcExtSWF,strFilename,"Game Files");
         this.hideInterface();
         this.world.visible = false;
      }
      
      public function clearExternamSWF() : void
      {
         var child:DisplayObject = null;
         SoundMixer.stopAll();
         while(this.mcExtSWF.numChildren > 0)
         {
            child = this.mcExtSWF.getChildAt(0);
            if(child is MovieClip)
            {
               this.recursiveStop(MovieClip(child));
            }
            this.mcExtSWF.removeChildAt(0);
         }
         this.world.visible = true;
         this.showInterface();
      }
      
      public function openCharacterCustomize() : void
      {
         this.ui.mcPopup.fOpen("Customize");
      }
      
      public function openArmorCustomize() : void
      {
         this.ui.mcPopup.fOpen("ArmorColor");
      }
      
      public function showFactionInterface() : void
      {
         this.ui.mcPopup.fOpen("Faction");
      }
      
      public function showConfirmtaionBox(sMsg:String, fHandler:Function) : void
      {
         var modal:* = undefined;
         var modalO:* = undefined;
         modal = new ModalMC();
         modalO = {};
         modalO.strBody = sMsg;
         modalO.btns = "dual";
         modalO.params = {};
         modalO.callback = function(params:Object):*
         {
            fHandler(params.accept);
         };
         this.ui.ModalStack.addChild(modal);
         modal.init(modalO);
      }
      
      public function showMessageBox(sMsg:String, fHandler:Function = null) : void
      {
         var modal:* = undefined;
         var modalO:* = undefined;
         modal = new ModalMC();
         modalO = {};
         modalO.strBody = sMsg;
         modalO.btns = "mono";
         modalO.params = {};
         modalO.callback = function(params:Object):*
         {
            if(fHandler != null)
            {
               fHandler();
            }
         };
         this.ui.ModalStack.addChild(modal);
         modal.init(modalO);
      }
      
      public function getServerTime() : Date
      {
         var date_now:Date = null;
         var ts:* = undefined;
         date_now = new Date();
         ts = this.ts_login_server + (date_now.getTime() - this.ts_login_client);
         return new Date(ts);
      }
      
      public function get date_server() : Date
      {
         return this.getServerTime();
      }
      
      public function showTracking(qsVal:String) : void
      {
         var uid:* = undefined;
         try
         {
            uid = objLogin.userid != null ? objLogin.userid : 0;
            this.extCall.logQuestProgress(uid,qsVal);
         }
         catch(e:*)
         {
         }
      }
      
      public function removeApop() : void
      {
         if(this.apop == null)
         {
            return;
         }
         this.apop_ = null;
         this.world.removeMovieFront();
      }
      
      public function createApop() : void
      {
         if(this.apop_ != null)
         {
            this.removeApop();
         }
         this.apop_ = new apopCore(this as MovieClip,this.apopTree[this.curID]);
         this.apop_.x = 270;
         this.apop_.y = 20;
         this.world.FG.addChild(this.apop_);
         this.world.FG.mouseChildren = true;
      }
      
      public function rand(min:Number = 0, max:Number = 1) : Number
      {
         return this.rn.rand(min,max);
      }
      
      public function get TravelMap() : Object
      {
         return this.travelMapData;
      }
      
      public function get apop() : apopCore
      {
         return this.apop_;
      }
      
      public function get objWorldMap() : *
      {
         return this.WorldMapData;
      }
      
      public function getLogin() : Object
      {
         return objLogin;
      }
      
      internal function frame1() : *
      {
         stop();
      }
      
      internal function frame12() : *
      {
         this.init();
         this.showTracking("2");
      }
      
      internal function frame13() : *
      {
         this.loadTitle();
         if(this.showServers)
         {
            if(FacebookConnect.isLoggedIn && loginInfo.strPassword == null && ISWEB)
            {
               this.extCall.fbLogin();
            }
            else
            {
               this.login(loginInfo.strUsername,loginInfo.strPassword);
            }
            this.showServers = false;
         }
         else if(this.csShowServers)
         {
            this.mcLogin.gotoAndPlay("Servers");
            this.csShowServers = false;
         }
         stop();
      }
      
      internal function frame23() : *
      {
         trace("at game");
         this.initInterface();
         this.initWorld();
         stop();
      }
      
      internal function frame33() : *
      {
         if(this.params.vars != null)
         {
            this.loadAccountCreation("newuser/" + this.params.vars.sCharCreate);
         }
         else
         {
            this.loadAccountCreation("newuser/AQW-Landing-MERGETEST.swf");
         }
         stop();
      }
      
      internal function frame43() : *
      {
         if(this.mcCharSelect != null)
         {
            trace("Cleaning up existing mcCharSelect");
            trace("children count: " + this.numChildren);
            this.mcCharSelect = null;
         }
         this.loader = new mcLoader();
         this.loader.x = 400;
         this.loader.y = 211;
         this.addChild(this.loader);
         this.csLoader = new Loader();
         this.csLoader.contentLoaderInfo.addEventListener(Event.COMPLETE,this.onCSComplete,false,0,true);
         this.csLoader.contentLoaderInfo.addEventListener(ProgressEvent.PROGRESS,this.onCSProgress,false,0,true);
         this.csLoader.contentLoaderInfo.addEventListener(IOErrorEvent.IO_ERROR,this.onCSError,false,0,true);
         this.fileUrl = this.getFilePath() + "interface/CharSelect/charselect.swf";
         if(this.params != null && this.params.vars != null && this.params.vars.sVersion != null)
         {
            this.fileUrl += "?v=" + this.params.vars.sVersion;
         }
         this.csLoader.load(new URLRequest(this.fileUrl));
         this.csbLoaded = 0;
         this.csbTotal = 0;
         stop();
      }
   }
}

