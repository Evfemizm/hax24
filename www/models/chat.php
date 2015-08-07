<?php
/*функции для чата*/
function sendChatMessage($link, $chatMessage, $userId, $toUserId = 0){
	$chatMessage = esc($chatMessage);
	if(mb_strlen($chatMessage)<1){
	
		return 'message_empty';
	}elseif(mb_strlen($chatMessage)<3){
		return 'not_min_message';
	}else{
		if(!getUserLogin($link,$toUserId)){
			$toUserId=0;
		}
		mysqli_query($link, "INSERT INTO `chat`(`chat_from_id`, `chat_to_id`,`chat_message`) VALUES ('$userId','$toUserId','$chatMessage')");
		return 'message_send';
	}

}
function getChatMessage($link, $userId){
	

		$res=mysqli_query($link, "SELECT chat.*, users.user_login FROM chat LEFT JOIN users ON chat.chat_from_id=users.user_id WHERE `chat_to_id`='0' OR `chat_to_id`='$userId' OR `chat_from_id`='$userId' ORDER BY chat_message_id DESC ");
		$chatMessage = array();
		while($chatMessages=mysqli_fetch_assoc($res)) {  
		
			$chatMessage[] = $chatMessages;
			
			
		}
		return $chatMessage;
}	
function getChatMessagePr($link, $userId){
		$res=mysqli_query($link, "SELECT chat.*, users.user_login FROM chat LEFT JOIN users ON chat.chat_from_id=users.user_id WHERE `chat_to_id`='$userId' OR `chat_from_id`='$userId' AND `chat_to_id`!='0' ORDER BY chat_message_id DESC ");
		$chatMessage = array();
		while($chatMessages=mysqli_fetch_assoc($res)) {  
		
			$chatMessage[] = $chatMessages;
			
			
		}
		return $chatMessage;
}