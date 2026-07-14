<?php
class Handler extends ContentMS {
    var $UserData, $World, $Settings;
    
    function Handler() {
        $this->World = new stdClass();
		$this->Settings = new stdClass();
        $this->UserData = new stdClass();
        $this->UserData->id = 0;
        $this->UserData->Login = false;
        $this->UserData->ActivationFlag = 5;
        $this->UserData->Access = 1;
        $this->UserData->Name = 'Guest';
        $this->UserData->Level = 0;
        $this->UserData->Exp = 0;
        $this->UserData->Gold = 0;
        $this->UserData->Coins = 0;
        $this->UserData->KillCount = 0;
        $this->UserData->DeathCount = 0;        
        $this->UserData->Inventory = null;        
        $this->UserData->FlashVars = null;       
        $this->UserData->Address = '0.0.0.0';       


        if (!file_exists(Configuration::getPublic('WorldItems'))) {
            //$this->CacheObjects('Items');
        } else $this->World->Items = json_decode(file_get_contents(Configuration::getPublic('WorldItems')), true);
        $sql = $this->MySQL('Query', "SELECT * FROM `settings_login`");
        while ($GameSettings = $sql->fetch_object()) $this->Settings->{$GameSettings->name} = $GameSettings->value;
        $this->assign("Settings", $this->Settings);        
        if (!isset($_SESSION["info"]['browser'])) {
            $_SESSION["info"]['browser']['engine'] = 'UNKNOWN';
            $_SESSION["info"]['browser']['version'] = 'UNKNOWN';
            $_SESSION["info"]['browser']['platform'] = 'UNKNOWN';
            $_SESSION["info"]['browser']['name'] = 'UNKNOWN';

            $navigator_user_agent = empty($_SERVER['HTTP_USER_AGENT']) ? null : strtolower($_SERVER['HTTP_USER_AGENT']);

            if (strpos($navigator_user_agent, 'linux')) : $_SESSION["info"]['browser']['platform'] = 'Linux';
            elseif (strpos($navigator_user_agent, 'mac')) : $_SESSION["info"]['browser']['platform'] = 'Mac';
            elseif (strpos($navigator_user_agent, 'win')) : $_SESSION["info"]['browser']['platform'] = 'Windows';
	        endif;

            if (strpos($navigator_user_agent, "trident")) {
                $_SESSION["info"]['browser']['engine'] = 'TRIDENT';
                $_SESSION["info"]['browser']['version'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "trident/") + 8, 3));
            } elseif (strpos($navigator_user_agent, "webkit")) {
                $_SESSION["info"]['browser']['engine'] = 'WEBKIT';
                $_SESSION["info"]['browser']['version'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "webkit/") + 7, 8));
            } elseif (strpos($navigator_user_agent, "presto")) {
                $_SESSION["info"]['browser']['engine'] = 'PRESTO';
                $_SESSION["info"]['browser']['version'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "presto/") + 6, 7));
            } elseif (strpos($navigator_user_agent, "gecko")) {
                $_SESSION["info"]['browser']['engine'] = 'GECKO';
                $_SESSION["info"]['browser']['version'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "gecko/") + 6, 9));
            } elseif (strpos($navigator_user_agent, "robot"))
                $_SESSION["info"]['browser']['engine'] = 'ROBOTS';
            elseif (strpos($navigator_user_agent, "spider"))
                $_SESSION["info"]['browser']['engine'] = 'ROBOTS';
            elseif (strpos($navigator_user_agent, "bot"))
                $_SESSION["info"]['browser']['engine'] = 'ROBOTS';
            elseif (strpos($navigator_user_agent, "crawl"))
                $_SESSION["info"]['browser']['engine'] = 'ROBOTS';
            elseif (strpos($navigator_user_agent, "search"))
                $_SESSION["info"]['browser']['engine'] = 'ROBOTS';
            elseif (strpos($navigator_user_agent, "w3c_validator")) 
                $_SESSION["info"]['browser']['engine'] = 'VALIDATOR';
            elseif (strpos($navigator_user_agent, "jigsaw"))
                $_SESSION["info"]['browser']['engine'] = 'VALIDATOR';
				
            if (preg_match('/msie/i', $navigator_user_agent) && !preg_match('/opera/i', $navigator_user_agent)) 
                $_SESSION["info"]['browser']['name'] = 'Internet Explorer';
            elseif (preg_match('/firefox/i', $navigator_user_agent)) 
                $_SESSION["info"]['browser']['name'] = 'Mozilla Firefox'; 
            elseif (preg_match('/chrome/i', $navigator_user_agent)) {
                $_SESSION["info"]['browser']['name'] = 'Google Chrome'; 
           } elseif (preg_match('/safari/i', $navigator_user_agent))         
                $_SESSION["info"]['browser']['name'] = 'Apple Safari';     
            elseif (preg_match('/opera/i', $navigator_user_agent)) 
                $_SESSION["info"]['browser']['name'] = 'Opera';    
            elseif (preg_match('/netscape/i', $navigator_user_agent)) 
                $_SESSION["info"]['browser']['name'] = 'Netscape';   
        }

        if (isset($_SESSION['udata'])) {
            $sql = $this->MySQL('Query', "SELECT Access, ActivationFlag, UpgradeExpire, Coins  FROM `users` WHERE Hash = '{$_SESSION['udata']->Hash}'");
            $ResultSet = $sql->fetch_object();
            
            if ($ResultSet != null) {
                $_SESSION['udata']->Access = $ResultSet->Access;
                $_SESSION['udata']->ActivationFlag = $ResultSet->ActivationFlag;
                $_SESSION['udata']->UpgradeExpire = $ResultSet->UpgradeExpire;
                $_SESSION['udata']->Coins = $ResultSet->Coins;

                $this->UserData = $_SESSION['udata'];
                $this->UserData->Login = true;

				$BrowserStats = $this->MySQL('FetchObject', "SELECT COUNT(*) AS exist FROM users_browser WHERE UserID = {$this->UserData->id}")->exist;
				$Referer = $this->MySQL('EscapeString', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null);
                if ($BrowserStats > 0) {
				    $this->MySQL('Query', "UPDATE users_browser SET Referer = '{$Referer}', Engine = '{$_SESSION["info"]['browser']['engine']}', Platform = '{$_SESSION["info"]['browser']['platform']}', Browser = '{$_SESSION["info"]['browser']['name']}'WHERE UserID = {$this->UserData->id}");
				} else {
			    	$this->MySQL('Query', "INSERT INTO users_browser (UserID, Referer, Engine, Platform, Browser) VALUES ({$this->UserData->id}, '{$Referer}', '{$_SESSION["info"]['browser']['engine']}', '{$_SESSION["info"]['browser']['platform']}', '{$_SESSION["info"]['browser']['name']}')");
				}
            }
        } else if (isset($_COOKIE['udata'])) {
            parse_str($_COOKIE['udata'], $_COOKIE['udata']);
            $_COOKIE['udata'] = $this->MySQL('EscapeArray', $_COOKIE['udata']);

            $sql = $this->MySQL('Query', "SELECT Hash FROM `users` WHERE id = '{$_COOKIE['udata']['id']}'");
            $ResultSet = $sql->fetch_object();

            if ($ResultSet != null) {
                if ($_COOKIE['udata']['token'] == md5($ResultSet->Hash)) {
                    $this->AuthenticateUser($ResultSet->Hash);                                
                }
            }
        }
        
        $this->assign('UserData', $this->getLoginData(), true);
        $this->ContentMS();
    }
	
    /* Initializes user sessions and validates session name (to prevent client attack) */ 
    function InitializeSessions() {
        if (isset($_COOKIE[session_name()])) $sessid = $_COOKIE[session_name()];
        else if (isset($_GET[session_name()])) $sessid = $_GET[session_name()];
		else {
            session_start();
            return false;
        }

        if (!preg_match('/^[a-zA-Z0-9,\-]{22,40}$/', $sessid)) {
            return false;
        }
		
        session_start();
        return true;
    }
    
    /* Completely destroys user sessions  */ 
    function DestroySessions() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    }

    function sortItems($a, $b) { return strcmp($a->Type, $b->Type); }
    function getUserInventory($Id) {
        $EquippedItems = array();
        $EquippedItems['ba'] = new stdClass();
        $EquippedItems['ba']->Name = null;
        $EquippedItems['ba']->File = 'none';
        $EquippedItems['ba']->Link = 'none';
        $EquippedItems['pe'] = new stdClass();
        $EquippedItems['pe']->Name = null;
        $EquippedItems['pe']->File = 'none';
        $EquippedItems['pe']->Link = 'none';
        $EquippedItems['he'] = new stdClass();
        $EquippedItems['he']->Name = null;
        $EquippedItems['he']->File = 'none';
        $EquippedItems['he']->Link = 'none';
        $EquippedItems['co'] = new stdClass();
        $EquippedItems['co']->Name = null;
        $EquippedItems['co']->File = 'none';
        $EquippedItems['co']->Link = 'none';
        $EquippedItems['ar'] = new stdClass();
        $EquippedItems['ar']->Name = null;
        $EquippedItems['ar']->File = 'none';
        $EquippedItems['ar']->Link = 'none';
        $EquippedItems['ar']->UserQty = 0;
		
        $EquippedItems['Weapon'] = new stdClass();
        $EquippedItems['Weapon']->Name = null;
        $EquippedItems['Weapon']->File = 'none';
        $EquippedItems['Weapon']->Link = 'none';
        $EquippedItems['Weapon']->Type = 'none';
        
        $FlashVars = null;
        $Weapons = array();
        $Armors = array();
        $Classes = array();
        $Houses = array();
        $Items = $this->MySQL('Query', "SELECT ItemID, Equipped, Quantity FROM users_items WHERE UserID = {$Id} AND Bank = 0");   
        
        while ($Item = $Items->fetch_object()) {
            $ItemObj = $this->getItemObject($Item->ItemID);
            $ItemObj->Highlight = $ItemObj->Coins > 0 ? 'acItem' : ($ItemObj->Upgrade ? 'memItem' : null);             
            $ItemObj->UserQty = $Item->Quantity;
            if ($Item->Equipped > 0) $EquippedItems[$ItemObj->Equipment] = $ItemObj; 
            switch ($ItemObj->Type) {
                case 'ServerUse': 
                case 'Enhancement': 
                case 'Note': 
                case 'Item': 
                    continue;
                case 'Armor':
                    array_push($Armors, $ItemObj);
                    break;
                case 'Class':
                    for ($a = 1; $a < 10; $a++) {
                        $rankExp = pow(($a + 1), 3) * 100;
						$arrRanks[$a] = $a > 1 ? ($rankExp + $arrRanks[($a - 1)]) : ($rankExp + 100);
                    }
            
                    for ($i = 1; $i < 10; $i++) {
                        if ($arrRanks[$i] >= $ItemObj->UserQty) {
                            if ($ItemObj->UserQty >= 302500) {
 							    $ItemObj->Rank = 10;
								break;
							} else 
							    $ItemObj->Rank = $i;
								break;
                        }
					}

                    array_push($Classes, $ItemObj);
                    break;
                case 'House':
                case 'Wall Item':
                case 'Floor Item':
                    array_push($Houses, $ItemObj);
                    break;
                default:
                    array_push($Weapons, $ItemObj);
            }
        }

		# Some users might not have any classes equipped
		if (isset($EquippedItems['ar'])) {
            $EquippedItems['ar']->Link = isset($EquippedItems['co']->Link) && strcmp($EquippedItems['co']->File, 'none') != 0 ? $EquippedItems['co']->Link : $EquippedItems['ar']->Link;
            $EquippedItems['ar']->File = isset($EquippedItems['co']->File) && strcmp($EquippedItems['co']->File, 'none') != 0 ? $EquippedItems['co']->File : $EquippedItems['ar']->File;
        }
		
        @usort($Weapons, function ($a, $b) { return strcmp($a->Type, $b->Type); });
        @usort($Houses, function ($a, $b) { return strcmp($a->Type, $b->Type); });
        @usort($Armors, function ($a, $b) { return strcmp($a->Type, $b->Type); });
        @usort($Classes, function ($a, $b) { return strcmp($a->Type, $b->Type); });
        
        return array('HTMLInven' => null,        
        'EquippedItems' => $EquippedItems,        
        'Weapons' => $Weapons,        
        'Houses' => $Houses,     
        'Armors' => $Armors,   
        'Classes' => $Classes,   
        'FlashVars' => "&strClassName={$EquippedItems['ar']->Name}&strClassFile={$EquippedItems['ar']->File}&strClassLink={$EquippedItems['ar']->Link}&strArmorName={$EquippedItems['co']->Name}&strWeaponFile={$EquippedItems['Weapon']->File}&strWeaponLink={$EquippedItems['Weapon']->Link}&strWeaponType={$EquippedItems['Weapon']->Type}&strWeaponName={$EquippedItems['Weapon']->Name}&strCapeFile={$EquippedItems['ba']->File}&strCapeLink={$EquippedItems['ba']->Link}&strCapeName={$EquippedItems['ba']->Name}&strHelmFile={$EquippedItems['he']->File}&strHelmLink={$EquippedItems['he']->Link}&strHelmName={$EquippedItems['he']->Name}&strPetFile={$EquippedItems['pe']->File}&strPetLink={$EquippedItems['pe']->Link}&strPetName={$EquippedItems['pe']->Name}&bgindex=0");
    }
    
    /* Initializes user achievements (often used for charpages)
     *
     * @param $user: User Data;
     * @returns array list of achievements;
     */     
    function getUserAcheivements($user) {
        $Achievements = array();
        $DateTime = new DateTime('2011-05-23 21:02:33');
        $Interval = $DateTime->diff(new DateTime($user->DateCreated));
        $BetaDays = $Interval->format('%R%a');
        $Query = $this->MySQL('Query', 'SELECT id FROM `users` WHERE Access < 40 AND Access > 0 ORDER BY `Level` DESC, `KillCount` DESC, `DeathCount` ASC, `Exp` DESC LIMIT 1');
        $UserObj = $Query->fetch_object();
    
        $Query = $this->MySQL('Query', "SELECT Rank FROM `users_guilds` WHERE userid={$user->id}");
        $Guild = $Query->fetch_object();
    
        if (($BetaDays >= 0 && $BetaDays <= 30) && $user->Upgraded > -1) {
            $Achv = new stdClass();
            $Achv->Title = 'Founder';
            $Achv->Description = 'Awarded to those who became an upgraded Member within the first month of HiddenProject\'s release!';
            $Achv->Icon = 'certificate';
            array_push($Achievements, $Achv);
        }
    
        if ($BetaDays >= 0 && $BetaDays <= 30) {
            $Achv = new stdClass();
            $Achv->Title = 'Beta Character';
            $Achv->Description = 'Awarded to those who created an account during our Beta release!';
            $Achv->Icon = 'ax';
            array_push($Achievements, $Achv);
        }

        if ($UserObj->id == $user->id) {
            $Achv = new stdClass();
            $Achv->Title = 'The Beater';
            $Achv->Description = 'Awarded to who currently sits on the King\'s Throne.';
            $Achv->Icon = 'skull';
            array_push($Achievements, $Achv);
        }

        if ($user->Access == 4) {
            $Achv = new stdClass();
            $Achv->Title = 'The Ambassador';
            $Achv->Description = 'Given to those volunteers who willingly to devote him self to HiddenProject and specialize in helping players, new and old with any questions or problems they may have.';
            $Achv->Icon = 'shield';
            array_push($Achievements, $Achv);
        }
        
        if ($user->Upgraded > 0) {
            $Achv = new stdClass();
            $Achv->Title = 'VIP Member';
            $Achv->Description = 'Awarded to those who have upgraded their accounts.';
            $Achv->Icon = 'certificate';
            array_push($Achievements, $Achv);
        }
        
        if ($user->Access >= 40) {
            $Achv = new stdClass();
            $Achv->Title = 'Staff Member';
            $Achv->Description = 'Bunches of cool guys.';
            $Achv->Icon = 'old_man';
            array_push($Achievements, $Achv);
        }

        if ($user->Access >= 40) {
            $Achv = new stdClass();
            $Achv->Title = 'Millionaire';
            $Achv->Description = 'Awarded to any player with more than 1,000,000 Gold.';
            $Achv->Icon = 'credit';
            array_push($Achievements, $Achv);
        }
        
        if ($user->DeathCount > $user->KillCount) {
            $Achv = new stdClass();
            $Achv->Title = 'N00b';
            $Achv->Description = 'Losers with high amount of deaths.';
            $Achv->Icon = 'thumbs_down';
            array_push($Achievements, $Achv);
        }

        if ($Query->num_rows > 0 && $Guild->Rank >= 3) {
            $Achv = new stdClass();
            $Achv->Title = 'Guild Master';
            $Achv->Description = '';
            $Achv->Icon = 'group';
            array_push($Achievements, $Achv);
        }
        
        if (!empty($user->HouseInfo)) {
            $Achv = new stdClass();
            $Achv->Title = 'Architect';
            $Achv->Description = "Built a house. Come visit /house {$user->Name}";
            $Achv->Icon = 'bank';
            array_push($Achievements, $Achv);
        }
        
        return $Achievements;
    }
	
    /* Exports user variables (often used for charpages)
     *
     * @param $id: User ID;
     * @returns flashvars;
     */        
    function getUserFlashVars($id) {
        $UserData = $this->getUserObject($id);    
                
        $ResultSet = $this->MySQL('Query', "SELECT File, Name FROM `hairs` WHERE id = {$UserData->HairID}");
        $HairData = $ResultSet->fetch_object();
        $GuildData = new stdClass;
        $GuildData->Name = null;
        
        $ResultSet = $this->MySQL('Query', "SELECT GuildID FROM `users_guilds` WHERE UserID = {$UserData->id}");
        if ($ResultSet->num_rows > 0) {
            $UserGuild = $ResultSet->fetch_object();
            $ResultSet = $this->MySQL('Query', "SELECT Name FROM `guilds` WHERE id = {$UserGuild->GuildID}");
            $GuildData = $ResultSet->fetch_object();
        }
        
        $ColorHair = hexdec($UserData->ColorHair);
        $ColorSkin = hexdec($UserData->ColorSkin);
        $ColorEye = hexdec($UserData->ColorEye);
        $ColorTrim = hexdec($UserData->ColorTrim);
        $ColorBase = hexdec($UserData->ColorBase);
        $ColorAccessory = hexdec($UserData->ColorAccessory);

        $CharacterData = "&intAccessLevel={$UserData->Access}&intColorHair={$ColorHair}&intColorSkin={$ColorSkin}&intColorEye={$ColorEye}&intColorTrim={$ColorTrim}&intColorBase={$ColorBase}&intColorAccessory={$ColorAccessory}&ia1=0&strGender={$UserData->Gender}&strHairFile={$HairData->File}&strHairName={$HairData->Name}&strName={$UserData->Name}&intLevel={$UserData->Level}&strGuildName={$GuildData->Name}";
        return $CharacterData;
    }
    
    /* Calculates and retrieve user stats and progress as an array
     *
     * @param $user: User Data;
     * @returns array;
     */   
    function calculateStats($user = null) {
        $user = $user == null ? $this->UserData : $user;
        $UserExp = $user->Exp / $this->calculateLevel($user->Level, 100);
        $UserExpMax = $user->Level >= 60 ? true : ($user->Exp > $this->calculateLevel($user->Level, 100) ? true : false);
        $ClassPoints = $user->Inventory['EquippedItems']['ar']->UserQty > 302500 ? 302500 : $user->Inventory['EquippedItems']['ar']->UserQty;        
        return array
           ('ExpPercentage' => $UserExpMax ? 100 : round($UserExp * 100, 2),
            'ExpWidth' => $UserExpMax ? 300 : round($UserExp * 300, 2),
            'CPPercentage' => round(($ClassPoints / 302500) * 100, 2),
            'CPWidth' => round(($ClassPoints / 302500) * 300, 2));
    }
    
    /* Calculates user level based on server formula (mext v3)
     *
     * @param $x: level;
     * @param $y: max level;
     * @returns result;
     */          
    function calculateLevel($x, $y) {
        if ($x < $y) {        
            $base = 1000;
            $delta = 850000;
            $curve = (double) 1.66;

            if ($x < 1) {
                $x = 1;
            }
                    
            if ($x > $y) {
                $x = $y;
            }

            $x = ((double) ($x - 1) / ($y - 1));    
            $x = $base + pow($x, $curve) * $delta;
            for ($i = 0; $i < 9 && $x % 10 != 0; $i++) $x++;            
            return (int) $x;
        }
                
        return 200000000;
    }
    
    function sendVerification($user) {
        $token = $this->encryptPassword($user->Email, $user->Name);      
        $message = array();
        $message[] = "You've entered {$user->Email} as the contact email address for your account. To complete the process, 
        we just need to verify that this email address belongs to you. In order to help maintain the security of your account, please verify your email address by clicking the following link:";
        $message[] = "<!------------------------------------------------------------------------------------------------------->";
        $message[] = "<a href='http://{$_SERVER['HTTP_HOST']}/verification.php?token={$token}&id={$user->id}'>http://{$_SERVER['HTTP_HOST']}/verification.php?token={$token}&id={$user->id}</a><br /><br />";        
        $message[] = 'Your email address will be used to assist you in changing your account credentials or regaining access to your account, should you ever need help with those things.';
        $message[] = '<!------------------------------------------------------------------------------------------------------->';
        $message[] = 'Please contact us if our assistance is needed.';
        $message[] = 'HiddenProject Customer Support: '.Configuration::getPublic('Email');
        $message[] = '<!------------------------------------------------------------------------------------------------------->';
        $message[] = 'Thanks for helping us maintain the security of your account.';    
        $this->sendEmail($user->Email, 'Email Verification Link', implode("<br />", $message), $user->Name);
    }
    
    /* Password encryption
     *
     * @param $x: Username;
     * @param $y: Password;
     * @returns password hash
     */     
    function encryptPassword($x, $y) {
         return strrev(strtoupper(substr(hash('sha512', $y . strtolower($x)), strlen($x), 17))); 
    }

	function redirectToRoot() { header('Location: '.Configuration::getPublic('RootPath')); exit(); }
    function requireAdmin() { $this->requireLogin(); if ($this->UserData->Access < 40) $this->redirectToRoot(); }
    function requireLogin() { if (!$this->UserData->Login) $this->redirectToRoot(); }
    function generatePassword() {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        $password = null;
            
        for ($i = 0, $result = ''; $i < 8; $i++) {
            $index = rand(0, $count - 1);
            $password .= mb_substr($chars, $index, 1);
        }
        
        return $password;
    }
    
    /* Handles user login request
     *
     * @param $param: Username / Encrypted Password;
     * @param $param2: (Optional) Unecrypted Password;
     * @param $remember (boolean) Set user cookies for future use, default is false;
     * @returns (boolean) true if success, false otherwise;
     */     
    function AuthenticateUser($param, $param2 = null, $remember = false) {
        $UserToken = null;
        if (isset($param2)) {
            $UserToken = $this->encryptPassword($param, $param2);
        } else $UserToken = strtoupper($param);
        $UserData = $this->getUserObject($UserToken, true);
        if ($UserData !== NULL) {
            $this->UserData = $UserData;
            $this->UserData->Login = true;
            $this->UserData->Country = $this->UserData->Country == 'xx' ? $this->getCountryCode() : $this->UserData->Country;
            $this->UserData->Address = $this->getRemoteAddress();
            $this->UserData->Location = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $this->UserData->Referer = isset($_SERVER['HTTP_REFERER']) ? ($_SERVER['HTTP_REFERER'] != $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ? $_SERVER["HTTP_REFERER"] : null) : null;
            $this->UserData->Inventory = $this->getUserInventory($this->UserData->id);
            $this->UserData->FlashVars = $this->getUserFlashVars($this->UserData->id) . $this->UserData->Inventory['FlashVars'];
            $_SESSION['udata'] = $this->UserData;
            setcookie('udata', "id={$this->UserData->id}&token=" . md5($this->UserData->Hash), $remember ? time() + 31536000 : false, '/', $_SERVER['SERVER_NAME']);
        } else {
            $this->DestroySessions();
            $this->UserData->Login = false;
            unset($_COOKIE['udata']);
            setcookie('udata', null, -1, '/');
        }
        
        return $this->UserData->Login;
    }
    
    function getRemoteAddress() {
        //return trim(isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
        return $_SERVER['REMOTE_ADDR'];
    }

    /* Retrieve User Object
     *
     * @param $Id: User Id
     */     
    function getUserObject($Id, $token = false) {
        $ResultSet = $this->MySQL('Query', "SELECT * FROM `users` WHERE ".($token ? 'Hash' : 'id')." = '$Id'");
        return $ResultSet->num_rows > 0 ?  $ResultSet->fetch_object() : null;
    }
    
    /* Retrieve User Object by Name
     *
     * @param $Id: User Name
     */     
    function getUserObjectByName($Id) {
	    # For security reason, we need to get live user data information directly from the database
        // if ($this->UserData->Name == $Id) return $this->UserData;
        $ResultSet = $this->MySQL('Query', "SELECT * FROM `users` WHERE Name = '$Id'");
        return $ResultSet->num_rows > 0 ?  $ResultSet->fetch_object() : null;
    }
    
    /* Retrieve Item Object
     *
     * @param $Id: Item Id
     */     
    function getItemObject($Id) {
        if (isset($this->World->Items[$Id]))
            return (object) $this->World->Items[$Id];
        else {
            $ResultSet = $this->MySQL('Query', "SELECT * FROM `items` WHERE id={$Id}");
            return $ResultSet->num_rows > 0 ? $ResultSet->fetch_object() : null;
        }
    }
    
    function getLoginData() {
        $UserData = new stdClass();
        foreach ($this->UserData as $key => $value) $UserData->{$key} = is_bool($value) && !is_int($value) ? ($value ? 'true' : 'false'): $this->UserData->{$key}; 
        return $UserData;        
    }
    
    function getCountryCode() {
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$this->UserData->Address}"));
        return $ip_data && $ip_data->geoplugin_countryCode != null ? $ip_data->geoplugin_countryCode : 'xx';
    }
    
    function sendEmail($to, $subject, $message, $name, $cc = null) {
        $Handler = new Handler();
        $Handler->assign('Template', 'email');
        $Handler->setTemplateDir('./templates/email/');
        $Handler->assign('Content', $message, true);
        $Handler->assign('Name', $name, true);
        Configuration::setPublic('Template', 'email');

        require_once 'classes/class.phpmailer/PHPMailerAutoload.php';

        $mail = new PHPMailer(true);        
        $mail->isSMTP();
        $mail->SMTPAuth = true;    
        $mail->SMTPDebug = Configuration::getProtected('SMTPDebug');
        $mail->Host = Configuration::getProtected('SMTPHost');
        $mail->Port = Configuration::getProtected('SMTPPort');
        $mail->SMTPSecure = Configuration::getProtected('SMTPSecure');
        $mail->Username = Configuration::getProtected('SMTPUser');
        $mail->Password = Configuration::getProtected('SMTPPass');
        /*$mail->isSMTP();
        $mail->SMTPDebug = true;
        $mail->Host = '94.155.46.50';
        $mail->Port = 25;
        $mail->SMTPAuth = false;  */
		
        $mail->Subject = $subject;
        $mail->SetFrom("team@{$_SERVER['HTTP_HOST']}", Configuration::getPublic('Name')); 
        $mail->addAddress($to);
        $mail->addReplyTo(Configuration::getPublic('Email'));
        if (!is_null($cc)) $mail->addCC($cc); 

        $mail->IsHTML(true);
        $mail->ContentType = 'text/html'; 
        $mail->CharSet = 'utf-8';
        $mail->WordWrap = 80;
        $mail->Body = $Handler->fetch('template.default.html');
        if (!$mail->send()) {  echo 'Not sent: <pre>'.print_r(error_get_last(), true).'</pre>'; }
    }
    
    /* Processes user payment
     *
     * @param $type is type of payment (PayPal or PayGol)
     * @param $data is data sent by the provider
     */     
    function processPayment($type, $data) {
        $UpgDaysLeft = null;
        $serviceid = null;
        $transId = null;
        $itemname = null;
        $amount = 0;
        $quantity = 1;
        
        switch(strtoupper($type)) {
            case 'PAYPAL';
                $serviceid = $data['type'];
                $transId = $data['transaction'];
                $amount = $data['amount'];
                $quantity = empty($data['quantity']) ? 1 : $data['quantity'];
                break;
            case 'PAYGOL';
                $serviceid = $data['service_id'];
                $transId = $data['message_id'];
                $amount = $data['price'];
                break;
            default:
                $this->log("Unsupported type of payment: {$type}", 'Data recieved:\n' . addslashes(var_export($data, true)));
                exit(1);
        }
        
        # Check whether payment currency is correct or not
        if ($data['currency'] != 'USD' && strcasecmp($type, 'PayPal') == 0) $this->log("Unsupported payment currency: {$data['currency']}", 'Data recieved:\n' . addslashes(var_export($data, true)));
        
        $datetime1 = new DateTime(date("F j, Y, g:i a"));
        $datetime2 = new DateTime($this->UserData->UpgradeExpire);
        $interval = $datetime1->diff($datetime2);
        $UpgDaysLeft = $interval->format('%R%a');
        $UpgStart = ($UpgDaysLeft < 0 ? 'NOW()' : 'UpgradeExpire');

        switch (strtoupper($serviceid)) {
            # BASIC VIP MEMBERSHIP
            case 'VIP499':
            case 68121:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 4.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = 'Basic VIP Membership';
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(5000*{$quantity}),SlotsBag=SlotsBag+(10*{$quantity}),SlotsHouse=SlotsHouse+(10*{$quantity}),ActivationFlag=5,UpgradeExpire=DATE_ADD({$UpgStart}, INTERVAL (7*{$quantity}) DAY) WHERE id={$this->UserData->id}");
                break;
            # STANDARD VIP MEMBERSHIP
            case 'VIP999':
            case 68122:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 9.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = 'Standard VIP Membership';               
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(10000*{$quantity}),SlotsBag=SlotsBag+15,SlotsHouse=SlotsHouse+10,ActivationFlag=5,UpgradeExpire=DATE_ADD({$UpgStart}, INTERVAL 3 WEEK) WHERE id={$this->UserData->id}");
                break;
            # PREMIUM VIP MEMBERSHIP
            case 'VIP1499':
            case 68123:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 14.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = 'Premium VIP Membership';
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(15000*{$quantity}),SlotsBag=SlotsBag+(25*{$quantity}),SlotsHouse=SlotsHouse+(15*{$quantity}),ActivationFlag=5,UpgradeExpire=DATE_ADD({$UpgStart}, INTERVAL (1*{$quantity}) MONTH) WHERE id={$this->UserData->id}");
                break;
            # ULTIMATE VIP MEMBERSHIP
            case 'VIP1999':
            case 68124:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 19.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = 'Ultimate VIP Membership';
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(25000*{$quantity}),SlotsBag=SlotsBag+(35*{$quantity}),SlotsHouse=SlotsHouse+(20*{$quantity}),ActivationFlag=5,UpgradeExpire=DATE_ADD({$UpgStart}, INTERVAL (2*{$quantity}) MONTH) WHERE id={$this->UserData->id}");
                break;
            # 3000 ACs
            case 'AC299':
            case 70636:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 2.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = '3,000 AdventureCoins';
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(3000*{$quantity}) WHERE id={$this->UserData->id}");
                break;
            # 7000 ACs
            case 'AC499':
            case 70637:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 4.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = '7,000 AdventureCoins';
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(7000*{$quantity}) WHERE id={$this->UserData->id}");
                break;
            # 15000 ACs
            case 'AC999':
            case 70638:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 9.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = '15,000 AdventureCoins';
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(15000*{$quantity}) WHERE id={$this->UserData->id}");
                break;
            # 35000 ACs
            case 'AC1999':
            case 70639:
                if (strcasecmp($type, 'PayPal') == 0 && $amount < 19.99) {
                      $this->log("Attempted illegal input", 'Amount of transaction does not match. Data recieved:\n' . addslashes(var_export($data, true)));
                    exit(1);
                }
                
                $itemname = '35,000 AdventureCoins';               
                $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(35000*{$quantity}) WHERE id={$this->UserData->id}");
                break;
            default:
                $this->log("Unknown service id: {$serviceid}", 'Data recieved:\n' . addslashes(var_export($data, true)));
                exit(1);
        }
		
        if (strcasecmp($data['bonus'], 'Yes') == 0) {
            $itemname .= ' + 5,000 AdventureCoins';
            $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+5000 WHERE id={$this->UserData->id}");
        }
		
		
        if ($this->MySQL('FetchObject', "SELECT COUNT(*) AS 'PurchaseCount' FROM users_purchases WHERE userid={$this->UserData->id}")->PurchaseCount <= 0) {
		    $this->MySQL('Query', "UPDATE `users` SET Coins=Coins+(2000*{$quantity}) WHERE id={$this->UserData->id}");
		}

        $total = number_format($quantity * $amount);                
        $amount = number_format($amount);
                
        $message = array();
        $message[] = "We have confirmed your payment and processed the following order.";        
        $message[] = "<!-------------------------------------------------------------->";        
        $message[] = "Character ID: {$this->UserData->id}";            
        $message[] = "Transaction ID: {$transId}";            
        $message[] = "{$itemname}";        
        $message[] = "Unit price {$amount} {$data['currency']} x {$quantity} unit(s) = {$total} {$data['currency']}";
        $message[] = "<!-------------------------------------------------------------->";            
        $message[] = "Payment Method: {$type}";        
        $message[] = "Total: ".($quantity * $amount)." {$data['currency']}";        
        $message[] = "<!-------------------------------------------------------------->";    
        $message[] = 'Please reply to '.Configuration::getPublic('Email').' if you have any questions.';
        $this->sendEmail($this->UserData->Email, 'Payment Acknowledgment', implode("<br />", $message), $this->UserData->Name, Configuration::getPublic('Email'));
        $this->MySQL('Query', "INSERT INTO  `users_purchases` (UserID, Reference, Item, Method, Date) VALUES ({$this->UserData->id}, '{$transId}', '{$serviceid}', '{$type}', NOW());");
    }
    
    function log($violation, $details) {
        $this->MySQL('Query', "INSERT INTO  `users_logs` (UserID, Violation, Details) VALUES ({$this->UserData->id}, '{$violation}', '{$details}');");
    }    
    
    function utf8_encode_deep(&$input) {
        if (is_string($input)) {
            $input = utf8_encode($input);
        } else if (is_array($input)) {
            foreach ($input as &$value) {
                $this->utf8_encode_deep($value);
            }
        
             unset($value);
        } else if (is_object($input)) {
             $vars = array_keys(get_object_vars($input));             
             foreach ($vars as $var) {
                 $this->utf8_encode_deep($input->$var);
             }
         }
     }

    /* Cache various game world objects
     *
     * @param $type: Type of object (Optional)
     */      
    function CacheObjects($type = null) {
        switch($type) {
            case 'Items':
                $Items = array();
                $Query = $this->MySQL('Query', 'SELECT * FROM `items`');
                while ($Item = $Query->fetch_object()) $Items[$Item->id] = $Item;
                
                # Converts items to UTF-8 to avoid JSON encode failures
                $this->utf8_encode_deep($Items);                
                file_put_contents(Configuration::getPublic('WorldItems'), json_encode($Items));        
                $this->World->Items = $Items;                
                break;
            case 'Settings':
                break;
            case 'Rates':
                break;
           default:
               $this->CacheObjects('Items');
        }
    }
    
    function LoadConfigurations(){
        $this->Settings = $this->Rates = array();
        $Query = $this->MySQL('Query', 'SELECT * FROM `settings_login`');
        while ($GameSettings = $Query->fetch_object()) $this->Settings[$GameSettings->name] = $GameSettings->value;
        $Query = $this->MySQL('Query', 'SELECT * FROM `settings_rates`');
        while ($GameSettings = $Query->fetch_object()) $this->Rates[$GameSettings->name] = $GameSettings->value;
    }
}
?>