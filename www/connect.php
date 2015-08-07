<?php
header("Content-Type: text/html; charset=UTF-8");
define('APP_DIR', __DIR__);
//include ('balance.php');
include ('config.php');
include ('models/functions.php');
include ('message.php');
define('PASSWORD_SALT', 'p2n4v3j');
define( '_SEECRET', 1 );
$link=mysqli_connect(getCfg('db_host'),getCfg('db_login'),getCfg('db_password'),getCfg('db_name')) or die("Не могу подключиться к серверу БД(1)");
mysqli_set_charset($link, 'utf8');
date_default_timezone_set('Europe/Moscow');
