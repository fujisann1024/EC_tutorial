<?php
$error = null;

require_once("MyValidator.php");
function xss($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}
//名前に関するエラーメソッド
function NameError(string $value,$name = "名前"){
    if(empty($value['name'])){
        global $error;
        print '<p style="color:red;">' . $name . "は必須入力です</p>";
        return  $error += 1;
    }
}
//パスワードに関するエラーメソッド
function PasswordError($value, int $len = 8, $name = "パスワード"){
    global $error;

    //パスワードの入力欄が空でない場合
    if(!empty($value['password'])){
        //数値で記入されてない場合は表示
        if(!ctype_digit($value['password'])){
            print '<p style="color:red;">' . $name . "は数値で指定してください</p>";
        }
        
        //パスワードが指定の文字以下ならば表示
        if(mb_strlen($value['password']) < $len){
            $this->errors[] = '<p style="color:red;">' . $name . "は" . $len . "文字以上で入力してください</p>";
        }
        
    }else{
        print '<p style="color:red;">' . $name . "は必須入力です</p>";
    }
    return $error += 1;
}

function go(&$error){
    if(empty($error)){
        header('Location: check.php');
        exit();
    }
}
