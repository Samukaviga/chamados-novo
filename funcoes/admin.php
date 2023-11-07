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
            chamado.prioridade,
            chamado.status,
            chamado.mensagem,
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

function listagemRelatorio($pdo, $setor) {
    
    $sql = "SELECT ROW_NUMBER() OVER (ORDER BY chamado.prioridade DESC) AS 
        ordem, 
        usuario.id_usuario, 
        chamado.id_chamado, 
        usuario.nome, 
        unidade.nome_unidade,
        setor.nome_setor,
        chamado.mensagem,
        chamado.prazo, 
        chamado.titulo, 
        chamado.status, 
        chamado.prioridade, 
        departamento.nome as 'nome_departamento' 
    FROM usuario 
    INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade 
    INNER JOIN setor ON usuario.id_setor = setor.id_setor INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario 
    INNER JOIN departamento on departamento.id_departamento = chamado.id_departamento and departamento.id_departamento = :setor
    ORDER BY chamado.id_chamado DESC, chamado.status DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":setor", $setor, PDO::PARAM_INT);
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

function realizandoChamado($pdo, $titulo, $mensagem, $id_usuario, $data, $hora, $prazo, $status, $departamento, $prioridade) {
    
    $sql = "INSERT INTO chamado (titulo, mensagem, id_usuario, data, hora, status, id_departamento, prioridade, prazo) VALUES (:titulo, :mensagem, :id_usuario, :data, :hora, :status, :departamento, :prioridade, :prazo)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
    $stmt->bindParam(':data', $data, PDO::PARAM_STR);
    $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
    $stmt->bindParam(':prazo', $prazo, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':departamento', $departamento, PDO::PARAM_STR);
    $stmt->bindParam(':prioridade', $prioridade, PDO::PARAM_STR);

    if($stmt->execute()){
        return "Chamado Enviado Com Sucesso!!";   
    } else {
        return "Erro ao Enviar Chamado";
    }
}

function obterSetor($pdo, $id_usuario) {
    $sql = 'SELECT id_setor FROM usuario WHERE id_usuario = :id_usuario';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['id_setor'];
}

function alerta($mensagem) {
    echo "<script>alert('$mensagem');</script>";
}

function alertaERedirecionamento($mensagem){
    echo "<script>alert('$mensagem');</script>";
    header("Location: ./");
    exit;
}

function excluirChamado($pdo, $id) {
    $sql = "DELETE FROM chamado WHERE id_chamado = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if($stmt->execute()){
        return true;   
    } else {
        return false;
    }
}









