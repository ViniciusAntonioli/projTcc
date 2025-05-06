<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);
    $img_num = isset($_GET['img']) && $_GET['img'] == 2 ? 'imagem_2' : 'imagem_1'; // Alterna entre as imagens ( se for igual a 2, pega a imagem 2, senão pega a 1)

    $sql = "SELECT $img_num FROM tblproduto WHERE id_produto = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto && !empty($produto[$img_num])) {
        // Garantir o tipo correto para a resposta
        header("Content-Type: image/jpeg"); // Define o tipo da imagem (pode ser alterado se for outro formato)
        echo $produto[$img_num]; // Exibe a imagem
    } else {
        // Caso não tenha imagem, exibe uma imagem padrão :)
        header("Content-Type: image/jpeg");
        readfile("imgs/image.png"); // Imagem padrão
    }
} else {
    header("Content-Type: image/jpeg");
    readfile("imgs/image.png"); // Imagem padrão

}
?>