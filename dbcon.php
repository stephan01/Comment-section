<?php

try{
    $conn = new PDO('mysql:host=localhost;dbname=login_comment', 'root', '');
}catch(PDOException $e){
    die('Could not connect!');
}


