<?php
     include_once("../../conexao.php");

    $id_chamado = $_GET['id_chamado'];

    // Aqui você pode usar o seu código para atualizar o banco de dados com os valores recebidos

    // Exemplo de conexão PDO

    // Atualizar o banco de dados
    $sql = "UPDATE chamado SET status = 2 WHERE id_chamado = :id_chamado";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_chamado", $id_chamado, PDO::PARAM_INT);
    $stmt->execute();

    // Responder com uma mensagem de sucesso
    header("Location: ../../src/membro/arquivo.php?id_chamado=" . $id_chamado); // Substitua com o caminho relativo da sua página
    exit;
?>