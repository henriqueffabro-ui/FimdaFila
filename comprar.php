<?php
session_start();
include("config.php");

if (!isset($_POST['id_lanche']) || !isset($_POST['qtd'])) {
    die("Dados inválidos.");
}

$id_lanche = (int) $_POST['id_lanche'];
$qtd = (int) $_POST['qtd'];

if ($qtd < 1 || $qtd > 5) {
    die("Quantidade inválida.");
}

if (!isset($_SESSION['id'])) {
    die("Você precisa estar logado.");
}

$id_cliente = (int) $_SESSION['id'];

// Busca cliente
$sql_cliente = "SELECT * FROM cliente WHERE id = $id_cliente";
$result_cliente = $conexao->query($sql_cliente);

if ($result_cliente->num_rows == 0) {
    die("Cliente não encontrado.");
}

$cliente = $result_cliente->fetch_assoc();

// Busca lanche
$sql_lanche = "SELECT * FROM lanches WHERE id = $id_lanche";
$result_lanche = $conexao->query($sql_lanche);

if ($result_lanche->num_rows == 0) {
    die("Lanche não encontrado.");
}

$lanche = $result_lanche->fetch_assoc();

// Verifica estoque
if ($lanche['qtd'] < $qtd) {
    die("Estoque insuficiente. Disponível: " . $lanche['qtd']);
}

// Calcula valor total
$preco_total = $lanche['preco'] * $qtd;

// Define data de retirada
date_default_timezone_set('America/Sao_Paulo');

$dataRetirada = new DateTime('tomorrow');

// pula finais de semana
while ($dataRetirada->format('N') >= 6) {
    $dataRetirada->modify('+1 day');
}

$dataRetiradaBanco = $dataRetirada->format('Y-m-d');
$dataRetiradaExibir = $dataRetirada->format('d/m/Y');

// Cria pedido
$sql_pedido = "INSERT INTO pedido (
    nome_cliente,
    id_cliente,
    nome_lanche,
    id_lanche,
    preco_lanche,
    turma,
    turno,
    cargo,
    qtd,
    status,
    data_retirada
) VALUES (
    '{$cliente['nome']}',
    {$cliente['id']},
    '{$lanche['nome']}',
    {$lanche['id']},
    $preco_total,
    '{$cliente['turma']}',
    '{$cliente['turno']}',
    '{$cliente['cargo']}',
    $qtd,
    'pendente',
    '$dataRetiradaBanco'
)";

if ($conexao->query($sql_pedido)) {

    echo "
        <h2>Pedido criado com sucesso!</h2>

        <p><strong>Lanche:</strong> {$lanche['nome']}</p>

        <p><strong>Quantidade:</strong> {$qtd}</p>

        <p><strong>Valor:</strong> R$ " . number_format($preco_total, 2, ',', '.') . "</p>

        <p><strong>Data de retirada:</strong> {$dataRetiradaExibir}</p>

        <p><strong>Status:</strong> Pendente de pagamento</p>

        <hr>

        <h3>Pagamento via PIX</h3>

        <img src='imgs/qrcode_www.youtube.com.png' alt='QR Code PIX' width='200'>

        <p>Chave PIX: 666</p>

        <p>
            Após realizar o pagamento, aguarde a confirmação do administrador.
        </p>
    ";

} else {

    echo "Erro ao realizar pedido: " . $conexao->error;

}
?>