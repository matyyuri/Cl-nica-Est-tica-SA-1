<?php
require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conexao = conectarBanco();

    $sql="INSERT INTO cliente (nome, telefone, email, endereco, data_nascimento, genero, perfil)
    VALUES (:nome, :telefone, :email, :endereco, :data_nascimento, :genero, :perfil)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome",$_POST["nome"]);
    $stmt->bindParam(":telefone",$_POST["telefone"]);
    $stmt->bindParam(":email",$_POST["email"]);
    $stmt->bindParam(":endereco",$_POST["endereco"]);
    $stmt->bindParam(":data_nascimento",$_POST["data_nascimento"]);
    $stmt->bindParam(":genero",$_POST["genreo"]);
    $stmt->bindParam(":perfil",$_POST["perfil"]);

    try{
        $stmt->execute();
        echo "Cliente cadastrado com sucesso!";
    }catch(PDOException $e){
        error_log("Erro ao inserir cliente:".$e->getMessage());
        echo "Erro ao cadastrar cliente.";
    }
}
?>