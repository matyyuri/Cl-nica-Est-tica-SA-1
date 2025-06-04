<?php
require 'conexao.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conexao = conectarBanco();

    $id=filter_var($_POST["id_cliente"], FILTER_SANITIZE_NUMBER_INT);
    $nome=htmlspecialchars(trim($_POST["nome"]));
    $telefone=htmlspecialchars(trim($_POST["telefone"]));
    $email=filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $endereco=htmlspecialchars(trim($_POST["endereco"]));
    $data_nascimento=htmlspecialchars(trim($_POST["data_nascimento"]));
    $genero=htmlspecialchars(trim($_POST["genero"]));
    $perfil=htmlspecialchars(trim($_POST["perfil"]));

    if(!$id || !$email){
        die("Erro: ID inválido ou e-mail incorreto.");
    }

    $sql="UPDATE cliente SET nome =:nome, telefone =:telefone, email =:email, endereco=:endereco, data_nascimento =:data_nascimento, genero =:genero, perfil =:perfil WHERE id_cliente = :id";

    $stmt= $conexao->prepare($sql);
    $stmt->bindParam(":id",$id, PDO::PARAM_INT);
    $stmt->bindParam(":nome",$nome);
    $stmt->bindParam(":telefone",$telefone);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":endereco",$endereco);
    $stmt->bindParam(":data_nascimento",$data_nascimento);
    $stmt->bindParam(":genero",$genero);
    $stmt->bindParam(":perfil",$perfil);

    try{
        $stmt->execute();
        echo "Cliente atualizado com sucesso!";
    }catch(PDOException $e){
        error_log("Erro ao atualizar cliente:".$e->getMessage());
        echo "Erro ao atyalizar registro.";
    }
}   
?>