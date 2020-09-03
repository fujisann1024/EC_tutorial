<?php
session_start();
require_once("method.php");
require_once("../dbconnect2.php");
//セッションのjoinが空だったら会員登録画面に戻す
returnCheck($_SESSION,'join');

if(!empty($_POST)){
    $i = new DBcon($_SESSION,'join');
    $i->registerMember();
    unset($_SESSION['join']);
    header('Location: thanks.php');
    exit();
}


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

            <div>住所</div>
            <p><?php xss($_SESSION['join']['address']);?></p>

            <div>年齢</div>
            <p><?php xss($_SESSION['join']['age']);?></p>

            <div>メールアドレス</div>
            <p><?php xss($_SESSION['join']['email']);?></p>

            <div>パスワード</div>
            <p><?php print "表示できません」";?></p>

            <div>電話番号</div>
            <p><?php xss($_SESSION['join']['tellphone']);?></p>

            <div>
                <a href="index.php?action=rewrite">書き直す</a> |
                <input type = "submit" value = "登録する">
            </div>
        </form>

    </div>
</body>
<footer>
    <div>会員登録ありがとうございます</div>
</footer>
</html>