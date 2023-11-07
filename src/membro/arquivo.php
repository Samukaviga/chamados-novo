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
                <a class="cabecario__navegacao__link" href="./">Home</a>
                <a class="cabecario__navegacao__link" href="./relatorio.php">Relatorio</a>
                <a class="cabecario__navegacao__link" id="mostrar__engrenagem" href="#"><img class="cabecario__navegacao__engrenagem" src="../../assets/7596520.png" alt="Engrenagem"></a>
            </div>
        </nav>
        <p class="cabeario_usuario">Olá <?= $nome; ?></p>
    </header>
    <main class="conteudo">
        <section class="chamado">
            
      
 <!--
            <form class="formulario" action="" method="POST" enctype="multpart/form-data">
                <h1 class="formulario__titulo">Arquivo</h1>
                
                <div class="formulario__grupo">
                
                    <input type="file" name="arquivo" class="input"  autocomplete="off" required="">
                    <label class="formulario__label"></label>
                
                </div>
                    <input type="submit" name="enviar">
               <button type="submit" name="enviar" class="formulario__botao">Enviar</button> 
            </form> -->

            <form class="formulario" action="" method="post" enctype="multipart/form-data">
                <h1 class="formulario__titulo">Selecione o arquivo</h1>

                <input type="file" name="arquivo">
                <input type="submit" name="enviar">
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