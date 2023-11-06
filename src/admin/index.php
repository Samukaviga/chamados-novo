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


    /* FUNCOES */
        $emAberto = emAberto($pdo, $setor);
        $emAndamento = emAndamento($pdo, $setor);
        $concluido = concluido($pdo, $setor);

        $listaEmAndamento = listagemEmAndamento($pdo, $setor);
        $listaEmAberto = listagemEmAberto($pdo, $setor);
        $listaConcluido = listagemConcluido($pdo, $setor);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Principal</title>
</head>
<body>
    <header class="cabecario">
        <nav class="cabecario__menu">
            <img class="cabecario__logo" src="../../assets/logo.png" alt="">
            <div class="cabecario__navegacao" >
                <a class="cabecario__navegacao__link" href="../admin/">Home</a>
                <a class="cabecario__navegacao__link" href="../admin/chamados.php">Chamados</a>
                <a class="cabecario__navegacao__link" href="../admin/relatorio.php">Relatorio</a>
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
                    <p class="container__tarefa__item__quantidade"><?= $emAberto; ?></p>
                </a>
            </div>

            <div class="container__tarefa__item">
                <a id="popup__lateral__abrir__andamento" class="container__tarefa__item_link" href="#">
                    <h2 class="container__tarefa__item__titulo">Andamento</h2>
                    <p class="container__tarefa__item__quantidade"><?= $emAndamento; ?></p>
                </a>
            </div>

            <div class="container__tarefa__item">
                <a id="popup__lateral__abrir__concluido" class="container__tarefa__item_link" href="#">
                    <h2 class="container__tarefa__item__titulo">Concluido</h2>
                    <p class="container__tarefa__item__quantidade"><?= $concluido; ?></p>
                </a>
            </div>
            
        </section>
       
      

    </main>

    <!-- ENGRENAGEM --->
    
    <div id="popup__engrenagem__abrir" class="popup__engrenagem">
        <ul class="popup__engrenagem__lista">
           <a class="popup__engrenagem__link" href="../admin/alterarSenha.html"><li class="popup__engrenagem__item">Alterar Senha</li></a>
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
                        <th>Nome</th>
                        <th>Titulo</th>
                        <th>Prazo de Entrega</th>
                    </tr>
                    <?php foreach($listaEmAberto as $lista): ?>
                    <tr>
                        <td><?= $lista['id_usuario']; ?></td>
                        <td><?= $lista['nome']; ?></td>
                        <td><?= $lista['titulo']; ?></td>
                        <td><?= $lista['prazo']; ?></td>
                    </tr>
                    <?php endforeach; ?>
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
                        <th>Nome</th>
                        <th>Titulo</th>
                        <th>Prazo de Entrega</th>                     
                    </tr>
                    <?php foreach($listaEmAndamento as $lista): ?>
                    <tr>
                        <td><?= $lista['id_usuario']; ?></td>
                        <td><?= $lista['nome']; ?></td>
                        <td><?= $lista['titulo']; ?></td>
                        <td><?= $lista['prazo']; ?></td>
                    </tr>
                    <?php endforeach; ?>
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
                    <th>Nome</th>
                    <th>Titulo</th>
                    <th>Prazo de Entrega</th>
                    </tr>
                    <?php foreach($listaConcluido as $lista): ?>
                    <tr>
                        <td><?= $lista['id_usuario']; ?></td>
                        <td><?= $lista['nome']; ?></td>
                        <td><?= $lista['titulo']; ?></td>
                        <td><?= $lista['prazo']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
    </div>

</body>
    <script src="../../js/funcoes.js" ></script>

</html> 