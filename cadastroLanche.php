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

</body>
</html>