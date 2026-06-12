<?php
include_once('config.php');

if(isset($_POST['submit'])){

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $turma = $_POST['turma'];
    $turno = $_POST['turno'];
    $cargo = $_POST['cargo'];

    $result = mysqli_query($conexao, "INSERT INTO clientes(nome, senha, email, turma, turno, cargo) VALUES ('$nome, $senha, $email, $turma, $turno, $cargo)");

    header('Location: login.php');

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> cadastro birdiepedia </title>

    <link rel="stylesheet" href="../css/estilo-singin.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/responsivo.css">

<!-- fontes :3 -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kolker+Brush&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


</head>
<body class="body-cadastro">
    
    <!-- caixinha do cadastro :3 -->
    <div class="container-cadastro">

        <h1 class="h1-sigin"> Cadastro </h1>

        <form action="/cadastro" method="post">

            <!--input de usuario-->
            <label for="usuario" class="label"> Usuario: </label>
            <input type="text" name="usuario" placeholder="nome de usuario" class="input-usuario">
            <br>

            <!--input de senha-->
            <label for="senha" class="label"> Senha: </label>
            <input type="password" name="senha" placeholder="digite sua senha" class="input-senha">
            <br>

            <!--input de email-->
            <label for="email" class="label"> E-mail: </label>
            <input type="email" name="email" placeholder="digite seu e-mail" class="input-email">
            <br>

            <!--butaun :3c-->
            <button type="submit" class="btn-cadastro"> cadastrar-se </button>
            
        </form>

        <button onclick="location.href='home.html'" class="btn-link-home">
            voltar
        </button>

    </div>

</body>
</html>