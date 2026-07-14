<?php
require_once 'config.php';
require_once 'classes/class.smarty/Smarty.class.php';
require_once 'classes/class.content.php';
require_once 'classes/class.gamehandler.php';
require_once 'classes/class.data.php';

$Handler = new Handler();
$Handler->caching = false;
$_POST = $Handler->MySQL('EscapeArray', $_POST);
$XML = new SimpleXMLElement('<login></login>');
$DOM = new DOMDocument();

if (empty($_POST)) die('Invalid Request');
if (isset($_POST['token']) && strcasecmp($_POST['token'], session_id()) == 0 || ((isset($_POST['unm']) || isset($_POST['pwd'])) && $Handler->AuthenticateUser($_POST['unm'], $_POST['pwd']))) {
    $datetime1 = new DateTime(date('Y-m-d h:i:s'));
    $datetime2 = new DateTime($Handler->UserData->UpgradeExpire);
    $interval = $datetime1->diff($datetime2);
	
    $XML->addAttribute('bSuccess', '1');
    $XML->addAttribute('userid', $Handler->UserData->id);
    $XML->addAttribute('unm', $Handler->UserData->Name);
    $XML->addAttribute('iAccess', $Handler->UserData->Access);
    $XML->addAttribute('iUpg', $Handler->UserData->UpgradeDays >= 0 ? 1 : 0);
    $XML->addAttribute('iAge', $Handler->UserData->Age);
    $XML->addAttribute('sToken', $Handler->UserData->Hash);
    $XML->addAttribute('dUpgExp', preg_replace('/\s+/', 'T', $Handler->UserData->UpgradeExpire));
    $XML->addAttribute('iUpgDays', $Handler->UserData->UpgradeDays);
    $XML->addAttribute('iSendEmail', $Handler->UserData->ActivationFlag);
    $XML->addAttribute('strEmail', $Handler->UserData->Email);
    $XML->addAttribute('bCCOnly', '0');
    $XML->addAttribute('strCountryCode', $Handler->UserData->Country);            
				
    $DOM->loadXML($XML->asXML());
    $DOM->getElementsByTagName('login');
    $DOC = $DOM->getElementsByTagName('login');
    foreach ($DOC as $ELEMENT) {
        if ($ELEMENT->getAttribute('bSuccess') == 1) {
		    $_SERVER['REMOTE_ADDR'] = $Handler->MySQL('EscapeString', $_SERVER['REMOTE_ADDR']);
            $Handler->MySQL('Query', "UPDATE `users`  SET Country = '{$Handler->UserData->Country}', LastLogin = NOW(), webLogin=1, Address='{$_SERVER['REMOTE_ADDR']}' WHERE id={$Handler->UserData->id}");    
            $ServerList = $Handler->MySQL('Query', "SELECT * FROM `servers`");
            while ($server = $ServerList->fetch_assoc()) {
                $child = $XML->addChild('servers');
                $child->addAttribute('sName', $server['Name']);
                $child->addAttribute('sIP', $server['IP']);
                $child->addAttribute('iPort', 5588);
                $child->addAttribute('iCount', $server['Count']);
                $child->addAttribute('iMax', $server['Count'] >= $server['Max'] ? -1 : $server['Max']);
                $child->addAttribute('bOnline', $server['Online']);
                $child->addAttribute('iChat', $server['Chat']);
                $child->addAttribute('bUpg', $server['Upgrade']);
                $child->addAttribute('sLang', 'xx');
				}
            }
        }
    } else {
    $XML->addAttribute('bSuccess', '0');
    $XML->addAttribute('sMsg', isset($_POST['token']) ? 'Sorry! We\'ve had a problem keeping you logged in. Please clear your cookies, close your browser, and try again to log in. Thanks.' : 'The username and password you entered did not match. Please check the spelling and try again.');
}

$XMLDOM = dom_import_simplexml($XML);
$XMLString = $XMLDOM->ownerDocument->saveXML($XMLDOM->ownerDocument->documentElement);

header("Content-Type: text/xml");
print $XMLString; exit();
?>