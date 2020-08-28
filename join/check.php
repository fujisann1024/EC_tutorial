<?php
session_start();
//
if(!isset($_SESSION['join'])){
    print "Hello";
}
print $_SESSION['join']['name'];
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
 
    </div>  
</body>
<footer>
    <div>会員登録ありがとうございます</div>
</footer>
</html>