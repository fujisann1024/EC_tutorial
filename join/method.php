<?php

function xxe($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}

function error($error){
    if(!empty($error)){
        if($error['name'] === ''){
           return;
        }
        if($error['address'] === ''){
            return;
        }
        if($error['age'] === ''){
            return;
        }
        if($error['email'] === ''){
            return;
        if($error['password'] === ''){
            return;
        }
        if(strlen($error['password']) < 4){
            return;
        }
    }
    
}