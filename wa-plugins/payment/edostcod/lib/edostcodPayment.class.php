<?php
/*********************************************************************************
Обработчик наложенного платежа eDost
Версия 1.0, 10.04.2015
Автор: ООО "Айсден"

Работает только вместе с модулем доставки eDost.
*********************************************************************************/

class edostcodPayment extends waPayment {

	// получение данных по наложенному платежу
	public static function GetCodData() {

		// принимается запрос только со страницы оформления заказа
		if (empty($_SERVER['REQUEST_URI']) || strpos($_SERVER['REQUEST_URI'], 'checkout') === false) return false;

		// в заказе выбрана доставка 'edost' и в сессии есть данные для выбранного тарифа
		$order_data = wa()->getStorage()->get('shop/checkout'); // данные из сессии по текущему заказу
		if (empty($order_data['shipping']['plugin']) || $order_data['shipping']['plugin'] != 'edost' ||
			empty($order_data['shipping']['rate_id']) || empty($order_data['edost']['tariff'][$order_data['shipping']['rate_id']])) return false;

		$p = $order_data['edost']['tariff'][$order_data['shipping']['rate_id']];

		if (isset($p['priceoffice'])) {
			$address = '';
			if (wa()->getUser()->isAuth()) $contact = wa()->getUser();
			else $contact = (isset($order_data['contact']) ? $order_data['contact'] : false);
			if ($contact) {
				$s = $contact->get('address.shipping');
				if (!$s) $s = $contact->get('address');
				if (isset($s[0]['data']['street'])) $address = $s[0]['data']['street'];
			}

			$type = 0;
			$s = explode(', '.$order_data['edost']['sign']['code'].': ', $address);
			if (!empty($s[1])) {
				$s = explode('/', $s[1]);
				if (!empty($s[2])) $type = intval($s[2]);
			}
			if (isset($p['priceoffice'][$type])) {
				$v = $p['priceoffice'][$type];
				$p = array(
					'price' => $v['price'],
					'pricecash' => $v['pricecash'],
					'priceinfo' => $v['priceinfo'],
					'office_type' => $v['type'],
				);
			}
		}

		if ($p['pricecash'] >= 0) return array(
			'sign' => $order_data['edost']['sign'],
			'price' => $p,
		);

		return false;

	}


	// отключение модуля оплаты через вывод ошибки (+ js замена стандартного поля в шаблоне)
	public function allowedCurrency() {

		if (empty($_SERVER['REQUEST_URI']) || strpos($_SERVER['REQUEST_URI'], 'checkout') === false || strpos($_SERVER['REQUEST_URI'], 'checkout/success') !== false) return 'RUB';
        else if (self::GetCodData() !== false) return 'RUB';
        else return "<span id=\"edost_cod_error\"></span><script type=\"text/javascript\">
			var E = $('#edost_cod_error').parent().parent()[0];
			if (E) E.innerHTML = 'Оплата при получении недоступна для выбранного способа доставки!';
        </script>";

	}


    // вывод наценок наложенного платежа (+ js замена стандартного поля в шаблоне)
    public function customFields(waOrder $order) {

		$s = '';
		$data = self::GetCodData();
		if ($data !== false) {
			$sign = $data['sign'];
			$p = $data['price'];
			$p['codplus'] = $p['pricecash'] - $p['price'];

            $s = array();
			if (!empty($p['codplus'])) $s['codplus'] = str_replace('%codplus%', shop_currency($p['codplus'], 'RUB'), $sign['codplus']);
			if (!empty($p['transfer'])) $s['transfer'] = '<span id="edost_transfer" style="color: #F00;">'.str_replace('%transfer%', shop_currency($p['transfer'], 'RUB'), $sign['transfer']).'</span>';
			if (!empty($p['codplus']) && !empty($p['transfer'])) $s['codtotal'] = str_replace('%codtotal%', shop_currency($p['codplus'] + $p['transfer'], 'RUB'), $sign['codtotal']);

			if (!empty($s)) {
				$s = implode('<br>', $s);
				$s = '<div id="edost_cod_info">'.$s.'</div>';
				$s = "<span id=\"edost_description_insert\"></span><script type=\"text/javascript\">
					var E = $('#edost_description_insert').parent().parent().parent().parent()[0];
					if (E) E.innerHTML = '".$s."';
					</script>";

				return array(
					'codinfo' => array(
						'title' => '',
						'description' => $s,
						'control_type' => waHtmlControl::CUSTOM
//						'callback' => array('edostcodPayment', 'GetPlusInfo'), // заполнение поля 'value' через собственную функцию 'GetPlusInfo' (прямое указание 'value' без функции игнорируется!!!)
					)
				);
			}
		}

		return array();

    }

}

?>