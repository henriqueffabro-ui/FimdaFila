<?php
session_start();
include("config.php");

if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<?php if(isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'Admin'){ ?>

    <a href="adm.php">Painel Administrativo</a><br>
    <a href="adm_lanches.php">Gerenciar Lanches</a><br>

<?php } ?>

<h1>Opaa, <?php echo $_SESSION["nome"]; ?>!</h1>

<h3>Dados do usuário</h3>

<p><strong>Nome:</strong> <?php echo $_SESSION["nome"]; ?></p>

<p><strong>Email:</strong> <?php echo $_SESSION["email"]; ?></p>

<p><strong>Turma:</strong> <?php echo $_SESSION["turma"]; ?></p>

<p><strong>Turno:</strong> <?php echo $_SESSION["turno"]; ?></p>

<p><strong>Cargo:</strong> <?php echo $_SESSION["cargo"]; ?></p>

<a href="logout.php">Sair</a>

<br><br><br><br>

 <h1>Todos R$8,00</h1>
    <ol>
        <li>Mini Pizza de Calabresa</li>
        <li>Mini Pizza de Presunto e Queijo</li>
        <li>Mini Pizza de Chocolate Preto</li>
        <li>Mini Pizza de Frango Catupiry</li>
        <li>Hamburguer de Forno</li>
        <li>Salgado Assado de Pizza</li>
        <li>Salgado Assado de Frango</li>
      
    </ol>

    <?php
       $sql = "SELECT * FROM lanches";
        $result = $conexao->query($sql);

if($result->num_rows > 0){

    foreach($result as $lanche){
        echo "
            <div class='lanche'>
                <a href='lanche.php?id={$lanche['id']}'>
                    {$lanche['nome']}
                </a>

                <p>Valor: R$ {$lanche['preco']}</p>
                <p>Quantidade: {$lanche['qtd']}</p>
            </div>
            <hr>
        ";
    }

}else{
    echo "<p>Nenhum lanche cadastrado.</p>";
}
    
    ?>


<h2>Meus Pedidos</h2>

<?php

if(isset($_SESSION['id'])){

    $id_cliente = (int) $_SESSION['id'];

    $sql_pedidos = "
        SELECT *
        FROM pedido
        WHERE id_cliente = $id_cliente
        ORDER BY id DESC
    ";

    $result_pedidos = $conexao->query($sql_pedidos);

    if($result_pedidos->num_rows > 0){

        echo "
        <table>
            <tr>
                <th>Lanche</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Data de Retirada</th>
                <th>Status</th>
            </tr>
        ";

        while($pedido = $result_pedidos->fetch_assoc()){

            $corStatus = "#ff9800";

            if($pedido['status'] == 'pago'){
                $corStatus = "green";
            }

            if($pedido['status'] == 'cancelado'){
                $corStatus = "red";
            }

            if($pedido['status'] == 'entregue'){
                $corStatus = "blue";
            }

            echo "
            <tr>
                <td>{$pedido['nome_lanche']}</td>

                <td>
                    R$ ".number_format($pedido['preco_lanche'], 2, ',', '.')."
                </td>

                <td>{$pedido['qtd']}</td>

                 <td>
                    " . date('d/m/Y', strtotime($pedido['data_retirada'])) . "
                 </td>

                <td style='color:$corStatus;font-weight:bold'>
                    {$pedido['status']}
                </td>
            </tr>
            ";
        }

        echo "</table>";

    }else{

        echo "<p>Você ainda não possui pedidos.</p>";

    }

}
?>
</body>
</html>