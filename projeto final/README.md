# UniHelp — Projeto Final

Aplicação acadêmica demonstrativa para localizar serviços, documentos, setores, salas e horários de uma instituição. O projeto reúne frontend e backend em PHP, HTML5, CSS, JavaScript e Bootstrap 5, com dados simulados em arrays multidimensionais.

## O que já funciona

- Página inicial responsiva usando o Grid do Bootstrap 5 (`row`, `col-*`, `row-cols-*` e `g-*`).
- Busca dinâmica: o JavaScript consulta `php/buscar.php`, que pesquisa os dados no backend PHP e devolve JSON.
- Categorias: cada categoria abre uma página com os serviços correspondentes.
- Área administrativa em `php/admin.php`: permite adicionar e remover categorias durante a sessão do navegador.
- Cabeçalho e rodapé reutilizáveis com `require_once`.
- Escape de conteúdo exibido em HTML para reduzir risco de injeção de marcação.
- Não precisa configurar MySQL para a demonstração.

> **Aviso:** os setores, locais, horários e documentos são exemplos fictícios para fins acadêmicos. O painel não tem login e as categorias são guardadas na sessão PHP, não em banco de dados. Portanto, não use dados pessoais nem apresente essas informações como oficiais.

## Opção A — Executar no GitHub Codespaces

1. Envie esta pasta para um repositório GitHub ou abra o repositório no Codespaces.
2. Abra o terminal na raiz da pasta `projeto final`.
3. Confira se o PHP está instalado:

   ```bash
   php -v
   ```

4. Inicie o servidor:

   ```bash
   php -S 0.0.0.0:8000
   ```

5. No painel **Ports / Portas**, abra a porta `8000` no navegador.
6. A página inicial deve aparecer. Faça os testes abaixo.

O arquivo `.devcontainer/devcontainer.json` define o ambiente PHP e encaminha a porta 8000 quando usado como configuração do Codespaces/Dev Containers.

## Opção B — Executar no computador (Windows, VS Code ou terminal)

1. Instale o PHP 8.0 ou superior e confirme que o comando `php` funciona no terminal. Se usar XAMPP, abra o terminal do XAMPP ou configure o PHP no `PATH`.
2. Extraia o ZIP e abra a pasta `projeto final` no VS Code.
3. No terminal integrado, execute:

   ```powershell
   php -S localhost:8000
   ```

4. Abra `http://localhost:8000` no navegador.
5. Para encerrar, volte ao terminal e pressione `Ctrl+C`.

Também há o arquivo `INICIAR_WINDOWS.bat`, que inicia o servidor PHP e abre o endereço no navegador, desde que o comando `php` esteja disponível.

## Roteiro rápido de teste

1. Na página inicial, pesquise `matrícula`, `boleto` ou `laboratório` e confira os cards retornados.
2. Clique em uma categoria e confira os detalhes dos serviços.
3. Abra **Área Administrativa**, adicione uma categoria de teste e confirme que ela aparece na página inicial na mesma sessão.
4. Remova a categoria de teste e confira a atualização.
5. Redimensione a janela ou teste no celular: as colunas devem se reorganizar para telas menores.

## Estrutura

```text
projeto final/
├── index.php
├── categoria.php
├── style.css
├── script.js
├── config/
│   └── dados.php
├── includes/
│   ├── header.php
│   └── footer.php
├── php/
│   ├── admin.php
│   └── buscar.php
├── img/
│   └── logo.png
├── .devcontainer/
│   └── devcontainer.json
└── INICIAR_WINDOWS.bat
```

## Dependências e limites

- PHP 8.0+ recomendado.
- O Bootstrap 5.3.3 é carregado por CDN; é necessária internet para carregar o CSS e o JavaScript do Bootstrap.
- Os dados de serviços estão em `config/dados.php` no array `$procedimentos`.
- As categorias adicionadas/removidas no painel são temporárias e ficam na sessão PHP atual. Para persistência entre sessões seria necessário banco de dados ou armazenamento em arquivo, além de autenticação e controles de segurança antes de qualquer uso real.
