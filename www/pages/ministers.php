<?php
defined('_SEECRET') or die('Ай-яй-яй! Сюда нельзя!');
if(isAuth($link)){

	echo t('_ministers', $data);

}else{

	header('Location: /login');

}