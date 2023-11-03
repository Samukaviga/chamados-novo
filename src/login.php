<?php

include_once("../conexao.php");
include_once("../funcoes/membro.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){

     
    if(empty(trim($_POST["email"]))){
        alerta("Por favor, insira o email de usuário.");
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["senha"]))){
        alerta("Por favor, insira sua senha.");
    } else{
        $senhaDigitada = trim($_POST["senha"]);
    }

    if(!empty($senhaDigitada) && !empty($email)){ 
        
        $usuario = buscandoUsuario($pdo, $email);

        if($usuario){
            var_dump($usuario);

            $id = $usuario["id_usuario"];
            $email = $usuario["email"];
            $hashed_password = $usuario["senha"];
            $nome = $usuario['nome'];
            $setor = $usuario['id_setor'];
            $tipo = $usuario['tipo'];

            if(password_verify($senhaDigitada, $hashed_password)){
                 
                 session_start();
                        
                 $_SESSION["loggedin"] = true;
                 $_SESSION["id_usuario"] = $id;
                 $_SESSION["email"] = $email;
                 $_SESSION['nome'] = $nome;
                 $_SESSION['tipo'] = $tipo; 
                 $_SESSION['id_setor'] = $setor;                           
                 
                     if($tipo ==! 0){
                             header("location: ./admin/");
                     } else if ($tipo == 0){
                          // Redirecionar o usuário para a página de boas-vindas
                             header("location: ./membro/");
                     }

            } else {
                alerta('Usuario ou Senha incorretos!');
            }


        }else {
            alerta("Usuario ou Senha incorretos!");
        }
    } else{ 
        echo "Algo deu errado";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login.css">
    <title>Meus Livros</title>
</head>
<body>
    <header class="cabecario">
    </header>
    <main class="login">
        <section class="login__container" >
            <h1 class="login__container__titulo">Login</h1>
            <img  class="login__container__imagem" src="../assets/logo.png" alt="">
            <form action="" method="POST">
                <div>
                    <div class="login__conteudo__input">
                        <label class="login__label" for="email">Email:</label>
                        <input class="login__input" type="email" name="email" id="email" placeholder="Digite seu Email" required>
                    </div>
                    <div class="login__conteudo__input">
                        <label class="login__label" for="senha">Senha:</label>
                        <input class="login__input" type="password" name="senha" id="senha" placeholder="Digite sua Senha" required>
                    </div>
                    <div class="login__conteudo__botao" >
                        <input class="login__input__botao" type="submit" name="submit" value="Enviar">
                    </div>
                </div>
            </form>

        </section>
    </main>

</body>
</html>