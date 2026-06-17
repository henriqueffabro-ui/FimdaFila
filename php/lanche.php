<?php
include("config.php");

if(!isset($_GET['id'])){
    die("Lanche não encontrado.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM lanches WHERE id = $id";
$result = $conexao->query($sql);

if($result->num_rows == 0){
    die("Lanche não encontrado.");
}

$lanche = $result->fetch_assoc();

// Configurando o horário para São Paulo, Brasil, para mostrar o dia de amanhã
$timezone = new DateTimeZone('America/Sao_Paulo');
$data = new DateTime('tomorrow', $timezone);

//tira sabado e domingo da contagem de datas porque não dá pra retirar lanche no finial de semana
while ($data->format('N') >= 6) { // 6 = sábado, 7 = domingo
    $data->modify('+1 day');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $lanche['nome']; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <div class="dados">

     <h1><?php echo $lanche['nome']; ?></h1>

        <div class="info-card">
            <p>Valor: R$ <?php echo $lanche['preco']; ?></p>
        </div>

        <div class="info-card">
            <p>Quantidade disponível: <?php echo $lanche['qtd']; ?></p>
        </div>

        <div class="info-card">
            <p>Retirada: <?= $data->format('d/m/Y') ?></p>
        </div>

    </div>

    <button type="button" onclick="window.location.href='index.php'">
     Voltar para a lista de lanches
</button>

    <form action="comprar.php" method="POST">

        <input type="hidden" name="id_lanche" value="<?= $lanche['id'] ?>">

        <p class="titulo-qtd">Quantidade:</p>

        <div class="radio-group">

            <label>
                <input type="radio" id="qtd1" name="qtd" value="1" checked>
                1
            </label>

            <label>
                <input type="radio" id="qtd2" name="qtd" value="2">
                2
            </label>

            <label>
                <input type="radio" id="qtd3" name="qtd" value="3">
                3
            </label>

            <label>
                <input type="radio" id="qtd4" name="qtd" value="4">
                4
            </label>

            <label>
                <input type="radio" id="qtd5" name="qtd" value="5">
                5
            </label>

        </div>

        <?php if($lanche['qtd'] > 0){ ?>

        <button type="submit">Comprar</button>

        <?php } else { ?>

        <p>Este lanche não está disponível no momento.</p>

        <?php } ?>

    </form>

</div>

</body>