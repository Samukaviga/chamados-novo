<?php 

function buscandoUsuario($pdo, $email) {
      
    $sql = "SELECT id_usuario, email, nome, senha, id_setor, tipo FROM usuario WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(); 
    return $result;
}

function alerta($mensagem) {
    echo "<script>alert('$mensagem');</script>";
}

function emAberto($pdo, $id) {
    $sql = "SELECT count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}

function emAndamento($pdo, $id) {
    $sql = "SELECT count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 2";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}

function concluido($pdo, $id){
    $sql = "SELECT count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}

function listagemAndamento($pdo, $id) {
    $sql = "select chamado.titulo, chamado.id_chamado, usuario.tipo, chamado.prazo from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 2";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemEmAberto($pdo, $id) {
    $sql = "SELECT 
    chamado.titulo, 
    chamado.id_chamado, 
    chamado.prazo,
    usuario.tipo 
    FROM chamado 
    inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemConcluido($pdo, $id) {
    $sql = "select chamado.titulo, chamado.id_chamado, usuario.tipo, chamado.prazo from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemRelatorio($pdo, $id) {

    $sql = "SELECT
    ROW_NUMBER() OVER (ORDER BY chamado.titulo ASC) AS ordem,
    usuario.id_usuario,
    usuario.nome,
    unidade.nome_unidade,
    setor.nome_setor,
    chamado.titulo,
    chamado.prazo,
    chamado.prioridade,
    chamado.mensagem,
    chamado.status,
    chamado.id_chamado,
    departamento.nome as 'nome_departamento'
FROM 
    usuario
    INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade
    INNER JOIN setor ON usuario.id_setor = setor.id_setor
    INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario
    INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento
WHERE
    usuario.id_usuario = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemNome($pdo, $setor) {

    $sql = "SELECT id_usuario, nome FROM `usuario` WHERE id_setor = :setor AND tipo = 0;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function alertaERedirecionamento($mensagem){
    echo "<script>alert('$mensagem');</script>";
    header("Location: ./");
    exit;
}

function adicionandoMensagem($pdo, $texto, $id_chamado, $id_usuario, $data, $hora){

    $sql = "INSERT INTO mensagem_chamado (id_chamado, id_usuario, texto, data, hora) 
                VALUES (:id_chamado, :id_usuario, :texto, :data, :hora)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':texto', $texto, PDO::PARAM_STR);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_chamado', $id_chamado, PDO::PARAM_INT);
    $stmt->bindParam(':data', $data, PDO::PARAM_STR);
    $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
    
    if($stmt->execute()){
        return true;   
    } else {
        return false;
    }
}

function buscandoMensagem($pdo, $id_chamado){
   
    $sql = "SELECT mensagem_chamado.texto, chamado.titulo, mensagem_chamado.id_mensagem_chamado FROM `mensagem_chamado` INNER JOIN chamado ON chamado.id_chamado = mensagem_chamado.id_chamado WHERE mensagem_chamado.id_chamado = :id_chamado";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_chamado", $id_chamado, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function excluirMensagem($pdo, $id_mensagem){
    
    $sql = "DELETE FROM mensagem_chamado WHERE id_mensagem_chamado = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_mensagem, PDO::PARAM_INT);

    if($stmt->execute()){
        return true;   
    } else {
        return false;
}

}














