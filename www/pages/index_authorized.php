<?php
if($data['user_params']['user_location_type'] == 's'){
	$data['planets'] = get_planet($link, $data['user_params']['user_location'], $data['user_params']['user_galaxy']);
	
	if($_POST['flight']){
		if(flight($link, $data['user_id'], $_POST['planet'], $data['planets'])){
			header ('Location: /');
			exit();
		}
	
	}
	if($_POST['land']){
		if(location_type_up($link,$data['user_id'],$data['user_params']['user_location_type'])){
			header ('Location: /');
			exit();
		}
	
	}
	echo t('_space', $data);

}else{
	if($_POST['start']){
		if(location_type_up($link,$data['user_id'],$data['user_params']['user_location_type'])){
			header ('Location: /');
			exit();
		}
	}
	echo t('_planet');

}