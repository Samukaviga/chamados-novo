<?php

    include_once("../../conexao.php");
    include_once("../../funcoes/membro.php");

    session_start();  
    
    $id_usuario = $_SESSION["id_usuario"];
    $nome = $_SESSION["nome"];
    $tipo = $_SESSION["tipo"];
    $setor = $_SESSION["id_setor"];

    $id_chamado = $_SESSION["id_chamado"];

    if($tipo ==! 0){
        header("location: ../login.php");
        exit;
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

   

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if(isset($_POST['mensagem'])) {
            $mensagem = $_POST['mensagem'];
            $data = date('Y/m/d');
            $hora = date('H:i');
            
            $adicionou = adicionandoMensagem($pdo, $mensagem, $id_chamado, $id_usuario, $data, $hora);
            
            if($adicionou){
                header("location: ./arquivo.php?id_chamado=" . $id_chamado);
                exit();
      
            } else {
                alerta("Erro ao adicionar mensagem");
            }
            
        } else {
            echo "Erro no envio da mensagem.";
        }
    } 

