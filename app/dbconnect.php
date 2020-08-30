<?php

// $dsn = 'mysql:dbname=EC; host=127.0.0.1; charset=utf8';
// $user = 'root';
// $password = '';
//接続成功確認
// try{
//     $db = new PDO($dsn,$user,$password);
//     print '接続に成功しました';
// }catch(PDOException $e){
//     print "接続エラー：{$e->getMessage()}";
// }finally{
//     $db = null;
// }
function getDb(){
    $dsn = 'mysql:dbname=EC; host=127.0.0.1; charset=utf8';
    $user = 'root';
    $password = '';
                                        //持続的接続を有効にするか
    $db = new PDO($dsn.$user,$password,[PDO::ATTR_PERSISTENT => true]);
    //接続オプション　[エラーの通知方法 => 例外を発生]
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}
    

    

