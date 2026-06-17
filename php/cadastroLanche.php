<?php
include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $qtd = $_POST["qtd"];

    $stmt = $conexao->prepare("
        INSERT INTO lanches(nome, preco, qtd)
        VALUES(?, ?, ?)
    ");

    $stmt->bind_param(
        "sdi",
        $nome,
        $preco,
        $qtd
    );

    if($stmt->execute()){
        echo "Lanche cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Lanche</title>
</head>
<body>
<button onclick="window.location.href='index.php'">
    Home
</button>

<h1>Cadastrar Lanche</h1>

<form method="POST">

    <label>Nome do Lanche</label><br>
    <input type="text" name="nome" required>
    <br><br>

    <label>Preço</label><br>
    <input type="number" step="0.01" name="preco" required>
    <br><br>

    <label>Quantidade em Estoque</label><br>
    <input type="number" name="qtd" required>
    <br><br>

    <button type="submit">
        Cadastrar
    </button>

</form>

<h2>Lanches Cadastrados</h2>

<?php

$sql = "SELECT * FROM lanches ORDER BY nome";
$resultado = mysqli_query($conexao, $sql);

foreach($resultado as $lanche){
?>

    <div style="margin-bottom:10px;">
        <strong><?= $lanche["nome"] ?></strong><br>
        Preço: R$ <?= number_format($lanche["preco"], 2, ",", ".") ?><br>
        Estoque: <?= $lanche["qtd"] ?>
    </div>

    <hr>

<?php
}
?>

</body>
</html>