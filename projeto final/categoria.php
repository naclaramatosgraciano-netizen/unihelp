<?php
require_once __DIR__ . '/config/dados.php';
$nome = trim($_GET['categoria'] ?? '');
$res = array_values(array_filter($procedimentos, fn($item) => strcasecmp($item['categoria'], $nome) === 0));
$tituloPagina = $nome !== '' ? $nome : 'Categoria';
require_once __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
  <a class="back-link" href="index.php#categorias">← Voltar para categorias</a>
  <div class="mt-4 mb-4"><span class="eyebrow">CATEGORIA</span><h1 class="section-title mt-2"><?= htmlspecialchars($nome ?: 'Categoria não informada', ENT_QUOTES, 'UTF-8') ?></h1><p>Serviços e informações disponíveis nesta categoria.</p></div>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
    <?php if (!$res): ?>
      <div class="col"><article class="card info-card p-4 h-100"><h2 class="h5">Nenhuma informação encontrada</h2><p class="mb-0">Escolha outra categoria ou volte à página inicial.</p></article></div>
    <?php else: foreach ($res as $item): ?>
      <div class="col"><article class="card info-card p-4 h-100">
        <span class="eyebrow"><?= htmlspecialchars($item['categoria'], ENT_QUOTES, 'UTF-8') ?></span>
        <h2 class="h5 mt-2"><?= htmlspecialchars($item['titulo'], ENT_QUOTES, 'UTF-8') ?></h2>
        <p><?= htmlspecialchars($item['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
        <ul class="details-list">
          <li><strong>Setor:</strong> <?= htmlspecialchars($item['setor'], ENT_QUOTES, 'UTF-8') ?></li>
          <li><strong>Local:</strong> <?= htmlspecialchars($item['local'], ENT_QUOTES, 'UTF-8') ?></li>
          <li><strong>Horário:</strong> <?= htmlspecialchars($item['horario'], ENT_QUOTES, 'UTF-8') ?></li>
          <li><strong>Documentos:</strong> <?= htmlspecialchars($item['documentos'], ENT_QUOTES, 'UTF-8') ?></li>
        </ul>
      </article></div>
    <?php endforeach; endif; ?>
  </div>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>