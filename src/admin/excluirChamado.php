<?php 

    include_once("../../conexao.php");
    include_once("../../funcoes/admin.php");

    session_start(); 


    $tipo = $_SESSION["tipo"];

    if($tipo == 0){
        header("location: ../login.php");
        exit;
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){ 

        if($_GET['id_chamado']){
            $id_chamado = $_GET['id_chamado'];
        
           $excluido =  excluirChamado($pdo, $id_chamado);
        
            if($excluido){
                alerta("Chamado Excluido");
                header("Location: ./relatorio.php");
                exit;
            } else {
                alerta("Falha ao Excluir Chamado");
                header("Location: ./relatorio.php");
                exit;
            }
        }

       
    }   