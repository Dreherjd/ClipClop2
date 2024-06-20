<?php

function isTrunc($text)
{
    if (strlen($text) >= 19) {
        return substr($text,0,17) . "...";
    } else {
        return $text;
    }
}
