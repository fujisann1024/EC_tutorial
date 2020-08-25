<?php

function xxe($information, $set = "UTF-8"){
    print(htmlspecialchars($information,ENT_QUOTES | ENT_HTML5, $set));
}
