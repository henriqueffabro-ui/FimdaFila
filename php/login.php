<?php
session_start();
include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $conexao->prepare("
        SELECT *
        FROM cliente
        WHERE email = ?
    ");

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){

        $usuario = $resultado->fetch_assoc();

        if(password_verify($senha, $usuario["senha"])){

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nome"] = $usuario["nome"];
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["turma"] = $usuario["turma"];
            $_SESSION["turno"] = $usuario["turno"];
            $_SESSION["cargo"] = $usuario["cargo"];

            header("Location: index.php");
            exit;
        }
    }

    echo "Email ou senha incorretos.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> login birdiepedia </title>
    <link rel="stylesheet" href="../css/estilo-login.css">
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
<body class="body-login">
    

    <!-- caixinha do login :3 -->
    <div class="container-login">

        <h1 class="h1-login"> Login </h1>

        <form method="post">

            <!--input de email-->
            <label for="email" class="label"> E-mail: </label>
            <input type="email" name="email" placeholder="digite seu e-mail" class="input-email" required>
            <br>

            <!--input de senha-->
            <label for="senha" class="label"> Senha: </label>
            <input type="password" name="senha" placeholder="digite sua senha" class="input-senha" required>
            <br>

            <!--butaun >:3-->
            <button type="submit" class="btn-login"> login </button>
            
        </form>

        <button onclick="location.href='home.html'" class="btn-link-home">
            voltar
        </button>

    </div>

</body>
</html>