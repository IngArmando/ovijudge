<?php

	/*
	|| #################################################################### ||
	|| #                             chat                            # ||
	|| # ---------------------------------------------------------------- # ||
	|| #    Copyright �2010-2012 ArrowSuites LLC. All Rights Reserved.    # ||
	|| # This file may not be redistributed in whole or significant part. # ||
	|| # ---------------- chat IS NOT FREE SOFTWARE ---------------- # ||
	|| #   http://www.chat.com | http://www.chat.com/license/   # ||
	|| #################################################################### ||
	*/

	/**
	 * This function returns the user ID of the logged in user on your site.  Technical support will not
	 * help you with this for stand-alone installations.  You must purchase the professional installation
	 * if you are having trouble.
	 *
	 * Suggestion: Check out the other integration files in the functions/integrations directory for
	 * many examples of how this can be done.  The easiest way is to get the user ID through a cookie.
	 *
	 * @return the user ID of the logged in user or NULL if not logged in
	 */
	function get_user_id() 
	{
		global $db;
		
		$userid = NULL;

		if (!empty($_COOKIE['Elgg'])) 
		{
			$result = $db->execute("
				SELECT data 
				FROM " . TABLE_PREFIX . "users_sessions
				WHERE session = '" . $db->escape_string($_COOKIE['Elgg']) . "'
			");

			if ($row = $db->fetch_array($result))
			{
				$data = explode('|', $row[0]);

				if (!empty($data) AND !empty($data[1]))
				{
					$session = unserialize($data[1]);
					$userid = $session['guid'];
				}
			}
		}

		return $userid;
	}

	/**
	 * This function returns the SQL statement for the buddylist of the user.  You should retrieve
	 * all ONLINE friends that the user is friends with.  Do not retrieve offline users.  You can use
	 * global $online_timeout to get the online timeout.
	 * ex: AND (chat_status.session_time + 60 + " . $online_timeout . ") > " . time() . " 
	 *
	 * @param userid the user ID of the person receiving the buddylist
	 * @param the time of the buddylist request
	 * @return the SQL statement to retrieve the user's friend list
	 */
	function get_friend_list($userid, $time) 
	{
		global $db;
		global $online_timeout;
		
		$sql = ("
			SELECT DISTINCT " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " userid, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " username, chat_status.session_time lastactivity, " . TABLE_PREFIX . "entities." . DB_USERTABLE_AVATAR . " avatar, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " link, chat_status.is_admin, chat_status.status 
			FROM (SELECT guid_one, guid_two  FROM " . TABLE_PREFIX . "entity_relationships WHERE relationship = 'friend' UNION SELECT guid_two, guid_one FROM " . TABLE_PREFIX . "entity_relationships WHERE relationship = 'friend') friends  
			JOIN " . TABLE_PREFIX . DB_USERTABLE . " 
				ON  friends.guid_two = " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " 
			LEFT JOIN " . TABLE_PREFIX . "entities
				ON " . TABLE_PREFIX . "entities.guid = " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . "
			LEFT JOIN chat_status 
				ON " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " = chat_status.userid 
			WHERE friends.guid_one = '" . $db->escape_string($userid) . "' 
				AND chat_status.session_time > (" . time() . " - " . $online_timeout . " - 60)
			ORDER BY " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " ASC
		");
		
		return $sql; 
	}

	/**
	 * This function returns the SQL statement for all online users.  You should retrieve
	 * all ONLINE users regardless of friend status.  Do not retrieve offline users.  You can use
	 * global $online_timeout to get the online timeout.
	 * ex: AND (chat_status.session_time + 60 + " . $online_timeout . ") > " . time() . " 
	 *
	 * @param userid the user ID of the person receiving the buddylist
	 * @param the time of the buddylist request
	 * @return the SQL statement to retrieve all online users
	 */
	function get_online_list($userid, $time) 
	{
		global $db;
		global $online_timeout;
		
		$sql = ("
			SELECT DISTINCT " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " userid, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " username, chat_status.session_time lastactivity, " . TABLE_PREFIX . "entities." . DB_USERTABLE_AVATAR . " avatar, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " link, chat_status.is_admin, chat_status.status
			FROM " . TABLE_PREFIX . DB_USERTABLE . " 
			JOIN chat_status 
				ON " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " = chat_status.userid 
			LEFT JOIN " . TABLE_PREFIX . "entities
				ON " . TABLE_PREFIX . "entities.guid = " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " 
			WHERE chat_status.session_time > (" . time() . " - " . $online_timeout . " - 60)
				AND " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " != '" . $db->escape_string($userid) . "' 
			ORDER BY " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " ASC
		");
		
		return $sql; 
	}

	/**
	 * This function returns the SQL statement to get the user details of a specific user.  You should
	 * get the user's ID, username, last activity time in unix, link to their profile, avatar, and status.
	 *
	 * @param userid the user ID to get the details of
	 * @return the SQL statement to retrieve the user's defaults
	 */
	function get_user_details($userid) 
	{
		global $db;
		
		$sql = ("
			SELECT DISTINCT " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " userid, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " username, chat_status.session_time lastactivity, " . TABLE_PREFIX . "entities." . DB_USERTABLE_AVATAR . " avatar, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " link, chat_status.is_admin, chat_status.status
			FROM " . TABLE_PREFIX . DB_USERTABLE . " 
			LEFT JOIN " . TABLE_PREFIX . "entities
				ON " . TABLE_PREFIX . "entities.guid = " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " 
			LEFT JOIN chat_status 
				ON " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " = chat_status.userid 
			WHERE " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " = '" . $db->escape_string($userid) . "'
		");
		
		return $sql;
	}

	/**
	 * This function returns the profile link of the specified user ID.
	 *
	 * @param userid the user ID to get the profile link of
	 * @return the link of the user ID's profile
	 */
	function get_link($link, $user_id) 
	{
		global $base_url;
		
		return $base_url . "../profile/" . $link;
	}

	/**
	 * This function returns the URL of the avatar of the specified user ID.
	 *
	 * @param userid the user ID of the user
	 * @param image if the image includes more than just a user ID, this param is passed
	 * in from the avatar row in the buddylist and get user details functions.
	 * @return the link of the user ID's profile
	 */
	function get_avatar($image, $user_id) 
	{
		global $base_url;

		if (!empty($image))
		{
			return $base_url . "../mod/profile/icondirect.php?joindate=" . $image . "&guid=" . $user_id . "&size=medium";
		}
		else
		{
			return $base_url . AC_FOLDER_ADMIN . "/images/img-no-avatar.gif";
		}
	}
	
	/**
	 * This function returns the group ID of the user into an array.
	 *
	 * @param userid the user ID of the user
	 * @return an array of groups the user is in or NULL if no groups
	 */ 
	function get_group_id($userid)
	{
		global $db;
		
		$group_ids = array();
      
		return NULL;
	}
	
	/**
	 * This function returns an array of all the groups and their names so that
	 * the chat admin panel can manage them.
	 *
	 * @return nested arrays of the group IDs and names. The nested array must follow:
			   array(group id, group name)
	 */
	function get_all_groups()
	{
		global $db;
		
		$groups = array();
		
		return NULL;
	}

	/**
	 * This function returns the name of the logged in user.  You should not need to
	 * change this function.
	 *
	 * @param userid the user ID of the user
	 * @return the name of the user
	 */
	function get_username($userid) 
	{ 
		global $db;
		global $language;
		global $show_full_username;
		
		$users_name = $language[83];

		$result = $db->execute("
			SELECT " . DB_USERTABLE_NAME . " name 
			FROM " . TABLE_PREFIX . DB_USERTABLE . " 
			WHERE " . DB_USERTABLE_USERID . " = '" . $db->escape_string($userid) . "'
		");  

		if ($result AND $db->count_select() > 0)  
		{
			$row = $db->fetch_array($result); 
			$users_name = $row['name']; 
		}

		$pieces = explode(" ", $users_name);
		
		if ($show_full_username == 1)
		{
			return $users_name;
		}
		else
		{
			return $pieces[0]; 
		}
	} 

?>