<?php


class DBcon{
    private $data;
    private $key;

    public function __construct($data,$key){
        $this->data = $data;
        $this->key = $key;
        
    }


    
    //会員登録メソッド
    public function registerMember(){
        
        try{
            //INSERT命令の準備
            $db = $this->getDb();
            $stt = $db->prepare('INSERT INTO members( name, age, address, email, tellphone, password, created)
                         VALUES (:name, :age, :address, :email, :tellphone, :password, :created)');
            //INSERT命令にセット
            $stt->bindValue(':name',$this->data[$this->key]['name']);
            $stt->bindValue(':age',$this->data[$this->key]['age']);
            $stt->bindValue(':address',$this->data[$this->key]['address']);
            $stt->bindValue(':email',$this->data[$this->key]['email']);
            $stt->bindValue(':tellphone',$this->data[$this->key]['tellphone']);
            $stt->bindValue(':password',password_hash($this->data[$this->key]['password'], PASSWORD_DEFAULT));
            $stt->bindValue(':created',$this->data[$this->key]['created']);
            //SQLを実行
            $stt->execute();
        }catch(PDOException $e){
            print "エラーメッセージ:{$e->getMessage()}";
        } 
    }



    public function getDb(){
        $dsn = 'mysql:dbname=EC; host=127.0.0.1; charset=utf8';
        $user = 'root';
        $password = '';
                                            //持続的接続を有効にするか
        $db = new PDO($dsn,$user,$password,[PDO::ATTR_PERSISTENT => true]);
        //接続オプション　[エラーの通知方法 => 例外を発生]
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
   
}

class NotArgsDBcon extends DBcon{
    //引数なしのコンストラクタでオーバーライド
    public function __construct(){

    }

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

}

