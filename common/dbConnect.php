<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=clipclop2","root","");
} catch(PDOException){
    die();
}
?>