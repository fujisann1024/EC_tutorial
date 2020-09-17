<?php
require_once('dbconnect.php');
class CRUD extends DBcon{
    //引数なしのコンストラクタでオーバーライド
    public function __construct(){

    }
    //会員情報習得メソッド
    public function getInfomation($SESSION,$val){
        if(isset($SESSION[$val])){
            $connectDB = parent::getDb();
            $users = $connectDB->prepare('SELECT * FROM members WHERE id=?');
            $users->execute(array($SESSION[$val]));
            //?に代入した値とデータベース上にある値と一致すればカラム名をキーとして
            //カラム名の中の値をバリューとして配列で$userに渡す
            $user = $users->fetch();
            return $user;
        }
    }
    //メッセージ投稿メソッド
    public function postMessage($POST,$messageKey,$user){
        if(!empty($POST)){
            //メッセージが空のまま投稿されるのを防ぐ
            if($POST[$messageKey] !== ''){
                $connectDB = parent::getDb();
                $message = $connectDB->prepare('INSERT INTO posts 
                                                SET member_id=?,message=?,reply_message_id,created=NOW()');
                $message->execute(array(
                    $user,
                    $POST[$messageKey] 
                ));
                 //更新すると$_POST['message]は保持したままなので重複してメッセージをデータベースに記録してしまう
            header('Location: write.php');//メッセージの投稿が終わったら自分自身を表示する
            exit();

            }
        }
    }

    public function postData($SESSION, $val){
        $connectDB = parent::getDb();
        $data = $connectDB->prepare('SELECT m.name, p.* 
                                      FROM members m, posts p 
                                      WHERE m.id = p.member_id AND p.id = ?');
        $data->execute(array($SESSION[$val]));
        $posts = $data->fetch();
        return $posts;
    }


}