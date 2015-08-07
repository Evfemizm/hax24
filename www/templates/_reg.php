<?php
defined('_SEECRET') or die('Ай-яй-яй, сюда нельзя!');
?>
<h1>Регистрация</h1>
<?=$data['message']?>
<form method="post">
	Введиде имя персонажа (рус, англ буквы, цифры, а так же символы !, - и пробел):<br>
	<input type="text" name="user_login" value="<?=$data['user_login']?>" required><br>
	Введите пароль (англ буквы, цифры):<br>
	<input type="password" name="user_password" value="<?=$data['user_password']?>" required><br>
	Выберите роль:<br>
	<select name="user_type" required>
		<option selected value="1">Воитель</option>
		<option value="2">Пират</option>
		<option value="3">Торговец</option>
   </select><br>
   <input type="submit" value="Регистрация"><br>
   
</form>