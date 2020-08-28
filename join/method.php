<?php
//xxs対策メソッド
function xss($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}   
//エラー回数カウントメソッド
function errorCount(array $errors){
    $err = [];
    foreach($errors as $value){
        array_push($err,$value);
    }
    if(count($err) == 0){
        header('Location: check.php');
        exit();
    }
}

//セッション保存メソッド
function setSession(array $errors,$val){
    session_start();
    $err = [];
    foreach($errors as $value){
        array_push($err,$value);
    }
    if(count($err) == 0){
        $_SESSION[$val] = $_POST;
    }
}

