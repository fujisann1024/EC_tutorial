<?php

function e($information, $set = "UTF-8"){
    return htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set);
}