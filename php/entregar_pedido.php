<?php

include("config.php");

$id_pedido = (int) $_POST['id_pedido'];

$result = $conexao->query("
    SELECT status
    FROM pedido
    WHERE id = $id_pedido
");

$pedido = $result->fetch_assoc();

if($pedido['status'] != 'pago'){
    die("Somente pedidos pagos podem ser entregues.");
}

$conexao->query("
    UPDATE pedido
    SET status = 'entregue'
    WHERE id = $id_pedido
");

header("Location: adm.php");
exit();