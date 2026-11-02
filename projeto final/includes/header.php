<?php
$tituloPagina = $tituloPagina ?? 'UniHelp';
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="UniHelp: encontre serviços, documentos, ambientes e orientações institucionais.">
  <title><?= htmlspecialchars($tituloPagina, ENT_QUOTES, 'UTF-8') ?> | UniHelp</title>
  <link rel="icon" type="image/png" href="<?= isset($caminhoRaiz) ? $caminhoRaiz : '' ?>img/logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= isset($caminhoRaiz) ? $caminhoRaiz : '' ?>style.css">
</head>
<body>
<header class="site-header">
  <nav class="navbar navbar-expand-lg container py-3" aria-label="Navegação principal">
    <a class="navbar-brand brand-mark" href="<?= isset($caminhoRaiz) ? $caminhoRaiz : '' ?>index.php">Uni<span>Help</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
        <li class="nav-item"><a class="nav-link" href="<?= isset($caminhoRaiz) ? $caminhoRaiz : '' ?>index.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= isset($caminhoRaiz) ? $caminhoRaiz : '' ?>index.php#categorias">Categorias</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= isset($caminhoRaiz) ? $caminhoRaiz : '' ?>index.php#como-funciona">Como funciona</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= isset($caminhoRaiz) ? $caminhoRaiz : '' ?>php/admin.php">Área Administrativa</a></li>
      </ul>
    </div>
  </nav>
</header>