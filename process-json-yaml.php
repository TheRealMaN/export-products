<?php

require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

// variables
$file_dir           = __DIR__;
$file_source        = $file_dir.'/products.json';
$file_fixed         = $file_dir.'/products_fixed.json';
$file_destination   = $file_dir.'/frontmatter.yaml';

$fixes = array( 
  // replace array syntacsis
  // '1' => ['find' => '.png",', 'replace' => '.png"],'],
  // '2' => ['find' => '.png;', 'replace' => '.png", "'],
  // '3' => ['find' => '"image": "http', 'replace' => '"image": ["http'],
  // replace URL of images
  // '4' => ['find' => 'http://avonang.ru/img/', 'replace' => 'image://'],
  // replace image file format
  // '5' => ['find' => '.png', 'replace' => '.jpg'],
  // replace product currency
  '6' => ['find' => '.00 RUB', 'replace' => '']
);

// open JSON file
$file_content = file_get_contents($file_source);

// fix JSON file
foreach ($fixes as $fix) {
  $file_content = str_replace($fix['find'], $fix['replace'], $file_content);
}

// save fixed JSON file
file_put_contents($file_fixed, $file_content);

// open fixed JSON file and trim UTF BOM signature
$file_content = trim(file_get_contents($file_fixed), "\xEF\xBB\xBF");

// debug variable
$array = json_decode( $file_content, true );

echo 'error code: '.json_last_error();


// convert JSON to yaml
$yaml = Yaml::dump($array);

// save yaml file
file_put_contents($file_destination, $yaml);

?>