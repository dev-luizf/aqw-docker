<?php
class ContentMS extends Smarty {
    public $DB, $TotalQueries, $Variables, $Output, $Smarty;
    
    function ContentMS() {
        date_default_timezone_set(Configuration::getPublic('TimeZone'));

		parent::__construct();
        parent::setTemplateDir('./templates/'.Configuration::getPublic('Template').'/');
        parent::setCompileDir('./compiles/');
        parent::setCacheDir('./caches/');
		
		switch (Configuration::getPublic('CacheMode')) {
		    case 0:
                $this->caching = false;
				$this->force_compile = true;
			    break;
		    case 1:
                $this->caching = true;
                $this->cache_lifetime = 120;   
			    break;
		}

        $this->assign('Root', Configuration::getPublic('RootPath'));
        $this->assign('Title', Configuration::getPublic('Name'));
        $this->assign('Description', Configuration::getPublic('Description'));
        $this->assign('FacebookId', Configuration::getPublic('FacebookId'));
        $this->assign('Company', Configuration::getPublic('Company'));
        $this->assign('Template', Configuration::getPublic('Template'));
        $this->assign('PayPal', Configuration::getPublic('PayPal'));
        $this->assign('Location', Configuration::getPublic('Location'));
        $this->assign('Phone', Configuration::getPublic('Phone'));
        $this->assign('Email', Configuration::getPublic('Email'));
        $this->assign('Domain', $_SERVER['HTTP_HOST']);
        
        switch(Configuration::getPublic('ErrorReporting')) {
            case 0: error_reporting(0); break; 
            case 1: error_reporting(E_ERROR | E_WARNING | E_PARSE); break; 
            case 2: error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); break; 
            case 3: error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); break; 
            case 4: error_reporting(E_ALL ^ E_NOTICE); break; 
            case 5: error_reporting(E_ALL); break; 
            default: error_reporting(E_ALL); 
        }
    }
	
    /*
     * Handles database data transactions 
     *
     * @param type: Type of method (Query, Prepare, EscapeString, Close)
     * @param param: Data variable
     */
    public function MySQL($type, $param = null) {
        if (!isset($this->DB)) {
		    $MySQLHost = Configuration::getProtected('MySQLHost');
		    if (Configuration::getPublic('Persistency')) $MySQLHost = "p:{$MySQLHost}";
            $this->DB = new mysqli
            ($MySQLHost, 
             Configuration::getProtected('MySQLUser'), 
             Configuration::getProtected('MySQLPass'), 
             Configuration::getProtected('MySQLData'), 
             Configuration::getProtected('MySQLPort'));
			 if (mysqli_connect_error()) $this->SystemExit('Cannot connect to MySQL Database', __LINE__, __FILE__);     
        }
        
        switch (strtolower($type)) {
            case 'query':
                if ($Query = $this->DB->query($param)) {
                    $this->TotalQueries++;
                    return $Query;
                } else $this->SystemExit($this->DB->error . "\nParameters: " . var_export($param, true), __LINE__, __FILE__);                
                break;
            case 'prepare':
                if ($Query = $this->DB->prepare($param)) {
                    $this->TotalQueries++;
                    return $Query;
                } else $this->SystemExit($this->DB->error . "\nParameters: " . var_export($param, true), __LINE__, __FILE__);                          
                break;
            case 'fetchobject':            
            case 'fetchobj':            
                if ($Query = $this->MySQL('Query', $param)) {
                    return $Query->fetch_object();
                } else $this->SystemExit($this->DB->error . "\nParameters: " . var_export($param, true), __LINE__, __FILE__);                          
                break;
            case 'escapestring':
			    if (empty($param)) return $param;
                if ($Escape = $this->DB->real_escape_string($param)) {
                    return $Escape;
                } else $this->SystemExit($this->DB->error . "\nParameters: " . var_export($param, true), __LINE__, __FILE__);                    
                break;
            case 'escapearray':    
                foreach ($param as $key => $value) $param[$key] = $this->MySQL('EscapeString', $value);
				return $param;
                break;
            case 'close':
                $this->DB->close();
                break;			
			default:
			    $this->SystemExit('Unknown mysql command type ' . $type, __LINE__, __FILE__);   
        }
    }

    public function plain($text) {
        Header('Content-type: text/plain');
		print $text; exit();	
    }
	
    public function ApplyVariables($repeat = true) {
        foreach($this->Variables as $key => $one) {
            if (is_object($one) || strpos($key, '%') !== false) unset($this->Variables[$key]); 
        }
        
        $this->Output = empty($this->Variables) ? $this->Output : str_replace(array_keys($this->Variables), array_values($this->Variables), $this->Output);    
        $this->Variables = array_reverse($this->Variables, true);
        if ($repeat) $this->ApplyVariables(false);
    }
    
    /*
     * Terminates the script and print out error details
     *
     * @param text: Information regarding the error
     * @param line: Line where the error occurs in the script
     * @param file: File location of the error
     */
    public function SystemExit($text, $line, $file = null) {
        if (ob_get_level()) ob_end_clean();
		trigger_error("$text - ".date("F j, Y, g:i a")."\nLocation: $file ($line)",E_USER_ERROR);
    }
}
?>