$(document).ready(function() {
	function loadFields()
	{
		var fieldsHtml = "";
		$.post('?plugin=recall&module=backend&action=getextrafields', '', function(JData) {
			var cnt = 0;
			$.each(JData.data.fields, function(index, value) {
				var currentValues = '';
				if(value.values) {
					currentValues+= '<input type="button" value="Добавить" class="rc_field_addmore" data-cnt="'+cnt+'">';
					currentValues+= '<table class="rc_field_internaltable" data-cnt="'+cnt+'">';
					$.each(value.values, function(internalIndex, internalValue) {
						currentValues+='<tr><td><div class="rc_field_internalval"><a style="display:inline"><i class="icon16 sort rc_inner_sort"></i></a><input type="text" name="fields['+cnt+'][values][]" value="'+internalValue.name+'"><i class="icon16 rc_icon delete rc_field_internalval_del"></i></div></td></tr>';
					});
					currentValues+= '</table>';
				}
				
				var currentField = '<tr class="field_tr">';
				currentField+='\
					<td><a style="display:inline"><i class="icon16 sort rc_outer_sort"></i></a></td>\
					<td><input type="text" name="fields['+cnt+'][name]" value="'+value.name+'"></td>\
					<td>\
						<select name="fields['+cnt+'][type]" class="rc_field_type_select" data-cnt="'+cnt+'">\
							<option value="text" '; if(value.type=='text') {currentField+='selected';} currentField+='>Текстовый</option>\
							<option value="range" '; if(value.type=='range') {currentField+='selected';} currentField+='>Диапазон</option>\
							<option value="select" '; if(value.type=='select') {currentField+='selected';} currentField+='>Одиночный выбор</option>\
							<option value="checkbox" '; if(value.type=='checkbox') {currentField+='selected';} currentField+='>Множественный выбор</option>\
						</select>\
					</td>\
					<td>\
						<input type="checkbox" name="fields['+cnt+'][visible]" '; if(value.visible=='1') {currentField+='checked';} currentField+='>\
					</td>\
					<td>\
						<input type="checkbox" name="fields['+cnt+'][must_be]" '; if(value.must_be=='1') {currentField+='checked';} currentField+='>\
					</td>\
					<td class="rc_field_value_list">'+currentValues+'</td>\
					<td><i class="icon16 rc_icon delete rc_field_removefield"></i></td>\
				';
				currentField+='</tr>';
				fieldsHtml+=currentField;
				cnt++;
			});
			$(".rc_fields_table tbody").append(fieldsHtml);
			
			$(".rc_fields_table tbody").sortable( { 
				items: "> tr.field_tr",
				handle: ".rc_outer_sort",
				update: function(event, ui) {
				}
			});
			
			$(".rc_field_internaltable tbody").sortable( { 
				items: "> tr",
				handle: ".rc_inner_sort",
				update: function(event, ui) {
				}
			});
			
			$(".rc_add_ext_field").attr("data-count", cnt);
			
		} , "json");
	}
	
	$(".rc_ext_fields_form tr").live('click', function() {
		$(".rc_save_fields").addClass("rc_button_yellow");
	});
	
	$(".rc_ext_fields_form").submit(function(event) {
		$(".rc_saving_fields").slideDown();
		$.post('?plugin=recall&module=backend&action=saveextrafields', $(this).serialize(), function(JData) {
			$(".rc_saving_fields").slideUp();
			$(".rc_save_fields").removeClass("rc_button_yellow");
		} , "json");
		return false;
	});
	
	$(".rc_field_addmore").live('click', function() {
		$(this).parent().find('.rc_field_internaltable tbody').append('<tr><td><div class="rc_field_internalval"><a style="display:inline"><i class="icon16 sort rc_inner_sort"></i></a><input type="text" name="fields['+$(this).attr("data-cnt")+'][values][]" value=""><i class="icon16 rc_icon delete rc_field_internalval_del"></i></div></td></tr>');
		$(".rc_field_internaltable tbody").sortable( { 
			items: "> tr",
			handle: ".rc_inner_sort",
			update: function(event, ui) {
			}
		});
	});
	
	$(".rc_field_internalval_del").live('click', function() {
		$(this).parent().parent().parent().remove();
	});
	
	$(".rc_field_type_select").live('change', function() {
		var value = $(this).val();
		if(value == 'text' || value == 'range')
		{
			$(this).parent().parent().find(".rc_field_value_list").html('');
		}
		else
		{
			$(this).parent().parent().find(".rc_field_value_list").html('<input type="button" value="Добавить" class="rc_field_addmore" data-cnt="'+$(this).attr("data-cnt")+'">\
																			<table class="rc_field_internaltable" data-cnt="'+$(this).attr("data-cnt")+'"><tbody>\
																			</tbody></table>');
		}
	});
	
	$(".rc_add_ext_field").click(function() {
		var cnt = parseInt($(this).attr("data-count"));
		var currentField = '<tr class="field_tr">';
		currentField+='\
			<td><a style="display:inline"><i class="icon16 sort rc_outer_sort"></i></a></td>\
			<td><input type="text" name="fields['+cnt+'][name]" value="Новое поле"></td>\
			<td>\
				<select name="fields['+cnt+'][type]" class="rc_field_type_select" data-cnt="'+cnt+'">\
					<option value="text" selected>Текстовый</option>\
					<option value="range">Диапазон</option>\
					<option value="select">Одиночный выбор</option>\
					<option value="checkbox">Множественный выбор</option>\
				</select>\
			</td>\
			<td>\
				<input type="checkbox" name="fields['+cnt+'][visible]">\
			</td>\
			<td>\
				<input type="checkbox" name="fields['+cnt+'][must_be]">\
			</td>\
			<td class="rc_field_value_list"></td>\
			<td><i class="icon16 rc_icon delete rc_field_removefield"></i></td>\
		';
		currentField+='</tr>';
		
		$(".rc_fields_table").children("tbody").append(currentField);
			
		$(".rc_fields_table").children("tbody").sortable( { 
			items: "> tr.field_tr",
			handle: ".rc_outer_sort",
			update: function(event, ui) {
			}
		});
		$(this).attr("data-count", (cnt+1));
		$(".rc_save_fields").addClass("rc_button_yellow");
	});
	
	$(".rc_field_removefield").live('click', function() {
		if(confirm("Действительно удалить это дополнительное поле?")) {
			$(this).parent().parent().remove();
			$(".rc_save_fields").addClass("rc_button_yellow");
		}
	});
	
	loadFields();
});