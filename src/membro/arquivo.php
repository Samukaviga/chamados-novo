<?php

    include_once("../../conexao.php");
    include_once("../../funcoes/membro.php");

    session_start();  
    
    $id_usuario = $_SESSION["id_usuario"];
    $nome = $_SESSION["nome"];
    $tipo = $_SESSION["tipo"];
    $setor = $_SESSION["id_setor"];

    if($tipo ==! 0){
        header("location: ../login.php");
        exit;
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

    if($_GET['id_chamado']){
        $_SESSION['id_chamado'] = $_GET['id_chamado'];

        
        $listaMensagens = buscandoMensagem($pdo, $_SESSION['id_chamado']);
        
    }

    /*
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if(isset($_FILES['file'])) {
            $file = $_FILES['file'];
            var_dump($file);
            
        } else {
            echo "Erro no envio do arquivo.";
        }
    }*/

    if(isset($_POST['enviar'])){
        
        if(!empty($_FILES['arquivo']['name'])){

            $nomeArquivo = $_FILES['arquivo']['name'];
            $tipo = $_FILES['arquivo']['type'];
            $nomeTemporario = $_FILES['arquivo']['tmp_name'];
            $tamanho = $_FILES['arquivo']['size'];
            $erros = array();

            $pastaChamado = $_SESSION['id_chamado'];

            
            if (!is_dir("./upload/$pastaChamado")) {
                // Se não existir, crie a pasta
                mkdir("./upload/$pastaChamado", 0755, true);
            }

            
            // Move o arquivo da pasta temporaria de upload para a pasta de destino 
            if (move_uploaded_file($nomeTemporario, "./upload/$pastaChamado/$nomeArquivo")) { 
                alerta("Armazenado com Sucesso!");
            } 
            else { 
               alerta("Erro. O arquivo nao pode ser enviado!");
            }   


        }
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
                <a class="cabecario__navegacao__link" href="./">Home</a>
                <a class="cabecario__navegacao__link" href="./relatorio.php">Relatorio</a>
                <a class="cabecario__navegacao__link" id="mostrar__engrenagem" href="#"><img class="cabecario__navegacao__engrenagem" src="../../assets/7596520.png" alt="Engrenagem"></a>
            </div>
        </nav>
        <p class="cabeario_usuario">Olá <?= $nome; ?></p>
    </header>
    <main class="conteudo">
        <section class="chamado">
            

            <form class="formulario" action="" method="post" enctype="multipart/form-data">
                <h1 class="formulario__titulo">Selecione um arquivo</h1>

                <input type="file" name="arquivo">
                <input type="submit" name="enviar">
            </form>

            <form class="formulario" action="./mensagem.php" method="post">
                    <h1 class="formulario__titulo">Adicione um Texto</h1>

                    <textarea type="text" class="textarea" name="mensagem" rows="6" placeholder="Descricao" autocomplete="off" required=""></textarea>
                    
                    <div>
                        <input class="formulario__botao" type="submit" name="enviar">
                    </div>
                </form>


                <div class="arquivos">
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