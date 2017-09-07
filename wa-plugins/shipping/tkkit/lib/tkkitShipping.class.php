<?php
/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.3.3
 * @copyright Serge Rodovnichenko, 2016
 * @license http://www.webasyst.com/terms/#eula Webasyst
 * @package wa-plugins.shipping.tkkit
 */

/**
 * Pre PHP 5.5 polyfill
 */
require_once(dirname(__FILE__) . '/vendors/array_column.php');

/**
 * Расчет стоимости доставки ТК КиТ
 *
 * @property array $countries
 * @property array $from_city
 * @property bool $pickup
 * @property array $delivery // варианты доставки для расчета
 * @property bool $ekit_only
 * @property bool $incity_terminal_only
 * @property array $parcel_dimensions
 *
 * @property string $handling_base
 * @property string $handling_cost
 * @property string $rounding
 * @property string $rounding_type
 *
 * @property int $limit_hour
 * @property int $handling_days
 * @property array $shipping_days
 *
 * @property string $variants_order
 */
class tkkitShipping extends waShipping
{

    const API_URL = 'http://tk-kit.ru/API.1/';
    const CURRENCY = 'RUB';
    const LOG_FILE = 'shipping/tkkit.log';

    /** @var SimpleXMLElement|null */
    private $geography = null;

    /** @var SimpleXMLElement|null */
    private $offices = null;

    /**
     *
     * List of allowed address patterns
     * @return array
     */
    public function allowedAddress()
    {
        $address_patterns = array();
        if (is_array($this->countries)) {
            foreach ($this->countries as $country => $enabled) {
                if ($enabled) {
                    $address_patterns[] = array('country' => $country);
                }
            }
        }
        return $address_patterns;
    }


    /**
     *
     * @return string ISO3 currency code or array of ISO3 codes
     */
    public function allowedCurrency()
    {
        return self::CURRENCY;
    }

    /**
     *
     * @return string Weight units or array of weight units
     */
    public function allowedWeightUnit()
    {
        return 'kg';
    }

    /**
     * Не хочу ради контрола делать кучу статических методов
     * Пока будет железно указанный набор, тем более, что у китов с дальним зарубежьем проблема структурного характера
     *
     * @todo Возможно, работу с API стоит вынести в отдельный класс
     *
     * @return array
     */
    public static function getAvailableCountries()
    {
        $Country = waCountryModel::getInstance();

        // реально считает, оказывается вовсе не во все заявленные страны :(
        $countries = array('rus', 'kaz', 'blr', 'arm', 'kgz');

        $country_options = array();
        foreach ($countries as $country) {
            $country_options[] = array('value' => $country, 'title' => $Country->name($country));
        }

        return $country_options;
    }

    public function requestedAddressFields()
    {
        $fields = array(
            'country' => array('cost' => true),
            'city'    => array('cost' => true)
        );
        if (is_array($this->countries) &&
            array_key_exists('rus', $this->countries) &&
            $this->countries['rus'] == 1
        ) {
            $fields['region'] = array('cost' => true);
        }

        return $fields;
    }

    /**
     * Инициализация значений настроек модуля доставки
     *
     * @param array $settings
     * @return array
     * @throws waException
     */
    public function saveSettings($settings = array())
    {
        if (!isset($settings['from_city'])) {
            throw new waException('Не выбран город отправки');
        }

        try {
            $this->loadGeography(array('clear_cache'=>true));
        } catch (Exception $e) {
            self::log('Ошибка загрузки географии обслуживания (saveSettings): ' . $e->getMessage());
            throw new waException('Не удалось загрузить список городов');
        }

        $from_city_name = trim($settings['from_city']['city']);

        $city = $this->findCity(array(
            'country_iso3'   => 'rus',
            'region'         => $settings['from_city']['region'],
            'name_lowercase' => $this->makeSearchable($from_city_name)
        ));

        if (!$city) {
            self::log(
                "Не удалось определить город отправки (saveSettings).\n" .
                var_export($settings['from_city'], true)
            );
            throw new waException('Не удалось определить город отправки');
        }

        if (((string)$city['has_office'] == '0') && (!array_key_exists('pickup', $settings) || !$settings['pickup'])) {
            self::log("Обязательна услуга забора (saveSettings).\n" . var_export($city, true));
            throw new waException('В городе "' . (string)$city['name'] . '" услуга забора товара у отправителя обязательна');
        }

        $settings['from_city'] = $settings['from_city'] + array(
                'tzoneid'      => (string)$city['tzoneid'],
                'id'           => (string)$city['id'],
                'country_iso2' => 'RU',
                'country_iso3' => 'rus'
            );

        return parent::saveSettings($settings);
    }

    /**
     * Элемент управления для пункта настроек с размерами упаковки
     *
     * @param string $name
     * @param array $params
     * @return string
     */
    public static function settingPackageSelect($name, $params = array())
    {
        foreach ($params as $field => $param) {
            if (strpos($field, 'wrapper')) {
                unset($params[$field]);
            }
        }

        if (!empty($params['value']) && !is_array($params['value'])) {
            $params['value'] = array(array('min_weight' => 0, 'package' => $params['value']));
        }

        if (empty($params['value'])) {
            $params['value'] = array(array('min_weight' => 0, 'package' => '20x20x20'));
        }

        waHtmlControl::addNamespace($params, $name);

        $namespace = '';
        if (!empty($params['namespace'])) {
            if (is_array($params['namespace'])) {
                $namespace = array_shift($params['namespace']);
                while (($namespace_chunk = array_shift($params['namespace'])) !== null) {
                    $namespace .= "[{$namespace_chunk}]";
                }
            } else {
                $namespace = $params['namespace'];
            }
        }

        $view = wa()->getView();
        $view->assign(array('values' => $params['value'], 'namespace' => $namespace));

        $control = $view->fetch(
            waConfig::get('wa_path_plugins') . '/shipping/tkkit/templates/controls/package_select.html'
        );

        return $control;
    }

    /**
     * Элемент управления для пункта настроек выбора региона и города РФ для отправки
     *
     * @param string $name
     * @param array $params
     * @return string
     */
    public static function settingRegionCitySelect($name, $params = array())
    {
        foreach ($params as $field => $param) {
            if (strpos($field, 'wrapper')) {
                unset($params[$field]);
            }
        }
        waHtmlControl::addNamespace($params, $name);
        $namespace = '';
        if (!empty($params['namespace'])) {
            if (is_array($params['namespace'])) {
                $namespace = array_shift($params['namespace']);
                while (($namespace_chunk = array_shift($params['namespace'])) !== null) {
                    $namespace .= "[{$namespace_chunk}]";
                }
            } else {
                $namespace = $params['namespace'];
            }
        }

        $WaRegion = new waRegionModel();
        $regions = $WaRegion->getByCountry('rus');
        $regions = array_column($regions, 'name', 'code');
        $view = wa()->getView();
        $view->assign(array(
            'values'    => $params['value'],
            'namespace' => $namespace,
            'params'    => $params,
            'regions'   => $regions
        ));

        $control = $view->fetch(
            waConfig::get('wa_path_plugins') . '/shipping/tkkit/templates/controls/region_city_select.html'
        );

        return $control;
    }

    /**
     * 1. Учесть перенос часа
     * 2. Учесть комлектацию
     * 3. Учесть день недели
     *
     * @return int
     * @throws waException
     */
    private function calcDaysToShip()
    {
        $days_to_add = intval($this->handling_days);
        $limit_hour = intval($this->limit_hour);
        $limit_hour = (($limit_hour > 0) && ($limit_hour < 24)) ? $limit_hour : 0;

        if ($limit_hour && date('H') >= $limit_hour) {
            $days_to_add++;
        }

        if ($this->shipping_days && (count($this->shipping_days) < 7)) {
            while (
                ($dow = date('N', strtotime("+$days_to_add days"))) &&
                (!isset($this->shipping_days[$dow]) || !$this->shipping_days[$dow]) &&
                $days_to_add < 30
            ) {
                $days_to_add++;
            }
        }

        if ($days_to_add >= 30) {
            throw new waException("Насчитался месяц до отправки. Вероятно какая-то ошибка. Расчет прерван.");
        }

        return $days_to_add;
    }

    /**
     * Округляем до килограммов
     *
     * @return float|int
     */
    protected function getTotalWeight()
    {
        $weight = parent::getTotalWeight();
        $weight = ceil($weight);
        if ($weight > 0) {
            return $weight;
        }
        return 1;
    }

    /**
     *
     */
     
     
    public function calculate($address = null)
    {
        if($address) {
            $this->setAddress($address);
        }
        
        try {
            $this->checkRequiredExtensions();
        } catch (waException $e) {
            self::log('Ошибка проверки расширений PHP (calculate): ' . $e->getMessage());
            return false;
        }

        try {
            $this->loadGeography();
            $this->loadOffices();
        } catch (Exception $e) {
            self::log('Ошибка загрузки географии обслуживания (calculate): ' . $e->getMessage());
            return false;
        }

        try {
            $this->validateAddressFields($address);
        } catch (waException $e) {
            return array(
                array('rate' => null, 'comment' => $e->getMessage())
            );
        }

        // Город в который доставка
        $kit_city = $this->findCity(array(
            'country_iso3'   => $this->getAddress('country'),
            'region'         => ($this->getAddress('country') == 'rus' ? $this->getAddress('region') : null),
            'name_lowercase' => $this->makeSearchable($this->getAddress('city'))
        ));

        if (!($kit_city)) {
            self::log(
                "Не найден город доставки (calculate):\nСтрана: " .
                $this->getAddress('country') .
                "\nРегион: " . $this->getAddress('region') .
                "\nГород " . $this->getAddress('city') .
                ' : ' . $this->makeSearchable($this->getAddress('city'))
            );
            return false;
        }

        // todo провреить еще раз город отправителя

        // Терминалы в транспортной зоне
        $kit_tzone_terminals = $this->offices->xpath("//offices/office[@tzone_id='" . $kit_city['tzoneid'] . "' or @city_id='{$kit_city['id']}']");

        // Если в транспортной зоне есть хоть один терминал с кассой екит, то возможна доставка с наложкой
        $ekit_allowed = false;
        foreach ($kit_tzone_terminals as $terminal) {
            if ((string)$terminal['ekit'] == '1') {
                $ekit_allowed = true;
                break;
            }
        }

        // Здесь нет доставки с наложкой, а у нас включена опция "только с кассой Е-КИТ"
        if ($this->ekit_only && !$ekit_allowed) {
            self::log("В город {$kit_city['name']} нет наложенного платежа, в настройках доставка только в города с кассой Е-Кит");
            return false;
        }

        $courier = array();
        $terminals = array();

        // считаем адресную доставку, если включено в опциях
        if (isset($this->delivery['courier']) &&
            ((string)$kit_city['id'] != $this->from_city['id'])
        ) {
            try {
                $price = new waArrayObject($this->requestPrice($kit_city, array('return' => 'all')));
                $price_value = $this->calcTotalCost(floatval(str_replace(',', '.', (string)$price->PRICE->TOTAL)));
                $est_delivery = $this->getEstimatedDelivery((string)$price->ifset('DAYS', '0'));
                $courier['COURIER'] = array(
                    'name'         => 'Адресная доставка',
                    'currency'     => 'RUB',
                    'rate'         => $price_value,
                    'comment'      => 'Курьерская доставка по указанному адресу',
                    'est_delivery' => $est_delivery
                );
            } catch (Exception $e) {
                self::log(
                    'Ошибка расчета адресной доставки (calculate) город: ' .
                    var_export($kit_city, true) . "\n" . $e->getMessage()
                );
            }
        }

        // @todo: Есть гипотетическая вероятность, что в городе есть терминал, на котором нет кассы Е-КиТ, а наложку принимает терминал зоны, находящийся в другом городе. Будут проблемы -- придется переделывать
        if (isset($this->delivery['terminal']) && (bool)count($kit_tzone_terminals)) {
            $terminal_city = null; // город для которого считать доставку до терминала

            // Если в городе есть офис, то считаем доставку до этого города
            if ((string)$kit_city['has_office'] == '1') {
                $terminal_city = $kit_city;
            } else {
                foreach ($kit_tzone_terminals as $terminal) {
                    $t_city_id = (string)$terminal['city_id'];
                    if (!empty($t_city_id)) { // Бывают терминалы, у которых id города не указан o_O
                        if (((bool)$this->ekit_only && (string)$terminal['ekit'] == '1') || !(bool)$this->ekit_only) { // если в настройках требуется касса екит
                            $terminal_city = $this->findCity(array('id' => (string)$terminal['city_id']));
                            if (((string)$terminal_city['has_office'] == '1') && ((string)$terminal_city['id'] != (string)$kit_city['id'])) {
                                break;
                            } else {
                                $terminal_city = null;
                            }
                        }
                    }
                }
            }

            if (!is_null($terminal_city)) { // город с терминалом нашелся
                try {
                    $price = new waArrayObject($this->requestPrice($terminal_city, array('delivery' => 'stock', 'return' => 'all')));
                    $price_value = $this->calcTotalCost(floatval(str_replace(',', '.', (string)$price->PRICE->TOTAL)));
                    $est_delivery = $this->getEstimatedDelivery((string)$price->ifset('DAYS', '0'));
                    foreach ($kit_tzone_terminals as $terminal) {
                        if ($this->ekit_only && (string)$terminal['ekit'] != '1') {
                            continue;
                        }
                        if ($this->incity_terminal_only && ((string)$kit_city['id'] != (string)$terminal['city_id'])) {
                            continue;
                        }
                        if ($this->isBlacklistedTerminal($terminal)) {
                            continue;
                        }
                        $terminals['KITOF-' . $terminal['id']] = array(
                            'name'         => 'Терминал ' . htmlentities($terminal['name'], null, 'UTF-8'),
                            'currency'     => 'RUB',
                            'rate'         => $price_value,
                            'comment'      => implode(', ', array(
                                htmlentities($terminal['city_name'], null, 'UTF-8'),
                                htmlentities($terminal['street'], null, 'UTF-8'),
                                htmlentities($terminal['work_schedule'], null, 'UTF-8')
                            )),
                            'est_delivery' => $est_delivery
                        );

                    }
                } catch (Exception $e) {
                    self::log($e->getMessage());
                }

            }
        }

        $rates = $this->variants_order == 'courier-first' ? $courier + $terminals : $terminals + $courier;

        return $rates ? $rates : 'Недоступно';
    }

    protected function init()
    {
        waAutoload::getInstance()->add('EvalMath', "wa-plugins/shipping/tkkit/lib/vendors/evalmath.class.php");
        waAutoload::getInstance()->add('EvalMathStack', "wa-plugins/shipping/tkkit/lib/vendors/evalmath.class.php");
        parent::init();
    }

    /**
     *
     */
    protected function initControls()
    {
        $this
            ->registerControl('PackageSelect')
            ->registerControl('RegionCitySelect');

        parent::initControls();
    }

    /**
     * Расчет наценки
     *
     * @todo Надо вообще все перевести в формулы
     * @param float|string $kit_cost
     * @return float
     */
    private function calcTotalCost($kit_cost)
    {
        $kit_cost = floatval(str_replace(',', '.', $kit_cost));
        $percent_sign_pos = strpos($this->handling_cost, '%');

        // Если процентов нет, то и думать нечего. Приплюсуем и все дела
        if (($percent_sign_pos === false) && ($this->handling_base != 'formula')) {
            return $this->roundPrice(floatval(str_replace(',', '.', $this->handling_cost)) + $kit_cost);
        }

        if ($this->handling_base == 'formula') {
            $EvalMath = new EvalMath();
            $EvalMath->suppress_errors = 1;

            $EvalMath->evaluate('z=' . str_replace(',', '.', (string)$this->getTotalPrice()));
            $EvalMath->evaluate('s=' . str_replace(',', '.', (string)$kit_cost));

            $math_result = $EvalMath->evaluate($this->handling_cost);
            if ($math_result === false) {
                self::log('Ошибка исполнения формулы "' . $this->handling_cost . '" (' . $EvalMath->last_error . ')');
                return $this->roundPrice($kit_cost);
            }
            return $this->roundPrice($math_result);
        }

        switch ($this->handling_base) {
            case 'shipping' :
                $base = $kit_cost;
                break;
            case 'order_shipping':
                $base = $this->getTotalPrice() + $kit_cost;
                break;
            case 'order':
            default:
                $base = $this->getTotalPrice();
        }

        $cost = substr($this->handling_cost, 0, $percent_sign_pos);
        if (strlen($cost) < 1) {
            return $kit_cost;
        }

        return $this->roundPrice($kit_cost + $base * floatval($cost) / 100);
    }

    /**
     * Проверка необходимых расширений PHP. Чтоб не полагаться только на requirements.php
     */
    private function checkRequiredExtensions()
    {
        $required_extensions = array(
            'curl'      => 'Не найден модуль cURL для PHP.',
            'mbstring'  => 'Не найден модуль mbstring для PHP, необходимый для обработки ответа.',
            'simplexml' => 'Не найден модуль SimpleXML для PHP.'

        );
        foreach ($required_extensions as $ext => $msg) {
            if (!extension_loaded($ext)) {
                throw new waException($msg . ' Расчет стоимости доставки невозможен.');
            }
        }
    }

    /**
     * @param array $conditions
     * @param array $options
     * @return SimpleXMLElement|SimpleXMLElement|null
     */
    private function findCity($conditions = array(), $options = array())
    {
        $options = $options + array('first' => true);

        /**
         * @var bool $opt_first
         */
        extract($options, EXTR_PREFIX_ALL, 'opt');
        $result = null;
        $condition_array = array();
        foreach ($conditions as $attr => $value) {
            if (!is_null($value)) {
                $condition_array[] = "@$attr='$value'";
            }
        }

        if ($condition_array) {
            /** @var SimpleXMLElement[] $x_cities */
            $x_cities = $this->geography->xpath('//cities/city[' . implode(' and ', $condition_array) . ']');

            if (count($x_cities)) {
                if ($opt_first) {
                    $gor = null;
                    foreach ($x_cities as $x_city) {
                        if ((string)$x_city['settlement_type'] == 'гор.') {
                            $gor = $x_city;
                            break;
                        }
                    }
                    if (!is_null($gor)) {
                        $result = $gor;
                    } else {
                        $result = array_shift($x_cities);
                    }
                } else {
                    $result = $x_cities;
                }
            }
        }

        return $result;
    }

    /**
     * @return waCache
     */
    private function getCache()
    {
        $cache = wa()->getCache();
        if ($cache) {
            return $cache;
        }

        return new waCache(new waFileCacheAdapter(array()), 'webasyst');
    }

    /**
     * @param string $iso2
     * @return string
     * @throws waException
     */
    private function getCountryIso3ByIso2($iso2)
    {
        /** @var waCountryModel $Country */
        static $Country = null;

        /** @var string[] $codes */
        static $codes = array();

        $iso2 = mb_strtolower($iso2);

        if (array_key_exists($iso2, $codes)) {
            return $codes[$iso2];
        }

        if (is_null($Country)) {
            $Country = new waCountryModel();
        }

        $country = $Country->getByField('iso2letter', $iso2);
        if (!$country) {
            throw new waException('Неизвестный ISO2 код ' . $iso2);
        }
        $codes[$iso2] = $country['iso3letter'];

        return $codes[$iso2];
    }

    /**
     * Превращаем строку из настроек размеров посылки "ДxШxВ" в массив
     * [
     *  'length'=>int,
     *  'width' => int,
     *  'height' => int
     * ]
     * @return array
     * @throws waException
     */
    private function getDimensions()
    {
        if (!is_array($this->parcel_dimensions)) {
            $this->parcel_dimensions = array(
                array('min_weight' => 0, 'package' => $this->parcel_dimensions)
            );
        }

        $weight = $this->getTotalWeight();
        $package = null;

        foreach ($this->parcel_dimensions as $rule) {
            $min_weight = floatval(str_replace(',', '.', $rule['min_weight']));
            if ($weight < $min_weight) {
                break;
            }
            $package = $rule['package'];
        }

        if (is_null($package)) {
            throw new waException(sprintf("Не найдено подходящего размера упаковки для веса заказа %.3f кг.", $weight));
        }

        $dimensions = explode('x', strtolower($package));

        $items_cnt = count($dimensions);
        if ($items_cnt > 3) {
            $dimensions = array_slice($dimensions, 0, 3);
        } elseif ($items_cnt < 3) {
            $dimensions = array_fill($items_cnt - 1, 3 - $items_cnt, 20);
        }

        foreach ($dimensions as $k => $v) {
            $dimensions[$k] = intval($v) > 0 ? intval($v) : 20;
        }

        return array_combine(array('length', 'width', 'height'), $dimensions);
    }

    /**
     * Рассчитывает приблизительную дату доставки
     *
     * @param string $delivery_days
     * @return string
     * @throws waException
     */
    private function getEstimatedDelivery($delivery_days)
    {
        if (!$delivery_days) {
            return 'Уточняйте у менеджера';
        }

        $days = explode(',', $delivery_days);
        if (empty($days)) {
            return 'Уточняйте у менеджера';
        }

        $min_days = min($days);
        $max_days = max($days);

        if (($min_days == 0) || ($max_days == 0)) {
            return 'Уточняйте у менеджера';
        }

        $days_to_add = $this->calcDaysToShip();

        $est_delivery = waDateTime::format('humandate', sprintf("+%d days", (int)$min_days + $days_to_add));
        if ($min_days != $max_days) {
            $est_delivery .= '–' . waDateTime::format('humandate', sprintf("+%d days", (int)$max_days + $days_to_add));
        }

        return $est_delivery;
    }

    /**
     * @param SimpleXMLElement $terminal
     * @return bool
     */
    private function isBlacklistedTerminal($terminal)
    {
        if ((string)$terminal['tzone_id'] == '0000007700') {
            if ((string)$terminal['id'] !== '7701') {
                return true;
            }
        }
        return false;
    }

    /**
     * Загрузка и кэширование географии обслуживания
     *
     * @param array $params
     * @return null|SimpleXMLElement
     * @throws waException
     */
    private function loadGeography($params = array())
    {
        $defaults = array('clear_cache' => false);
        $params = $params + $defaults;

        /**
         * @var bool $clear_cache
         */
        extract($params);

        if (!is_null($this->geography) && ($this->geography instanceof SimpleXMLElement) && !$clear_cache) {
            return $this->geography;
        }

        $cache = $this->getCache();

        if ($clear_cache) {
            $cache->delete('geography', 'tkkit');
        }

        $geography_xml = $cache->get('geography', 'tkkit');

        if (!$geography_xml) {
            $cities = $this->request(array('request' => array('f' => 'get_city_list'), 'method' => waNet::METHOD_GET));
            $this->geography = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><cities />');

            foreach ($cities['CITY'] as $city) {
                try {
                    $country_iso3 = $this->getCountryIso3ByIso2($city['COUNTRY']);
                    $tzone = mb_strtolower($city['TZONE']);
                    $sr = mb_strtolower($city['SR'], 'utf-8');
                    $x_city = $this->geography->addChild('city');
                    $x_city['id'] = $city['ID'];
                    $x_city['name'] = $city['NAME'];
                    $x_city['name_lowercase'] = mb_ereg_replace('\s?\([^\)]*\)', '', $this->makeSearchable($city['NAME'], false));
                    $x_city['country_iso3'] = $country_iso3;
                    $x_city['country_iso2'] = $city['COUNTRY'];
                    $x_city['region'] = $city['REGION'];
                    $x_city['tzoneid'] = $city['TZONEID'];
                    $x_city['tzone'] = empty($tzone) || $tzone == 'n' ? 0 : 1; // видимо терминал, обслуживающий зону
                    $x_city['has_office'] = empty($sr) || $sr == 'n' ? 0 : 1;
                    $x_city['area_center'] = empty($city['OC']) ? 0 : 1;
                    $x_city['settlement_type'] = mb_strtolower($city['TP']);
                    // $city['SP'] ??????
                } catch (waException $e) {
                    self::log('Ошибка разбора географии (loadGeography): ' . var_export($city, true));
                }
            }
            $cache->set('geography', $this->geography->asXML(), 43200, 'tkkit');
        } else {
            try {
                $this->geography = new SimpleXMLElement($geography_xml);
            } catch (Exception $e) {
                self::log('Ошибка загрузки данных из кэша (loadGeography)');
                $this->geography = null;
            }
        }

        return $this->geography;
    }

    /**
     * Загрузка и кэширование списка региональных офисов
     *
     * @param array $params
     * @return null|SimpleXMLElement
     * @throws waException
     */
    private function loadOffices($params = array())
    {
        $default_params = array('clear_cache' => false);
        $params = $params + $default_params;

        /**
         * @var bool $clear_cache
         */
        extract($params);

        if (!is_null($this->offices) && ($this->offices instanceof SimpleXMLElement) && !$clear_cache) {
            return $this->offices;
        }

        $cache = $this->getCache();

//        $cache = new waSerializeCache('tkkitoffices', 43200, 'webasyst');
        if ($clear_cache) {
            $cache->delete('offices', 'tkkit');
        }

        $offices_xml = $cache->get('offices', 'tkkit');

        if ($offices_xml) {
            try {
                $this->offices = new SimpleXMLElement($offices_xml);
                return $this->offices;
            } catch (Exception $e) {
                self::log('Ошибка загрузки данных из кэша (loadOffices)');
            }
            $this->offices = null;
        }

        $cities = $this->request(array('request' => array('f' => 'get_rp'), 'method'=>waNet::METHOD_GET));
        $this->offices = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><offices />');

        foreach ($cities as $city_id => $offices) {
            foreach ($offices as $office) {
                try {
                    $country_iso3 = $this->getCountryIso3ByIso2($office['LAND1']);
                    $x_office = $this->offices->addChild('office');
                    $x_office['id'] = $office['WERKS'];
                    $x_office['name'] = $office['WERKS_NAME'];
                    $x_office['city_id'] = $city_id;
                    $x_office['country_iso3'] = $country_iso3;
                    $x_office['zip'] = $office['PSTLZ'];
                    $x_office['region'] = $office['REGIO'];
                    $x_office['city_name'] = $office['ORT01'];
                    $x_office['street'] = $office['STRAS'];
                    $x_office['work_schedule'] = mb_strtolower($office['ZSCHWORK'], 'UTF-8');
                    $x_office['address_comment'] = $office['ZALTAD'];
                    $x_office['street_code'] = $office['STREETCODE'];
                    $x_office['tzone_id'] = $office['TRANSPZONE'];
                    $x_office['phone'] = $office['TEL_NUMBER'];
                    $x_office['phone_ext'] = $office['TEL_EXTENS'];
                    $x_office['comment'] = $office['REMARK'];
                    $x_office['ekit'] = !empty($office['EKIT']) ? 1 : 0;
                } catch (waException $e) {
                    self::log('Ошибка нормализации данных по офису (loadOffices): ' . $e->getMessage());
                }
            }
        }

        $cache->set('offices', $this->offices->asXML(), 43200, 'tkkit');

        return $this->offices;
    }

    /**
     * Простой логгер
     *
     * @param string $msg
     */
    private static function log($msg)
    {
        if (waSystemConfig::isDebug()) {
            waLog::log($msg, self::LOG_FILE);
        }
    }

    /**
     * Строку в lowercase
     * Замена ё на е. xslt не понимает, что буквы взаимозаменяемы
     *
     * @param string $str
     * @param bool $escape применять htmlentities
     * @return string
     */
    private function makeSearchable($str, $escape=true)
    {
        $str = mb_strtolower($str, 'UTF-8');
        $str = mb_ereg_replace('ё', 'е', $str, 'UTF-8');

        return $escape ? htmlentities($str, ENT_QUOTES, 'UTF-8') : $str;
    }

    /**
     *
     * @param array $params
     * @return mixed
     * @throws waException
     */
    private function request($params = array())
    {
        $defaults = array('request' => array(), 'decode_json_result' => true, 'method'=>waNet::METHOD_POST);
        $params = $params + $defaults;

        /**
         * @var array $request
         * @var $method
         * @var bool $decode_json_result
         */
        extract($params);

        $url = self::API_URL;

        // is POST?
        if ($method == waNet::METHOD_GET) {
            $url .= '?' . http_build_query($request);
            $request=array();
        }

        $wanet = new waNet(array('format'=>waNet::FORMAT_RAW));
        $info = self::info($this->getId());
        $wanet->userAgent(sprintf(
            'TK Kit Calc Plugin v.%s for Webasyst Framework/%s',
            ifempty($info['version'], '1.0.0'),
            wa()->getVersion('webasyst')
        ));

        $result = $wanet->query($url, $request, $method);

        if ($decode_json_result) {
            $decoded_result = json_decode($result, true);
            if (is_null($decoded_result)) {
                self::log("Ошибка декодирования ответа сервера.\n " . var_export($result, true));
                throw new waException('Сервер перевозчика недоступен.');
            }
            return $decoded_result;
        }

        return $result;
    }

    /**
     * @param array|SimpleXMLElement $to
     * @param array $params
     * @return float|array
     * @throws waException
     */
    private function requestPrice($to, $params = array())
    {
        $default_params = array(
            'delivery' => 'courier',
            'pickup'   => $this->pickup ? 'courier' : 'stock',
            'return'   => 'price'
        );
        $params = $params + $default_params;

        /**
         * @var string $opt_delivery
         * @var string $opt_pickup
         * @var string $opt_return
         */
        extract($params, EXTR_PREFIX_ALL, 'opt');

        $from = $this->from_city;

        try {
            $dimensions = $this->getDimensions();
            if (!is_array($dimensions) || (count($dimensions) != 3)) {
                throw new waException('Ошибка размеров (requestPrice)');
            }
            if (!is_array($from) || !array_key_exists('id', $from) || !array_key_exists('region', $from) || !array_key_exists('tzoneid', $from)) {
                throw new waException('Ошибка в городе отправителя (requestPrice)');
            }
        } catch (waException $e) {
            self::log($e->getMessage());
            throw $e;
        }

        $data = array(
            'f'        => 'price_order',
            'DELIVERY' => $opt_delivery == 'courier' ? 1 : 0,
            'PICKUP'   => $opt_pickup == 'courier' ? 1 : 0,
            'WEIGHT'   => $this->getTotalWeight(),
//            'VOLUME'   => 0.001,
            'LENGTH'   => $dimensions['length'],
            'WIDTH'    => $dimensions['width'],
            'HEIGHT'   => $dimensions['height'],
            'SLAND'    => 'RU',
            'SZONE'    => (string)$from['tzoneid'],
            'SCODE'    => (string)$from['id'],
            'SREGIO'   => (string)$from['region'],
            'RLAND'    => (string)$to['country_iso2'],
            'RZONE'    => (string)$to['tzoneid'],
            'RCODE'    => (string)$to['id'],
            'RREGIO'   => (string)$to['region'],
            'PRICE'    => $this->getTotalPrice()
        );

        $result = $this->request(array('request' => $data, 'method'=>waNet::METHOD_POST));

        if (
            !array_key_exists('PRICE', $result) ||
            !array_key_exists('TRANSFER', $result['PRICE']) ||
            !array_key_exists('TOTAL', $result['PRICE']) ||
            is_null($result['PRICE']['TRANSFER'])
        ) {
            self::log(
                "Ошибка расчета стоимости доставки. Данные запроса:\n" .
                var_export($data, true) .
                "\nОтвет сервера:\n" .
                var_export($result, true)
            );
            throw new waException('Ошибка запроса сервера перевозчика');
        }

        if ($opt_return == 'price') {

            $price = floatval(str_replace(',', '.', $result['PRICE']['TOTAL']));

            // @todo: check and convert currency if needed
//        if(array_key_exists('E_WAERS', $result) && !empty($result['E_WAERS']) && $result['E_WAERS'] != 'RUB') {
//            $price = wacu
//        }

            return $price;
        }

        return $result;
    }

    /**
     * Округление по заданным в настройках правилам
     *
     * @param float|string $price
     * @return float
     */
    private function roundPrice($price)
    {
        if ($this->rounding == '0.01') {
            return $price;
        }

        $price = floatval(str_replace(',', '.', $price));
        $rounding = floatval($this->rounding);
        $precision = intval(0 - log10($rounding));
        $rounded = round($price, $precision);

        if ($this->rounding_type == 'std') {
            return $rounded;
        }

        if (($this->rounding_type == 'up') && ($price > $rounded)) {
            return $rounded + $rounding;
        }

        if (($this->rounding_type == 'down') && ($rounded > $price)) {
            return $rounded - $rounding;
        }

        return $rounded;
    }

    /**
     * Проверка заполненности адресных полей
     *
     * @return bool
     * @throws waException
     */
    private function validateAddressFields()
    {
        $country = $this->getAddress('country');
        $region = $this->getAddress('region');
        $city = $this->getAddress('city');

        if (!$country) {
            throw new waException('Для расчета стоимости доставки укажите страну доставки');
        }

        if (!array_key_exists($country, $this->countries)) {
            throw new waException('Доставка в выбранную страну не осуществляется');
        }

        if ($country == 'rus') {
            if (!$region || !$city) {
                throw new waException('Для расчета стоимости доставки укажите город и регион доставки');
            }
            return true;
        }

        if (!$city) {
            throw new waException('Для расчета стоимости доставки укажите город доставки');
        }

        return true;
    }
}
