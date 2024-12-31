<?php
require 'dbconnect.php';

try{
    $pdo=new PDO("mysql:host=$servername;dbname=$databaseName",$username,$password);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo"Connected Successfully";
}
catch(PDOException $e)
{
    echo "Connection Failed  : " .$e -> getMessage();
    die("Connection Failed : " .$e -> getMessage());
}
?>



