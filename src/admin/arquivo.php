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
          
    }

    if($_GET['id_chamado']){
        $_SESSION['id_chamado'] = $_GET['id_chamado'];

        $listaMensagens = buscandoMensagem($pdo, $_SESSION['id_chamado']);
    }

    /* FUNCOES */

    $listaNome = listagemNome($pdo, $setor);

?>
<!DOCTYPE html>
<html lang="pt-br">
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
            
                <div class="formulario">
                    <?php 

                            $pastaChamado = $_SESSION['id_chamado'];

                            if (is_dir("../membro/upload/$pastaChamado")) {
                                $path = "../membro/upload/$pastaChamado/";
                                $diretorio = dir($path);
                    
                                echo "<p class='arquivos__titulo'>Arquivo:</p><br />";
                                while($arquivo = $diretorio -> read()){
                                    // Verifica se o arquivo não é "." ou ".." antes de exibi-lo
                                    if ($arquivo !== "." && $arquivo !== "..") {
                                        echo "<p class='arquivos__arquivo'><a  href='".$path.$arquivo."'>".$arquivo."</a> <a class='arquivos__excluir' href='excluirArquivo.php?arquivo=".urlencode($arquivo)."'>Excluir</a></p>";
                                    }
                                }
                                $diretorio -> close();
                            }
                    
                    ?>
                </div>

                <div class="container__mensagem">
                          
                        <?php if(isset($listaMensagens)): ?>
                            
                            <?php foreach($listaMensagens as $lista): ?>

                            <h2 class="container__mensagem__titulo"><?= $lista['titulo']; ?></h2>
                          
                            <p class="container__mensagem__texto"><?= $lista['texto']; ?></p>
                            
                            <div class="div__texto__botao" >
                                <a href="./excluirMensagem.php?id_mensagem=<?= $lista['id_mensagem_chamado']; ?>" class="texto__botao__excluir">Excluir</a>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </div>
            
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