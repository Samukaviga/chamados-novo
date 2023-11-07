<?php

    include_once("../../conexao.php");
    include_once("../../funcoes/admin.php");

    session_start();  
    
    $id_usuario = $_SESSION["id_usuario"];
    $nome = $_SESSION["nome"];
    $tipo = $_SESSION["tipo"];
    $setor = $_SESSION["id_setor"];

    if($tipo == 0){
        header("location: ../login.php");
        exit;
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }


    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        
        $usuario = $_POST["usuario"];

        $titulo = $_POST["titulo"];
        $mensagem = $_POST["mensagem"];
        $prazo = $_POST["prazo"];
        $data = date('Y/m/d');
        $hora = date('H:i');
        $status = 1;
        $prioridade = 0;
        $departamento = obterSetor($pdo, $usuario);

        $mensagemAlerta = realizandoChamado($pdo, $titulo, $mensagem, $usuario, $data, $hora, $prazo, $status, $departamento, $prioridade);

        alerta($mensagemAlerta);
    }

    /* FUNCOES */

    $listaNome = listagemNome($pdo, $setor);

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
            
            <form class="formulario" action="" method="POST">
                <h1 class="formulario__titulo">Solicitar Chamado</h1>
         
                <div class="formulario__grupo">
                
                    <select class="input" name="usuario" >
                        <?php foreach($listaNome as $lista): ?>       
                            <option class="input" value="<?= $lista['id_usuario']; ?>"><?= $lista['nome']; ?></option>
                        <?php endforeach; ?>    
                    </select>
                    
                </div>
                
                <div class="formulario__grupo">
                
                    <input type="text" name="titulo" class="input"  autocomplete="off" placeholder="Titulo" required="">
                    
                
                </div>
                
                <div class="formulario__grupo">
                
                    <input type="text" name="prazo" class="input"  autocomplete="off" placeholder="Prazo: Semana 00/00" required="">
                    <!-- <label class="formulario__label">Prazo: Semana 00/00</label> -->
                
                </div>
                
                <div class="formulario__grupo">
                
                    <textarea type="text" class="textarea" name="mensagem" rows="4" placeholder="Descricao" autocomplete="off" required=""></textarea>
                
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