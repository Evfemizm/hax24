<?php
defined('_SEECRET') or die('Ай-яй-яй! Сюда нельзя!');
if(isAuth($link)){
	
	if(count($_POST)>0){
		$chatMessage = $_POST['chat_message'];
		if(getUserLogin($link,$_POST['chat_to_id']) && $_POST['priv'] == true){
			$toUserId = $_POST['chat_to_id'];
		}else{
			$toUserId = 0;
		}
		$data['message'] = $message[sendChatMessage($link, $chatMessage, $data['user_id'], $toUserId)];
		if($data['message'] == $message['message_send']){
			$_SESSION['message'] = $message['message_send'];
			if(isset($_GET['pr']))
				$urlPartQuest = '?pr='.$_GET['pr'];
			else
				$urlPartQuest = '';
			header ("Location: /chat".$urlPartQuest);
			exit;
		}

	}
	if(isset($_SESSION['message'])){

		$data['message'] = $_SESSION['message'];
		unset($_SESSION['message']);
	}
	if(isset($_GET['pr'])){
	
		$data['chat_messages'] = getChatMessagePr($link, $data['user_id']);
	}else{
		$data['chat_messages'] = getChatMessage($link, $data['user_id']);
	}
	if(isset($_GET['to'])){
		$data['to_user_id'] = $_GET['to'];
		$data['to_user_name']=getUserLogin($link,$_GET['to']);
		if($data['to_user_name']){
			echo t('_chat_to', $data);
		}
	}else{
		echo t('_chat', $data);
	}
}else{

	header('Location: /login');

}
