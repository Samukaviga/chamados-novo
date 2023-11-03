<?php

    include_once("../../conexao.php");

    session_start();  
    
    $id_usuario = $_SESSION["id_usuario"];
    $nome = $_SESSION["nome"];

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
    <title>Meus Livros</title>
</head>
<body>
    <header class="cabecario">
        <nav class="cabecario__menu">
            <img class="cabecario__logo" src="../../assets/logo.png" alt="">
            <div class="cabecario__navegacao" >
                <a class="cabecario__navegacao__link" href="../../src/membro/">Home</a>
                <a class="cabecario__navegacao__link" href="../../src/membro/relatorio.php">Relatorio</a>
                <a class="cabecario__navegacao__link" id="mostrar__engrenagem" href="#"><img class="cabecario__navegacao__engrenagem" src="../../assets/7596520.png" alt=""></a>
            </div>
        </nav>
    </header>
    <main class="alterar__senha">
        <section class="chamado">
            
            <form class="formulario formulario__alterar" action="">
                <h1 class="formulario__titulo">Alterar Senha</h1>
         
                <div class="formulario__grupo">
                
                    <input type="password" name="text" class="input"  autocomplete="off" required="">
                    <label class="formulario__label">Senha Atual</label>
                
                </div>

                <div class="formulario__grupo">
                
                    <input type="password" name="text" class="input"  autocomplete="off" required="">
                    <label class="formulario__label">Senha Nova</label>
                
                </div>
                
            
                <button class="formulario__botao formulario__alterar__botao">Alterar</button>
            </form>
            
        </section>


         <!-- ENGRENAGEM --->
    
         <div id="popup__engrenagem__abrir" class="popup__engrenagem">
            <ul class="popup__engrenagem__lista">
            <a class="popup__engrenagem__link" href="../membro/alterarSenha.php"><li class="popup__engrenagem__item">Alterar Senha</li></a>
                <a class="popup__engrenagem__link" href="../logout.php"><li class="popup__engrenagem__item">Sair</li></a>
            </ul>
        </div>

    </main>
<script src="../../js/funcoes.js" ></script>
</body>
</html>