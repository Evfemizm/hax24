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
	<textarea type="text" name="chat_message"  required></textarea><br>
	<input type="submit" value="Отправить">

</form>
<?=$data['message']?>
<?foreach($data['chat_messages'] as $message):?>
	<?if($message['chat_to_id'] != 0):?>
		<div class="message private"> <span>P: </span>
	<?else:?>
		<div class="message">
	<?endif;?>
	<span><?=$message['chat_message_time']?> </span><span><?=$message['user_login']?></span><a href="/chat?<?if($message['chat_to_id'] != 0)echo "pr=".$data['user_id']."&";?>to=<?=$message['chat_from_id']?>" name="private">&#62;</a>
	<div><?=$message['chat_message']?></div>
	</div>
<?endforeach;?>
