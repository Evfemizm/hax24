<?php
//error_reporting(E_ALL);
include 'connect.php';
session_start();
$data = array();
$pageName = substr($_SERVER['REQUEST_URI'], 1);
$simbolNum = strpos($pageName, '?');
/*если в запросе есть get значение, то срезаем его*/
if ($simbolNum != 0){
	$pageName = substr($pageName, 0, $simbolNum);
}
/*если обратились к главной*/
if ($pageName == 'index' || $pageName == ''){
/*если юзверь авторизован, то отдаем ему страницу с его данными, иначе просим авторизоваться или зарегаться*/
	if(isAuth($link)){
	ob_start();
		$data['user_id']=getId($link);
		$data['user_params'] = getUserParams($link,$data['user_id']);
		$data['time'] = date('H:i');
		echo t('_header',$data);
		include(APP_DIR.'/pages/index_authorized.php');
		echo t('_footer');
		ob_end_flush();
	} else{
		include(APP_DIR.'/pages/index_not_authorized.php');
	}
	/*иначе лезем за нужной страницей*/
} else{
ob_start();
	if(isAuth($link)){
		$data['user_id']=getId($link);
		$data['user_params'] = getUserParams($link,$data['user_id']);
		$data['time'] = date('H:m');
		echo t('_header', $data);	
	}
	
	$url = APP_DIR.'/pages/'.$pageName.'.php';
	if(is_file($url)){
		include ($url);	
	} else {
		include (APP_DIR.'/pages/404.php');
	}
	if(isAuth($link)){
		echo t('_footer');
	}
	ob_end_flush();
}
