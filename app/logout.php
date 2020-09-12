<?php

session_start();

$_SESSION = array();
if(ini_set('session.use_cookies')){
    $param = session_get_cookie_params();
    setcookie(session_name() . '',time() - 42000,
    $param['path'],$param['domain'],$param['secure'],$param['httponly']
    );
}
//セッションの破棄
session_destroy();

setcookie('email','',time()-3600);

header('Location: home.html');
exit();

