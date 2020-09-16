<?php
session_start();
require_once('../method.php');
require_once('../dbconnect.php');

//セッションのidが空だった場合(直接write.htmlにアクセスしたとき)
//home.htmlに戻る
returnCheck($_SESSION,'id','../home.html');
$CRUD = new NotArgsDBcon();
//入力したアカウント情報をもとに会員登録情報を$userに代入
$user = $CRUD->getInfomation($_SESSION,'id');

//投稿機能
$CRUD->postMessage($_POST,'message',$user['id']);



//投稿内容を表示する機能
$DB = new NotArgsDBcon();
$connectDB = $DB->getDb();
//値を入れるわけではないのでquery()でよい             テーブル名のエイリアス
$posts = $connectDB->query('SELECT m.name, p.* FROM members m, 
posts p WHERE m.id = p.member_id ORDER BY p.created DESC');

if(isset($_GET['res'])){
    $response = $connectDB->prepare('SELECT m.name, p.* 
                              FROM members m, posts p 
                              WHERE m.id = p.member_id AND p.id = ?');
    $response->execute(array($_GET['res']));
    $table = $response->fetch();
    $message = '@' . $table['name'] . '' . $table['message'];
}

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
            <p><?php xss($user['name']); ?>さん</p>
            <!-- value属性がないのでタグの間に記入する-->
            <textarea name="message" id="" cols="50" rows="10">
                <?php xss($message);?>
            </textarea>
            <input type = "hidden" name = "replay_post_id" value="">
        </div>
        <div>
            <input type = "submit" value = "投稿する">
        </div>
        
    </form>
    <!--投稿内容を表示-->
    <table border = "1">
        <?php foreach($posts as $post):?>
            <tr>
                <td>
                    <?php xss($post['message']);?>
                    <a href="write.php?res=<?php xss($post['id']);?>">Re</a>
                </td>              
            </tr>
        <?php endforeach; ?> 
    </table>
    
</div>
</body>
</html>