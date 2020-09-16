<?php
//メモ

//配列を初期化して
$arry = ['ha'];
$arry['ha'] = 95;

var_dump($arry['ha']);//int(95)
var_dump($arry[0]);//string(2) "ha" 
$i = "あかさたな";
$x = password_hash($i, PASSWORD_DEFAULT);
$y = password_verify($i,$x);
print $y;

class car{
    private $name;

    public function __construct(){

    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }
}

$i = new car();

$i->setName("あああ");
$i->setName("いいい");
$x = $i->getName();
var_dump($x);//1string(9) "いいい"

interface IFax{
    function send();
}

interface IPrinter{
    function print();
}

trait FaxTrait{

}

$x = "20";
$y = "40";
$z = $x . $y;
print $z;