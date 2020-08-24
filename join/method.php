<?php

function xxe($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}


function emptyError($error){
    if(!empty($error)){
        foreach($error as $key => $value){
            if($error[$key] === ''){
            print("<p>必須項目を入力してください</p>");
            break;
        }
    }
        
    }
}
