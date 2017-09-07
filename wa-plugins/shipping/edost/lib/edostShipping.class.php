<?php
/*********************************************************************************
Обработчик расчета доставки калькулятора eDost.ru
Версия 2.0.1, 19.10.2015
Автор: ООО "Айсден"

Компании доставки и параметры расчета задаются в личном кабинете eDost.ru (требуется регистрация: http://edost.ru/reg.php)
*********************************************************************************/

include_once 'lang/ru.php';
if (isset($path) && file_exists(dirname($path).'/edost_const.php')) include_once 'edost_const.php';
if (defined('EDOST_FUNCTION') && EDOST_FUNCTION == 'Y') include_once 'edost_function.php';

define('DELIVERY_EDOST_SERVER', 'edost.ru'); // сервер расчета доставки
define('DELIVERY_EDOST_SERVER_ZIP', 'edostzip.ru'); // справочный сервер
define('DELIVERY_EDOST_SERVER_RESERVE', 'xn--d1ab2amf.xn--p1ai'); // дополнительный сервер (едост.рф)
define('DELIVERY_EDOST_SERVER_RESERVE2', 'edost.net'); // дополнительный сервер


class edostShipping extends waShipping {
	public static $result = null;
	public static $setting_key = array(
		'id' => '', 'ps' => '', 'host' => '', 'hide_error' => 'N', 'show_zero_tariff' => 'N',
		'map' => 'N', 'cod_status' => '', 'send_zip' => 'Y', 'hide_payment' => 'Y', 'sort_ascending' => 'N',
		'template' => 'N', 'template_format' => 'odt', 'template_block' => 'off', 'template_block_type' => 'none', 'template_cod' => 'td', 'template_autoselect_office' => 'N', 'autoselect' => 'Y',
		'admin' => 'Y', 'order_type' => 'Y',
	);

	// вывод подсказки
	public static function DrawHint($name, $data, $warning = false, $x = 4, $y = 3) {
		$protocol = (!empty($_SERVER['HTTPS']) || !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ? 'https' : 'http');
		return '
			<a class="edost_hint'.($warning ? ' edost_warning' : '').'" style="margin: '.$y.'px 0 0 '.$x.'px;" onclick="return false;" href="#">
				<img id="'.$name.'_hint" src="'.$protocol.'://edostimg.ru/img/hint/'.($warning ? 'attention' : 'hint').'.gif">
				<span>'.$data.'</span>
			</a>
		';
	}

	// собственная функция вывода в админке 'input'
	public static function settingInput($name, $params = array()) {

		$r = '';
		if (isset($params['title2'])) $r .= '<span class="title">'.$params['title2'].': </span>';
		$length = (!empty($params['length']) ? $params['length'] : 40);
		$r .= '<input id="'.$params['id'].'" name="'.$name.'" class="checkbox edost_value" type="text" value="'.str_replace('"', '&quot;', $params['value']).'" maxlength="40" style="width: '.($length*7).'px; min-width: '.($length*7).'px;" maxlength="'.$length.'">';
		if (isset($params['hint'])) $r .= self::DrawHint($params['id'], $params['hint'], !empty($params['warning']));
		if (isset($params['note'])) $r .= ' <span class="note">('.$params['note'].')</span>';
		return $r;

	}

	// собственная функция вывода в админке 'select'
	public static function settingSelect($name, $params = array()) {

		$r = '';
		if (isset($params['title2'])) $r .= '<span class="title">'.$params['title2'].' </span>';
		$r .= '<select id="'.$params['id'].'" name="'.$name.'" class="select edost_value" style="vertical-align: baseline;">';
		foreach ($params['options'] as $k => $v) $r .= '<option value="'.$k.'" '.($k == $params['value'] ? 'selected=""' : '').'>'.$v['title'].'</option>';
		$r .= '</select>';
		if (isset($params['hint'])) $r .= self::DrawHint($params['id'], $params['hint'], !empty($params['warning']));
		if (isset($params['note'])) $r .= ' <span class="note">('.$params['note'].')</span>';
		return $r;

	}

	// собственная функция вывода в админке 'checkbox' (в базу сохраняется Y/N + обход ошибки стандартного checkbox при сохранении дефолтного значения отличного от 0)
	public static function settingCheckbox($name, $params = array()) {

		$r = '<input name="'.$name.'" id="'.$params['id'].'_hidden" value="'.$params['value'].'" type="hidden">';
		$r .= '<input id="'.$params['id'].'" class="checkbox edost_value" type="checkbox"'.($params['value'] == 'Y' ? ' checked="checked"' : '').' onclick="var E = document.getElementById(this.id + \'_hidden\'); if (E) E.value = (this.checked ? \'Y\' : \'N\');">';
		if (isset($params['title2'])) $r .= ' <label class="checkbox" for="'.$params['id'].'">'.$params['title2'].'</label>';
		if (isset($params['hint'])) $r .= self::DrawHint($params['id'], $params['hint'], !empty($params['warning']), 4, 1);
		return $r;

    }

	// собственная функция вывода в админке скрытого поля (для служебных параметров модуля)
	public static function settingHidden($name, $params = array()) {

		$r = '<input id="'.$params['id'].'" type="hidden" class="edost_value" value="hide">';
		if (!empty($params['value'])) foreach ($params['value'] as $k => $v) $r .= '<input name="'.$name.'['.$k.']" type="hidden" value="'.$v.'">';
		return $r;

    }

	// собственная функция вывода в админке блока редактирования названий и описаний тарифов
	public static function settingTariff($name, $params = array()) {
//		edost_class::draw_data($name, $params);

		$setting_data = edost_class::$mess['EDOST_ADMIN_SETTING'];
		$setting_cookie = edost_class::GetCookie();

		// загрузка тарифов, включенных в личном кабинете eDost
		$data = edost_class::RequestData('active=Y', 'delivery', false, $params['instance']);
		$error = (isset($data['error']) ? edost_class::GetEdostError($data['error']) : '');
		$data = (!empty($data['data']) ? $data['data'] : array());
		$data = array('0' => array('profile' => 0, 'company' => edost_class::$mess['EDOST_DELIVERY_ERROR']['tariff_zero'], 'name' => '', 'description' => '')) + $data;
		$tariff_count = count($data);
		foreach ($data as $k => $v) {
			$data[$k]['title'] = edost_class::GetTitle($v);
			$data[$k]['default'] = $data[$k]['title'];
			$data[$k]['description'] = '';
		}

		// совмещение тарифов из личного кабинета с тарифами из админки
		foreach ($params['value'] as $k => $v)
			if (isset($data[$k])) {
				$data[$k]['title'] = $v['title'];
				$data[$k]['description'] = $v['description'];
			}
			else {
				$data[$k] = $v;
				$data[$k]['hide'] = true;
			}
//		edost_class::draw_data('data', $data);

		$r = '<input id="'.$params['id'].'" type="hidden" class="edost_value" value="">';

		if (!empty($error)) $r .= '<div class="error" style="padding-top: 8px;">'.$error.'</div>';

		if ($tariff_count > 5) $r .= '
			<div style="padding-top: 15px;">
				<span id="edost_tariff_show" class="edost_link" style="color: #F00; display: '.($setting_cookie['setting_tariff_show'] == 'Y' ? 'none' : 'block').'" onclick="$(\'#edost_tariff\').show(); $(\'#edost_tariff_show\').hide(); $(\'#edost_tariff_hide\').show(); edost_UpdateCookie(\'setting_tariff_show\', \'Y\');">'.$setting_data['module_tariff_show'].'</span>
				<span id="edost_tariff_hide" class="edost_link" style="color: #F88; display: '.($setting_cookie['setting_tariff_show'] != 'Y' ? 'none' : 'block').'" onclick="$(\'#edost_tariff\').hide();  $(\'#edost_tariff_show\').show(); $(\'#edost_tariff_hide\').hide(); edost_UpdateCookie(\'setting_tariff_show\', \'N\');">'.$setting_data['module_tariff_hide'].'</span>
			</div>
		';

		$r .= '<div id="edost_tariff" style="display: '.($tariff_count <= 5 || $setting_cookie['setting_tariff_show'] == 'Y' ? 'block' : 'none').';">';
		foreach ($data as $k => $v) {
			if ($k == 0) $r .= '<div style="padding-top: 15px; font-size: 14px; font-weight: bold; color: #888;">'.$setting_data['tariff_zero'].' '.self::DrawHint('setting_module_tariff_zero', $setting_data['tariff_zero_hint'], false, 4, -1).'</div>';
			$r .= '
				<div class="edost_tariff" id="edost_tariff_'.$k.'_div" class="checkbox" style="margin-top: '.(isset($v['company_id']) && $c !== 0 && $c != $v['company_id'] ? 10 : 4).'px;'.(!empty($v['hide']) ? ' display: none;' : '').'">
					<input id="edost_title_'.$k.'" name="'.$name.'['.$k.'][title]" class="edost_title" value="'.str_replace('"', '&quot;', $v['title']).'" type="text" style="width: 400px;" maxlength="100">
					<input id="edost_description_'.$k.'" name="'.$name.'['.$k.'][description]" value="'.str_replace('"', '&quot;', $v['description']).'" type="text" style="width: 500px;" maxlength="1000">
					<input id="edost_default_'.$k.'" value="'.(!empty($v['default']) ? $v['default'] : '').'" type="hidden">
				</div>';
			if ($k == 0 && $tariff_count > 1) {
				$c = 0;
				$r .= '
				<div style="padding-top: 10px; font-size: 14px; color: #888;">
					<div style="display: inline-block; width: 410px;">'.$setting_data['tariff_title'].' '.self::DrawHint('setting_module_tariff_title', $setting_data['tariff_title_hint'], false, 4, -1).'</div>
					<div style="display: inline-block;">'.$setting_data['tariff_description'].'</div>
				</div>';
			}
			else $c = (isset($v['company_id']) ? $v['company_id'] : 0);
		}
		if ($tariff_count > 1) $r .= '
			<div style="width: 915px; padding-top: 5px;">
				<span class="edost_link" style="float: right; color: #00F;" onclick="edost_SetDefault()">'.$setting_data['module_tariff_default'].'</span>
			</div>
		';
		$r .= '</div>';

		$r .= '
			<style>
				span.error, div.error { padding-top: 5px; color: #F00; font-weight: bold; font-size: 14px; }
				span.note { color: #888; font-size: 13px; vertical-align: middle; }
				span.edost_link { cursor: pointer; font-size: 13px; font-weight: bold; }

				div.value label.checkbox, span.title { font-weight: bold; font-size: 13px; vertical-align: middle; }
				div.value input[type="checkbox"]:checked + label { color: #000; }
				div.value input[type="checkbox"] + label { color: #888; }

				a.edost_hint { cursor: default; position: absolute; text-decoration: none; }
				a.edost_hint:hover { z-index: 100; }
				a.edost_hint span { display: none; }
				a.edost_hint:hover span { background: #dff4ff; border-width: 1px 1px 1px 4px; border-color: #01a0f9; border-style: solid; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1); color: #000; font-size: 13px; font-weight: normal; display: block; position: absolute; width: 600px; left: 20px; top: 0px; padding: 8px; }
				a.edost_warning:hover span { background: #FEE; border-width: 1px 1px 1px 4px; border-color: #F00; border-style: solid; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1); color: #000; font-size: 13px; font-weight: normal; display: block; position: absolute; width: 600px; left: 20px; top: 0px; padding: 8px; }
			</style>

			<script type="text/javascript">
				function edost_UpdateCookie(name, value) {
					var key = ["setting_tariff_show"];
					var ar = document.cookie.match("(^|;) ?edost_admin=([^;]*)(;|$)");
					ar = (ar ? decodeURIComponent(ar[2]) : "");
					ar = ar.split("|");
					var s = "";
					for (var i = 0; i < key.length; i++) {
						if (i > 0) s += "|";
						if (name == key[i]) s += value;
						else if (ar[i] != undefined) s += ar[i];
					}
					document.cookie = "edost_admin=" + s + "; path=/; expires=Thu, 01-Jan-2016 00:00:01 GMT";
				}

				function edost_SetDefault() {
					var ar = $(".edost_title");
					for (var i = 0; i < ar.length; i++) {
						var id = ar[i].id.split("_");
						ar[i].value = $("#edost_default_" + id[2])[0].value;
					}
				}

				// удаление сдвига для поля "name"
				var ar = $(".edost_value");
				for (var i = 0; i < ar.length; i++)
					if (ar[i].type == "hidden" && ar[i].value == "hide") {
						var E = $(ar[i]).parent().parent();
						if (E[0] && E[0].className == "field") E[0].style.display = "none";
					}
					else {
						var E = $(ar[i]).parent();
						if (!E[0]) continue;
						E[0].style.marginLeft = "0";
						E = E.parent().find(".name")[0];
						if (E) E.style.width = "0";
					}
			</script>';

		return $r;

    }

/*
	// какие поля адреса выводить
	public function requestedAddressFields() {
		return array(); // все
//		return false; // нет полей
	}

	// дополнительные поля - работают примерно, как поля для адреса
	public function customFields($order) {
		return array();
	}
*/

	public function calculate($request = null, $address = null, $items = null) {
//$items = null;
		$config = $this->GetSettings();
        if(!$address) {
            $address = $this->getAddress();
        }

        //if(!$items) {
            
        //}

		$key = $this->key;
        

//		$ar = getAddress();
//		edost_class::draw_data('address', $ar);

//		edost_class::draw_data('config', $config);
//		edost_class::draw_data('address', $address);
//		edost_class::draw_data('items', $items);
//		edost_class::draw_data('_SESSION', $_SESSION);
//		edost_class::draw_data('_POST', $_POST);
//		edost_class::draw_data('_SERVER', $_SERVER);
//		die();

		// тип запроса
        if(!$request) {
            $request = '';
    		if ($config['order_type'] != 'N' && !empty($_SERVER['REQUEST_URI'])) {
    			$s = $_SERVER['REQUEST_URI'];
    			if (strpos($s, 'shop/?module=order') !== false) {
    				if (isset($_GET['action']) && $_GET['action'] == 'save') $request = 'admin_save'; // сохранение заказа
    				else $request = (isset($_POST['customer']) ? 'admin_post' : 'admin'); // пересчет
    			}
    			else if (strpos($s, 'checkout') !== false) {
    				if (!empty($_POST['step']) && $_POST['step'] == 'confirmation' || strpos($s, 'checkout/confirmation') !== false) $request = 'order_confirmation'; // подтверждение заказа
    				else $request = 'order'; // страница оформления заказа
    			}
    			else if (strpos($s, 'data/shipping') !== false) {
    				$request = 'order'; // пересчет доставки на странице оформления заказа
    			}
    		}
        }

		$config['request'] = $request;
//		edost_class::draw_data('request', $request.', uri: '.$_SERVER['REQUEST_URI']);

        if(!$items) {
            $items = $this->getItems();
    		if ($config['order_type'] != 'N') {
    			// получение списка товаров (исправление ошибки: webasyst не передает в массиве 'items' id товаров + при сохранении заказа в админке приходит левый адрес !!!)
    			$items_original = $items;
    			$items = array();
    			if (in_array($request, array('order', 'order_confirmation'))) {
    				$ar = new shopCart();
    				$ar = $ar -> items();
    				if (!empty($ar)) foreach ($ar as $v) $items[] = array('id' => $v['product_id'], 'quantity' => $v['quantity'], 'price' => $v['price'], 'currency' => $v['currency'], 'sku_id' => $v['sku_id']);
    //				edost_class::draw_data('shopCart', $ar);
    			}
    			else if ($request == 'admin') {
    				foreach ($items_original as $v) $items[] = array('id' => $v['id'], 'quantity' => $v['quantity'], 'price' => $v['item']['price'], 'currency' => 'RUB', 'sku_id' => $v['item']['sku_id']); // 'currency' => $v['currency'] - пишет валюту товара 'EUR', но цену передает в рублях !!!
    			}
    			else if ($request == 'admin_post' && !empty($_POST['items'])) {
    				$currency = (!empty($_POST['edost_currency']) ? $_POST['edost_currency'] : 'RUB');
    				foreach ($_POST['items'] as $v) $items[] = array('id' => $v['product_id'], 'quantity' => $v['quantity'], 'price' => $v['price'], 'currency' => $currency, 'sku_id' => $v['sku_id']);
    			}
    			else if ($request == 'admin_save') {
    				if (isset($_POST['customer']['address.shipping'])) $address = $_POST['customer']['address.shipping'];
    				foreach ($items_original as $v) $items[] = array('id' => $v['product_id'], 'quantity' => $v['quantity'], 'price' => $v['price'], 'currency' => 'RUB', 'sku_id' => $v['sku_id']);
    			}
    			else {
    				foreach ($items_original as $v) if (!empty($v['id']) && !empty($v['quantity']) && isset($v['price']))
    					$items[] = array('id' => $v['id'], 'quantity' => $v['quantity'], 'price' => $v['price'], 'currency' => 'RUB', 'sku_id' => isset($v['sku_id']) ? $v['sku_id'] : '');
    			}
    //			edost_class::draw_data($request.' items modified', $items);
    		}
        }


		if (in_array($request, array('admin', 'admin_post', 'admin_save'))) {
			if ($config['admin'] != 'Y') $request = ''; // отключение расширенного редактирование заказа в админке
			$config['NAME_NO_CHANGE'] = true; // не менять названия при форматировании тарифов
		}


		// расчет доставки
		$data = $this->EdostCalculate($config, $address, $items);
//		edost_class::draw_data('data', $data);

		if (!empty($data['hide'])) return false; // отключение модуля доставки по команде из пользовательских функций


		if ($config['order_type'] == 'N') $format = array();
		else {
			// форматирование тарифов
			$format = edost_class::FormatTariff($data);

			// добавление нулевого тарифа
			if (!empty($format['data']['general']['tariff'])) foreach ($format['data']['general']['tariff'] as $v) if (isset($v['id']) && $v['id'] === 0) $data['data'][0] = $v;
		}
//		edost_class::draw_data('format', $format);

		if (empty($data['data'])) return false; // отключение модуля доставки, если нет доступных тарифов


		$cod = false;
		$sign = edost_class::$mess['EDOST_DELIVERY_SIGN'];
		$office_in_address = (isset($format['office_in_address']) ? $format['office_in_address'] : false);
		$ico_path = wa()->getRootUrl().'wa-plugins/shipping/edost/img/';
		if ($request == 'order') $format['ico_path'] = $ico_path;


		// модуль наложенного платежа (edostcod)
		$edost_payment = false;
		if (in_array($request, array('order_confirmation', 'admin'))) {
			$ar = new shopPluginModel();
			$ar = $ar->listPlugins('payment');
			foreach ($ar as $k => $v) if ($v['plugin'] === 'edostcod') { $edost_payment = $k; break; }
//			edost_class::draw_data('payment', $ar);
		}


		// данные для выпадающего списка в админке
		if (in_array($request, array('admin', 'admin_post'))) {
			$ar = array();
			if (!empty($format['data'])) foreach ($format['data'] as $f_key => $f) if (!empty($f['tariff'])) {
				if ($f['head'] != '') $ar[] = array('head' => $f['head']);
				foreach ($f['tariff'] as $k => $v) if (isset($v['id']) && !isset($v['hide'])) {
					$v['id'] = $key.'.'.$v['id'];
					$v['title'] = edost_class::GetTitle($v, true);
					if (isset($v['head'])) unset($v['head']);
					if (isset($v['office_mode']) && empty($v['office_map'])) unset($v['office_mode']);
					$ar[] = $v;
				}
			}
			$ar = edost_class::GetJson($ar, array('head', 'id', 'title', 'price', 'price_formatted', 'pricecash', 'pricecash_formatted', 'priceinfo_formatted', 'transfer_formatted', 'checked', 'office_id', 'office_mode', 'office_address_full', 'error'), true, false);
			$json = '{"format": '.$ar.', "ico_path": "'.$ico_path.'"'
				.(isset($format['map_json']) ? ', '.$format['map_json'] : '')
//				.(isset($format['address_original']) ? ', "address_original": "'.str_replace('"', '&quot;', $format['address_original']).'"' : '')
				.(!empty($format['warning']) ? ', "warning": "'.$format['warning'].'"' : '')
				.'}';
		}


		// вывод данных расчета через ошибку (вместо массива с тарифами возвращается строка)
		if ($request == 'admin_post') return $json;


		// вывод скрипта для админки
		if ($request == 'admin') {
?>
<style>
	table.edost td { margin: 0; padding: 0; }
	div.edost_main, div.edost_office_window, div.edost_main table { font-family: arial; line-height: normal; }
	div.edost_main table, div.edost_office_window table { margin: 0; }
	div.edost_main table td, div.edost_office_window table.edost_office_head td { border: 0px; padding: 0px; }
	td.edost_office_head_delimiter { border-color: #ccc !important; border-style: solid !important; border-width: 0 1px 0 0 !important; }
	span.edost_format_link { cursor: pointer; color: #A00; font-size: 14px; font-weight: bold; }
</style>

<script>

	function edost_InsertJS() {
		var s = $.order_edit.updateTotal.toString();

		if (s.indexOf("/* edost */") > 0) return false;

		s = s.replace("var data = {};", "var data = {};    /* edost */ if (ajax) $('#edost_loading').css('display', 'inline'); data.edost_currency = $.order_edit.options.currency; var edost_selected = $('#shipping_methods').val();");
		s = s.replace("data.discount = discount;", "data.discount = discount; var s = ''; for (var i = 0; i < data.items.length; i++) s += data.items[i].product_id + '|' + data.items[i].quantity + '|' + data.items[i].price + '|' + data.items[i].sku_id + '|'; if (edost_items !== false && edost_items != s) edost_city = 'update'; edost_items = s;");
		s = s.replace("var found", "if (el_selected == null) el_selected = '';    var found");
		s = s.replace("if (found) {", "$('#edost_loading').css('display', 'none'); el_selected = edost_InsertData('parse_error', edost_selected) || el_selected || false;  if (found && !shipping_methods[el_selected]) { el.val(el_selected); found = false; }    if (found) {");

		$.order_edit.updateTotal = eval("(" + s + ")");
		return true;
	}

	function edost_InsertHead(map) {

		var E = document.head;
		var date = Math.round(new Date() / 86400000);
		var protocol = (document.location.protocol == 'https:' ? 'https://' : 'http://')

		var E2 = document.getElementById('edost_office_css');
		if (!E2) {
			var E2 = document.createElement("LINK");
			E2.id = "edost_office_css";
			E2.href = protocol + "edostimg.ru/shop/office.css?a=" + date;
			E2.type = "text/css";
			E2.rel = "stylesheet";
			E.appendChild(E2);
		}

		if (!map) return;

		var E2 = document.getElementById('edost_office_js');
		if (!E2) {
			var E2 = document.createElement("SCRIPT");
			E2.id = "edost_office_js";
			E2.src = protocol + "edostimg.ru/shop/office.js?a=" + date;
			E2.type = "text/javascript";
			E2.charset = "utf-8";
			E.appendChild(E2);
		}

	}

	function edost_InsertData(data, selected) {

		var r = false;
		edost_shipping = false;

		var E = $("#shipping_methods");
		if (!E[0]) return r;

		// получение данных из поля с ошибкой
		if (data === 'parse_error') {
			data = '';
			var ar = E.find('option');
			for (var i = 0; i < ar.length; i++) if (ar[i].value == '<?php echo $key;?>' && $(ar[i]).data('error')) { data = $(ar[i]).data('error'); break; }
		}

		if (!selected) {
			var selected = E.find('option:selected');
			selected = (selected[0] ? selected.val() : '');
		}

		E.find("option[value^='<?php echo $key;?>.']").remove();
		E.find("option[value='<?php echo $key;?>']").remove();

		r = (E.find("option[value='" + selected + "']")[0] ? selected : r);

		if (data == '') return r;

		var E2 = $('#edost_office_data');
		if (E2[0]) E2[0].value = data;

		data = (window.JSON && window.JSON.parse ? JSON.parse(data) : eval('(' + data + ')'));

//		if (data.address_original != undefined) edost_address = data.address_original;

		var s = (data.warning || '') + (data.format[0].error || '');
		$('#edost_warning').html(s != '' ? '<div style="padding: 5px 0;">' + s + '</div>' : '');

		if (data.format == undefined || data.format.length == 0) return r;

		edost_InsertHead(data.tariff != undefined ? true : false);

		// извлечение тарифов других модулей, чтобы потом добавить их в конец списка
		E.find("option[value='']").remove();
		s2 = '';
		var ar = E.find('option');
		for (var i = 0; i < ar.length; i++) {
			var v = $(ar[i]);
			s2 += '<option value="' + v.val() + '"' + (v.data('error') ? ' data-error="' + v.data('error') + '"' : '') + (v.data('rate') ? ' data-rate="' + v.data('rate') + '"' : '');
			if (v.val() == selected) {
				s2 += ' selected="selected"';
				r = selected;
			}
			s2 += '>' + v.text() + '</option>'
		}

		// формирование общего списка с тарифами
		var s = '';
		var optgroup = false;
		for (var i = 0; i < data.format.length; i++) {
			var v = data.format[i];
			if (v.head !== undefined) {
				if (optgroup) s += '</optgroup>';
				optgroup = true;
				s += '<optgroup label="' + v.head + '">';
				continue;
			}
			if (v.id == selected || v.checked) r = v.id;
			s += '<option value="' + v.id + '" data-rate="' + v.price + '"' + (v.id == selected || v.checked ? ' selected="selected"' : '');
			if (v.pricecash != undefined) s += ' data-edost_pricecash="' + v.pricecash + '"';
			if (v.transfer_formatted != undefined) s += ' data-edost_transfer="' + v.transfer_formatted + '"';
			if (v.priceinfo_formatted != undefined) s += ' data-edost_priceinfo="' + v.priceinfo_formatted + '"';
			if (v.office_address_full != undefined) s += ' data-edost_address="' + v.office_address_full + '"';
			if (v.office_mode != undefined) s += ' data-edost_office_mode="' + v.office_mode + '"';
			if (v.office_id != undefined) s += ' data-edost_office_id="' + v.office_id + '"';
			if (v.price_formatted === '0') v.price_formatted = '<?php echo $sign['free'];?>';
			if (v.pricecash_formatted === '0') v.pricecash_formatted = '<?php echo $sign['free'];?>';
			s += '>' + v.title + (v.price_formatted != undefined ? ' - ' + v.price_formatted : '') + (v.pricecash_formatted != undefined ? ' (' + v.pricecash_formatted + ')' : '');
			s += '</option>';
		}
		s += s2;
		if (optgroup) s += '</optgroup>';
		E.html('<option value=""></option>' + s);

		return r;

	}

	function edost_ShippingChange(update) {

		if (update == undefined) update = true;

		var shop_address = $("input[name='customer[address.shipping][street]']")[0];
		if (shop_address) if (shop_address.value != '' && shop_address.value.indexOf(', <?php echo $sign['code'];?>:') == -1) edost_address = shop_address.value;

		var o = $("#shipping_methods option:selected");
		var value = o.val();

		if (value === edost_shipping) return;
		edost_shipping = value;

		var data = (o.data() || {});
		var rate = (data.rate || 0);
		var a = (data.edost_address == undefined ? false : true);

		// вывод адреса пункта выдачи в отдельном поле
		var office_address = $("#edost_office_address")[0];
		if (office_address) {
			office_address.style.display = (a ? 'block' : 'none');
			var s = '';
			if (a) {
				var s2 = data.edost_address.split(', <?php echo $sign['code'];?>: ');
				if (s2[1] == undefined)	s = '<b style="color: #F00;"><?php echo $sign['admin_office_no'];?></b>';
				else {
					s = '<b style="color: #00A;">' + s2[0].replace(': ', ':</b><br>').replace(', <?php echo $sign['tel'];?>:', '<br>').replace(', <?php echo $sign['schedule'];?>:', '<br>');
					var code = s2[1].split('/');
					if (code[0] != '' && code[0] != 'S' && code[0] != 'T') s += '<br><b><?php echo $sign['code'];?>: ' + code[0] + '</b>';
					if (data.edost_office_id) s += '<br><a class="edost_link" href="http://www.edost.ru/office.php?c=' + data.edost_office_id + '" target="_blank"><?php echo $sign['map'];?></a>';
				}
			}
			office_address.innerHTML = s;
		}
		if (shop_address) {
			shop_address.style.display = (!a ? 'block' : 'none');
			shop_address.value = (a ? data.edost_address : edost_address);
		}

		// ссылка на карту
		var s = '';
		if (data.edost_office_mode) s += '<span style="cursor: pointer; color: #A00; font-size: 14px; font-weight: bold;" onclick="edost_office.window(\'' + data.edost_office_mode + '\');"><?php echo $sign['admin_office_get'];?></span>';
		$("#edost_link").html(s != '' ? '<div style="padding-top: 5px;">' + s + '</div>' : '');

		// открыть карту для тарифов с офисами
		value = (value ? value.split('.') : '');
		if (value[1] == 'shop' || value[1] == 'office' || value[1] == 'terminal') edost_office.window(value[1], true);

		// вывод pricecash и priceinfo
		var error = false;
		var s = '';
		<?php if ($edost_payment !== false) { ?>
		if (edost_shipping && $("#payment_methods").val() == '<?php echo $edost_payment;?>') {
			if (value[0] == '<?php echo $key;?>' && data.edost_pricecash != undefined && data.edost_pricecash >= 0) {
				rate = data.edost_pricecash;
				if (data.edost_transfer) s += '<div style="padding-top: 5px; color: #F00;"><?php echo str_replace('%transfer%', "' + data.edost_transfer + '", $sign['transfer']);?></div>';
			}
			else {
				rate = 0;
				error = '<span style="padding: 2px 8px; background: #F00; color: #FFF;"><?php echo $sign['admin_no_cod'];?></span>';
			}
		}
		<?php } ?>
		if (data.edost_priceinfo) s += '<div style="padding-top: 5px;"><?php echo str_replace('%price_info%', "' + data.edost_priceinfo + '", $sign['admin_priceinfo']);?></div>';
		$("#edost_price").html(s);

		// вывод цены и ошибки
		if (update) $("#shipping-rate").val($.order_edit.formatFloat(rate));
		if (o.data("error") || error !== false) {
			$("#shipping-rate").addClass("error");
			$("#shipping-info").html('<div class="error" style="padding-top: 10px;">' + (error !== false ? error : o.data('error')) + '</div>').show();
		} else {
			$("#shipping-rate").removeClass("error");
			$("#shipping-info").empty().hide();
		}
		if (update) $.order_edit.updateTotal(false);

	}

	function edost_SetOffice(profile, id, cod, mode) {
//		alert(profile + ' - ' + id + ' - ' + cod + ' - ' + mode);

		edost_office.map.balloon.close();
		edost_office.window('close');

		var E = $("input[name='customer[address.shipping][street]']")[0];
		if (!E) return;

		if (id == undefined) {
			E.value = '';
			return;
		}

		var s = '';
		for (var i = 0; i < edost_office.data.length; i++) for (var i2 = 0; i2 < edost_office.data[i].point.length; i2++) {
			var p = edost_office.data[i].point[i2];
			if (p.id == id) s += p.address + ', <?php echo $sign['code'];?>: /' + id + '/' + edost_office.data[i].to_office + '/' + profile;
		}
		E.value = s;

		edost_city = 'update';
		$.order_edit.updateTotal();

	}

	$(document).bind('ajaxComplete', function(event, xhr, settings) {
//		alert('ajaxComplete ' + settings.url);

		var E = $('#shipping_methods');
		if (!E[0]) return;

		edost_InsertJS();

		if (E[0].onchange != edost_ShippingChange) {
			E.unbind('change');
			E[0].onchange = edost_ShippingChange;
		}

		var E = $('#payment_methods')[0];
		if (E) E.onchange = function() { edost_shipping = false; edost_ShippingChange(); };

		if (settings.url.indexOf('&action=edit') > 0) $.order_edit.updateTotal(false); // открытие страницы редактирования заказа
		else if (settings.url.indexOf('&action=total') <= 0) return; // пересчет итого

		var country = ($("[name='customer[address.shipping][country]']").val() || '');
		var region = ($("[name='customer[address.shipping][region]']").val() || '');
		var city = ($("input[name='customer[address.shipping][city]']").val() || '');
		var zip = ($("input[name='customer[address.shipping][zip]']").val() || '');

		if (edost_country != country || edost_region != region || edost_city != city<?php echo ($config['send_zip'] == 'Y' ? ' || edost_zip != zip' : '');?>) {
			// расчет доставки при изменении страны, региона, города или индекса
			edost_country = country;
			edost_region = region;
			edost_city = city;
			edost_zip = zip;
			edost_shipping = false;
			edost_ShippingChange();
		}
		else if (!edost_shipping) edost_ShippingChange(false);

/*
		var E = $("input[name='customer[address.shipping][city]']")[0];
		if (E) E.onblur = edost_ShippingChange;

		<?php if ($config['send_zip'] == 'Y') { ?>
		var E = $("input[name='customer[address.shipping][zip]']")[0];
		if (E) E.onblur = edost_ShippingChange;
		<?php } ?>

		var E = $("input[name='customer[address.shipping][street]']")[0];
		if (E) E.onblur = edost_ShippingChange;
*/
	});

	$('#shipping_methods').after(
		'<img id="edost_loading" style="display: none; vertical-align: middle; padding-left: 5px;" src="<?php echo $ico_path;?>loading_small.gif" width="20" height="20" border="0">' +
		'<div id="edost_link"></div>' +
		'<div id="edost_warning" class="error"></div>' +
		'<div id="edost_price" style="font-size: 12px;"></div>' +
		'<input autocomplete="off" id="edost_office_data" value="" type="hidden">'
	);
	$("input[name='customer[address.shipping][street]']").after('<div id="edost_office_address" style="color: #000; line-height: normal;"></div>');

	var edost_shipping = false;
	var edost_items	= false;
	var edost_country = ($("[name='customer[address.shipping][country]']").val() || '');
	var edost_region = ($("[name='customer[address.shipping][region]']").val() || '');
	var edost_city = ($("input[name='customer[address.shipping][city]']").val() || '');
	var edost_zip = ($("input[name='customer[address.shipping][zip]']").val() || '');
	var edost_address = '';
	edost_InsertData('<?php echo $json;?>');

</script>
<?php
		}


		if (in_array($request, array('order', 'order_confirmation'))) {
			// загрузка из сессии данных заказа
			$order_data = wa()->getStorage()->get('shop/checkout');
//			edost_class::draw_data('order_data', $order_data);

			// если способ доставки не выбран, включается автовыбор
			if (!isset($order_data['shipping'])) $format['autoselect'] = true;

			// сохранение адреса офиса в поле 'street' (в контактные данные зарегистрированного покупателя или в сессию для нового покупателя)
			if (isset($format['shop_address'])) {
				if (wa()->getUser()->isAuth()) $contact = wa()->getUser();
				else $contact = (isset($order_data['contact']) ? $order_data['contact'] : false);

				if ($contact) {
					$s = $contact->get('address.shipping');
					if (!$s) $s = $contact->get('address');
					$s[0]['data']['street'] = $format['shop_address'];
					$s[0]['value'] = $format['shop_address'].', '.$s[0]['data']['city']; // у незарегистрированного пользователя 'value' автоматически не обновляется !!!
					$contact->set('address.shipping', $s[0]);

					if (wa()->getUser()->isAuth()) $contact->save();
					else $order_data['contact'] = $contact;
				}
			}

			// сохранение в сессию данных расчета для использования в модуле наложенного платежа
			$ar = array();
			foreach ($data['data'] as $k => $v) if ($k != 0) {
				$ar[$k] = array('price' => $v['price'], 'pricecash' => $v['pricecash'], 'transfer' => $v['transfer']);
				if (isset($v['priceoffice'])) $ar[$k]['priceoffice'] = $v['priceoffice'];
			}
			$order_data['edost']['tariff'] = $ar;

			// сохранение в сессию строк для использования в модуле наложенного платежа
			$order_data['edost']['sign'] = array();
			$ar = array('code', 'codplus', 'transfer', 'codtotal');
			foreach ($ar as $v) $order_data['edost']['sign'][$v] = $sign[$v];

			$save_order_data = true;
		}

		// передача в шаблон оформления заказа форматированных тарифов
		if ($request == 'order') {
			$format['plugin'] = 'edost';
			$format['shipping_id'] = $key;

			$ar = $address;
			foreach ($ar as $k => $v) $ar[$k] = str_replace('"', '', $v);
			$format['address'] = $ar;

			wa()->getView()->assign('edost_format', $format);
		}

		if ($request == 'order_confirmation') {
			// если в заказе выбран наложенный платеж
			if (isset($order_data['payment']) && $order_data['payment'] == $edost_payment) $cod = true;

			// удаление скобок из названия выбранного тарифа
			if (!empty($order_data['shipping']['name'])) {
				$s = trim($order_data['shipping']['name']);
				if (substr($s, 0, 1) == '(') $order_data['shipping']['name'] = substr($s, 1, -1);
			}
		}

		// сохранение в сессию данных заказа
		if (!empty($save_order_data)) wa()->getStorage()->set('shop/checkout', $order_data);


		// результирующий список тарифов
		$services = array();
//		$i = false;
		foreach ($data['data'] as $k => $v) {
//			if ($i === false) $i = $k;

			if (!empty($v['priceoffice']) && !empty($office_in_address) && $v['profile'] == $office_in_address['profile'] && isset($v['priceoffice'][$office_in_address['type']])) {
				$p = $v['priceoffice'][$office_in_address['type']];
				$v['price'] = $p['price'];
				$v['priceinfo'] = $p['priceinfo'];
				$v['pricecash'] = $p['pricecash'];
			}

			$services[$k] = array(
				'id' => $v['profile'],
				'name' => (!empty($v['title']) ? $v['title'] : edost_class::GetTitle($v)),
				'rate' => ($cod && isset($v['pricecash']) && $v['pricecash'] >= 0 ? $v['pricecash'] : $v['price']),
				'description' => '',
				'est_delivery' => null,
				'currency' => 'RUB',
			);
		}
//		if ($request == 'order' && $i !== false) $services[$k]['format'] = $format; // можно использовать для пересчета доставки на странице оформления заказа

//		edost_class::draw_data('services', $services);

		return $services;

	}


	// получение местоположения стандарта edost по адресу webasyst
	public static function GetEdostLocation($address) {

		$r = array();

		// поиск названия страны по коду
		$country_id = (isset($address['country']) ? $address['country'] : ''); // код страны ('rus' - Россия)
		if ($country_id === '') return false;
		if ($country_id === 'rus') $r['country'] = 0;
		else {
			$v = new waCountryModel();
			$country = $v->name($country_id);
			// $ar = $v -> all();  foreach ($ar as $c) echo '"'.$c['name'].'", ';  // все страны
			if ($country == '') return false;

			// перевод названий стран в формат edost (только отличия)
			$country_edost = array('Россия', 'Антильские острова', 'Доминиканская респ.', 'Китайская Народная Республика', 'Зеленого Мыса острова (Кабо-Верде)', 'Конго, Демократическая респ.', 'Корея, Северная', 'Корея, Южная', 'Кыргызстан', 'Мальдивские острова', 'Нидерланды (Голландия)', 'Мьянма', 'США', 'Центральная Африканская Респ.', 'Чехия', 'ЮАР', 'Гонконг', 'Тайвань', 'Макао', 'Папуа-Новая Гвинея', 'Майотта', 'Кука острова', 'Туркс и Кайкос', 'Американское Самоа', 'Самоа', 'Микронезия', 'Сент-Винсент', 'Сент-Китс', 'Гвинея Экваториальная', 'Валлис и Футуна острова');
			$country_shop = array('Российская Федерация', 'Антильские Острова (Нидерландские)', 'Доминиканская Республика', 'Китай', 'Кабо-Верде', 'Конго, Демократическая Республика', 'Корейская Народно-Демократическая Республика', 'Корея, Республика', 'Киргизия (Кыргызстан)', 'Мальдивы', 'Нидерланды', 'Мьянма (Бирма)', 'Соединенные Штаты Америки (США)', 'Центральноафриканская Республика', 'Чешская Республика', 'Южно-Африканская Республика', 'Сянган (Гонгонг)', 'Тайвань (провинция Китая)', 'Аомынь (Макао)', 'Папуа — Новая Гвинея', 'Маоре (Майотта)', 'Кука, Острова', 'Теркс и Кайкос', 'Восточное Самоа', 'Западное Самоа', 'Микронезия (Федеративные Штаты Микронезии)', 'Сент-Винсент и Гренадины', 'Сент-Китс и Невис', 'Экваториальная Гвинея', 'Уоллис и Футуна');
			$i = array_search($country, $country_shop);
			if ($i !== false) $country = $country_edost[$i];

			// определение кода страны стандарта edost
			$ar = array(0 => "Россия", 1 => "Австралия", 2 => "Австрия", 3 => "Азербайджан", 4 => "Албания", 5 => "Алжир", 6 => "Американское Самоа", 7 => "Ангилья", 8 => "Англия", 9 => "Ангола", 10 => "Андорра", 11 => "Антигуа и Барбуда", 12 => "Антильские острова", 13 => "Аргентина", 14 => "Армения", 15 => "Аруба", 16 => "Афганистан", 17 => "Багамские острова", 18 => "Бангладеш", 19 => "Барбадос", 20 => "Бахрейн", 21 => "Беларусь", 22 => "Белиз", 23 => "Бельгия", 24 => "Бенин", 25 => "Бермудские острова", 26 => "Болгария", 27 => "Боливия", 28 => "Бонайре", 29 => "Босния и Герцеговина", 30 => "Ботсвана", 31 => "Бразилия", 32 => "Бруней", 33 => "Буркина Фасо", 34 => "Бурунди", 35 => "Бутан", 36 => "Валлис и Футуна острова", 37 => "Вануату", 38 => "Великобритания", 39 => "Венгрия", 40 => "Венесуэла", 41 => "Виргинские острова (Британские)", 42 => "Виргинские острова (США)", 43 => "Восточный Тимор", 44 => "Вьетнам", 45 => "Габон", 46 => "Гаити", 47 => "Гайана", 48 => "Гамбия", 49 => "Гана", 50 => "Гваделупа", 51 => "Гватемала", 52 => "Гвинея", 53 => "Гвинея Экваториальная", 54 => "Гвинея-Бисау", 55 => "Германия", 56 => "Гернси (Нормандские острова)", 57 => "Гибралтар", 58 => "Гондурас", 59 => "Гонконг", 60 => "Гренада", 61 => "Гренландия", 62 => "Греция", 63 => "Грузия", 64 => "Гуам", 65 => "Дания", 66 => "Джерси (Нормандские острова)", 67 => "Джибути", 68 => "Доминика", 69 => "Доминиканская респ.", 70 => "Египет", 71 => "Замбия", 72 => "Зеленого Мыса острова (Кабо-Верде)", 73 => "Зимбабве", 74 => "Израиль", 75 => "Индия", 76 => "Индонезия", 77 => "Иордания", 78 => "Ирак", 79 => "Иран", 80 => "Ирландия", 81 => "Исландия", 82 => "Испания", 83 => "Италия", 84 => "Йемен", 85 => "Казахстан", 86 => "Каймановы острова", 87 => "Камбоджа", 88 => "Камерун", 89 => "Канада", 90 => "Канарские острова", 91 => "Катар", 92 => "Кения", 93 => "Кипр", 94 => "Кирибати", 95 => "Китайская Народная Республика", 96 => "Колумбия", 97 => "Коморские острова", 98 => "Конго", 99 => "Конго, Демократическая респ.", 100 => "Корея, Северная", 101 => "Корея, Южная", 102 => "Косово", 103 => "Коста-Рика", 104 => "Кот-д'Ивуар", 105 => "Куба", 106 => "Кувейт", 107 => "Кука острова", 108 => "Кыргызстан", 109 => "Кюрасао", 110 => "Лаос", 111 => "Латвия", 112 => "Лесото", 113 => "Либерия", 114 => "Ливан", 115 => "Ливия", 116 => "Литва", 117 => "Лихтенштейн", 118 => "Люксембург", 119 => "Маврикий", 120 => "Мавритания", 121 => "Мадагаскар", 122 => "Майотта", 123 => "Макао", 124 => "Македония", 125 => "Малави", 126 => "Малайзия", 127 => "Мали", 128 => "Мальдивские острова", 129 => "Мальта", 130 => "Марокко", 131 => "Мартиника", 132 => "Маршалловы острова", 133 => "Мексика", 134 => "Микронезия", 135 => "Мозамбик", 136 => "Молдова", 137 => "Монако", 138 => "Монголия", 139 => "Монтсеррат", 140 => "Мьянма", 141 => "Намибия", 142 => "Науру", 143 => "Невис", 144 => "Непал", 145 => "Нигер", 146 => "Нигерия", 147 => "Нидерланды (Голландия)", 148 => "Никарагуа", 149 => "Ниуэ", 150 => "Новая Зеландия", 151 => "Новая Каледония", 152 => "Норвегия", 153 => "Объединенные Арабские Эмираты", 154 => "Оман", 155 => "Пакистан", 156 => "Палау", 157 => "Панама", 158 => "Папуа-Новая Гвинея", 159 => "Парагвай", 160 => "Перу", 161 => "Польша", 162 => "Португалия", 163 => "Пуэрто-Рико", 164 => "Реюньон", 165 => "Руанда", 166 => "Румыния", 167 => "Сайпан", 168 => "Сальвадор", 169 => "Самоа", 170 => "Сан-Марино", 171 => "Сан-Томе и Принсипи", 172 => "Саудовская Аравия", 173 => "Свазиленд", 174 => "Северная Ирландия", 175 => "Сейшельские острова", 176 => "Сен-Бартельми", 177 => "Сенегал", 178 => "Сент-Винсент", 179 => "Сент-Китс", 180 => "Сент-Кристофер", 181 => "Сент-Люсия", 182 => "Сент-Маартен", 183 => "Сент-Мартин", 184 => "Сент-Юстас", 185 => "Сербия", 186 => "Сингапур", 187 => "Сирия", 188 => "Словакия", 189 => "Словения", 190 => "Соломоновы острова", 191 => "Сомали", 192 => "Сомалилэнд", 193 => "Судан", 194 => "Суринам", 195 => "США", 196 => "Сьерра-Леоне", 197 => "Таджикистан", 198 => "Таиланд", 199 => "Таити", 200 => "Тайвань", 201 => "Танзания", 202 => "Того", 203 => "Тонга", 204 => "Тринидад и Тобаго", 205 => "Тувалу", 206 => "Тунис", 207 => "Туркменистан", 208 => "Туркс и Кайкос", 209 => "Турция", 210 => "Уганда", 211 => "Узбекистан", 212 => "Украина", 213 => "Уругвай", 214 => "Уэльс", 215 => "Фарерские острова", 216 => "Фиджи", 217 => "Филиппины", 218 => "Финляндия", 219 => "Фолклендские (Мальвинские) острова", 220 => "Франция", 221 => "Французская Гвиана", 222 => "Французская Полинезия", 223 => "Хорватия", 224 => "Центральная Африканская Респ.", 225 => "Чад", 226 => "Черногория", 227 => "Чехия", 228 => "Чили", 229 => "Швейцария", 230 => "Швеция", 231 => "Шотландия", 232 => "Шри-Ланка", 233 => "Эквадор", 234 => "Эритрея", 235 => "Эстония", 236 => "Эфиопия", 237 => "ЮАР", 238 => "Ямайка", 239 => "Япония");
			$i = array_search($country, $ar);
			if ($i !== false) $r['country'] = $i;
			else return false;
		}

		// поиск названия региона по коду
		$region_id = (isset($address['region']) ? $address['region'] : ''); // код региона (или название, если у страны нет списка регионов)
		if ($r['country'] == 0 && $region_id == '') return false;
		if ($r['country'] == 0) {
			$v = new waRegionModel();
			$ar = $v->get($country_id, $region_id);
			$region = $ar['name'];
			if ($region == '') return false;
			// $ar = $v -> getByCountry('rus');  foreach ($ar as $c) echo '"'.$c['name'].'", ';  // все регионы

			// города федерального значения в списке регионов
			$region_edost = array('Московская область', 'Ленинградская область', 'Республика Крым');
			$region_shop = array('Москва', 'Санкт-Петербург', 'Севастополь');
			$i = array_search($region, $region_shop);
			if ($i !== false) {
				if (empty($address['city'])) $address['city'] = $region;
				$region = $region_edost[$i];
			}

			// перевод названий регионов в формат edost (только отличия)
			$region_edost = array('Республика Северная Осетия - Алания', 'Еврейская АО', 'Ненецкий АО', 'Ханты-Мансийский АО', 'Чукотский АО', 'Ямало-Ненецкий АО', "Республика Адыгея", "Республика Алтай", "Республика Башкортостан", "Республика Бурятия", "Республика Дагестан", "Республика Ингушетия", "Кабардино-Балкарская Республика", "Республика Калмыкия", "Карачаево-Черкесская Республика", "Республика Карелия", "Республика Коми", "Республика Марий Эл", "Республика Мордовия", "Республика Саха (Якутия)", "Республика Северная Осетия - Алания", "Республика Татарстан", "Республика Тыва", "Удмуртская Республика", "Республика Хакасия", "Ханты-Мансийский АО", "Чеченская Республика", "Чувашская Республика", 'Республика Крым');
			$region_shop = array('Республика Северная Осетия — Алания', 'Еврейская автономная область', 'Ненецкий автономный округ', 'Ханты-Мансийский автономный округ - Югра', 'Чукотский автономный округ', 'Ямало-Ненецкий автономный округ', "Адыгея республика", "Алтай республика", "Башкортостан республика", "Бурятия республика", "Дагестан республика", "Ингушетия республика", "Кабардино-Балкарская республика", "Калмыкия республика", "Карачаево-Черкесская республика", "Карелия республика", "Коми республика", "Марий Эл республика", "Мордовия республика", "Саха (Якутия) республика", "Северная Осетия-Алания", "Татарстан республика", "Тыва республика", "Удмуртская республика", "Хакасия республика", "Ханты-Мансийский-Югра автономный округ", "Чеченская республика", "Чувашская республика", 'Крым');
			$i = array_search($region, $region_shop);
			if ($i !== false) $region = $region_edost[$i];

			// определение кода региона стандарта edost
			if ($region != '') {
				$ar = array(22 => 'Алтайский край', 28 => 'Амурская область', 29 => 'Архангельская область', 30 => 'Астраханская область', 31 => 'Белгородская область', 32 => 'Брянская область', 33 => 'Владимирская область', 34 => 'Волгоградская область', 35 => 'Вологодская область', 36 => 'Воронежская область', 79 => 'Еврейская АО', 75 => 'Забайкальский край', 37 => 'Ивановская область', 38 => 'Иркутская область', 7 => 'Кабардино-Балкарская Республика', 39 => 'Калининградская область', 40 => 'Калужская область', 41 => 'Камчатский край', 9 => 'Карачаево-Черкесская Республика', 42 => 'Кемеровская область', 43 => 'Кировская область', 44 => 'Костромская область', 23 => 'Краснодарский край', 24 => 'Красноярский край', 45 => 'Курганская область', 46 => 'Курская область', 47 => 'Ленинградская область', 48 => 'Липецкая область', 49 => 'Магаданская область', 50 => 'Московская область', 51 => 'Мурманская область', 83 => 'Ненецкий АО', 52 => 'Нижегородская область', 53 => 'Новгородская область', 54 => 'Новосибирская область', 55 => 'Омская область', 56 => 'Оренбургская область', 57 => 'Орловская область', 58 => 'Пензенская область', 59 => 'Пермский край', 25 => 'Приморский край', 60 => 'Псковская область', 1 => 'Республика Адыгея', 4 => 'Республика Алтай', 2 => 'Республика Башкортостан', 3 => 'Республика Бурятия', 5 => 'Республика Дагестан', 6 => 'Республика Ингушетия', 8 => 'Республика Калмыкия', 10 => 'Республика Карелия', 11 => 'Республика Коми', 12 => 'Республика Марий Эл', 13 => 'Республика Мордовия', 14 => 'Республика Саха (Якутия)', 15 => 'Республика Северная Осетия - Алания', 16 => 'Республика Татарстан', 17 => 'Республика Тыва', 19 => 'Республика Хакасия', 61 => 'Ростовская область', 62 => 'Рязанская область', 63 => 'Самарская область', 64 => 'Саратовская область', 65 => 'Сахалинская область', 66 => 'Свердловская область', 67 => 'Смоленская область', 26 => 'Ставропольский край', 68 => 'Тамбовская область', 69 => 'Тверская область', 70 => 'Томская область', 71 => 'Тульская область', 72 => 'Тюменская область', 18 => 'Удмуртская Республика', 73 => 'Ульяновская область', 27 => 'Хабаровский край', 86 => 'Ханты-Мансийский АО', 74 => 'Челябинская область', 20 => 'Чеченская Республика', 21 => 'Чувашская Республика', 87 => 'Чукотский АО', 89 => 'Ямало-Ненецкий АО', 76 => 'Ярославская область', 90 => 'Байконур', 91 => 'Республика Крым');
				$i = array_search($region, $ar);
				if ($i !== false) $r['region'] = $i;
			}

			if (!isset($r['region'])) return false;
		}
		else $r['region'] = '';

		$r['city'] = (isset($address['city']) ? edost_class::utf8_win($address['city']) : '');
		$r['zip'] = (isset($address['zip']) ? substr($address['zip'], 0, 8) : '');
		$r['street'] = (isset($address['street']) ? $address['street'] : '');

		return $r;

	}


	// расчет доставки
	function EdostCalculate($config, $address, $items) {

		if (!(self::$result == null || isset($config['NO_LOCAL_CACHE']) && $config['NO_LOCAL_CACHE'] == 'Y')) return self::$result;

		$order = array('address' => $address, 'items' => $items);

		if (class_exists('edost_function') && method_exists('edost_function', 'BeforeCalculate')) {
			$v = edost_function::BeforeCalculate($order, $config);
			if ($v !== false && is_array($v)) return self::SetResult($v, $order, $config);
		}

		if ($config['order_type'] == 'N') {
			// НЕ стандартное оформление заказа
			$order['weight'] = $this->getTotalWeight();
			$order['price'] = $this->getTotalPrice();
			$order['size'] = array(0, 0, 0);
		}
		else {
			// стандартное оформление заказа
			$currency_model = new shopCurrencyModel();

			$weight_measure = (defined('EDOST_WEIGHT_MEASURE') ? EDOST_WEIGHT_MEASURE : 'KG');
			$volume_ratio = (defined('EDOST_VOLUME_RATIO') ? EDOST_VOLUME_RATIO : 1);
			$prop = array(
				'weight' => (defined('EDOST_WEIGHT_CODE') ?  EDOST_WEIGHT_CODE : 'weight'),
				'x' => (defined('EDOST_LENGTH_CODE') ?  EDOST_LENGTH_CODE : 'length'),
				'y' => (defined('EDOST_WIDTH_CODE') ?  EDOST_WIDTH_CODE : 'width'),
				'z' => (defined('EDOST_HEIGHT_CODE') ?  EDOST_HEIGHT_CODE : 'height'),
				'size' => (defined('EDOST_SIZE_CODE') ?  EDOST_SIZE_CODE : 'size'),
				'volume' => (defined('EDOST_VOLUME_CODE') ? EDOST_VOLUME_CODE : 'volume'),
			);
//			edost_class::draw_data('prop', $prop);

			$id = array();
			$prop_model = new shopProductFeaturesModel();
			foreach ($order['items'] as $k => $v) {
				$id[] = $v['id'];
				$ar = $prop_model->getValues($v['id']);
//				edost_class::draw_data('ar', $ar);

				foreach ($prop as $p_key => $p) {
					$s = 0;
					if (!empty($ar[$p])) {
						if ($p_key == 'size') {
							if ($ar[$p] instanceof shopCompositeValue) {
								$s = array();
								for ($i = 0; $i <= 2; $i++) {
									$c = $ar[$p]->offsetGet($i);
									$s[$i] = (!empty($c['value_base_unit']) ? $c['value_base_unit'] : 0);
								}
							}
						}
						else if ($ar[$p] instanceof shopDimensionValue) {
							if (!empty($ar[$p]['value_base_unit'])) $s = $ar[$p]['value_base_unit'];
						}
						else if (!is_object($ar[$p])) $s = $ar[$p];
					}
					$v[$p_key] = $s;
				}

				if (is_array($v['size'])) {
					$v['x'] = $v['size'][0];
					$v['y'] = $v['size'][1];
					$v['z'] = $v['size'][2];
				}

				$order['items'][$k] = $v;
			}

			// получение веса артиклов (только если в константах не задан собственный код для характеристики товара "вес")
			if (!empty($id) && !defined('EDOST_WEIGHT_CODE')) {
				$feature_model = new shopFeatureModel();
				$prop_shop = $feature_model->getByCode('weight');
				if ($prop_shop) {
					$ar = $feature_model->getValuesModel($prop_shop['type']);
					$ar = $ar->getProductValues($id, $prop_shop['id']);
					foreach ($order['items'] as $k => $v) if (isset($ar['skus'][$v['sku_id']])) $order['items'][$k]['weight'] = $ar['skus'][$v['sku_id']]; // isset($ar[$v['id']]) ? $ar[$v['id']] : 0
				}
			}
//			edost_class::draw_data('items', $order['items']);

/*
			// загрузка свойств через 'shopFeatureModel' (не работает получение габаритов из свойства '3d.dimension.length' !!!)
			$product_id = array();
			foreach ($order['items'] as $v) $product_id[] = $v['id'];

			$feature_model = new shopFeatureModel();
			$prop_shop = $feature_model -> getByCode($prop);
			foreach ($prop as $p_key => $p) {
				if ($p == '' || !isset($prop_shop[$p])) $ar = false;
				else {
					// $prop_shop[$p]['type'] == '3d.dimension.length'
					$ar = $feature_model -> getValuesModel($prop_shop[$p]['type']);
					$ar = $ar -> getProductValues($product_id, $prop_shop[$p]['id']);
				}
				foreach ($order['items'] as $k => $v) $order['items'][$k][$p_key] = (!empty($ar[$v['id']]) ? $ar[$v['id']] : 0);
			}
			edost_class::draw_data('items', $order['items']);
			edost_class::draw_data('prop_shop', $prop_shop);
*/

			$weight_zero = false;
			$total_weight = 0;
			$total_price = 0;
			$package = array();

			foreach ($order['items'] as $v) if (!empty($v['quantity'])) {
				self::CommaToPoint($v['weight']);
				if ($weight_measure !== 'KG') $v['weight'] *= 0.001;
				if ($v['weight'] <= 0 && defined('EDOST_WEIGHT_DEFAULT')) $v['weight'] = EDOST_WEIGHT_DEFAULT;
				if ($v['weight'] <= 0) $weight_zero = true;
				$total_weight += $v['weight'] * $v['quantity'];

				if (!empty($v['currency']) && $v['currency'] != 'RUB') $v['price'] = $currency_model->convert($v['price'], $v['currency'], 'RUB');
				$total_price += $v['price'] * $v['quantity'];

				$s = array($v['x'], $v['y'], $v['z']);
				foreach ($s as $k2 => $v2) self::CommaToPoint($s[$k2]);

				// если задано только два размера, тогда считается, что это труба (длина и диаметр)
				if ($s[0] > 0 && $s[1] > 0 && $s[2] == 0) $s[2] = $s[1];
				if ($s[0] > 0 && $s[2] > 0 && $s[1] == 0) $s[1] = $s[2];

				// если габаритов нет, но задан объем, тогда габариты вычисляются из объема
				if (!empty($v['volume']) && $s[0] == 0 && $s[1] == 0 && $s[2] == 0) {
					self::CommaToPoint($v['volume']);
					$volume = ($v['volume'] > 0 ? $v['volume'] : 0);
					$s[0] = $s[1] = $s[2] = pow($volume, 1/3) * $volume_ratio;
				}

				edost_class::PackItem($package, $s, $v['quantity']);
			}

			if (defined('EDOST_IGNORE_ZERO_WEIGHT') && EDOST_IGNORE_ZERO_WEIGHT == 'Y') $weight_zero = false;

			if ($weight_zero) $order['weight'] = 0;
			else if ($total_weight > 0) $order['weight'] = $total_weight;
			else $order['weight'] = 0;

			$order['price'] = $total_price;
			$order['size'] = edost_class::PackItems($order['weight'] > 0 ? $package : ''); // суммируем размеры груза
		}
//		edost_class::draw_data('order', $order);

		if (class_exists('edost_function') && method_exists('edost_function', 'BeforeCalculateRequest')) {
			$v = edost_function::BeforeCalculateRequest($order, $config);
			if ($v !== false && is_array($v)) return self::SetResult($v, $order, $config);
		}

		$order['weight'] = round($order['weight'], 3);
		if (!($order['weight'] > 0)) return $this->SetResult(array('error' => 11), $order, $config); // у товаров не задан вес

		if (!isset($order['location'])) $order['location'] = self::GetEdostLocation($order['address']);
		if ($order['location'] === false) return self::SetResult(array('error' => 5), $order, $config); // в выбранное местоположение расчет доставки не производится


		// загрузка старого расчета из кэша
		$cache_id = 'delivery_'.$config['id'].'_'.$order['location']['country'].'_'.$order['location']['region'].'_'.urlencode($order['location']['city']).'_'.urlencode($order['location']['zip']).'_'.ceil($order['weight']*1000).'_'.ceil($order['price']*100).'_'.ceil($order['size'][0]*1000).'_'.ceil($order['size'][1]*1000).'_'.ceil($order['size'][2]*1000);
        $cache = new waSerializeCache($cache_id, defined('EDOST_CACHE_LIFETIME') ? EDOST_CACHE_LIFETIME : 18000, 'shipping_edost');
        $r = $cache->get();
		if (isset($r['data'])) return $this->SetResult($r, $order, $config);


		// запрос на сервер расчета
		$ar = array();
		$ar[] = 'country='.$order['location']['country'];
		$ar[] = 'region='.$order['location']['region'];
		$ar[] = 'city='.urlencode($order['location']['city']);
		$ar[] = 'weight='.urlencode($order['weight']);
		$ar[] = 'insurance='.urlencode($order['price']);
		$ar[] = 'size='.urlencode(implode('|', $order['size']));
		if ($order['location']['zip'] !== '' && $config['send_zip'] == 'Y') $ar[] = 'zip='.urlencode($order['location']['zip']);
		$r = edost_class::RequestData(implode('&', $ar), 'delivery', $config, $this);

		// замена названий тарифов данными из настроек
		if (!empty($r['data'])) foreach ($r['data'] as $k => $v) if (!empty($config['tariff'][$v['profile']]['title'])) {
			$s = $config['tariff'][$v['profile']];
			$r['data'][$k]['title'] = $s['title'];
			$r['data'][$k]['description'] = $s['description'];
		}

		if (class_exists('edost_function') && method_exists('edost_function', 'AfterCalculate')) edost_function::AfterCalculate($order, $config, $r);

		// сохранение расчета в лог файл
		if (defined('EDOST_WRITE_LOG') && EDOST_WRITE_LOG == 'Y') {
			$s = '';
			if (isset($r['error'])) $s = edost_class::GetEdostError($r['error']);
			else if (!empty($r['data'])) foreach ($r['data'] as $k => $v) $s .= "\r\n".implode(' | ', $v);
			self::WriteLog($order['location']['country'].', '.$order['location']['region'].', '.edost_class::win_utf8($order['location']['city']).', '.$order['location']['zip'].', '.$order['weight'].' kg, '.$order['price'].' rub, '.implode(' x ', $order['size']).' - '.date("Y.m.d H:i:s")."\r\n".$s);
		}

		if (!isset($r['error'])) $cache->set($r);

		return $this->SetResult($r, $order, $config);

	}

	// установка результата в переменную класса
	function SetResult($data, $order, $config) {

		$k = (isset($data['sizetocm']) ? $data['sizetocm'] : 0); // коэффициент пересчета габаритов магазина в сантиметры (учитывая размерность в личном кабинете edost)
		$size = (isset($order['size']) ? $order['size'] : array(0, 0, 0));

		$data['order'] = array(
			'location' => (isset($order['location']) ? $order['location'] : false),
			'weight' => (isset($order['weight']) ? $order['weight'] : 0),
			'price' => (isset($order['price']) ? $order['price'] : 0),
			'size1' => ceil($size[0] * $k),
			'size2' => ceil($size[1] * $k),
			'size3' => ceil($size[2] * $k),
			'sizesum' => ceil(($size[0] + $size[1] + $size[2]) * $k),
			'config' => $config,
			'plugin' => $this,
		);

		self::$result = $data;

		return $data;

	}


	public function allowedCurrency() {
		return 'RUB';
	}

	public function allowedWeightUnit() {
		return 'kg';
	}

	public static function CommaToPoint(&$n) {
		if (!empty($n)) $n = str_replace(',', '.', $n);
	}

	public static function WriteLog($data) {
		$fp = fopen(dirname(__FILE__)."/edost.log", "a");
		fwrite($fp, "\r\n==========================================\r\n");
		fwrite($fp, $data);
		fclose($fp);
	}

}




class edost_class {
	public static $error = false;
	public static $mess;

	public static function RequestError($code, $msg, $file, $line) {
//		echo "<br>edost_class error: $msg ($code)<br>";
		self::$error = true;
		return true;
	}

	// запрос на сервер edost
	public static function RequestData($post, $type, $config, $plugin = false) {

		if (empty($config) && !empty($plugin)) $config = $plugin->GetSettings();

		$id = $config['id'];
		$ps = $config['ps'];
		$server = $config['host'];
		if (empty($server)) $server = ($type == 'delivery' ? $config['hidden']['server'] : $config['hidden']['server_zip']);

		if ($id === '' || $ps === '') return array('error' => 12);
		if (intval($id) == 0) return array('error' => 3);
		if ($post === '') return array('error' => 4);

		$server_default = ($type == 'delivery' ? DELIVERY_EDOST_SERVER : DELIVERY_EDOST_SERVER_ZIP);
		if ($server == '') $server = $server_default;
		$url = 'http://'.$server.'/'.($type == 'delivery' ? 'api2.php' : 'api.php');

		$post = 'id='.$id.'&p='.$ps.'&'.$post;
		$parse_url = parse_url($url);
		$path = $parse_url['path'];
		$host = $parse_url['host'];

		self::$error = false;
		set_error_handler(array('edost_class', 'RequestError'));
		$fp = fsockopen($host, 80, $errno, $errstr, 4); // 4 - максимальное время запроса
		restore_error_handler();
//		echo '<br>error: '.($fp ? 'fsockopen TRUE' : 'fsockopen FALSE').' | '.(self::$error ? 'self::error TRUE' : 'self::error FALSE').' | '.$errno.' - '.$errstr;

		if ($errno == 13 || self::$error || !$fp) $r = array('error' => 14); // настройки сервера не позволяют отправить запрос на расчет
		else {
			$out =	"POST ".$path." HTTP/1.0\n".
					"Host: ".$host."\n".
					"Referer: ".$url."\n".
					"Content-Type: application/x-www-form-urlencoded\n".
					"Content-Length: ".strlen($post)."\n\n".
					$post."\n\n";

//			echo '<br>----------------<br>'.$out.'<br>----------------'; // !!!!!
//			$_SESSION['EDOST']['out'] = $out;

			fputs($fp, $out);
			$r = '';
			while ($gets = fgets($fp, 512)) $r .= $gets;
			fclose($fp);

//			echo '<br><br>response from server (original): ----------------<br>'.edost_class::win_utf8($r).'<br>----------------'; // !!!!!
//			$_SESSION['EDOST']['response'] = edost_class::win_utf8($r);

			$r = stristr($r, 'api_data:', false);
			if ($r === false) $r = array('error' => 8); // сервер расчета не отвечает
			else {
				$r = substr($r, 9);
				$r = self::ParseData($r, $type);
			}
		}

//		edost_class::draw_data('request result', $r);

		// переключение на второй стандартный сервер, если первый не отвечает
		if (isset($r['error']) && in_array($r['error'], array(8, 14)) && empty($config['host']) && !empty($plugin)) {
			$server_new = '';
			$ar = array($server_default, DELIVERY_EDOST_SERVER_RESERVE, DELIVERY_EDOST_SERVER_RESERVE2);
			for ($i = 0; $i < count($ar)-1; $i++) if ($ar[$i] == $server) { $server_new = $ar[$i+1]; break; }
			$config = $plugin->GetSettings();
			$config['hidden'][$type == 'delivery' ? 'server' : 'server_zip'] = $server_new;
			$plugin->saveSettings($config);
		}

		return $r;

	}

	// загрузка офисов
	public static function GetOffice($order, $company) {

		if (!isset($order['location']['country']) || empty($company)) return false;

		$data = array();
		$location = $order['location'];
		$config = $order['config'];

		$cache_id = 'office_'.$config['id'].'_'.$location['country'].'_'.$location['region'].'_'.urlencode($location['city']).'_'.implode('_', $company);
        $cache = new waSerializeCache($cache_id, 86400, 'shipping_edost');
        $data = $cache->get();
		if (!isset($data['data'])) {
			$ar = array();
			$ar[] = 'type=office';
			$ar[] = 'country='.$location['country'];
			$ar[] = 'region='.$location['region'];
			$ar[] = 'city='.urlencode($location['city']);
			$ar[] = 'company='.urlencode(implode(',', $company));
			$data = self::RequestData(implode('&', $ar), 'office', $config, $order['plugin']);

			if (class_exists('edost_function') && method_exists('edost_function', 'AfterGetOffice')) edost_function::AfterGetOffice($order, $data);

			if (!isset($data['error'])) {
				foreach ($data['data'] as $k => $v) foreach ($v as $k2 => $v2)
					$data['data'][$k][$k2]['address_full'] = $v2['address'].($v2['address2'] != '' ? ', ' : '').$v2['address2'];

				$cache->set($data);
			}
		}

//		edost_class::draw_data('get office', $data);

		// ограничение по параметрам заказа
		if (!empty($data['data']) && !empty($data['limit']))
			foreach ($data['limit'] as $v) if (isset($data['data'][$v['company_id']]))
				foreach ($data['data'][$v['company_id']] as $k2 => $v2) if ($v2['type'] == $v['type']) {
					$a = false;
					if ($order['weight'] < $v['weight_from'] || $v['weight_to'] != 0 && $order['weight'] > $v['weight_to']) $a = true;

					$ar = array('size1', 'size2', 'size3', 'sizesum');
					foreach ($ar as $s) if ($v[$s] != 0 && $order[$s] > $v[$s]) $a = true;

					if ($a) unset($data['data'][$v['company_id']][$k2]);
					else if ($v['price'] != 0) $data['data'][$v['company_id']][$k2]['codmax'] = intval($v['price'] - $order['price'] - 1);
				}

		return $data;

	}

	// форматирование тарифов
	public static function FormatTariff($data) {
//		edost_class::draw_data('FormatTariff', $data);

		$r = array();
		$sign = self::$mess['EDOST_DELIVERY_SIGN'];
		$rename = self::$mess['EDOST_DELIVERY_RENAME'];
		$order = (isset($data['order']) ? $data['order'] : array());
		$warning = (isset($data['warning']) ? $data['warning'] : array());
		$error = (isset($data['error']) ? $data['error'] : 0);
		$data = (!empty($data['data']) ? $data['data'] : array());

		$config = (isset($order['config']) ? $order['config'] : false);
		foreach (edostShipping::$setting_key as $k => $v) if (empty($config[$k])) $config[$k] = $v;
		if ($config['template_block'] == 'off') $config['template_block_type'] = 'none';

		$office_get = array();
		$office_key = array('shop', 'office', 'terminal');
		$tariff_shop = array(35,56,57,58, 31,32,33,34);


		foreach ($data as $k => $v) {
			$p = $v;

			$ar = array('price', 'priceinfo', 'pricecash', 'transfer', 'priceoffice');
			foreach ($ar as $i) if (isset($v[$i])) unset($v[$i]);

			// удаление 'со страховкой'
			if (!isset($v['title'])) {
				$v['title'] = edost_class::GetTitle($v);
				$v['name'] = trim(str_replace($sign['insurance'], '', $v['name']));
			}
			else {
				$s = $v['title'];
				$s = str_replace($sign['insurance'], '', $s);
				$s = explode('(', $s);
				$v['company'] = trim($s[0]);
				$v['name'] = '';
				if (isset($s[1])) {
					$s = explode(')', $s[1]);
					$v['name'] = trim($s[0]);
				}
			}

			$v['tariff_id'] = $v['ico'] = $v['id'];

			if (in_array($v['format'], $office_key)) $office_get[$v['company_id']] = $v['company_id'];

			if (!empty($p['priceoffice'])) foreach ($p['priceoffice'] as $v2) {
				$ar = $v;
				$ar['to_office'] = $v2['type'];
				$ar += self::GetPrice('price', $v2['price']);
				if ($v2['priceinfo'] > 0) $ar += self::GetPrice('priceinfo', $v2['priceinfo']);
				if ($v2['pricecash'] >= 0) {
					$ar += self::GetPrice('pricecod', $v2['pricecash']);
					$ar += self::GetPrice('pricecash', $v2['pricecash']);
				}
				$data[] = $ar;
			}

			$v += self::GetPrice('price', $p['price']);
			if ($p['priceinfo'] > 0) $v += self::GetPrice('priceinfo', $p['priceinfo']);
			if ($p['pricecash'] >= 0) {
				$v += self::GetPrice('pricecod', $p['pricecash'] + $p['transfer']);
				$v += self::GetPrice('pricecash', $p['pricecash']);
				$v += self::GetPrice('transfer', $p['transfer']);
			}

			$data[$k] = $v;
		}
//		edost_class::draw_data('data start', $data);
//		edost_class::draw_data('office_get', $office_get);


		// получение выбранного пункта выдачи из адреса
		$shop_office_id = false;
		if (!empty($order['location']['street'])) {
			$s = explode(', '.$sign['code'].': ', $order['location']['street']);
			if (!empty($s[1])) {
				$s = explode('/', $s[1]);
				if (!empty($s[3])) {
					$r['office_in_address'] = array(
						'code' => $s[0],
						'id' => $s[1],
						'type' => $s[2],
						'profile' => $s[3],
					);
					foreach ($data as $k => $v) if ($v['profile'] == $s[3]) {
						$_SESSION['EDOST']['office_default'][$v['format']] = array('id' => $s[1], 'profile' => $s[3]);
						if (empty($s[0])) $shop_office_id = $s[1];
						break;
					}
				}
			}
			else $_SESSION['EDOST']['address_original'] = $order['location']['street'];
		}


		// сортировка
		if ($config['template_format'] == 'off') $sorted = false;
		else {
			self::SortTariff($data, $config);
			$sorted = true;
		}


		// группы тарифов
		$ar = array(
			'odt' => array('shop', 'office', 'terminal', 'door', 'house', 'post', 'general'),
			'dot' => array('door', 'house', 'shop', 'office', 'terminal', 'post', 'general'),
			'tod' => array('post', 'shop', 'office', 'terminal', 'door', 'house', 'general'),
		);
		$ar = (isset($ar[$config['template_format']]) ? $ar[$config['template_format']] : $ar['odt']);
		$format = array_fill_keys($ar, '');
		$format_data = self::$mess['EDOST_DELIVERY_FORMAT'];
		foreach ($format as $f_key => $f) {
			$f = (isset($format_data[$f_key]) ?  $format_data[$f_key] : array());
			if (!isset($f['name'])) $f['name'] = '';
			$f['data'] = array();
			$format[$f_key] = $f;
		};


		// распределение тарифов по группам
		foreach ($data as $k => $v) {
			$f_key = (!empty($v['format']) && isset($format[$v['format']]) ? $v['format'] : 'general');
			$format[$f_key]['data'][] = $v;
		}
//		edost_class::draw_data('FORMAT start', $format);


		// модификация названий тарифов под шаблон edost
		$hide = array();;
		foreach ($sign['hide'] as $v) $hide[] = '- '.$v;
		$hide = array_merge($hide, $sign['hide']);
		foreach ($format as $f_key => $f) if (!empty($f['data'])) {
			// удаление названия тарифа, если у всех тарифов компании одинаковые названия (или тариф только один)
			if (empty($config['NAME_NO_CHANGE'])) {
				$n = count($f['data']);
				for ($i = 0; $i < $n; $i++) if (!isset($f['data'][$i]['deleted'])) {
					$p = $p2 = 0;
					for ($i2 = $i+1; $i2 < $n; $i2++) if ($f['data'][$i]['company'] == $f['data'][$i2]['company']) {
						$p++;
						if ($f['data'][$i]['name'] == $f['data'][$i2]['name']) $p2++;
						$f['data'][$i2]['deleted'] = true;
					}
					if ($p == $p2) for ($i2 = $i; $i2 < $n; $i2++) if ($f['data'][$i]['company'] == $f['data'][$i2]['company']) $format[$f_key]['data'][$i2]['name'] = '';
				}
			}

			// удаление из названия тарифа текста 'курьером до двери', 'до пункта выдачи', ...
			if (empty($config['NAME_NO_CHANGE']) || in_array($f_key, array('office', 'terminal'))) {
				if (in_array($f_key, array('door', 'office', 'terminal', 'house'))) foreach ($format[$f_key]['data'] as $k => $v) if ($v['name'] != '') {
					$s = str_replace($hide, '', $v['name']);
					$format[$f_key]['data'][$k]['name'] = trim($s);
				}
			}
		}
//		edost_class::draw_data('FORMAT name', $format);


		// загрузка офисов с сервера edost
		$office_error = false;
		$office = self::GetOffice($order, $office_get);
		if (isset($office['error'])) $office_error = $office['error'];
		$office = (!empty($office['data']) ? $office['data'] : array());
//		edost_class::draw_data('office', $office);


		// проверка на существование выбранных офисов + определение 'type'
//		$_SESSION['EDOST']['office_default'] = '';
		$active_office = (!empty($_SESSION['EDOST']['office_default']) ? $_SESSION['EDOST']['office_default'] : array());
		foreach ($active_office as $k => $v) foreach ($office as $o) if (isset($o[$v['id']])) {
			$active_office[$k]['type'] = $o[$v['id']]['type'];
			break;
		}
//		edost_class::draw_data('active_office', $active_office);


		// удаление тарифов без офисов
		foreach ($format as $f_key => $f) if (in_array($f_key, $office_key) && !empty($f['data'])) {
			// количество офисов у каждого тарифа (сначала с эксклюзивной ценой, затем остальные)
			$office_count = array();
			$office_count_total = 0;
			for ($i = 0; $i <= 1; $i++) foreach ($f['data'] as $k => $v) {
				$id = $v['company_id'];
				if (!isset($office_count[$id])) {
					$office_count[$id]['total'] = (isset($office[$id]) ? count($office[$id]) : 0);
					$office_count_total += $office_count[$id]['total'];
				}

				if ($i == 0 && isset($v['to_office'])) {
					$n = 0;
					if (isset($office[$id])) foreach ($office[$id] as $o) if ($o['type'] == $v['to_office']) $n++;
					$f['data'][$k]['office_count'] = $n;
					$office_count[$id][$v['to_office']] = $n;

					// определение тарифа для выбранного офиса (эксклюзивного)
					if ($n > 0 && isset($active_office[$f_key]['type']) && $v['profile'] == $active_office[$f_key]['profile'] && $v['to_office'] == $active_office[$f_key]['type']) $active_office[$f_key]['tariff_key'] = $k;
				}
				else if ($i == 1 && !isset($v['to_office'])) {
					$n = $office_count[$id]['total'];
					foreach ($office_count[$id] as $k2 => $v2) if ($k2 !== 'total') $n -= $v2;
					$f['data'][$k]['office_count'] = $n;
				}
			}

			foreach ($f['data'] as $k => $v) if ($v['office_count'] == 0) unset($f['data'][$k]);
			if ($office_count_total > 0) $f['office_count'] = $office_count_total;

			$format[$f_key] = $f;
		}

		// определение тарифа для выбранного офиса (не эксклюзивного)
		foreach ($format as $f_key => $f) foreach ($f['data'] as $k => $v) if (!isset($v['to_office']))
			if (isset($active_office[$f_key]['type']) && !isset($active_office[$f_key]['tariff_key']) && $v['profile'] == $active_office[$f_key]['profile']) $active_office[$f_key]['tariff_key'] = $k;

//		edost_class::draw_data('active_office', $active_office);


		// проверка на наличие 'priceinfo'
		$priceinfo = false;
		foreach ($format as $f_key => $f) if (!empty($f['data']))
			foreach ($f['data'] as $k => $v) if (isset($v['priceinfo'])) $priceinfo = true;


		// данные для карты
		if (!empty($office)) {
			$point = array();
			foreach ($office as $k => $v) $point[] = '{"company_id": "'.$k.'", "data": '.self::GetJson($v, array('id', 'name', 'address', 'schedule', 'gps', 'type', 'metro', 'codmax')).'}';
			$tariff = array();
			foreach ($format as $f_key => $f) if (isset($f['office_count'])) {
				self::FormatInsurance($f); // удаление 'со страховкой', если в группе все тарифы со страховкой
				if (!$sorted) self::SortTariff($f['data'], $config);
				foreach ($f['data'] as $k => $v) {
					if (isset($v['priceinfo'])) $v = array_replace($v, self::GetPrice('price', $v['price'] + $v['priceinfo'])); // на карте 'priceinfo' включается в доставку
					if (isset($v['pricecod'])) $v += self::GetPrice('codplus', $v['pricecod'] - $v['price']); // на карте выводится только доплата за наложку 'codplus'
					$v['company'] = self::RenameTariff($v['company'], $rename['company']);
					$tariff[] = $v;
				}
			}
			$r['map_json'] =
				'"point": ['.implode(', ', $point).'], '.
				'"tariff": '.self::GetJson($tariff, array('profile', 'company', 'name', 'tariff_id', 'price', 'price_formatted', 'pricecash', 'codplus', 'codplus_formatted', 'day', 'insurance', 'to_office', 'company_id', 'format'));
		}


		// перенос всех тарифов с офисами в одну группу 'office' + добавление общего тарифа для выбора на карте
		$f2 = $format['office'];
		$f2['data'] = array();
		$f2['office_count'] = 0;
		$f2['head'] = $sign['bookmark']['office'];
		foreach ($format as $f_key => $f) if (isset($f['office_count'])) {
			self::FormatRange($f, $config['template_cod'] != 'off' ? true : false);

			// выделение единственного офиса (или самого первого, если включено в настройках модуля 'template_autoselect_office')
			if (!isset($active_office[$f_key]['tariff_key']) && (count($f['data']) == 1 && $f['office_count'] == 1 || $config['template_autoselect_office'] == 'Y')) {
				$k = $f['min']['key'];
				$v = $f['data'][$k];
				$id = false;
				if (isset($v['to_office'])) {
					foreach ($office[$v['company_id']] as $o) if ($o['type'] == $v['to_office']) { $id = $o['id']; break; }
				}
				else foreach ($office[$v['company_id']] as $o) {
					$a = true;
					foreach ($f['data'] as $k2 => $v2) if ($k2 !== $k && $v2['company_id'] == $v['company_id'] && isset($v2['to_office']) && $v2['to_office'] == $o['type']) $a = false;
					if ($a) { $id = $o['id']; break; }
				}
				$active_office[$f_key] = array('id' => $id, 'profile' => $v['profile'], 'type' => $office[$v['company_id']][$id]['type'], 'tariff_key' => $k);
			}

			$active_key = (isset($active_office[$f_key]['tariff_key']) ? $active_office[$f_key]['tariff_key'] : false);

			foreach ($f['data'] as $k => $v) {
				if ($f['office_count'] != 1 || count($f['data']) != 1) {
					$v['office_map'] = 'change';
					$v['office_link'] = $sign['change'];
				}
				else $v['office_link'] = $sign['map'];

				$v['office_mode'] = $f_key;

				if ($k === $active_key) {
					$p = $active_office[$f_key];
					$o = $office[$v['company_id']][$p['id']];
					$v['office_id'] = $o['id'];
					$v['office_type'] = $o['type'];
					$v['office_address'] = self::GetOfficeAddress($o);
					$v['office_address_full'] = self::GetOfficeAddress($o, $v);

					if ($o['id'] === $shop_office_id) {
						$r['shop_address'] = $v['office_address_full']; // используется при оформлении заказа для переноса данных по пункту выдачи в поле 'street' профиля покупателя
						$v['checked'] = true; // используется в админке для выделения тарифа после выбора офиса на карте
					}

					// отключение наложенного платежа, если превышена максимально допустимая сумма перевода для выбранного офиса
					if (isset($v['pricecash']) && isset($o['codmax']) && $v['pricecash'] > $o['codmax']) {
						$ar = array('pricecash', 'pricecash_formatted', 'pricecod', 'pricecod_formatted');
						foreach ($ar as $v2) unset($v[$v2]);
					}
				}
				else {
					$v['office_address'] = '';
					$v['hide'] = true;
				}

				self::FormatHead($v, $f['name']);
				$f2['data'][] = $v;
			}

			if ($active_key === false) {
				$sort = 0;
				$company_id = false;
				foreach ($f['data'] as $k => $v) {
					if ($sort == 0) $sort = $v['sort'];

					if ($company_id === false) {
						$company_id = $v['company_id'];
						$tariff = $v;
					}
					else if ($v['company_id'] != $company_id) {
						$company_id = false;
						break;
					}
				}

				$v = array(
					'id' => 'edost',
					'profile' => $f_key,
					'company' => (!empty($company_id) ? $tariff['company'] : ''),
					'name' => '',
					'description' => '',
					'ico' => (!empty($company_id) ? $tariff['ico'] : 35),
					'company_id' => (!empty($company_id) ? $company_id : ''),
					'format' => $f_key,
					'sort' => $sort,
					'price' => $f['price']['max']['value'],
					'price_formatted' => self::GetRange($f['price']),
					'price_long' => ($f['price']['min']['value'] == $f['price']['max']['value'] ? 'normal' : 'light'),
					'day' => '',
					'office_map' => 'get',
					'office_mode' => $f_key,
					'office_link' => $f['get'],
					'office_count' => 0,
					'office_address_full' => '',
				);
				if ($f['pricecod']['max']['value'] >= 0) {
					$v['pricecod'] = $f['pricecod']['max']['value'];
					$v['pricecod_formatted'] = self::GetRange($f['pricecod']);
				}

				self::FormatHead($v, $f['name']);
				$f2['data'][] = $v;
			}

			$f2['office_count'] += $f['office_count'];
			$format[$f_key]['data'] = array();
		}
		$format['office'] = $f2;
//		edost_class::draw_data('format', $format);


		// количество отображаемых тарифов
		foreach ($format as $f_key => $f) if (!empty($f['data'])) {
			$n = 0;
			foreach ($f['data'] as $k => $v) if (!isset($v['hide'])) $n++;
			$format[$f_key]['count_show'] = $n;
		}


		// перемещение групп в общий список 'general'
		$count_format = 0;
		$count_tariff = 0;
		$count_pack = 0;
		$auto = false;
		if ($config['template_block'] == 'auto2') foreach ($format as $f_key => $f) if (!in_array($f_key, array('general')) && $f['count_show'] > 2) $auto = true;
		foreach ($format as $f_key => $f) if (!empty($f['data'])) {
			$count_format++;
			$count_tariff += $f['count_show'];
		}
		foreach ($format as $f_key => $f) if (!empty($f['data'])) {
			if ($f_key == 'general') {
				$format[$f_key]['pack'] = 'normal';
				$count_pack++;
			}
			else if ($count_format == 1 && $count_tariff <= 2 || $config['template_format'] == 'off' || $config['template_block'] == 'off' || ($config['template_block'] == 'auto1' && $f['count_show'] <= 2) || ($config['template_block'] == 'auto2' && !$auto)) {
				$format[$f_key]['pack'] = 'head';
				$count_pack++;
			}
		}
		if ($count_pack > 1) {
			$f2 = $format['general'];
			$f2['data'] = array();
			foreach ($format as $f_key => $f) if (isset($f['pack'])) {
				if ($f['pack'] == 'normal') $data = $f['data'];
				else if ($f['pack'] == 'head') {
					$data = array();
					foreach ($f['data'] as $k => $v) {
						self::FormatHead($v, $f['name']);
						$data[] = $v;
					}
				}

				if (count($f2['data']) != 0 && $config['template_format'] != 'off') $f2['data'][] = array('delimiter' => true);
				$f2['data'] = array_merge($f2['data'], $data);
				$format[$f_key]['data'] = array();
			}
			$format['general'] = $f2;
		}
//		edost_class::draw_data('format', $format);


		// наличие наложенного платежа в блоках
		$cod = false;
		if ($config['template_cod'] != 'off') foreach ($format as $f_key => $f) foreach ($f['data'] as $v) if (isset($v['pricecod'])) {
			$format[$f_key]['cod'] = true;
			$cod = true;
			break;
		}


		// подпись предупреждений для блока "до подъезда"
		if (!empty($format['house']['data'])) {
			$f = $format['house'];

			$count = count($f['data']);
			$count_priceinfo = 0;
			foreach ($f['data'] as $v) if (isset($v['priceinfo'])) $count_priceinfo++;

			$p = -1;
			foreach ($f['data'] as $v) {
				if (!isset($v['priceinfo'])) $p = -1;
				else if ($p < 0) {
					$p = $v['price'];
					$p_formatted = $v['price_formatted'];
				}
				else if ($p != $v['price']) $p = -1;
				if ($p < 0) break;
			}

			// общие предупреждения в заголовке
			$f['warning'] = $sign['house_warning'];
			if ($count == $count_priceinfo) {
				$f['warning'] .= ($f['warning'] != '' ? '<br>' : '').$sign['priceinfo_warning'];
				if ($p > 0) $f['description'] = str_replace('%price%', $p_formatted, $sign['priceinfo_description']);
			}

			// предупреждения у тарифов
			foreach ($f['data'] as $k => $v) if (isset($v['priceinfo'])) {
				if ($count != $count_priceinfo) $v['warning'] = $sign['priceinfo_warning'];
				if ($p < 0 && $v['price'] > 0) $v['description'] = str_replace('%price%', $v['price_formatted'], $sign['priceinfo_description']).($v['description'] != '' ? '<br>' : '').$v['description'];
				$f['data'][$k] = $v;
			}

			$format['house'] = $f;
		}


		// сортировка
		if (!$sorted) self::SortTariff($format['general']['data'], $config);


		// добавление нулевого тарифа (если нет других тарифов или есть ошибка загрузки офисов)
		if ($config['hide_error'] != 'Y' || $config['show_zero_tariff'] == 'Y') {
			$count = 0;
			foreach ($format as $f_key => $f) foreach ($f['data'] as $v) if (isset($v['id'])) $count++;
			if ($count == 0 || $config['hide_error'] != 'Y' && $office_error !== false) {
				$s = '';
				if ($config['hide_error'] != 'Y')
					if ($office_error !== false) $s = edost_class::GetEdostError($office_error, 'office');
					else $s = edost_class::GetEdostError($error);

				$format['general']['data'][] = array(
					'id' => 'edost',
					'profile' => 0,
					'name' => '',
					'company' => (isset($config['tariff'][0]['title']) ? $config['tariff'][0]['title'] : ''),
					'description' => (isset($config['tariff'][0]['description']) ? $config['tariff'][0]['description'] : ''),
					'error' => $s,
					'price' => 0,
					'ico' => 0,
				);
			}
		}


		// форматирование стоимости для заголовка + поиск самого дешевого тарифа в группе
		foreach ($format as $f_key => $f) if (!empty($f['data']) && !isset($f['pricehead'])) {
			self::FormatRange($f, $config['template_cod'] != 'off' ? true : false);
			$format[$f_key] = $f;
		}
//		edost_class::draw_data('format', $format);


		// упаковка групп тарифов в один общий массив
		$data = array();
		$day = false;
		$count_tariff = 0;
		foreach ($format as $f_key => $f) if (!empty($f['data'])) {
			if ($f_key == 'general' && count($data) == 0) $head = '';
			else $head = (isset($f['head']) ? $f['head'] : $f['name']);

			$insurance = (!in_array($f_key, array('office', 'general')) && self::FormatInsurance($f) ? $sign['insurance_head'] : ''); // общая надпись "страховка включена во все тарифы"

			$ar = array();
			foreach ($f['data'] as $k => $v) {
				if (isset($v['id'])) {
					$count_tariff++;
					$v['id'] = $v['profile'];
					$v['name'] = self::RenameTariff($v['name'], $rename['name']);
					$v['insurance'] = (isset($v['insurance']) && $v['insurance'] == 1 ? $sign['insurance'] : '');
					if (!isset($v['priceinfo']) && $v['price'] == 0 && !isset($v['error'])) $v['free'] = $sign['free'];
					if (isset($v['pricecod']) && $v['pricecod'] == 0) $v['cod_free'] = $sign['free'];
					if (!empty($v['day'])) $day = true;
				}
				$ar[] = $v;
			}

			$data[$f_key] = array(
				'head' => $head,
				'cod' => (isset($f['cod']) ? true : false),
				'description' => (isset($f['description']) ? $f['description'] : ''),
				'warning' => (isset($f['warning']) ? $f['warning'] : ''),
				'insurance' => $insurance,
				'tariff' => $ar,
			);
		}

		$r['data'] = $data;
		$r['count'] = $count_tariff;
		$r['cod'] = ($count_tariff == 1 || $config['template_cod'] != 'td' ? false : $cod); // есть тарифы с наложенным платежом и включен вывод в отдельной колонке
		$r['priceinfo'] = $priceinfo; // есть тарифы с предупреждением
		$r['day'] = $day; // есть тарифы со сроком доставки
		$r['border'] = ($config['template_block_type'] == 'border' && count($data) > 1 ? true : false); // блок с обводкой
		$r['warning'] = edost_class::GetEdostWarning($warning);
		$r['address_original'] = (!empty($_SESSION['EDOST']['address_original']) ? str_replace(array('"', "\n", "\r"), array('&quot;', ' ', ''), $_SESSION['EDOST']['address_original']) : '');
		$r['sign'] = $sign;

//		edost_class::draw_data('FORMAT RESULT', $r);

		return $r;

	}


	// если все тарифы в группе со страховкой, тогда параметр 'insurance' удаляется и возвращается true
	public static function FormatInsurance(&$f) {

		$n = count($f['data']);
		if ($n <= 1) return false;

		$i = 0;
		foreach ($f['data'] as $v) if (!empty($v['insurance'])) $i++;

		if ($i != $n) return false;
		else {
			foreach ($f['data'] as $k => $v) unset($f['data'][$k]['insurance']);
			return true;
		}

	}


	// упаковка в json по заданным ключам
	public static function GetJson($data, $key, $array = true, $pack = true) {

		if (!$array) $data = array($data);
		else if (!is_array($data) || count($data) == 0) return '[]';

		$s = array();
		foreach ($data as $v) {
			$s2 = array();
			if ($pack) {
				foreach ($key as $v2) $s2[] = (isset($v[$v2]) ? str_replace(array('"', "'"), array('', ''), $v[$v2]) : '');
				$s[] = '"'.implode('|', $s2).'"';
			}
            else {
				foreach ($v as $k2 => $v2) if (in_array($k2, $key)) $s2[] = '"'.$k2.'": "'.str_replace(array('"', "'"), array('', ''), $v2).'"';
				$s[] = '{'.implode(', ', $s2).'}';
			}
		}

		if (!$array) return $s[0];
		else return '['.implode(', ', $s).']';

	}


	// разбор упакованного массива (1,2,... : 3,4,... : ...)
	public static function ParseArray($array, $id, &$data) {

		$array = preg_replace("/[^0-9.:,-]/i", "", substr($array, 0, 1000));
		if ($array == '') return;

		if ($id == 'priceoffice') $key = array('type', 'price', 'priceinfo', 'pricecash');
		else if ($id == 'limit') $key = array('company_id', 'type', 'weight_from', 'weight_to', 'price', 'size1', 'size2', 'size3', 'sizesum');
		else return;

		$key_count = count($key);
		$default = array_fill_keys($key, 0);
		if ($id == 'priceoffice') $default['pricecash'] = -1;

		$r = array();
		$array = explode(':', $array);
		foreach ($array as $v) {
			$v = explode(',', $v);
			if ($v[0] == '' || !isset($v[1])) continue;

			$ar = $default;
			foreach ($v as $k2 => $v2) if ($k2 < $key_count && $v2 !== '') $ar[$key[$k2]] = $v2;
			if ($id == 'priceoffice') $r[$v[0]] = $ar; else $r[] = $ar;
		}
		if (!empty($r)) $data[$id] = $r;

	}

	// разбор ответа сервера
	public static function ParseData($data, $type = 'delivery') {

		if ($type == 'delivery') $key = array('id', 'price', 'priceinfo', 'pricecash', 'priceoffice', 'transfer', 'day', 'insurance', 'company', 'name', 'format', 'company_id', 'city');
		else if ($type == 'document') $key = array('id', 'data', 'data2', 'name', 'size', 'quantity', 'mode', 'cod', 'delivery', 'length', 'space');
		else if ($type == 'office') $key = array('id', 'code', 'name', 'address', 'address2', 'tel', 'schedule', 'gps', 'type', 'metro');
//		else if ($type == 'zip') $key = array();
		else return array('error' => 4);

		$r = array();
		$data = explode('|', $data);

		// общие параметры: error=2;warning=1;sizetocm=1;...
		$p = explode(';', $data[0]);
		foreach ($p as $v) {
			$s = explode('=', $v);
			$s[0] = preg_replace("/[^0-9_a-z]/i", "", substr($s[0], 0, 20));
			if (isset($s[1]) && $s[0] != '')
				if ($s[0] == 'limit') self::ParseArray($s[1], 'limit', $r);
				else if ($s[0] == 'warning') $r[$s[0]] = explode(':', $s[1]);
				else $r[$s[0]] = $s[1];
		}
/*
		if ($type == 'zip') {
			$ar = array('country', 'region', 'city');
			foreach ($ar as $v) if (isset($r[$v])) $r[$v] = $GLOBALS['APPLICATION']->ConvertCharset(substr($r[$v], 0, 80), 'windows-1251', LANG_CHARSET);
		}
*/
		if (isset($r['error'])) return $r;

		$r['data'] = array();
		$array_id = '';
		$sort = 0;
		$key_count = count($key);
		foreach ($data as $k => $v) if ($k == 0 || $v == 'end') {
			if ($k != 0 && isset($parse[$key[0]]) && isset($parse[$key[1]])) {
				$sort++;
				if ($type == 'delivery') {
					$profile = $parse['id']*2 + ($parse['insurance'] == 1 ? 0 : -1);
					$parse['profile'] = $profile;
					$parse['sort'] = $sort*2;
					if ($profile > 0) $r['data'][$profile] = $parse;
				}
				else if ($array_id !== '') $r['data'][$array_id][$parse['id']] = $parse;
				else $r['data'][$parse['id']] = $parse;
			}
			$i = 0;
			$parse = array();
		}
		else if ($v === 'key') $array_id = 'get';
		else if ($array_id === 'get') $array_id = $v;
		else if ($i < $key_count) {
			$p = $key[$i];
			$i++;

			if ($type == 'delivery') {
				if (in_array($p, array('day', 'company', 'name'))) $v = self::win_utf8(substr($v, 0, 80));
				else if (in_array($p, array('price', 'priceinfo', 'pricecash', 'transfer'))) {
					$v = preg_replace("/[^0-9.-]/i", "", substr($v, 0, 11));
					if ($v === '') $v = ($p == 'pricecash' ? -1 : 0);
				}
				else if (in_array($p, array('id', 'insurance'))) $v = intval($v);
				else if ($p == 'company_id') $v = preg_replace("/[^a-z0-9]/i", "", substr($v, 0, 3));
				else if ($p == 'format') $v = preg_replace("/[^a-z]/i", "", substr($v, 0, 10));
				else if ($p == 'priceoffice') {
					self::ParseArray($v, $p, $parse);
					continue;
				}
			}

			if ($type == 'document') {
				if ($p == 'insurance' || $p == 'cod') $v = ($v == 1 ? true : false);
				else if ($p == 'delivery') $v = ($v != '' ? explode(',', $v) : false);
				else if ($p == 'size') $v = explode('x', $v);
				else if ($p == 'length' || $p == 'space') {
					$v = explode(',', $v);
					$o = array();
					foreach ($v as $s) if ($s != '') {
						$s = explode('=', $s);
						if ($s[0] != '') $o[$s[0]] = (isset($s[1]) ? intval($s[1]) : 0);
					}
					$v = $o;
				}
			}

			if ($type == 'office') {
				if ($p == 'type') $v = intval($v);
				else if (in_array($p, array('id', 'gps'))) $v = preg_replace("/[^a-z0-9.,]/i", "", substr($v, 0, 30));
				else $v = self::win_utf8(substr($v, 0, 160));
			}

			$parse[$p] = $v;
		}

		return $r;

	}


	// получение 'title' тарифа
	public static function GetTitle($v, $full = false) {
		$r = $v['company'];
		if ($full && isset($v['head']) && !isset($v['company_head'])) $r = $v['head'];
		$s = $v['name'];
		if ($full) $s .= ($s != '' && $v['insurance'] != '' ? ' ' : '').$v['insurance'];
		return $r.($s != '' ? ' ('.$s.')' : '');
	}


	// получение стоимости числом и строкой в отформатированном виде ($key == 'value' - возвращается только значение,  $key == 'formatted' - возвращается только отформатированная строка)
	public static function GetPrice($key, $price) {

		$r = array();
		if ($price == '') $price = 0;

		$r[$key] = $price;
		if ($key != 'value') $r[$key.'_formatted'] = ($price == '0' ? '0' : shop_currency($price, 'RUB'));

		if ($key == 'value') return $r[$key];
		if ($key == 'formatted') return $r[$key.'_formatted'];
		return $r;

	}


	// сортировка тарифов
	public static function SortTariff(&$data, $config) {

		$r = $data;

		// тарифы с офисами не сортируются
		$first = false;
		$data_office = array();
		foreach ($r as $k => $v) if (isset($v['office_link'])) {
			if ($k == 0) $first = true;
			$data_office[] = $v;
			unset($r[$k]);
		}

		if (count($r) <= 1) return;

		$ar = array();
		foreach ($r as $k => $v)
			if ($config['sort_ascending'] == 'Y') $ar[] = floatval($v['price']) + (isset($v['priceinfo']) ? floatval($v['priceinfo']) : 0); // по стоимости доставки
			else $ar[] = (isset($v['sort']) ? $v['sort'] : 0); // по коду сортировки

		array_multisort($ar, SORT_ASC, SORT_NUMERIC, $r);

		if (count($data_office) > 0) $r = ($first ? array_merge($data_office, $r) : array_merge($r, $data_office));

		$data = $r;

	}


	// получение адреса офиса (если передан $tariff, тогда формируется полный адрес с телефонами, расписанием работы и т.д.)
	public static function GetOfficeAddress($office, $tariff = false) {

		$r = '';
		$sign = self::$mess['EDOST_DELIVERY_SIGN'];
		$metro = ($office['metro'] != '' ? $sign['metro'].$office['metro'] : '');
		$r = $office['name'];
		$r .= ($r != '' && $metro != '' ? ', ' : '').$metro;
		$r = ($r != '' ? ' ('.$r.')' : '');

		if ($tariff === false) return $office['address'].$r;

		$shop = (in_array($tariff['company_id'], array('s1', 's2', 's3', 's4')) ? true : false);
		$shop_company_default = (in_array($tariff['company'], $sign['shop_company_default']) ? true : false);

		$c = $office['code'];
		if ($c == '') $c = ($shop ? 'S' : 'T');

		if (in_array($office['type'], array(5, 6))) $head = $sign['postamat']['name'];
		else $head = $sign[$tariff['format']];

		$s = array();
		$s[] = $head.(!$shop_company_default && $tariff['format'] != 'shop' ? ' '.$tariff['company'] : '').': '.$office['address_full'] . $r;
		if ($office['tel'] != '') $s[] = $sign['tel'].': '.$office['tel'];
		if ($office['schedule'] != '') $s[] = $sign['schedule'].': '.$office['schedule'];
		$s[] = $sign['code'].': '.$c.'/'.$office['id'].'/'.$office['type'].'/'.$tariff['profile'];
		$r = implode(', ', $s);

		return $r;

	}


	// замена названий по массиву соответсвий $data
	public static function RenameTariff($s, $data) {
		if ($s != '' && isset($data[1])) {
			$i = array_search($s, $data[0]);
			if ($i !== false) $s = $data[1][$i];
		}
		return $s;
	}


	// форматирование тарифа для вывода в блоке 'general'
	public static function FormatHead(&$v, $head) {

		if (isset($v['head']) || $v['format'] == 'post') return;

		$sign = self::$mess['EDOST_DELIVERY_SIGN'];

		$v['head'] = $head;
		if (isset($v['office_type']) && in_array($v['office_type'], array(5, 6))) $v['head'] = $sign['postamat']['head'];

		$shop_company_default = (in_array($v['company'], $sign['shop_company_default']) ? true : false);
		$a = false;
		if (isset($v['office_count'])) $a = true;
		else if ($v['company_id'] != 27 || !$shop_company_default) $v['company_head'] = $sign['delivery_company']; // вывод названия службы доставки отдельной строкой (кроме тарифов Курьер)
		if ($a && $v['format'] != 'shop' && !$shop_company_default) {
			$rename = self::$mess['EDOST_DELIVERY_RENAME'];
			$v['head'] .=  ' '.self::RenameTariff($v['company'], $rename['company']); // добавление названия компании к заголовку (для тарифов с офисами)
		}

		// подпись предупреждений для ТК
		if (in_array($v['format'], array('terminal', 'house'))) {
			$v['warning'] = '';
			if ($v['format'] == 'terminal' && isset($v['office_count']) && $v['office_count'] > 1) $v['warning'] = $sign['terminal_warning'];
			else if ($v['format'] == 'house') $v['warning'] = $sign['house_warning'];

			if (isset($v['priceinfo'])) {
				$v['warning'] .= ($v['warning'] != '' ? '<br>' : '').$sign['priceinfo_warning'];
				if ($v['price'] > 0) $v['description'] = str_replace('%price%', $v['price_formatted'], $sign['priceinfo_description']).(!empty($v['description']) ? '<br>'.$v['description'] : '');
			}
		}

	}


	// получение ошибки калькулятора по коду
	public static function GetEdostError($id, $type = 'delivery') {

		$error = self::$mess['EDOST_DELIVERY_ERROR'];
		$r = $error['head'].($type == 'office' ? $error['office'] : '');
		$r .= (isset($error[$id]) ? $error[$id] : $error['no_delivery']).'!';
		return $r;

	}

	// получение предупреждений калькулятора
	public static function GetEdostWarning($id) {

		$r = '';
		if (!empty($id)) {
			$warning = self::$mess['EDOST_DELIVERY_WARNING'];
			foreach ($id as $v) if (!empty($warning[$v])) $r .= $warning[$v].'<br>';
			if ($r != '') $r = $warning[0].'<br>'.$r;
		}
		return $r;

	}

	// получение диапазона цены: от 'минимальная' до 'максимальная' (от 100 руб. до 200 руб.) + поиск самого дешевого тарифа
	public static function FormatRange(&$format, $cod) {
		$price = $pricecod = self::SetRange();
		$min = false;
		foreach ($format['data'] as $k => $v) if (isset($v['id']) && !isset($v['price_long'])) {
			$p = $v['price'] + (isset($v['priceinfo']) ? $v['priceinfo'] : 0);
			if ($min === false || $p < $min['price']) $min = array('price' => $p, 'key' => $k);
			$price = self::SetRange($price, $p);
			if ($cod && isset($v['pricecod'])) $pricecod = self::SetRange($pricecod, $v['pricecod'], $v['pricecod_formatted']);
		}
		if ($min !== false) {
			$v = $min + $format['data'][$min['key']];
			$v['price_formatted'] = self::GetPrice('formatted', $v['price']);
			$format['min'] = $v;
		}
		$price['min']['formatted'] = self::GetPrice('formatted', $price['min']['value']);
		$price['max']['formatted'] = self::GetPrice('formatted', $price['max']['value']);
		$format['price'] = $price;
		$format['pricecod'] = $pricecod;
		$format['pricehead'] = self::AddRange($price, $pricecod);
	}
	public static function SetRange($range = false, $value = 0, $formatted = '') {
		if ($range === false) return array('min' => array('value' => -1, 'formatted' => ''), 'max' => array('value' => -1, 'formatted' => ''));
		if ($range['min']['value'] == -1 || $value < $range['min']['value']) $range['min'] = array('value' => $value, 'formatted' => $formatted);
		if ($range['max']['value'] == -1 || $value > $range['max']['value']) $range['max'] = array('value' => $value, 'formatted' => $formatted);
		return $range;
	}
	public static function AddRange($range = false, $range2) {
		if ($range === false) return $range2;
		if ($range2['min']['value'] >= 0) $range = self::SetRange($range, $range2['min']['value'], $range2['min']['formatted']);
		if ($range2['max']['value'] >= 0) $range = self::SetRange($range, $range2['max']['value'], $range2['max']['formatted']);
		return $range;
	}
	public static function GetRange($range) {
		$sign = self::$mess['EDOST_DELIVERY_SIGN'];
		$r = ($range['min']['value'] != $range['max']['value'] && $range['min']['value'] !== '0' ? '<br>' : '');
		$r = ($range['min']['value'] != $range['max']['value'] ? $sign['from'] . $range['min']['formatted'] . $r . $sign['to'] : '') . $range['max']['formatted'];
		return $r;
	}


	// упаковка одного товара
	public static function PackItem(&$package, $s, $quantity) {

		if (!($s[0] > 0 && $s[1] > 0 && $s[2] > 0 && $quantity > 0)) return false;

		sort($s); // сортировка габаритов по возрастанию

		if ($quantity == 1) {
			$package[] = array('X' => $s[0], 'Y' => $s[1], 'Z' => $s[2]);
			return true;
		}

		$x1 = $y1 = $z1 = $l = 0;
		$max1 = floor(sqrt($quantity));
		for ($y = 1; $y <= $max1; $y++) {
			$i = ceil($quantity / $y);
			$max2 = floor(sqrt($i));

			for ($z = 1; $z <= $max2; $z++) {
				$x = ceil($i/$z);

				$l2 = $x*$s[0] + $y*$s[1] + $z*$s[2];
				if ($l == 0 || $l2 < $l) {
					$l = $l2;
					$x1 = $x;
					$y1 = $y;
					$z1 = $z;
				}
			}
		}

		$package[] = array('X' => $x1*$s[0], 'Y' => $y1*$s[1], 'Z' => $z1*$s[2]);
		return true;

	}

	// упаковка разных товаров
	public static function PackItems($a) {

		if (empty($a)) return array(0, 0, 0);

		$n = count($a);
		for ($i3 = 1; $i3 < $n; $i3++) {
			// сортировка размеров по убыванию
			for ($i2 = $i3-1; $i2 < $n; $i2++) {
				for ($i = 0; $i <= 1; $i++) {
					if ($a[$i2]['X'] < $a[$i2]['Y']) {
						$a1 = $a[$i2]['X'];
						$a[$i2]['X'] = $a[$i2]['Y'];
						$a[$i2]['Y'] = $a1;
					};
					if ($i == 0 && $a[$i2]['Y'] < $a[$i2]['Z']) {
						$a1 = $a[$i2]['Y'];
						$a[$i2]['Y'] = $a[$i2]['Z'];
						$a[$i2]['Z'] = $a1;
					}
				}
				$a[$i2]['sum'] = $a[$i2]['X'] + $a[$i2]['Y'] + $a[$i2]['Z']; // сумма сторон
			}

			// сортировка товаров по возрастанию
			for ($i2 = $i3; $i2 < $n; $i2++)
				for ($i = $i3; $i < $n; $i++)
					if ($a[$i-1]['sum'] > $a[$i]['sum']) {
						$a2 = $a[$i];
						$a[$i] = $a[$i-1];
						$a[$i-1] = $a2;
					}

			// упаковка двух самых маленьких товаров
			if ($a[$i3-1]['X'] > $a[$i3]['X']) $a[$i3]['X'] = $a[$i3-1]['X'];
			if ($a[$i3-1]['Y'] > $a[$i3]['Y']) $a[$i3]['Y'] = $a[$i3-1]['Y'];
			$a[$i3]['Z'] = $a[$i3]['Z'] + $a[$i3-1]['Z'];
			$a[$i3]['sum'] = $a[$i3]['X'] + $a[$i3]['Y'] + $a[$i3]['Z']; // сумма сторон
		}

		$r = array(round($a[$n-1]['X'], 3), round($a[$n-1]['Y'], 3), round($a[$n-1]['Z'], 3));
		sort($r); // сортировка габаритов по возрастанию

		return $r;

	}


	// загрузка локальных настроек из cookie
	public static function GetCookie() {
		$r = array(
			'setting_tariff_show' => 'N', // редактировать названия тарифов (Y, N)
		);
		$ar = (!empty($_COOKIE['edost_admin']) ? explode('|', preg_replace("/[^0-9a-z_|-]/i", "", $_COOKIE['edost_admin'])) : array());
		$i = 0;
		foreach ($r as $k => $v) {
			$r[$k] = (isset($ar[$i]) ? $ar[$i] : $v);
			$i++;
		}
		return $r;
	}

	public static function draw_data($name, $data) {
		echo '<br><b>'.$name.':</b> '.(is_array($data) ? '<pre style="font-size: 12px">'.print_r($data, true).'</pre>' : $data);
	}


	// перекодировка из UTF8 в WIN
	public static function utf8_win($s) {
		$out = '';
		$c1 = '';
		$byte2 = false;
		$n = (function_exists('mb_strlen') ? mb_strlen($s, 'windows-1251') : strlen($s));
		for ($c = 0; $c < $n; $c ++) {
			$i = ord($s[$c]);
			if ($i <= 127) $out .= $s[$c];
			if ($byte2) {
				$new_c2 = ($c1 & 3) * 64 + ($i & 63);
				$new_c1 = ($c1 >> 2) & 5;
				$new_i = $new_c1 * 256 + $new_c2;
				if ($new_i == 1025) {
					$out_i = 168;
				}
				else {
					if ($new_i == 1105)	$out_i = 184;
					else $out_i = $new_i-848;
				}
				$out .= chr($out_i);
				$byte2 = false;
			}
			if (($i >> 5) == 6) {
				$c1 = $i;
				$byte2 = true;
			}
		}
		return $out;
	}

	// перекодировка из WIN в UTF8
	public static function win_utf8($s) {
		$utf = '';
		$mb = (function_exists('mb_substr') ? true : false);
		$n = (function_exists('mb_strlen') ? mb_strlen($s, 'windows-1251') : strlen($s));
		for ($i = 0; $i < $n; $i++) {
			$donotrecode = false;
			$c = ord($mb ? mb_substr($s, $i, 1, 'windows-1251') : substr($s, $i, 1));
			if ($c == 0xA8) $res = 0xD081;
			elseif ($c == 0xB8) $res = 0xD191;
			elseif ($c < 0xC0) $donotrecode = true;
			elseif ($c < 0xF0) $res = $c + 0xCFD0;
			else $res = $c + 0xD090;
			$c = ($donotrecode) ? chr($c) : (chr($res >> 8) . chr($res & 0xff));
			$utf .= $c;
		}
		return $utf;
	}

}

edost_class::$mess = $MESS;

/*
	echo '<br>shop_currency: '.shop_currency($n['price'], $n['currency']);  // перевод в текущую валюту магазина
	echo '<br>shop_currency: '.$rate_model -> convert($n['price'], $n['currency'], 'RUB');

	$row = $rate_model->getById($currency);

	// валюты
	$currency = wa()->getConfig()->getCurrency(false);
	$rate_model = new shopCurrencyModel();
	$row = $rate_model->getById($currency);
	$rate = $row['rate'];

	$rate = 1;
	$currency_model = new shopCurrencyModel();
	$currency_model -> getRate($currency) ?????

	$data['price']     = (float) $currency_model->convertByRate($data['price'], 1, $rate);

	wa_currency($product['min_price'], $currency); // подписывает " руб." ?


	// получение данных по номеру оформленного заказа
	$ar = new shopOrderModel;
	$ar = $ar->getOrder(9);
	edost_class::draw_data('order 9', $ar);
*/

?>