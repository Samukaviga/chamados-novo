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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Relatorio</title>
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
        <section class="relatorio" >
            
           <table class="relatorio__tabela">
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Setor</th>
                  <th>Titulo</th>
                  <th>Descricao</th>
                  <th>Data Estimada</th>
                  <th>Concluido</th>
                  <th>Prioridade</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Samuel</td>
                  <td>TI</td>
                  <td>Site</td>
                  <td>refatorando codigo</td>
                  <td>02/11/ - Quinta feira</td>
                  <td>
                    <div class="form-check form-switch d-flex justify-content-center align-items-center">
                        <input class="form-check-input" type="checkbox" role="switch">
                    </div>
                  </td>
                  <td>
                    <div class="form-check form-switch d-flex justify-content-center align-items-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onchange="checkboxPrioridade(this, '<?php echo $id_chamado; ?>', '<?php echo $titulo; ?>')" <?php echo $checkboxPrioridade; ?>>
                    </div>
                  </td>
                </tr>
           </table>
            
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