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

/**
 * Converts new lines entered in a textArea into ptags
 * @param String - the text with new lines
 * @return String - the text with p tags
 */
function convertNewLinesToParagraphs($text){
    $escaped = escapeHTML($text);
    return '<p>' . str_replace("\n", "</p><p>", $escaped) . '</p>';
}

/**
 * redirects user to passed in path
 * @param String - the path you wish to have the user redirected to
 */
function redirect($url){
    echo '<script language="javascript">window.location.href ="'.$url.'"</script>';
}