<?php
defined('_SEECRET') or die('Ай-яй-яй, сюда нельзя!');
?>
<h1>Авторизация</h1>
<?=$data['message']?>
<form method="post">
	Введиде имя персонажа (рус, англ буквы, цифры, а так же символы !, - и пробел):<br>
	<input type="text" name="user_login" value="" required><br>
	Введите пароль (англ буквы, цифры):<br>
	<input type="password" name="user_password" value="" required><br>
	
   <input type="submit" value="Войти"><br>
   
</form>