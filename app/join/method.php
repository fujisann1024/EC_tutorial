<?php
//xxs対策メソッド
function xss($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}



//エラーがゼロならセッションに保存して指定のメソッド
function setSes_movFile(array $errors,$val,$file){
    session_start();
    if(count($errors) == 0){
        $_SESSION[$val] = $_POST;
        header("Location: $file");
        exit();
    }
}
//確認画面からアクセスされたら会員登録画面に戻すメソッド
function returnCheck(array $SESSION,$val){
    if(!isset($SESSION[$val])){
        header('Location: index.php');
        exit();
    }
}

