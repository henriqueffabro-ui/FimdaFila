<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'banco_fila';

$conexao = new_mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($conexao->connect_error){
    echo "Falha na Conexão";
}
else {
    echo "Conexão Bem-Sucedida!";
}

?>