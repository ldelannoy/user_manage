<?php
$host = 'localhost';
$db = 'user_manage';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$sdn = "mysql:host=$host;dbname=$db;charset=$charset";

try{
  $pdo = new \PDO($sdn,$user,$pass);
} catch (\PDOException $e){
  echo $e->getMessage();
  echo 'Impossible de se connecter à la BDD';
}
