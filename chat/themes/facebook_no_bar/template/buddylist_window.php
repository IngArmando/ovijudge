<div class="chat_userstabtitle">
	<div class="chat_tab_name">'+lang[4]+'</div>
	<div class="chat_more_button">
		<a href="javascript:void(0);" class="chat_panel_item chat_more_anchor"></a>
		<div id="chat_options_wrapper" class="chat_more_wrapper">
			<div id="chat_options_flyout" class="">
				<ul class="chat_inner_menu">
					<li class="chat_menu_item">
						<a id="chat_setting_sound" class="chat_menu_anchor">
							<span>'+lang[6]+'</span>
							<input type="checkbox" checked="" />
						</a>
					</li>
					<li class="chat_menu_item">
						<a id="chat_setting_window_open" class="chat_menu_anchor">
							<span>'+lang[17]+'</span>
							<input type="checkbox" checked="" />
						</a>
					</li>
					<li class="chat_menu_item">
						<a id="chat_setting_names_only" class="chat_menu_anchor">
							<span>'+lang[18]+'</span>
							<input type="checkbox" checked="" />
						</a>
					</li>
					<li class="chat_menu_item">
						<a id="chat_setting_block_list" class="chat_menu_anchor" style="background:none">
							<span>'+lang[95]+'</span>
							<input type="checkbox" checked="" />
						</a>
					</li>
					<li class="chat_menu_separator"></li>
					<li class="chat_menu_item">
						<a id="chat_gooffline" class="chat_menu_anchor">
							<span>'+lang[5]+'</span>
						</a>
					</li>
				</ul>
				<div class="chat_block_menu">
					<div class="chat_block_menu_text">'+lang[96]+'</div>
					<div style="float:left">
						<select></select>
					</div>
					<div class="chat_ui_button" id="chat_unblock_button" style="float:right">
						<div style="width:45px;height:18px;position:relative;top:2px;left:-1px;">'+lang[97]+'</div>
					</div>
					<div class="chat_clearfix"></div>
				</div>
				<i class="chat_more_tip"></i>
			</div>
		</div>
	</div>
	<div class="chat_theme_button">
		<a href="javascript:void(0);" class="chat_theme_link chat_more_anchor"></a>
		<div id="chat_theme_wrapper" class="chat_more_wrapper">
			<div id="chat_theme_flyout" class="">
				<div class="chat_theme_menu">
					<div class="chat_theme_menu_text">'+lang[108]+'</div>
					<div style="float:left">
						<select class="chat_themeswitcher">'+_ts+'</select>
					</div>
					<div class="chat_ui_button" id="chat_theme_button" style="float:right">
						<div style="width:45px;height:18px;position:relative;top:2px;left:-1px;">'+lang[109]+'</div>
					</div>
					<div class="chat_clearfix"></div>
				</div>
				<i class="chat_more_tip"></i>
			</div>
		</div>
	</div>
</div>
<div class="chat_powered_by">'+acp+'</div>
<div class="chat_facebook_connect"></div>
<div class="chat_tabcontent chat_tabstyle">
	<div id="chat_buddylist_message_flyout" class="chat_message_box">
		<div class="chat_message_box_wrapper">
			<div>
				<span class="chat_message_text"></span>
			</div>
		</div>
	</div>
	<div class="chat_enter_name_wrapper">
		<input placeholder="'+lang[119]+'" type="text" id="chat_guest_name_input" maxlength="25" />
	</div>
	<div id="chat_userscontent">
		<div id="chat_userslist_available"></div>
		<div id="chat_userslist_busy"></div>
		<div id="chat_userslist_away"></div>
		<div id="chat_userslist_invisible"></div>
		<div id="chat_userslist_offline"></div>
	</div>
	<div id="chat_search_friends">
		<input type="text" class="chat_search_friends_text" placeholder="'+lang[12]+'"  />
	</div>
</div>