<?php
session_start();
require_once('../method.php');
require_once('../dbconnect.php');

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
    $_SESSION['time'] = time();

    $DB = new DBcon(null, null);
    $connectDB = $DB->getDB();
    $users = $connectDB->prepare('SELECT * FROM members WHERE id=?');
    $users->execute(array($_SESSION['id']));
    //?に代入した値とデータベース上にある値と一致すればカラム名をキーとして
    //カラム名の中の値をバリューとして配列で$userに渡す
    $user = $users->fetch();
}else{
    //$_SESSION['id']が空(=直接write.phpにアクセス)またはログインしてから1時間経ったら
    //home.htmlに戻す
    header('Location: ../home.html');
    exit();
}

//投稿機能
if(!empty($_POST)){
    //メッセージが空のまま投稿されるのを防ぐ
    if($_POST['message'] !== ''){
        $DB = new DBcon(null, null);
        $connectDB = $DB->getDB();
        $message = $connectDB->prepare('INSERT INTO posts SET member_id=?,message=?,created=NOW()');
        $message->execute(array(
            $user['id'],
            $_POST['message']
        )
        );
        //更新すると$_POST['message]は保持したままなので重複してメッセージをデータベースに記録してしまう
        header('Location: write.php');//メッセージの投稿が終わったら自分自身を表示する
        exit();

    }
}

//投稿内容を表示する機能
$DB = new DBcon(null, null);
$connectDB = $DB->getDB();
//値を入れるわけではないのでquery()でよい             テーブル名のエイリアス
$posts = $connectDB->query('SELECT m.name, p.* FROM members m, 
posts p WHERE m.id = p.member_id ORDER BY p.created DESC');



//var_dump($user);

var_dump($posts);
?>
<!DOCTYPE html>
<html lang="en">
<head style = "background-color:blue;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<header>
    <div>
        <h1>掲示板</h1><a href="../logout.php">ログアウト</a>
        <a href="DBcreate.php">テスト</a>
    </div>
</header>
<body>
<div>
    <form action="" method="post">
        <div>
            <p><?php xss($user['name']); ?></p>
            <textarea name="message" id="" cols="50" rows="10">

            </textarea>
            <input type = "hidden" name = "replay_post_id" value="">
        </div>
        <div>
            <input type = "submit" value = "投稿する">
        </div>
        
    </form>
    <!--投稿内容を表示-->
    <table boder = "1">
        <?php foreach($posts as $post):?>
            <tr>
                <p><?php xss($post['message']);?></p>
            </tr>
        <?php endforeach; ?> 
    </table>
    
</div>
</body>
</html>