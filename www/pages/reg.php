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
		$data['message']=$message[ctreateAccount($link, $data['user_login'], $data['user_password'], $data['user_type'])];
		
	}
	if($data['message']==$message['complete']){
	/*если регистрация завершена то авторизуем юзверя и отправляем на главную*/
		auth($link, $data['user_login'], $data['user_password']);
		header ('Location: /');

	}
	echo t('_reg', $data);


}else{
header('Location: /');

}