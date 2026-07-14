<?php
class AdminPanel extends Handler {
    var $Facebook, $User, $Profile;
	
    function AdminPanel() {
	    //require_once '../classes/class.winuptime.php';
	    require_once '../classes/facebook.php';		
		
	    $this->Handler();
        $this->caching = false;
		$this->force_compile = true;
		$this->requireAdmin();
		$this->setTemplateDir('../templates/adminre/');
	    $this->assign('Uptime', gmdate("H", $this->MySQL('FetchObject', "SHOW GLOBAL STATUS LIKE 'Uptime'")->Value));
	    $this->assign('Usage', 100 - round(disk_free_space('/') / disk_total_space('/') * 100, 2));
		$this->assign('UserData', $this->getLoginData());
		
        $this->Facebook = new Facebook(array(
            'appId'  => Configuration::getProtected('FBAppId'),
            'secret' => Configuration::getProtected('FBAppSecret'),
			'cookie' => true,
			'fileUpload' => true
        ));
        
        if ($this->User = $this->Facebook->getUser()) {
            try { $this->Profile = $this->Facebook->api('/me'); }              
            catch (FacebookApiException $e) {
                error_log($e);
                $this->User = null;
            }
        } else Header('Location: '.$this->Facebook->getLoginUrl(array( 'scope' => 'publish_stream, publish_actions, manage_pages, photo_upload' )));
	}
	
	function getBreakpoint() {
		$Breakpoint = array();
		$sql = $this->MySQL('Query', "SELECT Browser, ROUND(SUM(100) / (SELECT COUNT(*) AS total FROM users_browser)) AS Percentage FROM users_browser GROUP BY Browser ORDER BY COUNT(*) DESC");
		while ($ResultSet = $sql->fetch_object()) {
    		$numbers = range(1, 5);
			shuffle($numbers);
			$ResultSet->Bar = implode(',', $numbers);
			$ResultSet->Engine = $this->MySQL('FetchObject', "SELECT Engine FROM users_browser WHERE Browser = '{$ResultSet->Browser}' LIMIT 1")->Engine;
    		array_push($Breakpoint, $ResultSet);
		}
		return $Breakpoint;
	}
}
