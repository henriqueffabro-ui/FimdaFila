<?php
session_start();

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

<h1>Opaa, <?php echo $_SESSION["nome"]; ?>!</h1>

<h3>Dados do usuário</h3>

<p><strong>ID:</strong> <?php echo $_SESSION["id"]; ?></p>

<p><strong>Nome:</strong> <?php echo $_SESSION["nome"]; ?></p>

<p><strong>Email:</strong> <?php echo $_SESSION["email"]; ?></p>

<p><strong>Turma:</strong> <?php echo $_SESSION["turma"]; ?></p>

<p><strong>Turno:</strong> <?php echo $_SESSION["turno"]; ?></p>

<p><strong>Cargo:</strong> <?php echo $_SESSION["cargo"]; ?></p>

<a href="logout.php">Sair</a>

</body>
</html>