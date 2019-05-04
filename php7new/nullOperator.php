<?php
//Для теста
//http://alarm.my/php7new/nullOperator.php?name=artur
$val = $_GET['name'] ?? 'default';
echo $val;