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
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/index.js"></script>
    <link rel="icon" href="../imgs/img-d-aba.webp" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo-index.css">
    <link rel="stylesheet" href="../css/reset.css">
    <!-- fontes :3 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kolker+Brush&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body  class="body-index">

<?php if(isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'Admin'){ ?>

    <a href="adm.php">Painel Administrativo</a><br>
    <a href="adm_lanches.php">Gerenciar Lanches</a><br>
    <a href="cadastroLanche.php">Cadastrar Lanche</a><br>

<?php } ?>
<div class="container-informacoes">
    <h1 class="h1-nome">Opaa, <?php echo $_SESSION["nome"]; ?>!</h1>

    <h3 class="h3-dados">Dados do usuário</h3>

    <p class="p-nome"><strong>Nome:</strong> <?php echo $_SESSION["nome"]; ?></p>

    <p class="p-turma"><strong>Turma:</strong> <?php echo $_SESSION["turma"]; ?></p>

    <p class="p-turno"><strong>Turno:</strong> <?php echo $_SESSION["turno"]; ?></p>

    <p class="p-cargo"><strong>Cargo:</strong> <?php echo $_SESSION["cargo"]; ?></p>

    <p class="p-email"><strong>Email:</strong> <?php echo $_SESSION["email"]; ?></p>
    
    <button onclick="location.href='logout.php'" class="btn-sair">
        sair
    </button>
</div>
    <br><br>


    <ol class="lista-de-sabores">
        <h3>Sabores Disponíveis:</h3>
        <br>
        <li class="li-sabor">Mini Pizza de Calabresa</li>
        <li class="li-sabor">Mini Pizza de Presunto e Queijo</li>
        <li class="li-sabor">Mini Pizza de Chocolate Preto</li>
        <li class="li-sabor">Mini Pizza de Frango Catupiry</li>
        <li class="li-sabor">Hamburguer de Forno</li>
        <li class="li-sabor">Salgado Assado de Pizza</li>
        <li class="li-sabor">Salgado Assado de Frango</li>
      
    </ol>

<br><br>
    


    <hr class="hr-1">
    <hr class="hr-2">

    <?php
       $sql = "SELECT * FROM lanches";
        $result = $conexao->query($sql);

if($result->num_rows > 0){

    foreach($result as $lanche){
        echo "
            <div class='container-lanche'>
                <h2 class='h2-nome-lanche'>{$lanche['nome']}</h2>

                <div class='container-preco'>
                    <button class='btn-comprar'>
                        <a href='lanche.php?id={$lanche['id']}' class='link-comprar'>
                            comprar
                        </a>
                    </button>

                    <h3 class='h3-valor'>Valor: R$ {$lanche['preco']}</h3>
                    <p class='p-quantidade'>Quantidade: {$lanche['qtd']}</p>
                </div>
            </div>
            <hr class='hr-2'>
            
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
                <th>Código</th>
                <th>Ação</th>
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


                <td>{$pedido['codigo']}</td>


                <td>
                    <button onclick=\"mostrarCodigo('{$pedido['codigo']}')\">
                        Ampliar
                    </button>
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

<div id="modalCodigo" class="modal">
    <div class="modal-conteudo">
        <span class="fechar" onclick="fecharCodigo()">&times;</span>

        <div id="codigoGrande"></div>
    </div>
</div>
</body>
</html>