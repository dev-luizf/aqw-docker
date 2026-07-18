<?php
/** POLICE LINE STARTS HERE, PLEASE DO NOT TOUCH - SENSTIIVE HANDLERS MAY CAUSE SERIOUS WREKT **/
class WarningException              extends ErrorException {}
class ParseException                extends ErrorException {}
class NoticeException               extends ErrorException {}
class CoreErrorException            extends ErrorException {}
class CoreWarningException          extends ErrorException {}
class CompileErrorException         extends ErrorException {}
class CompileWarningException       extends ErrorException {}
class UserErrorException            extends ErrorException {}
class UserWarningException          extends ErrorException {}
class UserNoticeException           extends ErrorException {}
class StrictException               extends ErrorException {}
class RecoverableErrorException     extends ErrorException {}
class DeprecatedException           extends ErrorException {}
class UserDeprecatedException       extends ErrorException {}

abstract class Configuration {
    static private $protected = array(); 
    static private $public = array();
    public static function getProtected($key) {return isset(self::$protected[$key]) ? self::$protected[$key] : null;}
    public static function getPublic($key) {return isset(self::$public[$key]) ? self::$public[$key] : null;}
    public static function setProtected($key,$value) {self::$protected[$key] = $value;}
    public static function setPublic($key,$value) {self::$public[$key] = $value;}
}

set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
{
	// Do not start output buffers or strip_tags here — that silently destroyed
	// Flash login XML (<login .../>) whenever a notice/warning fired first.
	if (0 === error_reporting()) {
		return false;
	}
	switch ($err_severity) {
		case E_ERROR:
			throw new ErrorException(trim($err_msg), 0, $err_severity, $err_file, $err_line);
		case E_PARSE:
			throw new ParseException(trim($err_msg), 0, $err_severity, $err_file, $err_line);
		case E_CORE_ERROR:
			throw new CoreErrorException(trim($err_msg), 0, $err_severity, $err_file, $err_line);
		case E_COMPILE_ERROR:
			throw new CompileErrorException(trim($err_msg), 0, $err_severity, $err_file, $err_line);
		case E_USER_ERROR:
			throw new UserErrorException(trim($err_msg), 0, $err_severity, $err_file, $err_line);
		case E_RECOVERABLE_ERROR:
			throw new RecoverableErrorException(trim($err_msg), 0, $err_severity, $err_file, $err_line);
		default:
			// Warnings/notices/deprecations: log-worthy but must not abort Flash endpoints.
			return false;
	}
});
# Database Configurations (override with MYSQL_* env vars in Docker)
Configuration::setProtected('MySQLHost', getenv('MYSQL_HOST') !== false && getenv('MYSQL_HOST') !== '' ? getenv('MYSQL_HOST') : '127.0.0.1');
Configuration::setProtected('MySQLUser', getenv('MYSQL_USER') !== false && getenv('MYSQL_USER') !== '' ? getenv('MYSQL_USER') : 'root');
Configuration::setProtected('MySQLPass', getenv('MYSQL_PASSWORD') !== false ? getenv('MYSQL_PASSWORD') : '');
Configuration::setProtected('MySQLData', getenv('MYSQL_DATABASE') !== false && getenv('MYSQL_DATABASE') !== '' ? getenv('MYSQL_DATABASE') : 'mextv3');
Configuration::setProtected('MySQLPort', (int) (getenv('MYSQL_PORT') !== false && getenv('MYSQL_PORT') !== '' ? getenv('MYSQL_PORT') : 3306));

# Mail Server
Configuration::setProtected('SMTPDebug', 0);
Configuration::setProtected('SMTPHost', 'smtp.gmail.com');
Configuration::setProtected('SMTPPort', 587);
Configuration::setProtected('SMTPSecure', 'tls');
Configuration::setProtected('SMTPUser', "");
Configuration::setProtected('SMTPPass', "");

# Email Activation 
# Account security purpose such as email verification, email change, and account recovery
# 0 - Disable
# 1 - Enable 
Configuration::setPublic('EmailActivation', 0);

# Registration limit
# Limits number of registration daily. Useful for SMTP server like google (Limits 500 email sends)
Configuration::setPublic('RegistrationLimit', 999999);

# Persistent MySQL Connections
# The idea behind persistent connections is that a connection between a client process and a database can be reused by a client process, 
# rather than being created and destroyed multiple times. This reduces the overhead of creating fresh connections every time one is required, 
# as unused connections are cached and ready to be reused.
Configuration::setPublic('Persistency', 1);

# Misc Settings (override with SITE_* / SERVER_* env vars in Docker)
Configuration::setPublic('Name', getenv('SITE_NAME') !== false && getenv('SITE_NAME') !== '' ? getenv('SITE_NAME') : 'Armagedom Worlds');
Configuration::setPublic('Company', getenv('SITE_COMPANY') !== false && getenv('SITE_COMPANY') !== '' ? getenv('SITE_COMPANY') : 'Armagedom Team');
Configuration::setPublic('Template', 'infinityarts');
Configuration::setPublic('Description', getenv('SITE_DESCRIPTION') !== false && getenv('SITE_DESCRIPTION') !== '' ? getenv('SITE_DESCRIPTION') : 'Simply the best AQW private server! We provide a lag free, top of the line gaming experience to the players.');
Configuration::setPublic('FacebookId', '1533387873585287');
Configuration::setPublic('FacebookAppId', '748519611890999');
Configuration::setPublic('FacebookSecret', '7e9689bbad6f1f932037a0501db7ab5c');
Configuration::setPublic('Location', 'Internet Worldwide');
Configuration::setPublic('TimeZone', getenv('TIMEZONE') !== false && getenv('TIMEZONE') !== '' ? getenv('TIMEZONE') : 'UTC');
Configuration::setPublic('Phone', '+91 20069658135');
Configuration::setPublic('Email', 'manav2511@gmail.com');
Configuration::setPublic('PayPal', 'manav2511@gmail.com');
Configuration::setPublic('RootPath', '/');

# Game Settings
Configuration::setPublic('CharacterFile', 'gamefiles/character3.swf');
Configuration::setPublic('RegistrationFile', 'gamefiles/newuser/HP-Landing-12.17.13-HP.A.swf');
Configuration::setPublic('GameLoader', getenv('GAME_LOADER') !== false && getenv('GAME_LOADER') !== '' ? getenv('GAME_LOADER') : '/gamefiles/loaders/loader.swf');
Configuration::setPublic('PublicGameIP', getenv('PUBLIC_GAME_IP') !== false && getenv('PUBLIC_GAME_IP') !== '' ? getenv('PUBLIC_GAME_IP') : '127.0.0.1');
Configuration::setPublic('GamePort', (int) (getenv('GAME_PORT') !== false && getenv('GAME_PORT') !== '' ? getenv('GAME_PORT') : 5588));
Configuration::setPublic('ServerName', getenv('SERVER_NAME') !== false && getenv('SERVER_NAME') !== '' ? getenv('SERVER_NAME') : 'Armagedom');

# PHP error reporting. Supported values are given below. 
# 0 - Turn off all error reporting 
# 1 - Running errors 
# 2 - Running errors + notices 
# 3 - All errors except notices and warnings 
# 4 - All errors except notices 
# 5 - All errors 
Configuration::setPublic('ErrorReporting', 3);

# Cache Mode
# 0 - Disable all content caching
# 1 - Default cache system (Smarty built-in Caching)
# 2 - WinCache system (Requires WinCache PHP extension)
Configuration::setPublic('CacheMode', 0);
ini_set('display_errors', 1);	

# Debug Mode
# true/false - Enables PayPal sandbox for debugging purposes and prevents user from making payments
Configuration::setPublic('DebugMode', 0);

# PayGol IP Address Check
# true/false - Checks for IP validation (refer to paygol.php), not recommended since PayGol IP changes often
Configuration::setPublic('RemoteCheck', 0);

# Location settings
Configuration::setPublic('WorldItems', 'configs/items.conf');
?>