<?php
require_once 'config.php';
require_once 'classes/class.smarty/Smarty.class.php';
require_once 'classes/class.content.php';
require_once 'classes/class.gamehandler.php';
require_once 'classes/class.data.php';

$Handler = new Handler();
$advdata = new DataHandler(null, 'test');

foreach($Handler->Settings as $key => $value) {
	$advdata->addData($key, $value);
}

$advdata->addData('status', 'miku');
$Handler->plain($advdata->ParseData());
?>