<?php
define("BASE_URL", "/clipclop2/");
define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/clipclop2/");

function getRightNowSqlDate(){
    return date('Y-m-d H:i:s');
}

/**
 * @param String - the html you'd like escaped
 * @return String - the escaped string
 */
function escapeHTML($html){
    return htmlspecialchars($html, ENT_HTML5, 'UTF-8');
}

function convertNewLinesToParagraphs($text){
    $escaped = escapeHTML($text);
    return '<p>' . str_replace("\n", "</p><p>", $escaped) . '</p>';
}

function redirect($url){
    echo '<script language="javascript">window.location.href ="'.$url.'"</script>';
}