<?php
if (isset($_POST['imageData'])) {
    $imageData = $_POST['imageData'];

    $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

    // Salvar a imagem em uma pasta no servidor
    $imageFileName = 'uploads/' . microtime(true) . '.jpg';

    // Verificar se o arquivo já existe
    $counter = 1;
    while (file_exists($imageFileName)) {
        $imageFileName = 'uploads/' . microtime(true) . '_' . $counter . '.jpg';
        $counter++;
    }

    file_put_contents($imageFileName, $decodedImageData);

    include_once('conect/conexao.php');

    // Preparar e executar a consulta para inserir o nome da imagem na tabela
    $imageName = basename($imageFileName); // Obter somente o nome da imagem
    $stmt = $conn->prepare("INSERT INTO img (image_data) VALUES (?)");
    $stmt->bind_param("s", $imageName);
    
    if ($stmt->execute()) {
        echo "Imagem capturada, salva no servidor e nome adicionado ao banco de dados com sucesso!";
    } else {
        echo "Erro ao inserir o nome da imagem no banco de dados: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
} else {
    echo "Nenhum dado de imagem recebido.";
}
?>
