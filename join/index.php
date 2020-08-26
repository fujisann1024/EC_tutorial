<?php


//error check
require_once("method.php");
require("MyValidator.php");






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
    <div class = "format">
        <div class = "write">次のフォームにご記入ください</div></br>
            <form action="" method = "post">
            
                <p>名前<span>※必須</span></p>
                <input type="text" name="name" value="<?php xss($_POST['name']); ?>" >
                <!--エラーメッセージ-->
                <?php print $error1;?>

                <p>住所<span>※必須</span></p>
                <input type="text" name = "address" value="<?php xss($_POST['address']); ?>">
                    <!--エラーメッセージ-->
                
                
                <p>年齢<span>※必須</span></p>
                <input type="text" name = "age" value="<?php xss($_POST['age']); ?>">
                    <!--エラーメッセージ-->
                
                
                <p>メールアドレス <span>※必須</span></p>
                <input type="text" name = "email" value="<?php xss($_POST['email']); ?>">
                    <!--エラーメッセージ-->
                

                <p>パスワード<span>※必須</span></p>
                <input type="text" name = "password" value="<?php xss($_POST['password']); ?>">
                    <!--エラーメッセージ-->
                    <?php print $error2;?>
                
                <input type="submit" value="入力を確認する">
                
    
            </form>
    </div>  
</body>
<footer>
    <div>会員登録ありがとうございます</div>
</footer>
</html>