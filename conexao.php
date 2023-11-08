<?php

$host = "104.131.181.112";
$user = "juliano-u6B3gnF";
$pass = "@KTuMHVLNjI1bJPq8";
$dbname = "chamados";
$port = 3306;

try{
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){

        echo("Erro na conexao com o banco de dados" . $e->getMessage());
}



