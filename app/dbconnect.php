<?php
function getDB(){
    $dsn = 'mysql:dbname=EC; host=127.0.0.1; charset=utf8';
    $user = 'root';
    $password = '';
    //データベースの接続を確立
    $db = new PDO($dsn.$user,$password,[PDO::ATTR_PERSISTENT => true]);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;

}