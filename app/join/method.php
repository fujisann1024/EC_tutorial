<?php
//xxs対策メソッド
function xss($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}

//エラーがゼロなら確認画面に移動メソッド
function errorCount(array $errors){
    if(count($errors) == 0){
        header('Location: check.php');
        exit();
    }
}

//エラーがゼロならセッション保存メソッド
function setSession(array $errors,$val){
    session_start();
    if(count($errors) == 0){
        $_SESSION[$val] = $_POST;
    }
}
//確認画面からアクセスされたら会員登録画面に戻すメソッド
function returnCheck(array $SESSION,$val){
    if(!isset($SESSION[$val])){
        header('Location: index.php');
        exit();
    }
}

