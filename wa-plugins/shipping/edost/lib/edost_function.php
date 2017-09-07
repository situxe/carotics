<?php
/*********************************************************************************
Пользовательские функции модуля eDost (при обновлении данный файл не переписывается)

Для подключения в файле 'edost_const.php' должна быть установлена константа:
define('EDOST_FUNCTION', 'Y');
*********************************************************************************/

class edost_function {

	// вызывается перед расчетом доставки
	public static function BeforeCalculate(&$order, &$config) {
/*
		$order - параметры заказа
		$config - настройки модуля

		return false; // продолжить выполнение расчета
		return array('hide' => true); // отключить модуль (не производится запрос на сервер, не выводится ошибка)
		return array('data' => array( тарифы доставки )); // сбросить расчет и заменить результат массивом 'data' (формат должен соответствовать стандарту eDost)
*/

//		edost_class::draw_data('BeforeCalculate - order', $order);
//		edost_class::draw_data('BeforeCalculate - config', $config);


//		echo '<br>SERVER[REQUEST_URI]:'.$_SERVER['REQUEST_URI'];
//		$_SESSION['EDOST']['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
//		unset($_SESSION['EDOST']['office_default']); // сбросить выбранные на карте офисы

/*
		// вывести собственный тариф для указанных местоположений (вместо реального расчета)
		$ar = array('Москва', 'Владивосток');
		if (in_array($order['address']['city'], $ar)) {
			$order['location'] = edostShipping::GetEdostLocation($order['address']);
			if ($order['location'] === false) return false;

			return array(
				'sizetocm' => '100', // коэффициент пересчета габаритов магазина в сантиметры
				'data' => array(
					9 => array( // тариф "СПСР Экспресс"
						'id' => 5,
						'price' => 400,
						'priceinfo' => 0,
						'pricecash' => 500,
						'transfer' => 0,
						'day' => '3-4 дня',
						'insurance' => 0,
						'company' => 'СПСР Экспресс',
						'name' => 'пеликан-стандарт',
						'format' => 'door',
						'company_id' => 1,
						'city' => '',
						'profile' => 9,
						'sort' => 4,
					)
				)
			);
		}
*/

/*
		// изменить ид и пароль от сервера eDost (например, когда у магазина несколько филиалов в разных городах, и требуется изменять город отправки в зависимости от местонахождения покупателя)
		$config['id'] = '12345';
		$config['ps'] = 'aaaaa';
*/

		// отключить модуль на странице оформления заказа
//		if (strpos($_SERVER['REQUEST_URI'], 'checkout') !== false) return array('hide' => true);

/*
		// отключить модуль для указанных местоположений
		$ar = array('Москва', 'Владивосток');
		if (in_array($order['address']['city'], $ar)) return array('hide' => true);
*/

		return false;

	}

	// вызывается после обработки параметров заказа и перед запросом на сервер eDost
	public static function BeforeCalculateRequest(&$order, &$config) {
/*
		$order - параметры заказа
		$config - настройки модуля

		return false; // продолжить выполнение расчета
		return array('hide' => true); // отключить модуль (не производится запрос на сервер, не выводится ошибка)
		return array('data' => array( тарифы доставки )); // сбросить расчет и заменить результат массивом 'data' (формат должен соответствовать стандарту eDost)

		расчет производится по параметрам:
			$order['address'] - адрес доставки
			$order['weight'] - вес заказа в килограммах
			$order['price'] - цена заказа в рублях
			$order['size'] - массив с габаритами заказа (единица измерения должна совпадать с размерностью в личном кабинете eDost)
				Предупреждение: на выходе габариты должны быть отсортированы по возрастанию - пример: $order['size'] = array(30, 10, 20);  sort($order['size']);
*/

//		edost_class::draw_data('BeforeCalculateRequest - order', $order);


//		$order['weight'] = 0.5;
//		$order['weight'] += 32;
//		$order['price'] = 1000;
//		$order['size'] = array(10, 20, 30);

/*
		// установить местоположение расчета стандарта eDost (если установлено, тогда $order['address'] игнорируется)
		$order['location'] = array(
		    'country' => 0, // код страны стандарта eDost (0 - Россия)
		    'region' => 59, // код региона стандарта eDost
		    'city' => edost_class::utf8_win('Пермь'), // название города в кодировке win
			'zip' => (isset($address['zip']) ? substr($address['zip'], 0, 8) : ''),
			'street' => (isset($address['street']) ? $address['street'] : ''),
		);
*/

/*
		// добавить вес на упаковку для указанных местоположений
		$ar = array('Москва', 'Владивосток');
		if (in_array($order['address']['city'], $ar)) $order['weight'] += 1;
*/

		return false;

	}

	// вызывается после расчета доставки
	public static function AfterCalculate($order, $config, &$result) {
/*
		$order - параметры заказа
		$config - настройки модуля
		$result - результат расчета
*/

//		edost_class::draw_data('AfterCalculate - order', $order);
//		edost_class::draw_data('AfterCalculate - result', $result);

/*
		// исключение стоимости доставки из итого (для почты и EMS - id: 1, 2, 3)
		if (!empty($result['data'])) foreach ($result['data'] as $k => $v)
			if (in_array($v['id'], array(1, 2, 3)) && $v['price'] > 0) {
				$result['data'][$k]['priceinfo'] = $v['price'];
				$result['data'][$k]['price'] = 0;
			}
*/

		// удалить из расчета тариф "DPD - parcel - до пункта выдачи" (код 91)
//		if (isset($result['data']['91'])) unset($result['data']['91']);

/*
		// изменение стоимости доставки тарифа "PickPoint" (код 57)
		if (isset($result['data']['57'])) {
			// установка фиксированной стоимости доставки для указанных местоположений
			$ar = array('Москва', 'Владивосток');
			if (in_array($order['address']['city'], $ar)) {
				$result['data']['57']['price'] = 250; // стоимость доставки
				$result['data']['57']['pricecash'] = 250; // стоимость доставки при наложенном платеже (-1 - отключить наложенный платеж)
			}

			// установить эксклюзивную стоимость для пунктов выдачи с типом 5
			$result['data']['57']['priceoffice'] = array(
				5 => array(
					'type' => 5,
					'price' => $result['data']['57']['price'] + 100, // стандартная цена доставки + 100 руб.
					'priceinfo' => 0,
					'pricecash' => 800, // наложка
				),
			);
		}
*/
	}


	// вызывается после загрузки данных по пунктам выдачи
	public static function AfterGetOffice($order, &$result) {
/*
		$order - параметры заказа
		$result - пункты выдачи
*/
//		edost_class::draw_data('AfterGetOffice - order', $order);
//		edost_class::draw_data('AfterGetOffice - result', $result);


		// удалить пункты выдачи тарифа 'Самовывоз 1' (код 's1')
//		if (isset($result['data']['s1'])) unset($result['data']['s1']);

/*
		// вывести пункт выдачи для тарифа 'Самовывоз 1' (код 's1')
		$result['data']['s1'] = array(
			'12345A12345' => array(
				'id' => '12345A12345',
				'code' => '',
				'name' => 'ТЦ Калач',
				'address' => 'Москва, ул. Академика Янгеля, д. 6, корп. 1',
				'address2' => 'оф. 5',
				'tel' => '+7-123-123-45-67',
				'schedule' => 'с 10 до 20, без выходных2222',
				'gps' => '37.592311,55.596037',
				'type' => 3,
				'metro' => '',
			),
		);
*/
	}

}
?>