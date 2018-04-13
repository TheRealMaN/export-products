<?php

$epn = new \EpnBzLib\EpnBz('', ''); //создание объекта и авторизация на сайте `

$promo_url = 'http://ya.ru'; //получени промо url`

$short_url = $epn->short($promo_url); //сокращение промо урла к виду ali.pub/ABCDE`

?>