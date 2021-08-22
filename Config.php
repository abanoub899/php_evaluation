<?php

// define constant variables
define('DB_NAME', 'evaluation');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

try{

    // connection variable
    $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // encoded language
    mysqli_set_charset($db, 'utf8');


}catch (Exception $ex){
    print "An Exception occurred. Message: " . $ex->getMessage();
} catch (Error $e){
    print "The system is busy please try later";
}