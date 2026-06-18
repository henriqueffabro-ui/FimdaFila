<?php
include("config.php");

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $turma = $_POST["turma"];
    $turno = $_POST["turno"];
    $cargo = $_POST["cargo"];

    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Verifica se o email já existe
    $verifica = $conexao->prepare(
        "SELECT id FROM cliente WHERE email = ?"
    );

    $verifica->bind_param("s", $email);
    $verifica->execute();

    $resultado = $verifica->get_result();

    if($resultado->num_rows > 0){

        $erro = "Este e-mail já está cadastrado.";

    } else {

        $stmt = $conexao->prepare("
            INSERT INTO cliente(nome,email,senha,turma,turno,cargo)
            VALUES(?,?,?,?,?,?)
        ");

        $stmt->bind_param(
            "ssssss",
            $nome,
            $email,
            $senha,
            $turma,
            $turno,
            $cargo
        );

        if($stmt->execute()){

            header("Location: login.php");
            exit;

        } else {

            $erro = "Erro ao cadastrar usuário.";

        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> cadastro fim da fila </title>
    <link rel="icon" href="../imgs/img-d-aba.webp" type="image/x-icon">

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

        <?php if(!empty($erro)): ?>
    <p style="
        color:red;
        text-align:center;
        margin-bottom:15px;
        font-weight:bold;
    ">
        <?= $erro ?>
    </p>
<?php endif; ?>

        <form method="POST">

            <!--input de usuario-->
            <label for="usuario" class="label"> Usuario: </label>
            <input type="text" name="nome" placeholder="nome de usuario" class="input-usuario" required>
            <br>

            <!--input de senha-->
            <label for="senha" class="label"> Senha: </label>
            <input type="password" name="senha" placeholder="digite sua senha" class="input-senha" required>
            <br>

            <!--input de email-->
            <label for="email" class="label"> E-mail: </label>
            <input type="email" name="email" placeholder="digite seu e-mail" class="input-email" required>
            <br>

            <label for="email" class="label"> Turma: </label>
            <input type="text" name="turma" placeholder="digite sua turma" class="input-turma">
            <br>

            <label for="turno" class="label"> Turno: </label>

<select name="turno" class="input-turno" required>
    <option value="">Selecionar</option>
    <option value="Manhã">Manhã</option>
    <option value="Tarde">Tarde</option>
    <option value="Noite">Noite</option>
</select>

<br>

<label for="cargo" class="label"> Cargo: </label>

<select name="cargo" class="input-cargo" required>
    <option value="">Selecionar</option>
    <option value="Estudante">Estudante</option>
    <option value="Funcionário">Funcionário</option>
</select>

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