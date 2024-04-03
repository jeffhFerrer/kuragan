<?php
include_once('conect/conexao.php');
// Verifique se o parâmetro 'id' foi fornecido na URL
if (isset($_GET['id'])) {
    // Obtenha o valor do parâmetro 'id'
    $id = $_GET['id'];

    // Atualize o status da mensagem para "confirmado" (ou remova-a, se desejar)
    $sql = "UPDATE mensagens_suporte SET status = 'concluida' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Mensagem marcada como confirmada (ou removida)
        echo '<script>
        setTimeout(function() {
            window.location.href = "index.php?acao=suporte_reg";
        }, 0000); // Redirecionar após 2 segundos
    </script>';

        exit();
    } else {
        // Erro ao atualizar o status da mensagem
        die("Erro ao atualizar o status da mensagem: " . $stmt->error);
    }
} else {
    // ID não fornecido na URL, trate o erro conforme necessário
}
?>