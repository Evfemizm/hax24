<?php
defined('_SEECRET') or die('Ай-яй-яй, сюда нельзя!');
?>
<!doctype html>
<html>
<head>
<base href="/">
    <title>Название игры | <?=$data['user_params']['location_type_name']?> <?=$data['user_params']['planet_name']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="/css/css_reset.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>

<div class="wrapper">
<div class="game_title">Название игры</div>
<div class="row2">
	<span class="user_name"><?=$data['user_params']['user_login']?> (<?=$data['user_params']['type_name']?>) </span>
	<span class="time"><?=$data['time']?></span>
</div>
<div class="user_param">
	<span>
		<img src="/img/exp.png"> <?=$data['user_params']['exp']?>
	</span>
	<span>
		<img src="/img/exp.png"> <?=$data['user_params']['money']?>
	</span>
	<span>
		<img src="/img/exp.png"> <?=$data['user_params']['gold']?>
	</span>
</div>
<div class="locations">
	<a href="/" class="planet"><?=$data['user_params']['location_type_name']?> "<?=$data['user_params']['planet_name']?>"</a>
	<span class="galaxy">Галактика "<?=$data['user_params']['galaxy_name']?>"</span>
</div>
<div class="ship">
	<a class="my_ship_link" href="/ship"><img src="/img/exp.png"> Мой корабль</a>
	<span class="crash"><img src="/img/exp.png"> 50%</span>
</div>
<div class="content">