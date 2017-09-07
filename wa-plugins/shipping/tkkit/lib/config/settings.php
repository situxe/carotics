<?php
/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.3.0
 * @copyright Serge Rodovnichenko, 2016
 * @license http://www.webasyst.com/terms/#eula Webasyst
 * @package wa-plugins.shipping.tkkit
 */

return array(
    'from_city'            => array(
        'title'        => 'Город отправки',
        'description'  => 'Город в РФ из которого осуществляется отправка',
        'control_type' => 'RegionCitySelect',
        'value'        => array(
            'region'       => '77',
            'city'         => 'Москва',
            'id'           => '770000000000',
            'tzoneid'      => '0000007700',
            'country_iso3' => 'rus',
            'country_iso2' => 'RU'
        ),
    ),
    'pickup'               => array(
        'title'        => 'Забор груза',
        'description'  => 'Транспортная компания должна забрать груз на вашем складе. Уберите отметку, если вы сами привозите на терминал',
        'control_type' => waHtmlControl::CHECKBOX,
        'value'        => 1
    ),
    'parcel_dimensions'    => array(
        'value'        => array(array('min_weight' => 0, 'package' => '10x10x10')),
        'title'        => 'Средние размеры отправления в сантиметрах',
        'control_type' => 'PackageSelect',
    ),
    'countries'            => array(
        'title'            => 'Страны доставки',
        'description'      => 'В которые считать доставку',
        'control_type'     => waHtmlControl::GROUPBOX,
        'value'            => array('rus' => 'rus'),
        'options_callback' => array('tkkitShipping', 'getAvailableCountries'),
    ),
    'delivery'             => array(
        'title'        => 'Доставка',
        'description'  => 'Какие виды доставки рассчитывать',
        'control_type' => waHtmlControl::GROUPBOX,
        'value'        => array('courier' => 'courier', 'terminal' => 'terminal'),
        'options'      => array(
            array('value' => 'courier', 'title' => 'Адресная доставка (курьер)'),
            array('value' => 'terminal', 'title' => 'Терминал (пункт выдачи самовывоза)')
        )
    ),
    'ekit_only'            => array(
        'title'        => 'Только с кассой Е-КИТ',
        'description'  => 'Расчет будет производиться только для городов, в которых есть возможность приема наложенного платежа (есть касса Е-Кит)',
        'control_type' => waHtmlControl::CHECKBOX,
        'value'        => '1'
    ),
    'incity_terminal_only' => array(
        'title'        => 'Терминалы только в городе доставки',
        'description'  => 'Считать доставку до терминала только если терминал расположен в городе доставки. Если выключено, показывает возможность самовывоза с терминалов, обслуживающих город получателя, которые совсем необязательно находятся в том же городе',
        'value'        => '0',
        'control_type' => waHtmlControl::CHECKBOX
    ),
    'limit_hour'           => array(
        'value'        => 18,
        'title'        => 'Час переноса отгрузки',
        'description'  =>
            'Час, после которого к сроку доставки прибавляется 1 день. Укажите 0, чтобы выключить эту функцию',
        'control_type' => waHtmlControl::INPUT
    ),
    'handling_days'        => array(
        'value'        => 0,
        'title'        => 'Срок комплектации',
        'description'  =>
            'Дополнительное количество дней на комплектацию заказа. Срок будет добавлен к расчетному сроку доставки',
        'control_type' => waHtmlControl::INPUT
    ),
    'shipping_days'        => array(
        'title'        => 'Дни недели для отгрузки',
        'description'  =>
            'Дни недели, в которые осуществляется передача заказов на отправку. Сначала считается дата, когда заказ ' .
            'будет скомплектован в соответствии с предыдущими разделами настроек, после вычисляется первый ' .
            'подходящий день отправки',
        'control_type' => waHtmlControl::GROUPBOX,
        'options'      => array(
            array('value' => 1, 'title' => 'Понедельник'),
            array('value' => 2, 'title' => 'Вторник'),
            array('value' => 3, 'title' => 'Среда'),
            array('value' => 4, 'title' => 'Четверг'),
            array('value' => 5, 'title' => 'Пятница'),
            array('value' => 6, 'title' => 'Суббота'),
            array('value' => 7, 'title' => 'Воскресенье'),
        ),
        'value'        => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5)
    ),

    'handling_base'        => array(
        'value'        => 'order',
        'title'        => 'База расчета комплектации',
        'description'  =>
            'Базовая сумма, которая используется для расчета процентов при подсчете стоимости ' .
            'комплектации. Имеет смысл только если расчет комплектации идет в процентах. <b>Заказ</b> - стоимость ' .
            'товаров в заказе. <b>Заказ+доставка</b> - сумма стоимости заказа и <i>расчетной</i> (той, что Кит ' .
            'насчитал) стоимости доставки',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'order'          => 'Заказ',
            'order_shipping' => 'Заказ+доставка',
            'shipping'       => 'Доставка',
            'formula'        => 'Формула'
        ),
    ),
    'handling_cost'        => array(
        'value'        => 0,
        'title'        => 'Стоимость комплектации',
        'description'  =>
            'Дополнительная сумма, которая должна быть добавлена к результату расчета. Фиксированная сумма, ' .
            'проценты от <b>стоимости заказа</b>. Например "100" - 100 рублей, "10%" - 10 процентов. Или формула: ' .
            'в которой доступны переменные Z (стоимость заказа) и S (стоимость доставки). Подробнее о формуле ' .
            'смотрите <a href="//www.webasyst.ru/store/plugin/shipping/tkkit/#formula">на странице описания плагина</a>'
    ,
        'control_type' => waHtmlControl::INPUT,
    ),
    'rounding'             => array(
        'value'        => '0.01',
        'title'        => 'Округление',
        'description'  => 'Округление итогового результата с учетом всех наценок',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            '0.01' => 'Не округлять',
            '0.1'  => 'до 0.10 (десятков копеек)',
            '1'    => 'до 1.00 (целого рубля)',
            '10'   => 'до 10 (десятков рублей)',
            '100'  => 'до 100 (сотен рублей)'),
    ),
    'rounding_type'        => array(
        'value'        => 'std',
        'title'        => 'Правило округления',
        'description'  =>
            'Как поступать при округлении: <b>обычное</b> (до половины вниз, больше половины вверх), <b>вверх</b> -' .
            'всегда в большую сторону, <b>вниз</b> - всегда в меньшую сторону',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array('std' => 'Обычное', 'up' => 'Вверх', 'down' => 'Вниз'),
    ),

    'variants_order'       => array(
        'value'        => 'courier-first',
        'title'        => 'Очередность вариантов доставки',
        'description'  =>
            'Очередность показа вариантов доставки адресная или до терминала. Если для города доступны и адресная ' .
            'доставка, и терминалы, то здесь можно указать какой вариант будет первым',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array('courier-first' => 'Сначала адресная', 'terminal-first' => 'Сначала терминалы'),
    ),

    // for future use
//    'terminal_filter'   => array(
//        'title'        => 'Терминалы',
//        'description'  => '',
//        'control_type' => waHtmlControl::SELECT,
//        'value'        => 'tzone',
//        'options'      => array(
//            array('value' => 'city', 'title' => 'В городе'),
//            array('value' => 'zone', 'title' => 'В транспортной зоне')
//        )
//    )
);
