<?php
require 'conexao.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conexao = conectarBanco();

    $id=filter_var($_POST["pk_cli"], FILTER_SANITIZE_NUMBER_INT);
    $nome=htmlspecialchars(trim($_POST["nome_cli"]));
    $telefone=htmlspecialchars(trim($_POST["tele_cli"]));
    $endereco=htmlspecialchars(trim($_POST["endereco"]));
    $data_nasc=htmlspecialchars(trim($_POST["data_nasc"]));
    $genero=htmlspecialchars(trim($_POST["genero"]));
    $perfil=htmlspecialchars(trim($_POST["perfil"]));

    $email=filter_var($_POST["email_cli"], FILTER_VALIDATE_EMAIL);

    if(!$id || !$email){
        die("Erro: ID inválido ou e-mail incorreto.");
    }

    $sql="UPDATE cliente SET nome_cli=:nome, tele_cli = :telefone, endereco= :endereco,
    data_nasc= :data_nasc, genero= :genero, perfil= :perfil, email_cli = :email WHERE pk_cli = :id";

    $stmt= $conexao->prepare($sql);
    $stmt->bindParam(":pk_cli",$id, PDO::PARAM_INT);
    $stmt->bindParam(":nome_cli",$nome);
    $stmt->bindParam(":tele_cli",$telefone);
    $stmt->bindParam(":endereco",$endereco);
    $stmt->bindParam(":email_cli",$email);
    $stmt->bindParam(":data_nasc",$data_nasc);
    $stmt->bindParam(":genero",$genero);
    $stmt->bindParam(":perfil",$perfil);

    try{
        $stmt->execute();
        echo "Cliente atualizado com sucesso!";
    }catch(PDOException $e){
        error_log("Erro ao atualizar cliente:".$e->getMessage());
        echo "Erro ao atualizar registro.";
    }
}   
?>