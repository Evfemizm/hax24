<?

//проверяем логин (имя персонажа). русские буквы, цифры, пробел, дефис, воскл.знак
function isLogin($string){
	return preg_match("#^[АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯяa-zA-Z0-9-!]{4,20}$#", $string) > 0;
}
//проверяем имя пользователя или город(профайл). русские, английские буквы, дефис, пробел
function isString($string){
	return preg_match("#^[АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯяa-zA-Z-]{2,40}$#", $string) > 0;
}
//проверяем пароль - англ буквы+цифры*дефис
function isPassword($string){
	return preg_match("#^[a-zA-Z0-9-]{4,40}$#", $string) > 0;
}
//авторизация
function auth($link, $userLogin, $userPassword){
	if(!isLogin($userLogin)){
		return 'login_encorretcted';
	}elseif(!isPassword($userPassword)){
		return 'password_encorretcted';
	}else{
		$userPass = md5(PASSWORD_SALT.$userPassword);
		$res=mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `user_login`='$userLogin' AND `user_password`='$userPass'");
		$userId=mysqli_fetch_assoc($res);
		if(isset($userId['user_id'])){
			$key = md5(rand(11111,99999));
			setcookie("user_auth", $key, time()+7*24*3600);
			$_COOKIE['user_auth']=$key;
			$_SESSION['user_auth']=$key;
			$userId=$userId['user_id'];
			$lastIp=$_SERVER['REMOTE_ADDR'];
			mysqli_query($link, "UPDATE `users` SET `user_auth`='$key',`last_ip`='$lastIp' WHERE `user_id`='$userId'");
			return 'complete';
		}else{
			return 'no_wrtite_to_db';
		}
	}
}
//регистрация
function ctreateAccount($link, $userLogin, $userPassword, $userType){
	if(!isLogin($userLogin)){
		return 'login_encorretcted';
	}elseif(!isPassword($userPassword)){
		return 'password_encorretcted';
	}elseif($userType == 0 || $userType > 3){
		return 'user_type_encorretcted';
	}else{
		$res=mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `user_login`='$userLogin'");
		$userId=mysqli_fetch_assoc($res);
		
		if(isset($userId['user_id'])){
			return 'login_found';
		}else{
			$addUserPass = md5(PASSWORD_SALT.$userPassword);
			$firstIp=$_SERVER['REMOTE_ADDR'];

			if(mysqli_query($link, "INSERT INTO `users`(`user_login`, `user_password`,`user_type`, `exp`, `money`, `gold`, `user_access`, `user_location_type`, `user_location`,`user_galaxy`, `first_ip`) VALUES ('$userLogin','$addUserPass','$userType',0, 15000, 0, 5,'p',1,1,'$firstIp')")){
				$insertId= mysqli_insert_id($link);
				mysqli_query($link, "INSERT INTO `user_galaxy`(`user_id`, `user_galaxy_id`) VALUES ('$insertId',1)");
				return 'complete';
				}
			else
				return 'no_wrtite_to_db';
		}
	}
}
//проверка авторизации
function isAuth($link){
	if(isset($_SESSION['user_auth']) || isset($_COOKIE['user_auth'])){
		if (isset($_SESSION['user_auth']))
			$key = $_SESSION['user_auth'];
		else
			$key = $_COOKIE['user_auth'];
			
		$res=mysqli_query($link, "SELECT `last_ip` FROM `users` WHERE `user_auth`='$key'");
		$last_ip=mysqli_fetch_assoc($res);
		if(isset($last_ip['last_ip']))
			$ipMaskBase=explode('.', $last_ip['last_ip']);
		else
			$ipMaskBase=array(1,1);
			
		$ipMaskReal=explode('.', $_SERVER['REMOTE_ADDR']);
		if($ipMaskBase[0] == $ipMaskReal[0] && $ipMaskBase[1] == $ipMaskReal[1]){
			setcookie("user_auth", $key, time()+7*24*3600);
			$_SESSION['user_auth'] = $key;
			return true;
		}else{
			SetCookie("user_auth","");
			unset($_SESSION['user_auth']);
			header ('Location: /');
			exit();
		}
	}else{
		return false;
	}
}
//получить уровень доступа
function getAccess($link, $id){
	$res=mysqli_query($link, "SELECT `user_access` FROM `users` WHERE `user_id`='$id'");
	$userAccess=mysqli_fetch_assoc($res);
	return $userAccess['user_access'];
}
//получаем id текущего юзверя
function getId($link){
	$key = $_SESSION['user_auth'];	
	$res=mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `user_auth`='$key'");
	$userId=mysqli_fetch_assoc($res);
	return $userId['user_id'];
}
//получаем логин (имя) заданного юзверя
function getUserLogin($link,$id){	
	$res=mysqli_query($link, "SELECT `user_login` FROM `users` WHERE `user_id`='$id'");
	$userLogin=mysqli_fetch_assoc($res);
	return $userLogin['user_login'];
}
//получаем все данные о заданном юзвере
function getUserParams($link,$id){	
	$res=mysqli_query($link, "SELECT `user_login`, `user_type`, `exp`, `money`, `gold`, `user_location_type`, `user_location`, `user_galaxy`, `type_name`, `location_type_name`, `planet_name` , `galaxy_name` 
	FROM `users` 
	LEFT JOIN `user_types` ON users.user_type=user_types.type_id 
	LEFT JOIN `location_type` ON users.user_location_type=location_type.location_type_code 
	LEFT JOIN `planets` ON users.user_location=planets.planet_id 
	LEFT JOIN `galaxy` ON users.user_galaxy=galaxy.galaxy_id 
	WHERE `user_id`='$id'");
	$userParams=mysqli_fetch_assoc($res);
	return $userParams;
}
