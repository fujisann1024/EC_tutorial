<?php


class DBcon{
    private $data;
    private $key;
    private $pos;


    public function __construct($Session_data,$Session_key){
        session_start();
        $this->data = $Session_data;
        $this->key = $Session_key;
        $pos = $_POST;
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
    //重複確認メソッド
    public function duplicateCheck($error){
        if(empty($error)){
           try{
            $db = $this->getDb();
            //条件内でemailの値が一致したmembersテーブルのemailの件数をすべて取得しcntというカラムで取得
            $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email = ?');
            //フォームから受け取ったメールアドレスのデータをemailに代入して実行
            //POSTのemailがデータベース内に入ってれば1、入っていなければ0になる
            $member->execute(array($_POST['email']));
            //[cnt => 0 or 1]が$recodeに代入される
            $recode = $member->fetch();
            if($recode['cnt'] > 0){
                print "メールアドレスが重複しています";
            }
           }catch(PDOException $e){
             print "エラーメッセージ:{$e->getMessage()}";
           } 
        }
        
    }


    private function getDb(){
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
// $i = new DBcon($_SESSION,'join');
// print "";
// var_dump($i);