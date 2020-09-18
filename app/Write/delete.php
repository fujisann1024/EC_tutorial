<?php

session_start();
require_once('../dbconnect.php');
$i = new DBcon(null,null);

//削除機能
if(isset($_SESSION['id'])){
    $id = $_GET['id'];
    $DBconnect = $i->getDb();

    $messages = $DBconnect->prepare('SELECT * FROM posts WHERE id = ?');
    $messages->execute(array($id));
    $message = $messages->fetch();

    if($message['member_id'] == $_SESSION['id']){
        $del = $DBconnect->prepare('DELETE  FROM posts WHERE id = ?');
        $del->execute(array($id));
        
    }
    
}

header('Location: write.php');
exit();
