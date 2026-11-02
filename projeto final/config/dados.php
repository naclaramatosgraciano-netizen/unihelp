<?php
/**
 * Banco de dados simulado por arrays multidimensionais.
 * Os dados são demonstrativos e podem ser adaptados para a instituição.
 */
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$categoriasPadrao = [
    ['nome' => 'Estudos', 'icone' => '📚', 'descricao' => 'Informações acadêmicas, disciplinas, atividades e orientações.'],
    ['nome' => 'Financeiro', 'icone' => '💰', 'descricao' => 'Boletos, mensalidades, pagamentos e segunda via.'],
    ['nome' => 'Documentos', 'icone' => '📄', 'descricao' => 'Solicitação de documentos, declarações e protocolos.'],
    ['nome' => 'Coordenação', 'icone' => '🎓', 'descricao' => 'Informações sobre cursos, coordenação e procedimentos.'],
    ['nome' => 'Atendimento', 'icone' => '💬', 'descricao' => 'Encontre setores, contatos e horários de atendimento.'],
    ['nome' => 'Laboratórios', 'icone' => '💻', 'descricao' => 'Consulte laboratórios, equipamentos e localização.'],
    ['nome' => 'Localização', 'icone' => '📍', 'descricao' => 'Encontre salas, setores, blocos e ambientes.'],
    ['nome' => 'Horários', 'icone' => '🕐', 'descricao' => 'Consulte horários de aulas e atendimento.'],
];

$procedimentos = [
    ['categoria' => 'Estudos', 'titulo' => 'Acesso às atividades acadêmicas', 'descricao' => 'Consulte as orientações para acessar atividades e informações acadêmicas.', 'setor' => 'Coordenação', 'local' => 'Bloco Administrativo — Sala 08', 'horario' => '13:00 às 21:00', 'documentos' => 'Documento de identificação', 'palavras' => 'estudos atividades acadêmico curso disciplina'],
    ['categoria' => 'Financeiro', 'titulo' => 'Segunda via de boleto', 'descricao' => 'Consulte as orientações para solicitar uma segunda via de boleto.', 'setor' => 'Setor Financeiro', 'local' => 'Bloco Administrativo — Sala 04', 'horario' => '08:00 às 16:30', 'documentos' => 'Número de matrícula', 'palavras' => 'segunda via boleto financeiro pagamento mensalidade'],
    ['categoria' => 'Financeiro', 'titulo' => 'Renovação de matrícula', 'descricao' => 'Consulte as orientações para realizar a renovação de matrícula.', 'setor' => 'Secretaria Acadêmica', 'local' => 'Bloco Administrativo — Sala 02', 'horario' => '08:00 às 17:00', 'documentos' => 'Documento de identificação e matrícula', 'palavras' => 'matricula renovação renovar inscrição'],
    ['categoria' => 'Documentos', 'titulo' => 'Declaração de matrícula', 'descricao' => 'Saiba como solicitar sua declaração de matrícula.', 'setor' => 'Secretaria Acadêmica', 'local' => 'Bloco Administrativo — Sala 02', 'horario' => '08:00 às 17:00', 'documentos' => 'Documento de identificação', 'palavras' => 'declaração documento matrícula documentos'],
    ['categoria' => 'Coordenação', 'titulo' => 'Atendimento da coordenação', 'descricao' => 'Consulte como falar com a coordenação do seu curso.', 'setor' => 'Coordenação', 'local' => 'Bloco Administrativo — Sala 08', 'horario' => '13:00 às 21:00', 'documentos' => 'Documento de identificação', 'palavras' => 'coordenação coordenador curso professor'],
    ['categoria' => 'Atendimento', 'titulo' => 'Atendimento da Secretaria', 'descricao' => 'Consulte informações sobre atendimento presencial.', 'setor' => 'Secretaria Acadêmica', 'local' => 'Bloco Administrativo — Sala 02', 'horario' => '08:00 às 17:00', 'documentos' => 'Documento de identificação', 'palavras' => 'secretaria atendimento contato ajuda'],
    ['categoria' => 'Laboratórios', 'titulo' => 'Laboratório de Informática', 'descricao' => 'Consulte a localização e o horário de funcionamento do laboratório.', 'setor' => 'Coordenação de Informática', 'local' => 'Bloco B — Sala 12', 'horario' => '07:30 às 22:00', 'documentos' => 'Não necessário', 'palavras' => 'laboratório informática computador computadores lab'],
    ['categoria' => 'Localização', 'titulo' => 'Sala 101', 'descricao' => 'Sala de aula localizada no Bloco A.', 'setor' => 'Infraestrutura', 'local' => 'Bloco A — Primeiro andar', 'horario' => '07:30 às 22:00', 'documentos' => 'Não necessário', 'palavras' => 'sala 101 ambiente localização onde fica'],
    ['categoria' => 'Horários', 'titulo' => 'Horário de atendimento', 'descricao' => 'Consulte os horários de funcionamento dos principais setores.', 'setor' => 'Atendimento', 'local' => 'Bloco Administrativo', 'horario' => '08:00 às 17:00', 'documentos' => 'Não necessário', 'palavras' => 'horário atendimento hora funcionamento'],
];

if (!isset($_SESSION['unihelp_categorias'])) {
    $_SESSION['unihelp_categorias'] = $categoriasPadrao;
}
$categorias = $_SESSION['unihelp_categorias'];

function normalizarTexto(string $texto): string {
    $texto = function_exists('iconv') ? (iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $texto) ?: $texto) : $texto;
    return strtolower($texto);
}

function buscarProcedimentos(string $consulta, array $procedimentos): array {
    $consulta = trim(normalizarTexto($consulta));
    if ($consulta === '') {
        return [];
    }
    return array_values(array_filter($procedimentos, function ($item) use ($consulta) {
        $conteudo = normalizarTexto(implode(' ', [
            $item['titulo'], $item['descricao'], $item['categoria'],
            $item['palavras'], $item['setor'], $item['local'],
            $item['horario'], $item['documentos']
        ]));
        foreach (preg_split('/\s+/', $consulta) as $termo) {
            if ($termo !== '' && strpos($conteudo, $termo) !== false) {
                return true;
            }
        }
        return false;
    }));
}
