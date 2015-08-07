<?php
defined('_SEECRET') or die('Ай-яй-яй, сюда нельзя!');

/*пускаем на страницу только неавторизованных юзверей. остальных отправляем погулять*/
if(!isAuth($link)){
	$userLogin="";
	$userPassword="";
	$userType="";
	$mess="";
	if(count($_POST)>0){
		$data['user_login']=$_POST['user_login'];
		$data['user_password']=$_POST['user_password'];
		$data['user_type']=$_POST['user_type'];
		/*если массив пост отправлен, то запускаем функцию регистрации аккаунта. функция вернет сообщение complete в случае удачи, иначе код ошибки*/
		$data['message']=$message[auth($link, $data['user_login'], $data['user_password'])];
		
	}
	if($data['message']==$message['complete']){
	/*если аворизация завершена то отправляем на главную*/
		header ('Location: /');

	}
	echo t('_login', $data);

}else{

	echo t('_loginout');
}