<?php
// Создание YML файла с выгрузкой товара
// variables
require __DIR__ . '/vendor/autoload.php';

$file_dir         = __DIR__;
$file_source      = $file_dir.'/products_fixed.json';
$file_destination = $file_dir.'/products.yml';
$image_path       = 'http://avonang.ru/user/themes/actionshop/images/products/';

$categories = array();
$i = 1;

// open JSON file
$file_content = trim(file_get_contents($file_source), "\xEF\xBB\xBF");
$file_json = json_decode( $file_content, true );

$out  = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$out .= '<yml_catalog date="' . date('Y-m-d H:i') . '">' . "\r\n";
$out .= '<shop>' . "\r\n";

// Короткое название магазина, должно содержать не более 20 символов
$out .= '<name>Action Shop</name>' . "\r\n";

// Полное наименование компании
$out .= '<company>Action Shop - аксессуары для экшн камер GoPro</company>' . "\r\n";

// URL главной страницы магазина
$out .= '<url>http://avonang.ru/</url>' . "\r\n";

// Список курсов валют магазина
$out .= '<currencies>' . "\r\n";
$out .= '<currency id="RUR" rate="1"/>' . "\r\n";
$out .= '</currencies>' . "\r\n";


// Список категорий магазина
$out .= '<categories>' . "\r\n";

foreach($file_json['products'] as $product){
  $categories[] = $product['category'];
  $categories = array_unique($categories);
}

foreach($categories as $index => $category){
  $out .= '<category id="' . $i . '">' . $category . '</category>' . "\r\n";
  $i++;
}

$out .= '</categories>' . "\r\n";


// Вывод товаров
$out .= '<offers>' . "\r\n";
  
  foreach($file_json['products'] as $product){
      
    $out .= '<offer available="true" id="'. $product['id'] .'">' . "\r\n";

    // URL страницы товара на сайте магазина
    $out .= '<url>'. $product['link_affilate'] .'</url>' . "\r\n";

    // Цена
    $out .= '<price>'. str_replace(',', '', $product['price']) .'</price>' . "\r\n";

    // Валюта товара
    $out .= '<currencyId>RUR</currencyId>' . "\r\n";

    // ID категории
    $out .= '<categoryId>1</categoryId>' . "\r\n";

    // Изображения товара, до 10 ссылок
    for ($i=0; $i < $product['image']; $i++) {
      $out .= '<picture>'. $image_path . $product['id']. '-' . $i . '.jpg</picture>' . "\r\n";
    }

    // Название товара
    $out .= '<name>'. $product['name'] .'</name>' . "\r\n";

    // Описание товара, максимум 3000 символов.
    $out .= '<description><![CDATA['. $product['description'] .']]></description>' . "\r\n"; 

    $out .= '</offer>' . "\r\n";


};

$out .= '</offers>' . "\r\n";
$out .= '</shop>' . "\r\n";
$out .= '</yml_catalog>' . "\r\n";

$out = str_replace('-0.jpg', '.jpg', $out);

// output YML data
// header('Content-Type: text/xml; charset=utf-8');
// echo $out;

// beautify code and save YML to file
use PrettyXml\Formatter;

$formatter = new Formatter();
$formatter->setIndentSize(2);

$out = str_replace('<![CDATA[', 'in|||', $out);
$out = str_replace(']]>', '|||out', $out);

$out = $formatter->format($out);

$out = str_replace('in|||', '<![CDATA[', $out);
$out = str_replace('|||out', ']]>', $out);

file_put_contents($file_destination, $out);
exit;

?>