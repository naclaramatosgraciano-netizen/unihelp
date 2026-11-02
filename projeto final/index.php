<?php
require_once __DIR__ . '/config/dados.php';
$tituloPagina = 'Início';
require_once __DIR__ . '/includes/header.php';
?>
<main class="container py-4 py-lg-5">
  <section class="hero row align-items-center g-4 g-lg-5 py-4 py-lg-5">
    <div class="col-12 col-lg-7">
      <span class="eyebrow">INFORMAÇÃO INSTITUCIONAL</span>
      <h1 class="display-title mt-3">Encontre o que você precisa <span>sem complicação.</span></h1>
      <p class="lead-copy">Pesquise serviços, documentos, ambientes, horários e orientações da instituição em um único lugar.</p>
      <form id="searchForm" class="search-box d-flex flex-column flex-sm-row gap-2 mt-4" role="search">
        <label class="visually-hidden" for="searchInput">O que você precisa encontrar?</label>
        <input class="form-control form-control-lg" id="searchInput" name="q" placeholder="Ex.: renovar matrícula, laboratório..." autocomplete="off">
        <button class="btn btn-orange btn-lg" type="submit">Buscar</button>
      </form>
      <div class="popular d-flex flex-wrap gap-2 mt-3">
        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-search="renovar matrícula">Renovar matrícula</button>
        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-search="segunda via">Segunda via</button>
        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-search="laboratório">Laboratório</button>
      </div>
    </div>
    <div class="col-12 col-lg-5">
      <div class="preview-card p-4 p-md-5">
        <span class="fw-bold fs-5">⌕ O que você precisa?</span>
        <div class="preview-item mt-3"><strong>📍 Laboratório de Informática</strong><small>Bloco B • Sala 12</small></div>
        <div class="preview-item mt-3"><strong>📄 Segunda via de boleto</strong><small>Setor Financeiro</small></div>
        <p class="small mb-0 mt-3">Informações organizadas para facilitar sua rotina acadêmica.</p>
      </div>
    </div>
  </section>

  <section id="resultados" class="py-5 d-none" aria-live="polite">
    <span class="eyebrow">RESULTADOS</span>
    <h2 class="section-title mt-2">Informações encontradas</h2>
    <p id="resultadoTexto"></p>
    <div id="resultsGrid" class="row g-3"></div>
  </section>

  <section id="categorias" class="py-5">
    <span class="eyebrow">NOSSA SOLUÇÃO</span>
    <h2 class="section-title mt-2 mb-4">Tudo organizado em um só lugar</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3">
      <?php foreach ($categorias as $categoria): ?>
        <div class="col">
          <a class="card category-card h-100 p-4" href="categoria.php?categoria=<?= urlencode($categoria['nome']) ?>">
            <span class="fs-3"><?= htmlspecialchars($categoria['icone'], ENT_QUOTES, 'UTF-8') ?></span>
            <h3 class="h5 mt-3"><?= htmlspecialchars($categoria['nome'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="mb-0"><?= htmlspecialchars($categoria['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="como-funciona" class="py-5">
    <span class="eyebrow">COMO FUNCIONA</span>
    <h2 class="section-title mt-2 mb-4">Menos burocracia. Mais praticidade.</h2>
    <div class="row row-cols-1 row-cols-md-3 g-3">
      <div class="col"><div class="card info-card h-100 p-4"><strong>01 — Pesquise</strong><p class="mb-0 mt-2">Digite o serviço ou a informação que você precisa.</p></div></div>
      <div class="col"><div class="card info-card h-100 p-4"><strong>02 — Encontre</strong><p class="mb-0 mt-2">Confira setor responsável, local, horário e documentos.</p></div></div>
      <div class="col"><div class="card info-card h-100 p-4"><strong>03 — Resolva</strong><p class="mb-0 mt-2">Siga as orientações disponíveis para o procedimento.</p></div></div>
    </div>
  </section>
  <section id="contato" class="contact-panel text-center p-4 p-md-5 my-4">
    <h2 class="h2 text-white">Não encontrou o que procurava?</h2>
    <p class="text-white-50">Consulte as opções de atendimento disponíveis.</p>
    <a class="btn btn-light fw-bold" href="categoria.php?categoria=Atendimento">Ver atendimento</a>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>