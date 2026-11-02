(() => {
  const form = document.getElementById('searchForm');
  const input = document.getElementById('searchInput');
  const section = document.getElementById('resultados');
  const grid = document.getElementById('resultsGrid');
  const texto = document.getElementById('resultadoTexto');
  if (!form || !input || !section || !grid || !texto) return;

  const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
  }[char]));

  async function buscar(consulta) {
    const q = consulta.trim();
    if (!q) {
      section.classList.add('d-none');
      return;
    }
    section.classList.remove('d-none');
    texto.textContent = 'Buscando informações...';
    grid.innerHTML = '';
    try {
      const resposta = await fetch('php/buscar.php?q=' + encodeURIComponent(q), {
        headers: { 'Accept': 'application/json' }
      });
      if (!resposta.ok) throw new Error('Falha na consulta');
      const dados = await resposta.json();
      texto.textContent = dados.length
        ? `${dados.length} resultado(s) encontrado(s) para "${q}".`
        : `Nenhum resultado encontrado para "${q}".`;
      grid.innerHTML = dados.length ? dados.map((item) => `
        <div class="col-12 col-md-6 col-lg-4">
          <article class="card info-card p-4 h-100">
            <span class="eyebrow">${escapeHtml(item.categoria)}</span>
            <h3 class="h5 mt-2">${escapeHtml(item.titulo)}</h3>
            <p>${escapeHtml(item.descricao)}</p>
            <ul class="details-list mt-auto">
              <li><strong>Setor:</strong> ${escapeHtml(item.setor)}</li>
              <li><strong>Local:</strong> ${escapeHtml(item.local)}</li>
              <li><strong>Horário:</strong> ${escapeHtml(item.horario)}</li>
              <li><strong>Documentos:</strong> ${escapeHtml(item.documentos)}</li>
            </ul>
          </article>
        </div>`).join('') : `
        <div class="col-12"><article class="card info-card p-4">
          <h3 class="h5">Não encontramos essa informação.</h3>
          <p class="mb-0">Tente outra palavra, como “matrícula”, “boleto” ou “laboratório”.</p>
        </article></div>`;
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } catch (erro) {
      texto.textContent = 'Não foi possível realizar a busca.';
      grid.innerHTML = '<div class="col-12"><article class="card info-card p-4"><h3 class="h5">Erro na busca</h3><p class="mb-0">Confirme se o servidor PHP está rodando e tente novamente.</p></article></div>';
    }
  }

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    buscar(input.value);
  });
  document.querySelectorAll('[data-search]').forEach((botao) => {
    botao.addEventListener('click', () => {
      input.value = botao.dataset.search || '';
      buscar(input.value);
    });
  });
})();