<?php 

function emAberto($pdo, $setor) {

    $sql = "SELECT count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_setor = :setor and chamado.status = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}

function emAndamento($pdo, $setor) {
    
    $sql = "SELECT count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_setor = :setor and chamado.status = 2";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}

function concluido($pdo, $setor) {
     
    $sql = "SELECT count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_setor = :setor and chamado.status = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}

function listagemEmAndamento($pdo, $setor){
    
    $sql = "SELECT 
                usuario.id_usuario, 
                usuario.nome, 
                usuario.tipo,
                chamado.data, 
                chamado.prazo,
                chamado.titulo, 
                chamado.id_chamado 
            FROM chamado 
            INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario
            INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento 
            AND chamado.status = 2 
            AND usuario.id_setor = :setor";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function listagemEmAberto($pdo, $setor) {
    $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data,
            chamado.prazo,
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario
        INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento 
        AND chamado.status = 1 
        AND usuario.id_setor = :setor
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
}

function listagemConcluido($pdo, $setor) {
        $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data,
            chamado.prazo,
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario
        INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento 
        AND chamado.status = 0 
        AND usuario.id_setor = :setor
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
}

