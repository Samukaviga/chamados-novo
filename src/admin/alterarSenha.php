<?php

    include_once("../../conexao.php");
    include_once("../../funcoes/admin.php");

    session_start();  
    
    $id_usuario = $_SESSION["id_usuario"];
    $nome = $_SESSION["nome"];
    $tipo = $_SESSION["tipo"];

    if($tipo == 0){
        header("location: ../login.php");
        exit;
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;   
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["senhaAtual"])) || empty(trim($_POST["senhaNova"]))){
             alerta("Por favor insira uma senha");
        } else{
            
            $senhaAntiga = $_POST["senhaAtual"];
            $senhaNova = $_POST["senhaNova"];
         
            $alterou = alterarSenha($pdo, $senhaNova, $senhaAntiga, $id_usuario);

            if($alterou){
                alerta("Senha alterada com sucesso!");
            } else {
                alerta("Senha incorreta");
            }
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Meus Livros</title>
</head>
<body>
    <header class="cabecario">
        <nav class="cabecario__menu">
            <img class="cabecario__logo" src="../../assets/logo.png" alt="">
            <div class="cabecario__navegacao" >
                <a class="cabecario__navegacao__link" href="../../src/admin/">Home</a>
                <a class="cabecario__navegacao__link" href="../../src/admin/chamados.php">Chamados</a>
                <a class="cabecario__navegacao__link" href="../../src/admin/relatorio.php">Relatorio</a>
                <a class="cabecario__navegacao__link" id="mostrar__engrenagem" href="#"><img class="cabecario__navegacao__engrenagem" src="../../assets/7596520.png" alt=""></a>
            </div>
        </nav>
        <p class="cabeario_usuario">Olá <?= $nome; ?></p>
    </header>
    <main class="conteudo">
        <section class="chamado">
            
            <form class="formulario formulario__alterar" action="" method="POST">
                <h1 class="formulario__titulo">Alterar Senha</h1>
         
                <div class="formulario__grupo">
                
                    <input type="password" name="senhaAtual" class="input" placeholder="Senha Atual" autocomplete="off" required="">
                
                </div>

                <div class="formulario__grupo">
                
                    <input type="password" name="senhaNova" class="input" placeholder="Senha Nova" autocomplete="off" required="">
                
                </div>
                
            
                <button class="formulario__botao formulario__alterar__botao">Alterar</button>
            </form>
            
        </section>


         <!-- ENGRENAGEM --->
    
         <div id="popup__engrenagem__abrir" class="popup__engrenagem">
            <ul class="popup__engrenagem__lista">
            <a class="popup__engrenagem__link" href="./alterarSenha.php"><li class="popup__engrenagem__item">Alterar Senha</li></a>
                <a class="popup__engrenagem__link" href="../logout.php"><li class="popup__engrenagem__item">Sair</li></a>
            </ul>
        </div>

    </main>
<script src="../../js/funcoes.js" ></script>
</body>
</html>