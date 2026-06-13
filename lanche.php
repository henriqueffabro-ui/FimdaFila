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
</head>
<body>

    <h1><?php echo $lanche['nome']; ?></h1>

    <p>Valor: R$ <?php echo $lanche['preco']; ?></p>

    <p>Quantidade disponível: <?php echo $lanche['qtd']; ?></p>

    <a href="index.php">Voltar para a lista de lanches</a><br>

    <form action="comprar.php" method="POST">
    <input type="hidden" name="id_lanche" value="<?= $lanche['id'] ?>">

    <br><br>
     <p>Quantidade:</p>

    <input type="radio" id="qtd1" name="qtd" value="1" checked>
    <label for="qtd1">1</label>

    <input type="radio" id="qtd2" name="qtd" value="2">
    <label for="qtd2">2</label>

    <input type="radio" id="qtd3" name="qtd" value="3">
    <label for="qtd3">3</label>

    <input type="radio" id="qtd4" name="qtd" value="4">
    <label for="qtd4">4</label>

    <input type="radio" id="qtd5" name="qtd" value="5">
    <label for="qtd5">5</label>

    <br><br>
    <button type="submit">Comprar</button>
</form>

   <p>Retirada: <?= $data->format('d/m/Y') ?></p>
</body>
</html>