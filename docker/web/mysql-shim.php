<?php
/**
 * Minimal mysql_* → mysqli shim for PHP 7+ (Armagedom legacy CMS pages).
 * Inspired by dshafik/php7-mysql-shim.
 */
if (function_exists('mysql_connect')) {
    return;
}

// Constants formerly supplied by ext/mysql. Defining them keeps legacy default
// arguments and result-mode comparisons quiet on PHP 7+.
defined('MYSQL_ASSOC') || define('MYSQL_ASSOC', 1);
defined('MYSQL_NUM') || define('MYSQL_NUM', 2);
defined('MYSQL_BOTH') || define('MYSQL_BOTH', 3);

$GLOBALS['__mysql_shim_link'] = null;

function __mysql_shim_link($link = null)
{
    if ($link instanceof mysqli) {
        return $link;
    }
    if ($GLOBALS['__mysql_shim_link'] instanceof mysqli) {
        return $GLOBALS['__mysql_shim_link'];
    }
    return null;
}

function mysql_connect($host = null, $user = null, $pass = null, $new_link = false, $client_flags = 0)
{
    $host = $host !== null && $host !== '' ? $host : (getenv('MYSQL_HOST') ?: '127.0.0.1');
    $user = $user !== null ? $user : (getenv('MYSQL_USER') ?: 'root');
    $pass = $pass !== null ? $pass : (getenv('MYSQL_PASSWORD') !== false ? getenv('MYSQL_PASSWORD') : '');
    $port = 3306;
    if (strpos($host, ':') !== false) {
        list($host, $port) = explode(':', $host, 2);
        $port = (int) $port;
    }
    $envPort = getenv('MYSQL_PORT');
    if ($envPort) {
        $port = (int) $envPort;
    }
    $mysqli = mysqli_init();
    if (!$mysqli->real_connect($host, $user, $pass, null, $port)) {
        return false;
    }
    $GLOBALS['__mysql_shim_link'] = $mysqli;
    return $mysqli;
}

function mysql_pconnect($host = null, $user = null, $pass = null, $client_flags = 0)
{
    return mysql_connect($host, $user, $pass, false, $client_flags);
}

function mysql_select_db($database_name, $link = null)
{
    $link = __mysql_shim_link($link);
    if (!$link) {
        return false;
    }
    return $link->select_db($database_name);
}

function mysql_query($query, $link = null)
{
    $link = __mysql_shim_link($link);
    if (!$link) {
        return false;
    }
    return $link->query($query);
}

function mysql_fetch_array($result, $result_type = 3)
{
    if (!$result) {
        return false;
    }
    $type = MYSQLI_BOTH;
    if ($result_type === 1) {
        $type = MYSQLI_ASSOC;
    } elseif ($result_type === 2) {
        $type = MYSQLI_NUM;
    }
    return $result->fetch_array($type);
}

function mysql_fetch_assoc($result)
{
    return $result ? $result->fetch_assoc() : false;
}

function mysql_fetch_row($result)
{
    return $result ? $result->fetch_row() : false;
}

function mysql_fetch_object($result, $class_name = null, $params = null)
{
    if (!$result) {
        return false;
    }
    if ($class_name) {
        return $params ? $result->fetch_object($class_name, $params) : $result->fetch_object($class_name);
    }
    return $result->fetch_object();
}

function mysql_num_rows($result)
{
    return $result ? $result->num_rows : 0;
}

function mysql_affected_rows($link = null)
{
    $link = __mysql_shim_link($link);
    return $link ? $link->affected_rows : -1;
}

function mysql_insert_id($link = null)
{
    $link = __mysql_shim_link($link);
    return $link ? $link->insert_id : 0;
}

function mysql_real_escape_string($string, $link = null)
{
    $link = __mysql_shim_link($link);
    if (!$link) {
        return addslashes($string);
    }
    return $link->real_escape_string($string);
}

function mysql_escape_string($string)
{
    return mysql_real_escape_string($string);
}

function mysql_error($link = null)
{
    $link = __mysql_shim_link($link);
    return $link ? $link->error : mysqli_connect_error();
}

function mysql_errno($link = null)
{
    $link = __mysql_shim_link($link);
    return $link ? $link->errno : (int) mysqli_connect_errno();
}

function mysql_close($link = null)
{
    $link = __mysql_shim_link($link);
    if (!$link) {
        return false;
    }
    $ok = $link->close();
    if ($GLOBALS['__mysql_shim_link'] === $link) {
        $GLOBALS['__mysql_shim_link'] = null;
    }
    return $ok;
}

function mysql_free_result($result)
{
    if ($result instanceof mysqli_result) {
        $result->free();
        return true;
    }
    return false;
}

function mysql_num_fields($result)
{
    return $result ? $result->field_count : 0;
}

function mysql_result($result, $row, $field = 0)
{
    if (!$result) {
        return false;
    }
    $result->data_seek($row);
    $data = $result->fetch_array(MYSQLI_BOTH);
    return $data === null ? false : $data[$field];
}

if (!defined('MYSQL_ASSOC')) {
    define('MYSQL_ASSOC', 1);
}
if (!defined('MYSQL_NUM')) {
    define('MYSQL_NUM', 2);
}
if (!defined('MYSQL_BOTH')) {
    define('MYSQL_BOTH', 3);
}
