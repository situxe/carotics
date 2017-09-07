<?php
/*********************************************************************************
Константы модуля eDost (при обновлении данный файл не переписывается)
*********************************************************************************/

//define('EDOST_WEIGHT_DEFAULT', 0.1); // вес единицы товара по умолчанию в килограммах (будет использоваться, если вес у товара не задан)

//define('EDOST_WEIGHT_CODE', 'weight'); // код характеристики товара "вес" (если задан, тогда вес артиклов игнорируется)
//define('EDOST_WEIGHT_MEASURE', 'G'); // 'KG' или 'G' - единица измерения веса

//define('EDOST_VOLUME_CODE', 'volume'); // код характеристики товара "объем"
//define('EDOST_VOLUME_RATIO', 1000); // коэффициент перевода еденицы измерения объема в еденицу изерения габаритов (пример: коэффицент = 1000, если объем в метрах кубических, а габариты в миллиметрах)

//define('EDOST_SIZE_CODE', 'size'); // код характеристики товара "габариты" (тройной параметр - если не задан, тогда используются поля length, width и height)
//define('EDOST_LENGTH_CODE', 'length'); // код характеристики товара "длина"
//define('EDOST_WIDTH_CODE', 'width'); // код характеристики товара "ширина"
//define('EDOST_HEIGHT_CODE', 'height'); // код характеристики товара "высота"

//define('EDOST_FUNCTION', 'Y'); // 'Y' - подключить файл с пользовательскими функциями 'edost_function.php'
//define('EDOST_IGNORE_ZERO_WEIGHT', 'Y');  // 'Y' - рассчитывать доставку если в корзине есть товар с нулевым весом

//define('EDOST_WRITE_LOG', 'Y');  // 'Y' - включить запись данных расчета в лог файл
//define('EDOST_CACHE_LIFETIME', 18000);  // кэш 5 часов = 60*60*5, кэш 1 день = 60*60*24*1

?>