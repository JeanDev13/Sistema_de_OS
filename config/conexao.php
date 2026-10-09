<?php

$host = 'localhost';
$db = 'ordem_servico';
$usuario = 'root';
$senha = '';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $usuario, $senha);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOExeption $e){
    die("Erro ao conectar ao banco de dados.");
}

?>