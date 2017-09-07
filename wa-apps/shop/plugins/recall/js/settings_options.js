$(document).ready(function() {
	$(".rc_settings_form").find("input").keyup(function() {
		$(".rc_save_settings").addClass("rc_button_yellow");
	}).change(function() {
		$(".rc_save_settings").addClass("rc_button_yellow");
	});;

	$(".rc_settings_form").submit(function() {
		$(".rc_saving_settings").slideDown();
		$.post('?plugin=recall&module=backend&action=savethemesettings', $(this).serialize(), function(JData) {
			$(".rc_saving_settings").delay(300).slideUp();
			$(".rc_save_settings").removeClass("rc_button_yellow");
		} , "json");
		return false;
	});
	
	$(".rc_textcontent_value").keyup(function() {
		$(".rc_button_textcontent").addClass("rc_button_yellow");
	});
	
	$(".rc_textcontent").submit(function() {
		$(".rc_saving_text_content").slideDown();
		$.post('?plugin=recall&module=backend&action=savetextcontent', $(this).serialize(), function(JData) {
			$(".rc_saving_text_content").slideUp();
			$(".rc_button_textcontent").removeClass("rc_button_yellow");
		} , "json");
		return false;
	});
});