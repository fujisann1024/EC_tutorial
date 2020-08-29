<?php
session_start();
require_once("method.php");
//セッションのjoinが空だったら会員登録画面に戻す
returnCheck($_SESSION,'join');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <h1>会員登録</h1>
</header>
<body>
    <div id = "contetnt">
        <p>記入した内容を確認して、「登録する」ボタンをクリックしてください</p>
        <form action="" method="post">
          <input type="hidden" name="action" value="submit">
            <div>名前</div>
            <p><?php xss($_SESSION['join']['name']);?></p>
            
        </form>

    </div>
</body>
<footer>
    <div>会員登録ありがとうございます</div>
</footer>
</html>