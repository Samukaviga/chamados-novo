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

    $listagemRelatorio = listagemRelatorio($pdo, $id_usuario);

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
                <a class="cabecario__navegacao__link" href="../membro/">Home</a>
                <a class="cabecario__navegacao__link" href="../membro/relatorio.php">Relatorio</a>
                <a class="cabecario__navegacao__link" id="mostrar__engrenagem" href="#"><img class="cabecario__navegacao__engrenagem" src="../../assets/7596520.png" alt=""></a>
            </div>
        </nav>
        <p class="cabeario_usuario"> Olá <?= $nome; ?></p>
    </header>
    <main class="conteudo">
        <section class="relatorio" >
            
           <table class="relatorio__tabela">
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Titulo</th>
                  <th>Descricao</th>
                  <th>Prazo de Entrega</th>
                  <th>Concluido</th>
                </tr>
                <?php foreach($listagemRelatorio as $lista): ?>

                        <?php 
                            $prioridade = $lista['prioridade']; 
                            $id_chamado = $lista['id_chamado'];
                            $titulo = $lista['titulo']; 
                            $status = $lista['status'];
                            $checkboxConcluido = ($status == 0) ? 'checked' : '';
                        ?>

                <tr class="<?= $prioridade == 1 ? 'relatorio__prioridade' : ''; ?>">
                    

                    <td><?= $lista['id_chamado']; ?></td>
                    <td><?= $lista['nome']; ?></td>
                    <td><a class="relatorio__link" href="./arquivo.php?id_chamado=<?=$lista['id_chamado']; ?>"><?= $lista['titulo']; ?></a></td>
                    <td><?= $lista['mensagem']; ?></td>
                    <td><?= $lista['prazo']; ?></td>
                    <td>
                        <div class="form-check form-switch d-flex justify-content-center align-items-center">
                            <input class="form-check-input" type="checkbox" role="switch" onchange="checkboxConcluido(this, '<?php echo $id_chamado; ?>', '<?php echo $titulo; ?>')" <?= $checkboxConcluido; ?>>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
           </table>
            
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
    <script src="../../js/checkbox-membro/checkbox.js"></script>
</body>
</html>