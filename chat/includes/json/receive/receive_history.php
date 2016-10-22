<?php

	/*
	|| #################################################################### ||
	|| #                             chat                            # ||
	|| # ---------------------------------------------------------------- # ||
	|| #    Copyright ©2010-2012 ArrowSuites LLC. All Rights Reserved.    # ||
	|| # This file may not be redistributed in whole or significant part. # ||
	|| # ---------------- chat IS NOT FREE SOFTWARE ---------------- # ||
	|| #   http://www.chat.com | http://www.chat.com/license/   # ||
	|| #################################################################### ||
	*/

	// ########################## INCLUDE BACK-END ###########################
	require_once (dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'bootstrap.php');
	require_once (dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . AC_FOLDER_INCLUDES . DIRECTORY_SEPARATOR . 'init.php');

	// ########################### INITILIZATION #############################
	$response = array();
	$messages = array();
	$timestamp = time();

	// ######################## START HISTROY RECEIVE ########################
	if (logged_in($userid)) 
	{
		if (!empty($_POST['chatbox'])) 
		{
			$chatbox = get_var('chatbox');
			
			$result = $db->execute("
				SELECT clear_chats
				FROM chat_status 
				WHERE userid = '" . $db->escape_string($userid) . "'
			");

			$row = $db->fetch_array($result);
			
			$clear_chats = unserialize($row['clear_chats']);
			
			if (!empty($clear_chats)) 
			{
				if (array_key_exists($chatbox, $clear_chats))
				{
					$time_check = $clear_chats[$chatbox];
				} 
				else 
				{
					$time_check = 0;
				}
			} 
			else 
			{
				$time_check = 0;
			}
			
			$lower_limit = 0;
			
			if (!empty($_POST['history']) AND is_numeric($_POST['history']))
			{
				$lower_limit = 20 * ($_POST['history'] - 1);
			}
			
			$result = $db->execute("
				SELECT chat.id, chat.from, chat.to, chat.message, chat.sent, chat.read 
				FROM chat 
				WHERE ((chat.to = '" . $db->escape_string($userid) . "' 
							AND chat.from = '" . $db->escape_string($chatbox) . "') 
						OR (chat.from = '" . $db->escape_string($userid) . "' 
							AND chat.to = '" . $db->escape_string($chatbox) . "'))  
					AND (chat.sent > " . $time_check . " 
						OR (chat.user_read = '0'
								AND chat.to = '" . $db->escape_string($userid) . "')) 
				ORDER BY chat.id DESC
				LIMIT " . $db->escape_string($lower_limit) . ", 20
			");
		 
			while ($chat = $db->fetch_array($result)) 
			{
				$self = 0;
				$old = 0;
				
				if ($chat['from'] == $userid) 
				{
					$chat['from'] = $chat['to'];
					$self = 1;
					$old = 1;
				}

				if ($chat['read'] == 1) 
				{
					$old = 1;
				}
				
				$chat_message = $chat['message'];
				$chat_message = str_replace("\\'", "'", $chat_message);
				$chat_message = str_replace('\\"', '"', $chat_message);
				$chat_message = clickable_links($chat_message);

				$messages[] = array('id' => $chat['id'], 'from' => $chat['from'], 'message' => $chat_message, 'self' => $self, 'old' => $old, 'sent' => $chat['sent']);

				$timestamp = $chat['id'];
			}	
			
			$db->execute("
				UPDATE chat 
				SET chat.user_read = '1' 
				WHERE chat.from = '" . $db->escape_string($chatbox) . "' 
					AND chat.to = '" . $db->escape_string($userid) . "' 
					AND chat.user_read = '0'
			");
		}
		
		if (!empty($messages)) 
		{
			$response['messages'] = array_reverse($messages);
		}
	}

	header('Content-type: application/json; charset=utf-8');
	echo json_encode($response);
	close_session();
	exit;

?>