<?php

include_once("../../conexao.php");
include_once("../../funcoes/admin.php");

session_start();  


$id_chamado =  $_SESSION['id_chamado'];

if (isset($_GET['id_mensagem'])) {
    // Obtém o nome do arquivo a ser excluído
    $id_mensagem = $_GET['id_mensagem'];

    $excluido = excluirMensagem($pdo, $id_mensagem);
    
    if($excluido){
        
        header("Location: ./arquivo.php?id_chamado=" .  $id_chamado);
        exit;

    }else {
        alerta("Falha ao excluir mensagem");
    }

} else {
    echo "Parâmetro 'arquivo' não especificado.";
}