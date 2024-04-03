<?php
// Inclui o cabeçalho do site
include_once('includes/header.php');

// Defina as páginas e suas correspondentes ações
$paginas = array(
    'home' => 'pages/home.php',
    'sobre' => 'pages/sobre.php',
    'cadastro' => 'pages/cadastro.php',
    'video' => 'pages/video.php',
    'upload' => 'pages/upload.php',
    'update-filme' => 'pages/update-filme.php',
    'acao-videos' => 'pages/videos-acao.php',
    'delete-filme' => 'includes/delete-video.php',
    'contato' => 'pages/contato.php',
    'chat' => 'chat/index.php',
    'genero' => 'pages/genero.php',
    'user' => 'pages/user.php',
    'upuser' => 'pages/edit-user.php',
    'logs' => 'pages/logs.php',
    'notif' => 'notification/notifications.php',
    'notification' => 'notification/create_notification.php',
    'busca' => 'pages/busca.php',
    'suporte' => 'pages/suporte.php',
    'suporte_reg' => 'pages/suporte_reg.php',
    'suporte_det' => 'pages/suporte_det.php',
    'suporte_con' => 'remover_mensagem.php',
    'type_user' => 'pages/tipo_user.php',
    'erro' => 'pages/erro.php'
    // Adicione mais páginas conforme necessário
);

// Obtém o valor da ação da URL ou define como 'home' por padrão
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'home';

// Verifica se a página está definida no array, caso contrário, define como 'erro'
if (!array_key_exists($acao, $paginas)) {
    $acao = 'erro';
}


// Define o caminho completo para o arquivo da página com base na ação
$caminhoPagina = $paginas[$acao];

// Inclui a página correspondente
include_once($caminhoPagina);

// Inclui o rodapé do site
include_once('includes/footer.php');
?>