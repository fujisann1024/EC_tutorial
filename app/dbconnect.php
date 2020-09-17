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


