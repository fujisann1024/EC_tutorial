<?php

// $arry = ['ha'];
// $arry = ['ha' => 95];

// var_dump($arry);

$i = "あかさたな";
$x = password_hash($i, PASSWORD_DEFAULT);
$y = password_verify($i,$x);
print $y;