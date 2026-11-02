<?php
require_once __DIR__ . '/../config/dados.php';
$caminhoRaiz = '../';
$msg = '';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    if ($acao === 'adicionar') {
        $nomeNovo = trim((string)($_POST['nome'] ?? ''));
        if ($nomeNovo === '') {
            $erro = 'Digite o nome da categoria.';
        } else {
            $existe = false;
            foreach ($categorias as $item) {
                if (strcasecmp($item['nome'], $nomeNovo) === 0) { $existe = true; break; }
            }
            if ($existe) {
                $erro = 'Essa categoria já existe.';
            } else {
                $categorias[] = ['nome' => $nomeNovo, 'icone' => '📌', 'descricao' => 'Nova categoria de serviços do UniHelp.'];
                $_SESSION['unihelp_categorias'] = $categorias;
                $msg = 'Categoria adicionada nesta sessão.';
            }
        }
    } elseif ($acao === 'remover') {
        $indice = filter_input(INPUT_POST, 'indice', FILTER_VALIDATE_INT);
        if ($indice !== false && $indice !== null && isset($categorias[$indice])) {
            $removida = $categorias[$indice]['nome'];
            $categorias = array_values(array_filter($categorias, fn($item, $i) => $i !== $indice, ARRAY_FILTER_USE_BOTH));
            $_SESSION['unihelp_categorias'] = $categorias;
            $msg = 'Categoria removida desta sessão. Os procedimentos de demonstração não foram apagados.';
        } else {
            $erro = 'Não foi possível localizar essa categoria.';
        }
    }
}
$tituloPagina = 'Área Administrativa';
require_once __DIR__ . '/../includes/header.php';
?>
<main class="container py-5">
  <span class="eyebrow">PAINEL ADMINISTRATIVO</span>
  <h1 class="section-title mt-2">Gerenciar categorias</h1>
  <p>Adicione ou remova as categorias exibidas na página inicial. Esta é uma simulação em PHP com arrays e sessão, sem banco SQL nem autenticação real.</p>
  <?php if ($msg): ?><div class="alert alert-success" role="status"><?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
  <?php if ($erro): ?><div class="alert alert-danger" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
  <section class="admin-panel p-3 p-md-4">
    <h2 class="h4 mb-3">Categorias disponíveis</h2>
    <?php if (!$categorias): ?><p>Nenhuma categoria disponível.</p><?php endif; ?>
    <div class="list-group mb-4">
      <?php foreach ($categorias as $i => $item): ?>
        <div class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
          <span class="fw-bold"><?= htmlspecialchars($item['icone'], ENT_QUOTES, 'UTF-8') ?> <?= htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') ?></span>
          <form method="post" onsubmit="return confirm('Remover esta categoria da lista?')">
            <input type="hidden" name="acao" value="remover"><input type="hidden" name="indice" value="<?= (int)$i ?>">
            <button class="btn btn-outline-danger btn-sm" type="submit">Remover</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
    <form method="post" class="row g-2">
      <input type="hidden" name="acao" value="adicionar">
      <div class="col-12 col-md"><label for="nome" class="form-label">Nova categoria</label><input id="nome" class="form-control" name="nome" maxlength="60" placeholder="Ex.: Biblioteca" required></div>
      <div class="col-12 col-md-auto d-flex align-items-end"><button class="btn btn-orange w-100" type="submit">Adicionar categoria</button></div>
    </form>
  </section>
  <div class="alert alert-warning mt-4 mb-0"><strong>Importante:</strong> por usar sessão, as mudanças são demonstrativas e não constituem armazenamento permanente. Para produção real seria necessário banco de dados, autenticação e validação adicional.</div>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>