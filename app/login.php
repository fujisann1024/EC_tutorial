<?php
require_once('dbconnect.php');
require_once('method.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<style>
    header {background-color :blue;}
    body {background-color :deepskyblue;}
</style>
<header>
    <h1>ログインする</h1>
</header>
<body>
    <div>
        <p>メールアドレスとパスワードを記入してログインしてください</p>
        <p>入会手続きがまだの方はこちらから</p>
        <p><a href="join/index.php"></a>会員登録をする</p>
    </div>
    <form action="" method = "post">
        <p>メールアドレス</p><br>
        <input type = "text" name = "email" value = "<?php xxs($_POST['email']);?>">

        <p>パスワード</p><br>
        <input type = "password" name = "password" value = "<?php xxs($_POST['password']);?>">
        <input type = "submit" value = "ログインする">
    </form>
</body>
</html>