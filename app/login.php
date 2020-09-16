<?php
session_start();
require_once('dbconnect.php');
require_once('method.php');
require_once('join/MyValidator.php');

if($_COOKIE['email'] !== ''){
    $email = $_COOKIE['email'];
}
if(!empty($_POST)){
    //インスタンスを生成
    $DB = new NotArgsDBcon();
    //データベースにアクセス
    $query = $DB->getDb();
        //フォームの入力値が空でない場合
        if($_POST['email'] !== '' && $_POST['password'] !== ''){
            //SQLを発行し、?に入力されたEmailを代入
            $login = $query->prepare('SELECT password,id FROM members WHERE email=?');            
            $login->execute(array(
                $_POST['email'],
            ));
            //データが帰ってくればログイン成功(true),帰ってこなけっればログイン失敗(false)
            $pass = $login->fetch(PDO::FETCH_ASSOC);// ["カラム名"]=> カラム内の値
            //var_dump($pass);
            /*
            array(2) { ["password"]=> string(60) "$2y$10$xws/228wRozBDJ
            PDp1T12upEqADsWXz1hYPmhHsfy4b5DOR99wLPy" ["id"]=> string(2) "12" }
             */
            //入力したパスワードとデータベース上にあるハッシュ化されたパスワードを比較する->一致したらtrue
            $PasMatch = password_verify($_POST['password'],$pass['password']);
            //$PasMatchがtrueならばセッションにid情報を代入
            if($PasMatch){
                $_SESSION['id'] = $pass['id'];

                header('Location: Write/write.php');
                exit();
                if($_POST['save'] === 'on'){
                    //time()今の時間を秒単位で返す
                    //checkboxがチェックされたなら現在時間から2週間はクッキーを有効にする
                    setcookie('email',$_POST['email'],time() + 60 * 60 * 24 * 14);
                }
                
            }else{
                //ログインに失敗しました
                $error['login'] = 'feild';
            }
        }else{
            //どちらかのフォーム内容が空の場合エラーメッセージを表示
            $error['login'] = 'blank';
        }
}


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
        <p><a href="join/index.php">会員登録をする</a></p>
    </div>
    <form action="" method = "post">
        <p>メールアドレス</p><br>
        <input type = "text" name = "email" value = "<?php xss($email);?>">
        <!--testcode email.com-->
        <!--         line-->
        <p>
        <?php print $error['login'] == 'blank' ? 'メールアドレスとパスワードを入力して下さい': '';?>
        </p>
        

        <p>パスワード</p><br>
        <input type = "password" name = "password" value = "<?php xss($_POST['password']);?>">
        <!--testcode 44444444-->
        <!--testcode 66666666-->
        <p>
        <?php print $error['login'] == 'feild' ? 'ログインに失敗しました。正しくご記入ください': '';?>
        </p>

        <input id = "save" type = "checkbox" name = "save"　value = "on">
        <label for="save">次回から自動的にログインする</label>
        <div>
            <input type = "submit" value = "ログインする">
        </div>
        
    </form>
</body>
</html>