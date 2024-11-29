<?php
// CONFIGURAÇÃO DO BANCO DE DADOS
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'carros';

// ESTABELECE A CONEXÃO COM O BANCO DE DADOS
$conn = new mysqli($server, $usuario, $senha, $banco);

// VERIFICA A CONEXÃO
if ($conn->connect_error) {
    die("Falha ao se comunicar com banco de dados: " . $conn->connect_error);
}

// PEGA OS CAMPOS DO FORMULÁRIO
$Titulo = isset($_POST['title']) ? trim($_POST['title']) : null;
$Preco = isset($_POST['price']) ? trim($_POST['price']) : null;
$Descricao = isset($_POST['description']) ? trim($_POST['description']) : null;
$Modelo = isset($_POST['model']) ? trim($_POST['model']) : null;
$Kilometragem = isset($_POST['mileage']) ? trim($_POST['mileage']) : null;
$Datadecompra = isset($_POST['purchase_date']) ? trim($_POST['purchase_date']) : null;

// VALIDAÇÃO DOS CAMPOS
if (empty($Titulo) || empty($Preco) || empty($Descricao) || empty($Modelo) || empty($Kilometragem) || empty($Datadecompra)) {
    die("Por favor, preencha todos os campos obrigatórios.");
}

// INSERE NO BANCO DE DADOS
// PREPARA O COMANDO PARA A TABELA
$smtp = $conn->prepare("INSERT INTO formulario (_titulo, _preco, _descricao, _modelo, _kilometragem, _datadecompra) VALUES (?, ?, ?, ?, ?, ?)");
$smtp->bind_param("ssssss", $Titulo, $Preco, $Descricao, $Modelo, $Kilometragem, $Datadecompra);

// EXECUTA O COMANDO
if ($smtp->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro no envio da mensagem: " . $smtp->error;
}

// FECHA A CONEXÃO
$smtp->close();
$conn->close();
?>
