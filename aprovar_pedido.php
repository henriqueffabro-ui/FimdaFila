<?php

include("config.php");

$id_pedido = (int) $_POST['id_pedido'];

$sql = "SELECT * FROM pedido WHERE id = $id_pedido";
$result = $conexao->query($sql);

if($result->num_rows == 0){
    die("Pedido não encontrado.");
}

$pedido = $result->fetch_assoc();

if($pedido['status'] == 'pago'){
    die("Pedido já aprovado.");
}

$id_lanche = $pedido['id_lanche'];
$qtd = $pedido['qtd'];

$sql_lanche = "SELECT * FROM lanches WHERE id = $id_lanche";
$result_lanche = $conexao->query($sql_lanche);

$lanche = $result_lanche->fetch_assoc();

if($lanche['qtd'] < $qtd){
    die("Estoque insuficiente.");
}

// reduz estoque
$conexao->query("
    UPDATE lanches
    SET qtd = qtd - $qtd
    WHERE id = $id_lanche
");

// aprova pedido
$conexao->query("
    UPDATE pedido
    SET status = 'pago'
    WHERE id = $id_pedido
");

header("Location: adm.php");
exit();