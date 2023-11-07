<?php

    include_once("../../conexao.php");
    include_once("../../funcoes/membro.php");

    session_start();  
    
    $id_usuario = $_SESSION["id_usuario"];
    $nome = $_SESSION["nome"];

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

    /* FUNCOES */
    $listaAndamento = listagemAndamento($pdo, $id_usuario);
    $listaConcluido = listagemConcluido($pdo, $id_usuario);
    $listaEmAberto = listagemEmAberto($pdo, $id_usuario);


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
                <a class="cabecario__navegacao__link" href="./">Home</a>
                <a class="cabecario__navegacao__link" href="./relatorio.php">Relatorio</a>
                <a class="cabecario__navegacao__link" id="mostrar__engrenagem" href="#"><img class="cabecario__navegacao__engrenagem" src="../../assets/7596520.png" alt="Engrenagem"></a>
            </div>
        </nav>
        <p class="cabeario_usuario">Olá <?= $nome; ?></p>
    </header>
    <main class="conteudo">
        <section class="container__tarefa" >
            
            <div class="container__tarefa__item">
                <a id="popup__lateral__abrir__aberto" class="container__tarefa__item_link" href="#">
                    <h2 class="container__tarefa__item__titulo">Em Aberto</h2>
                    <p class="container__tarefa__item__quantidade"><?= emAberto($pdo, $id_usuario) ?></p>
                </a>
            </div>

            <div class="container__tarefa__item">
                <a id="popup__lateral__abrir__andamento" class="container__tarefa__item_link" href="#">
                    <h2 class="container__tarefa__item__titulo">Andamento</h2>
                    <p class="container__tarefa__item__quantidade"><?= emAndamento($pdo, $id_usuario) ?></p>
                </a>
            </div>

            <div class="container__tarefa__item">
                <a id="popup__lateral__abrir__concluido" class="container__tarefa__item_link" href="#">
                    <h2 class="container__tarefa__item__titulo">Concluido</h2>
                    <p class="container__tarefa__item__quantidade"><?= concluido($pdo, $id_usuario) ?></p>
                </a>
            </div>
            
        </section>
       
    </main>

    <!-- ENGRENAGEM --->
    
    <div id="popup__engrenagem__abrir" class="popup__engrenagem">
        <ul class="popup__engrenagem__lista">
           <a class="popup__engrenagem__link" href="../membro/alterarSenha.php"><li class="popup__engrenagem__item">Alterar Senha</li></a>
            <a class="popup__engrenagem__link" href="../logout.php"><li class="popup__engrenagem__item">Sair</li></a> 
        </ul>
    </div>

    <!-- EM ABERTO -->
    <div id="popup__lateral__aberto" class="popup__lateral">
        <div class="popup__lateral__fechar">
            <a id="popup__lateral__fechar__aberto" class="popup__lateral__fechar__link" href="#"><img class="popup__lateral__fechar__imagem" src="../../assets/x.png" alt=""></a>
        </div>

            <div class="popup__lateral__relatorio">
                <table class="popup__lateral__relatorio__tabela">
                    <tr>
                    <th>#</th>        
                    <th>Titulo</th>
                    <th>Prazo de Entrega</th>
                    </tr>
                    <?php foreach($listaEmAberto as $lista):  ?>
                    <tr>
                        <td><?= $lista['id_chamado']; ?></td>
                        <td> <a class="poupup__lateral__relatorio__link" href="../../js/checkbox-membro/adicionandoEmAberto.php?id_chamado=<?=$lista['id_chamado'];?>" class="link-success" id="aberto" onclick="handleClick('<?= $lista['id_chamado'];?>', '<?= $lista['tipo'];?>')"><?php echo $lista['titulo']."<br />\n";?></a></td>
                        <td><?= $lista['prazo']; ?></td>
                    
                   
                    </tr>
                    <?php endforeach;  ?>
                </table>
            </div>
    </div>
    <!-- EM ANDAMENTO -->
    <div id="popup__lateral__andamento" class="popup__lateral">
        <div class="popup__lateral__fechar">
            <a id="popup__lateral__fechar__andamento" class="popup__lateral__fechar__link" href="#"><img class="popup__lateral__fechar__imagem" src="../../assets/x.png" alt=""></a>
        </div>

       

            <div class="popup__lateral__relatorio">
                <table class="popup__lateral__relatorio__tabela">
                    <tr>
                    <th>#</th>        
                    <th>Titulo</th>
                    <th>Prazo de Entrega</th>
                    </tr>
                    <?php foreach($listaAndamento as $lista):  ?>
                    <tr>

                   

                        <td><?= $lista['id_chamado']; ?></td>
                        
                        <td> <a class="poupup__lateral__relatorio__link" href="../../js/checkbox-membro/adicionandoEmAberto.php?id_chamado=<?=$lista['id_chamado'];?>" class="link-success" id="aberto" onclick="handleClick('<?= $lista['id_chamado'];?>', '<?= $lista['tipo'];?>')"><?php echo $lista['titulo']."<br />\n";?></a></td>
                        <td><?= $lista['prazo']; ?></td>
                    
                   
                    </tr>
                    <?php endforeach;  ?>
                </table>
            </div>
    </div>
    <!-- CONCLUIDO -->
    <div id="popup__lateral__concluido" class="popup__lateral">
        <div class="popup__lateral__fechar">
            <a id="popup__lateral__fechar__concluido" class="popup__lateral__fechar__link" href="#"><img class="popup__lateral__fechar__imagem" src="../../assets/x.png" alt=""></a>
        </div>

            <div class="popup__lateral__relatorio">
                 <table class="popup__lateral__relatorio__tabela">
                    <tr>
                    <th>#</th>        
                    <th>Titulo</th>
                    <th>Prazo de Entrega</th>
                    </tr>
                    <?php foreach($listaConcluido as $lista):  ?>
                    <tr>

                        <td><?= $lista['id_chamado']; ?></td>
                        <td><a class="poupup__lateral__relatorio__link" href="./arquivo.php?id_chamado=<?=$lista['id_chamado'];?>"><?= $lista['titulo']; ?></a></td>
                        <td><?= $lista['prazo']; ?></td>
                    
                   
                    </tr>
                    <?php endforeach;  ?>
                </table>
            </div>
    </div>

</body>
    <script src="../../js/checkbox-membro/emAberto.js"></script>
    <script src="../../js/funcoes.js" ></script>

</html> 