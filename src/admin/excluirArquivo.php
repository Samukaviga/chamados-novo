<?php

include_once("../../conexao.php");
include_once("../../funcoes/admin.php");

session_start();  

if (isset($_GET['arquivo'])) {
    // Obtém o nome do arquivo a ser excluído
    $arquivo = $_GET['arquivo'];

    $pastaChamado = $_SESSION['id_chamado'];
    $path = "../membro/upload/$pastaChamado/";

    // Verifica se o arquivo existe na pasta
    if (file_exists($path . $arquivo)) {
        // Tenta excluir o arquivo
        if (unlink($path . $arquivo)) {
            
            //alertaERedirecionamento("Arquivo excluído com sucesso");
            header("Location: ./arquivo.php?id_chamado=". $pastaChamado);
            exit;
        } else {
            echo "Erro ao excluir o arquivo.";
        }
    } else {
        echo "Arquivo não encontrado.";
    }
} else {
    echo "Parâmetro 'arquivo' não especificado.";
}