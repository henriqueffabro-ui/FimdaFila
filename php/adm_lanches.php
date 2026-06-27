
<?php
session_start();
include("config.php");

/* VERIFICA SE É ADMIN */
if(!isset($_SESSION["cargo"]) || $_SESSION["cargo"] != "Admin"){
    die("Acesso negado.");
}

/* CADASTRAR */
if(isset($_POST["cadastrar"])){

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $qtd = $_POST["qtd"];

    $sql = "INSERT INTO lanches(nome, preco, qtd)
            VALUES('$nome', '$preco', '$qtd')";

    mysqli_query($conexao, $sql);
}

/* EDITAR */
if(isset($_POST["editar"])){

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $qtd = $_POST["qtd"];

    $sqlImagem = "";

    if(isset($_FILES["imagem"]) &&
       $_FILES["imagem"]["error"] == 0){

        // pega a imagem antiga
        $resultado = mysqli_query(
            $conexao,
            "SELECT imagem
             FROM lanches
             WHERE id='$id'"
        );

        $dados = mysqli_fetch_assoc($resultado);

        // apaga a imagem antiga
        if($dados["imagem"] &&
           file_exists($dados["imagem"])){
            unlink($dados["imagem"]);
        }

        // salva a nova
        $ext = pathinfo(
            $_FILES["imagem"]["name"],
            PATHINFO_EXTENSION
        );

        $nomeArquivo =
            uniqid() . "." . $ext;

        move_uploaded_file(
    $_FILES["imagem"]["tmp_name"],
    "../imgLanches/" . $nomeArquivo
);

        $sqlImagem = ", imagem='../imgLanches/$nomeArquivo'";
    }

    $sql = "UPDATE lanches
            SET nome='$nome',
                preco='$preco',
                qtd='$qtd'
                $sqlImagem
            WHERE id='$id'";

    mysqli_query($conexao, $sql);
}

/* EXCLUIR */
if(isset($_GET["excluir"])){

    $id = $_GET["excluir"];

    mysqli_query(
        $conexao,
        "DELETE FROM pedido WHERE id_lanche='$id'"
    );

    mysqli_query(
        $conexao,
        "DELETE FROM lanches WHERE id='$id'"
    );
}

/* BUSCAR LANCHE PARA EDIÇÃO */
$editar = null;

if(isset($_GET["editar"])){

    $id = $_GET["editar"];

    $resultado = mysqli_query($conexao,
        "SELECT * FROM lanches WHERE id='$id'");

    $editar = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Gerenciar Lanches</title>
<link rel="icon" href="../imgs/img-d-aba.webp" type="image/x-icon">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/adm_lanches.css">

<style>
    h3{
    font-family:Arial, Helvetica, sans-serif;
}
</style>

</head>
<body>

<header>
    <h2>Painel Administrativo - Lanches</h2>
</header>

<button onclick="window.location.href='adm.php'">
    Painel Administrativo
</button>

<button onclick="window.location.href='index.php'">
    Voltar para a Home
</button>

<div class="container">

<div class="card">

<h3>Editar Lanche</h3>

<form method="POST" enctype="multipart/form-data">

    <input type="hidden"
           name="id"
           value="<?= $editar['nome'] ?? '' ?>"

    <label>Nome</label>
    <input type="text"
           name="nome"
           value="<?= $editar['nome'] ?? '' ?>"
           required>

    <label>Preço</label>
    <input type="number"
           step="0.01"
           name="preco"
           value="<?= $editar['nome'] ?? '' ?>"
           required>

    <label>Quantidade</label>
    <input type="number"
           name="qtd"
           value="<?= $editar['nome'] ?? '' ?>"
           required>

    <?php if($editar && !empty($editar['imagem'])){ ?>
    <label>Imagem atual</label><br>
    <img src="../<?= $editar['imagem'] ?>"
         width="120"><br><br>
<?php } ?>

    <label>Alterar imagem</label>
    <input type="file"
           name="imagem"
           accept="image/*">

    <button class="btn-salvar"
            type="submit"
            name="editar">
        Atualizar
    </button>

</form>

</div>

<div class="card">

<h3>Lanches Cadastrados</h3>

<div class="table-container">

<table>

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Preço</th>
    <th>Quantidade</th>
    <th>Ações</th>
</tr>

<?php

$resultado = mysqli_query($conexao,
    "SELECT * FROM lanches ORDER BY id DESC");

while($lanche = mysqli_fetch_assoc($resultado)){
?>

<tr>

<td><?= $lanche["id"] ?></td>

<td><?= $lanche["nome"] ?></td>

<td>R$ <?= number_format($lanche["preco"],2,",",".") ?></td>

<td><?= $lanche["qtd"] ?></td>

<td>

<a class="btn-editar"
   href="?editar=<?= $lanche["id"] ?>">
   Editar
</a>

<a class="btn-excluir"
   href="?excluir=<?= $lanche["id"] ?>"
   onclick="return confirm('Excluir este lanche?')">
   Excluir
</a>

</td>

</tr>

<?php } ?>

</table>
</div>

</div>

</div>



</body>
