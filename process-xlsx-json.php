<?php

require __DIR__ . '/vendor/autoload.php';

$file_dir         = __DIR__;
$file_json = $file_dir.'/products.json';

$output = array();

if ( $xlsx = SimpleXLSX::parse('products.xlsx')) {
  
  // skip header
  $xlsx_parsed = array_slice($xlsx->rows(), 1);
  $i = 0;

  foreach ($xlsx_parsed as $row) {
    if (empty($row[0])) { break; };

    $output[$i] = [
      'id' => $row[0],
      'name' => $row[1],
      'price' => $row[2],
      'link' => $row[3],
      'link_affilate' => $row[4],
      'image' => $row[5],
      'description' => $row[6],
      'sort' => $row[7],
      'category' => $row[8]
    ];

    $i++;
  };

  $json = json_encode( $output, JSON_UNESCAPED_UNICODE );
  

  // save yaml file
  $json = '{ "products": ' . $json . '}';
  file_put_contents($file_json, $json);

} else {
	echo SimpleXLSX::parse_error();
}
?>