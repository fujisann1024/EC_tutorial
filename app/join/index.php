<?php
session_start();
//フォルダの読み込み
require_once("../method.php");
require_once("MyValidator.php");
require_once("../dbconnect.php");

//ボタンを押したときに実行される
if(isset($_POST['submit'])){
    //インスタンスの生成
    $validation = new MyValidator($_POST);
    //エラーメッセージを$errors[]に格納していく
    $errors = $validation->validateForm();
    //重複した時のエラーメッセージを$dupli[]に格納する
    $dupli = duplicateCheck($_POST,'email');
   
    //エラーの数がゼロになったらSESSIONのjoinにPOSTデータを渡し、check.phpに移動する
    setSes_movFile($errors,'join','check.php');  
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
    <div class = "format">
        <div class = "write">次のフォームにご記入ください</div></br>
            <form action="" method = "post">
            
                <p>名前</p><span>※必須</span>
                <input type="text" name="name" value="<?php xss($_POST['name']); ?>" >
                <!--エラーメッセージ-->
                <p class = "error"><?php echo $errors['name'] ?? '';?></p>
                

                <p>住所</p><span>※必須</span>
                <input type="text" name = "address" value="<?php xss($_POST['address']); ?>">
                    <!--エラーメッセージ-->
                <p class = "error"><?php echo $errors['address'] ?? '';?></p>
                
                
                <p>年齢</p><span>※必須</span>
                <input type="text" name = "age" value="<?php xss($_POST['age']); ?>">
                    <!--エラーメッセージ-->
                <p class = "error"><?php echo $errors['age'] ?? '';?></p>
                
                <p>メールアドレス </p><span>※必須</span>
                <input type="text" name = "email" value="<?php xss($_POST['email']); ?>">
                    <!--エラーメッセージ-->
                <p class = "error"><?php echo $errors['email'] ?? $dupli['email'];?></p>
                

                <p>パスワード</p><span>※必須</span>
                <input type="password" name = "password" value="<?php xss($_POST['password']); ?>">
                    <!--エラーメッセージ-->
                 <p class = "error"><?php  print $errors['password'] ?? '' ;?></p>

                <p>電話番号</p><span>※必須</span>
                <input type="text" name = "tellphone" value="<?php xss($_POST['tellphone']); ?>">
                    <!--エラーメッセージ-->
                <p class = "error"><?php echo $errors['tellphone'] ?? '';?></p>   
                
                <input type="submit" value="入力を確認する" name="submit">
                
    
            </form>
    </div>  
</body>
<footer>
    <div>会員登録ありがとうございます</div>
</footer>
</html>