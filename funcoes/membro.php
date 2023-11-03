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
    $sql = "select chamado.titulo, chamado.id_chamado, chamado.prazo from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 2";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemEmAberto($pdo, $id) {
    $sql = "select chamado.titulo, chamado.id_chamado, chamado.prazo from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemConcluido($pdo, $id) {
    $sql = "select chamado.titulo, chamado.id_chamado, chamado.prazo from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = :id and chamado.status = 0";
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














