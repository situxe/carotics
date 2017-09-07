$(document).ready(function() {
	function reportDraggable()
	{
		var request = "";
		var counter = 0;
		$(".rc_status_table").find("tr.item_tr").each(function() {
			if(request.length > 0) { request += '&'; }
			request += 'order['+$(this).find(".rc_save_status").attr("data-itemid")+']='+counter;
			counter++;
		});
		$.post('?plugin=recall&module=backend&action=savestatusorder', request, function(JData) {
			return;
		} , "json");
	}
	
	function regenStatusTable(data)
	{
		$(".ui-sortable tbody").sortable("destroy");
		$(".rc_status_table").remove();
		$(".rc_s_table").prepend('\
			<table class="zebra rc_table rc_status_table s-routing ui-sortable">\
			<tbody>\
			<tr class="header"><th>ID</th><th>Имя</th><th>Подсветка</th><th>Кол-во запросов</th><th>Действия</th></tr>\
			</tbody>\
			</table>\
		');
		$.each(data, function(index, value) {
			$(".rc_status_table tbody").append('\
			<tr class="item_tr">\
				<td><div class="rc_status_td"><a style="display:inline"><i class="icon16 sort"></i></a>'+value.id+'</div></td>\
				<td><input type="text" class="rc_status_name" data-itemid="'+value.id+'" value="'+value.name+'"></td>\
				<td><input type="text" class="rc_status_color" data-itemid="'+value.id+'" value="'+value.color+'"></td>\
				<td>'+value.request_count+'</td>\
				<td>\
					<i data-itemid="'+value.id+'" class="icon16 rc_icon delete rc_delete_status"></i>\
					<i data-itemid="'+value.id+'" class="rc_icon rc_save rc_save_inactive rc_save_status"></i>\
				</td>\
			</tr>\
			');
		});
		$(".rc_status_adding").fadeOut();
		$(".ui-sortable tbody").sortable( { 
			items: "> tr.item_tr",
			update: function(event, ui) {
				reportDraggable();
			}
		});
	}
	
	$(".ui-sortable tbody").sortable( { 
		items: "> tr.item_tr",
		update: function(event, ui) {
			reportDraggable();
		}
	});
	
	$(".rc_status_name").live('keyup', function() {
		$(this).parent().parent().find(".rc_save_status").removeClass("rc_save_inactive");
	});
	
	$(".rc_status_color").live('keyup', function() {
		$(this).parent().parent().find(".rc_save_status").removeClass("rc_save_inactive");
	});
	
	$(".rc_save_status").live('click', function() {
		var status_name = $(this).parent().parent().find(".rc_status_name").val();
		var status_color = $(this).parent().parent().find(".rc_status_color").val()
		if(status_name.length == 0) { alert('Имя статуса должно содержать хотя бы один символ.'); return; }
		if(status_color.length < 3) { status_color = '#03c';}
		
		$(".rc_status_adding").fadeIn();
		var thisElem = $(this);
		$.post('?plugin=recall&module=backend&action=renamestatus', 'status='+$(this).attr("data-itemid")+'&name='+encodeURI(status_name)+'&color='+encodeURI(status_color), function(JData) {
			//regenStatusTable(JData.data.status);
			$(".rc_status_adding").fadeOut();
			thisElem.addClass("rc_save_inactive");
		} , "json");
	});
	
	$(".rc_delete_status").live('click', function() {
		$(".rc_removestatus_removeid").val($(this).attr("data-itemid"));
		$(".rc_removed_name").html('"'+$(this).parent().parent().find(".rc_status_name").val()+'"');
		
		$(".rc_removestatus_newstatus").children().remove();
		$(".rc_removestatus_newstatus").append('<option value="-1" selected=true>Без статуса</option>');
		$(".rc_status_table").find("tr:not('.header')").each(function() {
			if($(this).find(".rc_delete_status").attr("data-itemid") != $(".rc_removestatus_removeid").val())
			{
				$(".rc_removestatus_newstatus").append('\
					<option value="'+$(this).find(".rc_delete_status").attr("data-itemid")+'">'+$(this).find(".rc_status_name").val()+'</option>\
				');
			}
		});
		
		
		$(".rc_status_delconfirm").show();
		$("html,body").animate( { scrollTop: $(".rc_status_delconfirm").offset().top-30 } , 1000);
	});
	
	$(".rc_button_delstatus").click(function() {
		$(".rc_status_adding").fadeIn();
		$.post('?plugin=recall&module=backend&action=removestatus', 'status='+$(".rc_removestatus_removeid").val()+'&new_status='+$(".rc_removestatus_newstatus").val(), function(JData) {
			regenStatusTable(JData.data.status);
			$(".rc_status_delconfirm").slideUp();
			$("html,body").animate( { scrollTop: $(".rc_status_table").offset().top-50 } , 1000);
		} , "json");
	});
	
	$(".rc_button_canceldel").click(function() {
		$(".rc_status_delconfirm").slideUp();
		$("html,body").animate( { scrollTop: $(".rc_status_table").offset().top-50 } , 1000);
	});
	
	$(".rc_addstatus").click(function(){
		var status_name = $(".rc_addstatus_text").val();
		var status_color = $(".rc_addstatus_color").val();
		if(status_name.length == 0) { alert('Имя статуса должно содержать хотя бы один символ.'); return; }
		if(status_color.length < 3) { status_color = '#03c';}
		$(".rc_status_adding").fadeIn();
		$.post('?plugin=recall&module=backend&action=addstatus', 'status='+encodeURI(status_name)+'&color='+encodeURI(status_color), function(JData) {
			regenStatusTable(JData.data.status);
			$(".rc_addstatus_text").val("");
		} , "json");
	});
});