<?php
require_once __DIR__ . '/../config/dados.php';
header('Content-Type: application/json; charset=utf-8');
$consulta = $_GET['q'] ?? '';
$resultados = buscarProcedimentos((string)$consulta, $procedimentos);
echo json_encode($resultados, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
