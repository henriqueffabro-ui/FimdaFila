<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'banco_fila';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//teste de conexão
//if($conexao->connect_error){
  //  echo "Falha na Conexão";
//}
//else {
  //  echo "Conexão Bem-Sucedida!";
//}

?>