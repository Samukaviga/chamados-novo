<?php

    include_once("../../conexao.php");

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Chamados</title>
</head>
<body>
    <header class="cabecario">
        <nav class="cabecario__menu">
            <img class="cabecario__logo" src="../../assets/logo.png" alt="">
            <div class="cabecario__navegacao" >
                <a class="cabecario__navegacao__link" href="../admin/">Home</a>
                <a class="cabecario__navegacao__link" href="../admin/chamados.php">Chamados</a>
                <a class="cabecario__navegacao__link" href="../admin/relatorio.php">Relatorio</a>
                <a class="cabecario__navegacao__link" id="mostrar__engrenagem" href="#"><img class="cabecario__navegacao__engrenagem" src="../../assets/7596520.png" alt=""></a>
            </div>
        </nav>
        <p class="cabeario_usuario">Olá <?= $nome; ?></p>
    </header>
    <main class="conteudo">
        <section class="chamado">
            
            <form class="formulario" action="#">
                <h1 class="formulario__titulo">Solicitar Chamado</h1>
         
                <div class="formulario__grupo">
                    <select class="input" name="" >
                        <option class="input" value="">Samuel</option>
                        <option class="input" value="">Gustavo</option>
                    </select>
                </div>
                
                <div class="formulario__grupo">
                
                    <input type="text" name="text" class="input"  autocomplete="off" required="">
                    <label class="formulario__label">Titulo</label>
                
                </div>
                
                <div class="formulario__grupo">
                
                    <textarea type="text" class="textarea" name="mensagem" rows="4" autocomplete="off" required=""></textarea>
                    <label class="formulario__label">Descricao</label>
                
                </div>
                <button class="formulario__botao">Enviar</button>
            </form>
            
        </section>

         <!-- ENGRENAGEM --->
    
        <div id="popup__engrenagem__abrir" class="popup__engrenagem">
            <ul class="popup__engrenagem__lista">
            <a class="popup__engrenagem__link" href="../admin/alterarSenha.php"><li class="popup__engrenagem__item">Alterar Senha</li></a>
                <a class="popup__engrenagem__link" href="../logout.php"><li class="popup__engrenagem__item">Sair</li></a>
            </ul>
        </div>

    </main>
<script src="../../js/funcoes.js" ></script>
</body>
</html>