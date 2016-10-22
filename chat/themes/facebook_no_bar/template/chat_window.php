<div class="chat_tabtitle">
	<div class="chat_user_status"></div>
	<div class="chat_tab_name">'+c+longname+i+'</div>
	<div class="chat_closebox"></div>
	<div class="chat_more_button">
		<a href="javascript:void(0)" class="chat_more_anchor" id="chat_more_'+b+'"></a>
		<div class="chat_more_wrapper">
			<div id="chat_more_popout_'+b+'" class="chat_more_popout">
				<div id="chat_file_transfer_'+b+'" class="chat_video_chat">
					'+lang[66]+'
				</div>
				<div class="chat_video_chat chat_chat_popout">
					'+lang[60]+'
				</div>
				<div id="chat_clear_'+b+'" class="chat_video_chat">
					'+lang[24]+'
				</div>
				<hr class="chat_options_divider" style="margin-top:5px" />
				<div id="chat_block_'+b+'" class="chat_video_chat">
					'+lang[84]+'
				</div>
				<div id="chat_report_'+b+'" class="chat_video_chat">
					'+lang[167]+'
				</div>
				<i class="chat_more_tip"></i>
			</div>
		</div>
	</div>
	<div id="chat_video_chat_'+b+'" class="chat_video_icon chat_video_unavailable"></div>
</div>
<div class="chat_tabcontent">
	<div id="chat_file_upload_div_'+b+'" class="chat_file_upload" style="display: none;">
		<div class="chat_file_upload_wrapper">
			<div style="float: right;">
				<div class="chat_ui_button">
					<input id="chat_file_upload_'+b+'" name="file_upload" type="file" />
					<div class="chat_upload_text">'+lang[86]+'</div>
				</div>
			</div>
			<div class="chat_upload_info_text" style="text-align: left; float: left; position: relative; width:150px">
				'+lang[87]+'<a href="javascript:void(0);" id="chat_file_cancel_'+b+'">'+lang[67]+'</a>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
	<div id="chat_chatbox_message_flyout_'+b+'" class="chat_message_box">
		<div class="chat_message_box_wrapper">
			<div>
				<span class="chat_message_text">'+lang[68]+'</span>
			</div>
		</div>
	</div>
	<div class="chat_tabcontenttext" id="chat_tabcontenttext_'+b+'"></div>
	<div class="chat_tabcontentinput">
		<textarea class="chat_textarea"></textarea>
		<div class="chat_smiley_button">
			<div class="chat_more_wrapper chat_smiley_popout">
				<div class="chat_more_popout">
					<div class="chat_smiley_box"></div>
					<i class="chat_more_tip"></i>
				</div>
			</div>
		</div>
	</div>
</div>