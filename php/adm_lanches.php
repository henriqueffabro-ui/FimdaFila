<<<<<<< HEAD
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

    $sql = "UPDATE lanches
            SET nome='$nome',
                preco='$preco',
                qtd='$qtd'
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

<?php if($editar){ ?>

<h3>Editar Lanche</h3>

<form method="POST">

    <input type="hidden" name="id"
           value="<?= $editar['id'] ?>">

    <label>Nome</label>
    <input type="text" name="nome"
           value="<?= $editar['nome'] ?>" required>

    <label>Preço</label>
    <input type="number" step="0.01"
           name="preco"
           value="<?= $editar['preco'] ?>" required>

    <label>Quantidade</label>
    <input type="number"
           name="qtd"
           value="<?= $editar['qtd'] ?>" required>

    <button class="btn-salvar"
            type="submit"
            name="editar">
        Atualizar
    </button>

</form>

<?php } else { ?>

<h3>Cadastrar Lanche</h3>

<form method="POST">

    <label>Nome</label>
    <input type="text" name="nome" required>

    <label>Preço</label>
    <input type="number" step="0.01"
           name="preco" required>

    <label>Quantidade</label>
    <input type="number"
           name="qtd" required>

  

</form>

<?php } ?>

</div>

<div class="card">

<h3>Lanches Cadastrados</h3>

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



</body>
=======
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

    $sql = "UPDATE lanches
            SET nome='$nome',
                preco='$preco',
                qtd='$qtd'
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

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/adm_lanches.css">

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

<?php if($editar){ ?>

<h3>Editar Lanche</h3>

<form method="POST">

    <input type="hidden" name="id"
           value="<?= $editar['id'] ?>">

    <label>Nome</label>
    <input type="text" name="nome"
           value="<?= $editar['nome'] ?>" required>

    <label>Preço</label>
    <input type="number" step="0.01"
           name="preco"
           value="<?= $editar['preco'] ?>" required>

    <label>Quantidade</label>
    <input type="number"
           name="qtd"
           value="<?= $editar['qtd'] ?>" required>

    <button class="btn-salvar"
            type="submit"
            name="editar">
        Atualizar
    </button>

</form>

<?php } else { ?>

<h3>Atualizar Lanche</h3>

<form method="POST">

    <label>Nome</label>
    <input type="text" name="nome" required>

    <label>Preço</label>
    <input type="number" step="0.01"
           name="preco" required>

    <label>Quantidade</label>
    <input type="number"
           name="qtd" required>

  

</form>

<?php } ?>

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
>>>>>>> ce28b839ec7791b6d13ea30be5113e57164c05e3
</html>