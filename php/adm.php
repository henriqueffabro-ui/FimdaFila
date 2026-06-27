
<?php
session_start();
include("config.php");

if(
    !isset($_SESSION['cargo']) ||
    $_SESSION['cargo'] != 'Admin'
){
    die("Acesso negado.");
}

// futuramente verificar se é administrador

$sql = "SELECT * FROM pedido ORDER BY id DESC";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel Administrativo</title>
    <link rel="icon" href="../imgs/img-d-aba.webp" type="image/x-icon">

    <style>

        table{
            border-collapse: collapse;
            width:100%;
        }

        td, th{
            border:1px solid #ccc;
            padding:10px;
        }

        .pendente{
            color:orange;
            font-weight:bold;
        }

        .pago{
            color:green;
            font-weight:bold;
        }

        .entregue{
            color:blue;
            font-weight:bold;
        }

        table{
    border-collapse: collapse;
    width: 100%;
    background-color: transparent;
}
    </style>

    <link rel="stylesheet" href="../css/adm.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>

<div class="admin-container">
<button onclick="location.href='index.php'">Voltar</button>
<button onclick="location.href='adm_lanches.php'">Gerenciar Lanches</button>

<h1>Painel Administrativo</h1>

<div class="table-container">
<table class="tabela-admin">

<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Lanche</th>
    <th>Qtd</th>
    <th>Valor</th>
    <th>Data de Retirada</th>
    <th>Status</th>
    <th>Código</th>
    <th>Ação</th>
    
</tr>

<?php while($pedido = $result->fetch_assoc()) { ?>

<tr>

    <td><?= $pedido['id'] ?></td>

    <td><?= $pedido['nome_cliente'] ?></td>

    <td><?= $pedido['nome_lanche'] ?></td>

    <td><?= $pedido['qtd'] ?></td>

    <td>R$ <?= number_format($pedido['preco_lanche'], 2, ',', '.') ?></td>

    <td>
    <?= date('d/m/Y', strtotime($pedido['data_retirada'])) ?>
</td>

    <td class="<?= $pedido['status'] ?>">
        <?= $pedido['status'] ?>
    </td>

    <td><?= $pedido['codigo'] ?></td>

    <td>

<?php if($pedido['status'] == 'pendente'){ ?>

    <form action="aprovar_pedido.php" method="POST">

        <input
            type="hidden"
            name="id_pedido"
            value="<?= $pedido['id'] ?>"
        >

        <button type="submit">
            Confirmar Pagamento
        </button>

    </form>

<?php } ?>

<?php if($pedido['status'] == 'pago'){ ?>

    <form action="entregar_pedido.php" method="POST">

        <input
            type="hidden"
            name="id_pedido"
            value="<?= $pedido['id'] ?>"
        >

    </form>

<?php } ?>


</td>

</tr>

<?php } ?>

</table>

</div>
</div>
</body>
