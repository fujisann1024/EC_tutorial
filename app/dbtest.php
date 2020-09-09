<?php

require_once('dbconnect.php');
$i = new DBcon();
       try{
            $db = $i->getDb();
            //条件内でemailの値が一致したmembersテーブルのemailの件数をすべて取得しcntというカラムで取得
            $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE :email');
            //フォームから受け取ったメールアドレスのデータをemailに代入して実行
            $member->bindValue(':email',$this->data[$this->key]);
            //POSTのemailがデータベース内に入ってれば1、入っていなければ0になる

            $member->execute();
            //[cnt => 0 or 1が$recodeに代入される
            $recode = $member->fetch();
            if($recode['cnt'] > 0){
                print "メールアドレスが重複しています";
            }
           }catch(PDOException $e){
                print "エラーメッセージ:{$e->getMessage()}";
           } 