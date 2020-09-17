<?php
session_start();
require_once("../CRUD.php");
require_once('../method.php');

returnCheck($_SESSION,'id','../write.php');
$host = new CRUD();
$posts = $host->postData($_SESSION,'id');
var_dump($posts);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<header>
    <h1>一言掲示板</h1>
</header>
<body>
    <p><a href="write.php">一覧に戻る</a></p>
    <h2>メッセージ一覧</h2>
    <p>
        <p><?php xss($posts['message']);?></p>
        <span>名前：<?php xss($posts['name']);?></span>
        <span>日付：<?php xss($posts['created'])?></span>
    </p>
    
</body>
</html>