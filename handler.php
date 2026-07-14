<?php
require_once 'config.php';
require_once 'classes/class.smarty/Smarty.class.php';
require_once 'classes/class.content.php';
require_once 'classes/class.gamehandler.php';

$Handler = new Handler();
switch(key($_GET)) {
    case '403':
        $Handler->display('template.forbidden.html');
        break;
    case '404':
        $Handler->assign('Content', $Handler->fetch("string: {include file='template.notfound.html'}"));
        $Handler->display('template.default.html');
        break;
    case 'news':
        $Handler->setTemplateDir('templates/payge/');

		$News = array();
		$Article = new stdClass();
		$Article->Title = 'test';
		$Article->Author = 'Rin';
		$Article->Date = '31.03.2013';
		array_push($News, $Article);
		
		$Handler->assign('Title', 'Serverinfo');
        $Handler->assign('News', $News);
        $Handler->display('template.default.html');
        break;
    case 'disclaimer':       
        $Handler->assign('Content', $Handler->fetch("string: {include file='template.disclaimer.html'}"));
        $Handler->display('template.default.html');
        break;
    case 'register':       
		$Handler->assign('ServerDate', $Handler->MySQL('FetchObject', "SELECT CURDATE() AS ServerDate")->ServerDate);
		$Handler->assign('ServerTime', $Handler->MySQL('FetchObject', "SELECT CURTIME() AS ServerTime")->ServerTime);
		$Handler->assign('LimitExceeded', $Handler->MySQL('FetchObject', "SELECT COUNT(*) AS 'Limit' FROM users WHERE DateCreated >= CURDATE()")->Limit > Configuration::getPublic('RegistrationLimit'));
        $Handler->assign('Content', $Handler->fetch("string: {include file='template.registration.html'}"));
        $Handler->display('template.default.html');
        break;
    case 'gameboard':
        if (!(strpos($_SERVER['REQUEST_URI'], 'session') !== false)  
        && $Handler->UserData->Login
        && !isset($_GET['session'])
        && !isset($_GET['upgrade']) 
        && !isset($_GET['token'])) 
		{ header('Location: ?session='.strtoupper(session_id())); }		
		
		$CurrentMonth = 0;
		$ResultSet = $Handler->MySQL('Query', "SELECT Item FROM users_purchases WHERE MONTH(DATE) = MONTH(NOW())");
		while ($Purchase = $ResultSet->fetch_object()) {
		    switch (strtoupper($Purchase->Item)) {
                # BASIC VIP MEMBERSHIP
                case 'VIP499':
                case 68121:
				    $CurrentMonth += 4.99;
					break;
                # STANDARD VIP MEMBERSHIP
                case 'VIP999':
                case 68122:
				    $CurrentMonth += 9.99;
					break;
                # PREMIUM VIP MEMBERSHIP
                case 'VIP1499':
                case 68123:
				    $CurrentMonth += 14.99;
					break;
                # ULTIMATE VIP MEMBERSHIP
                case 'VIP1999':
                case 68124:
				    $CurrentMonth += 19.99;
					break;
                # 3000 ACs
                case 'AC299':
                case 70636:
				    $CurrentMonth += 2.99;
					break;
                # 7000 ACs
                case 'AC499':
                case 70637:
				    $CurrentMonth += 4.99;
					break;
                # 15000 ACs
                case 'AC999':
                case 70638:
				    $CurrentMonth += 9.99;
					break;
                # 35000 ACs
                case 'AC1999':
                case 70639:
				    $CurrentMonth += 19.99;
					break;
			}
		}
		
		$Handler->assign('TargetAmount', 176.5);
		$Handler->assign('CurrentMonth', $CurrentMonth);
        $Handler->setTemplateDir('templates/playnow/');
        $Handler->display('template.default.html');
        break;
    case 'termsofservice':
        $Handler->assign('Content', $Handler->fetch("string: {include file='template.tos.html'}"));
        $Handler->display('template.default.html');
        break;
    case 'newsboard':
        header('Location: http://www.facebook.com/'.Configuration::getPublic('FacebookId'));
        break;
    case 'bonus':
	    if (!isset($_POST['Package'])) header('Location: /upgrade');
        $Handler->requireLogin();
        $Handler->assign('Package', $_POST['Package'], true);
        $Handler->assign('Content', $Handler->fetch("string: {include file='template.askbonus.html'}"));
        $Handler->display('template.default.html');
        break;
    case 'upgrade':
        //$Handler->requireLogin();
        $Handler->assign('Content', $Handler->fetch("string: {include file='template.upgrade.html'}"));
        $Handler->display('template.default.html');
        break;
	case 'test':

        $Handler->setTemplateDir('templates/lunaria/');
        $Handler->display('template.default.html');
        break;
}

?>