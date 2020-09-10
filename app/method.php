<?php
require_once('dbconnect.php');
//xxs対策メソッド
function xss($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}



//エラーがゼロならセッションに保存して指定のメソッド
function setSes_movFile(array $errors,$val,$file){
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

    //重複確認メソッド
    function duplicateCheck($ary,$key){
        $error2 = [];
        $DB = new DBcon(null,null);
        $query = $DB->getDb();
        //条件内でemailの値が一致したmembersテーブルのemailの件数をすべて取得しcntというカラムで取得
        $member = $query->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
        //フォームから受け取ったメールアドレスのデータをemailに代入して実行
        //POSTのemailがデータベース内に入ってれば1、入っていなければ0になる
        $member->execute(array($ary[$key]));
        //[cnt => 0 or 1が$recodeに代入される
        $recode = $member->fetch();
        if($recode['cnt'] > 0){
            $error2[$key] = "指定したメールアドレスはすでに登録されています";
        }else{
            $error2[$key] = null;
        }
        return $error2;
}

