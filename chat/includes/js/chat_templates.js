var chat = {};
chat.Templates = {
	bar_hide_tab				: function () { return '<div id="chat_hide_bar_button" class="chat_bar_right chat_bar_button"><?php echo $file_bar_hide_tab; ?></div>'; },
	bar_show_tab				: function () { return '<div id="chat_show_bar_button" class="chat_bar_right chat_bar_button"><?php echo $file_bar_show_tab; ?></div>'; },
	applications_bookmarks_tab		: function (c_ac_path,apps,b) { return '<?php echo $file_applications_bookmarks_tab; ?>'; },
	applications_bookmarks_window		: function (c_ac_path,apps,b) { return '<?php echo $file_applications_bookmarks_window; ?>'; },
	applications_bookmarks_list		: function (c_ac_path,apps,b) { return '<?php echo $file_applications_bookmarks_list; ?>'; },
	applications_tab			: function () { return '<?php echo $file_applications_tab; ?>'; },
	applications_window			: function () { return '<?php echo $file_applications_window; ?>'; },
	notifications_tab			: function () { return '<?php echo $file_notifications_tab; ?>'; },
	notifications_window			: function () { return '<?php echo $file_notifications_window; ?>'; },
	mod_tab			: function () { return '<?php echo $file_mod_tab; ?>'; },
	mod_window			: function () { return '<?php echo $file_mod_window; ?>'; },
	mod_report			: function () { return '<?php echo $file_mod_report; ?>'; },
	warnings_display			: function (h) { return '<?php echo $file_warnings_display; ?>'; },
	chat_tab				: function (shortname) { return '<div class="chat_bar_right chat_bar_button chat_user_tab"><?php echo $file_chat_tab; ?></div>'; },
	chat_window				: function (c, longname, i, l, b) { return '<div class="chat_tabpopup"><?php echo $file_chat_window; ?></div>'; },
	buddylist_tab				: function () { return '<?php echo $file_buddylist_tab; ?>'; },
	buddylist_window			: function (d, _ts, acp) { return '<?php echo str_replace("<!--", "", $file_buddylist_window); ?>'; },
	maintenance_tab				: function (c_login_url) { if(c_login_url=="")c_login_url="#"; return '<div id="chat_maintenance" class="chat_bar_right chat_bar_button"><a href="'+c_login_url+'"><?php echo $file_maintenance_tab; ?></a></div>'; },
	announcements_display			: function (h) { return '<?php echo $file_announcements_display; ?>'; },
	chatrooms_tab				: function () { return '<div id="chat_chatrooms_button" class="chat_bar_right chat_bar_button"><?php echo $file_chatrooms_tab; ?></div>'; },
	chatrooms_window			: function () { return '<div id="chat_chatrooms_popup" class="chat_tabpopup"><?php echo $file_chatrooms_window; ?></div>'; },
	chatrooms_room				: function (c_max_chatroom_msg) { return '<?php echo $file_chatrooms_room; ?>'; }
};
chat.IdleTime = <?php echo $idle_time; ?>;

