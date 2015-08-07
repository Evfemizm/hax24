<?php
/*
не знаю что это, поэтому пока закомментирую
spl_autoload_register(function ($class) {
    include APP_DIR.'/classes/' . $class . '.class.php';
});
*/

function esc($string){
	$string = mysql_real_escape_string($string);
	$string = trim($string);
	$string = strip_tags($string);
	return $string;
}

function t($templateName, $data=array()){
	ob_start();
	include(APP_DIR.'/templates/'.$templateName.'.php');
	return ob_get_clean();
}

function getCfg($key){
	global $config;
	if (isset($config[$key])){
		return $config[$key];
	} else {
		return NULL;
	}
}