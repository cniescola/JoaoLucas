<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dados = $_POST['data'] ?? null;
if (!$dados) {
    exit('Nenhum dado recebido.');
}

$json = json_decode($dados, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    exit('JSON inválido: ' . json_last_error_msg());
}

$con = new mysqli('localhost', 'root', 'cniaraguari85', 'produtos', 3306);
if ($con->connect_errno) {
    exit('Erro de conexão MySQL: ' . $con->connect_error);
}

$stmt = $con->prepare('INSERT INTO produto (titulo, subtitulo, preco, subpreco, oferta, auxiliar, `image`) VALUES (?, ?, ?, ?, ?, ?, ?)');
if (!$stmt) {
    exit('Erro prepare: ' . $con->error);
}

foreach ($json as $item) {
    $titulo    = $item['titulo']    ?? '';
    $subtitulo = $item['subtitulo'] ?? '';
    $preco     = $item['preco']     ?? '';
    $subpreco  = $item['subpreco']  ?? '';
    $oferta    = $item['oferta']    ?? '';
    $auxiliar  = $item['auxiliar'] ?? '';
    $imagem    = $item['imagem']    ?? $item['image'] ?? '';

    $stmt->bind_param('sssssss', $titulo, $subtitulo, $preco, $subpreco, $oferta, $auxiliar, $imagem);
    if ($stmt->execute()) {
        echo "Produto '{$titulo}' inserido com sucesso.<br>";
    } else {
        echo "Erro ao inserir '{$titulo}': " . $stmt->error . "<br>";
    }
}

$stmt->close();
$con->close();