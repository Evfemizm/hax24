<?php
defined('_SEECRET') or die('Ай-яй-яй, сюда нельзя!');
?>
<div>
<?if(isset($_GET['pr'])):?>
	<a href="/chat?pr=<?=$data['user_id']?>">Обновить</a> <a href="/chat">В общий</a></div>
<?else:?>
	<a href="/chat">Обновить</a> <a href="/chat?pr=<?=$data['user_id']?>">Приват</a></div>
<?endif;?>

<form method="post">
	Введите сообщение:<br>
	<textarea type="text" name="chat_message"  required><?=$data['to_user_name']?>,</textarea><br>
	<input type="hidden" name="chat_to_id" value="<?=$data['to_user_id']?>">
	<label><input type="checkbox" name="priv"/> Приват</label><br>
	<input type="submit" value="Отправить">

</form>

