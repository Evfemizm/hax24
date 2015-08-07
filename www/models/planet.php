<?php
function location_type_up($link,$userId,$lt){
	$nlt="";
	if($lt == 's'){
		
		$nlt='p';
	}else{
		$nlt='s';
	
	}
	return mysqli_query($link, "UPDATE `users` SET `user_location_type`='$nlt' WHERE `user_id`='$userId'");
	
}

function get_planet($link, $planet, $galaxy){

	$my = mysqli_query($link, "SELECT * FROM `planets` WHERE `planet_id`='$planet'");
	$my_planet = mysqli_fetch_assoc($my);
	$res = mysqli_query($link, "SELECT * FROM `planets` WHERE `galaxy_planet_id`='$galaxy' AND `planet_id`!='$planet'");
	$planets_arr = array();
	$i=0;
		while($planet_el=mysqli_fetch_assoc($res)) {  
		
			$planets_arr[$i] = $planet_el;
			$planets_arr[$i]['distance'] = sqrt(pow(($my_planet['planet_x']-$planets_arr[$i]['planet_x']),2)+pow(($my_planet['planet_y']-$planets_arr[$i]['planet_y']),2));
			$i++;
		}
		return $planets_arr;
}

function flight($link, $userId, $planet_to, $planets = array()){
	foreach($planets as $planet){
		if($planet['planet_id'] == $planet_to){
			if($planet['distance'] <=10.0){
				return mysqli_query($link, "UPDATE `users` SET `user_location`='$planet_to' WHERE `user_id`='$userId'");
			}
		}
	}

	

}
