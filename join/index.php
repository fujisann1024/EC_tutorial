<?php


//error check
require_once("method.php");
$main = $_POST;
if(!empty($_POST)){
    if($_POST['name'] === ''){
        $error['name'] = 'nothing';
    }
    if($_POST['address'] === ''){
        $error['address'] = 'nothing';
    }
    if($_POST['age'] === ''){
        $error['age'] = 'nothing';
    }
    if($_POST['email'] === ''){
        $error['email'] = 'nothing';
    }
    if($_POST['password'] === ''){
        $error['password'] = 'nothing';
    }
    if(strlen($_POST['password']) < 4){
        $error['password'] = 'nothing';
    }
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
            
                <p>名前<span>※必須</span></p>
                <input type="text" name="name" value="<?php xxe($_POST['name']); ?>" >
                <!--エラーメッセージ-->
                <!---->
                <?php emptyError($_POST['name']);?>

                <p>住所<span>※必須</span></p>
                <input type="text" name = "address" value="<?php print "Hello"; ?>">
                    <!--エラーメッセージ-->
                <?php if($error['address'] = 'nothing'):?>
                <p>住所を入力してください</p>  
                <?php endif; ?>
                
                <p>年齢<span>※必須</span></p>
                <input type="text" name = "age" value="">
                    <!--エラーメッセージ-->
                <?php if($error['age'] = 'nothing'):?>
                <p>年齢を入力してください</p>  
                <?php endif; ?>
                
                <p>メールアドレス <span>※必須</span></p>
                <input type="text" name = "email" value="">
                    <!--エラーメッセージ-->
                <?php if($error['email'] = 'nothing'):?>
                <p>メールアドレスを入力してください</p>  
                <?php endif; ?>

                <p>パスワード<span>※必須</span></p>
                <input type="text" name = "password" value="">
                    <!--エラーメッセージ-->
                <?php if($error['password'] = 'nothing'):?>
                <p>パスワードを入力してください</p>  
                <?php endif; ?>
                
                <input type="submit" value="入力を確認する">
                
    
            </form>
    </div>  
</body>
<footer>
    <div>会員登録ありがとうございます</div>
</footer>
</html>