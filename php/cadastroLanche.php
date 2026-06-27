<?php
include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $qtd = $_POST["qtd"];

    $imagem = "";

    // Upload da imagem
    if(isset($_FILES["imagem"]) &&
       $_FILES["imagem"]["error"] == 0){

        $ext = pathinfo(
            $_FILES["imagem"]["name"],
            PATHINFO_EXTENSION
        );

        $nomeArquivo = uniqid() . "." . $ext;

        move_uploaded_file(
            $_FILES["imagem"]["tmp_name"],
            "../imgLanches/" . $nomeArquivo
        );

        // caminho salvo no banco
        $imagem = "../imgLanches/" . $nomeArquivo;
    }

    $stmt = $conexao->prepare("
        INSERT INTO lanches
        (nome, preco, qtd, imagem)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sdis",
        $nome,
        $preco,
        $qtd,
        $imagem
    );

    if($stmt->execute()){
        echo "Lanche cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Lanche</title>

    <link rel="icon"
          href="../imgs/img-d-aba.webp"
          type="image/x-icon">

    <link rel="stylesheet"
          href="../css/cadastroLanche.css">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <style>
        .lanche img{
            max-width:120px;
            border-radius:10px;
            margin-bottom:10px;
        }
    </style>
</head>
<body>

<button onclick="window.location.href='index.php'">
    Home
</button>

<h1>Cadastrar Lanche</h1>

<form method="POST"
      enctype="multipart/form-data">

    <label>Nome do Lanche</label><br>
    <input type="text"
           name="nome"
           required>
    <br><br>

    <label>Preço</label><br>
    <input type="number"
           step="0.01"
           name="preco"
           required>
    <br><br>

    <label>Quantidade em Estoque</label><br>
    <input type="number"
           name="qtd"
           required>
    <br><br>

    <label>Imagem</label><br>
    <input type="file"
           name="imagem"
           accept="image/*">
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

<div class="lanche">

    <?php if(!empty($lanche["imagem"])){ ?>
        <img src="../<?= $lanche["imagem"] ?>"
             alt="<?= $lanche["nome"] ?>">
        <br>
    <?php } ?>

    <strong>
        <?= $lanche["nome"] ?>
    </strong>
    <br>

    Preço:
    R$ <?= number_format(
        $lanche["preco"],
        2,
        ",",
        "."
    ) ?>
    <br>

    Estoque:
    <?= $lanche["qtd"] ?>

</div>

<hr>

<?php
}
?>

</body>
</html>