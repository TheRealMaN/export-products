<?php

echo 'Processing XSLX file... - <strong>products.xslx</strong<br>';

include 'process-xlsx-json.php';
echo 'JSON exported - OK<br>';

include 'process-json-yaml.php';
echo 'YAML exported - OK<br>';

include 'process-json-yml.php';
echo 'YML exported - OK<br>';

?>