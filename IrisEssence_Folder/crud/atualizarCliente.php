<?php
require_once 'conexao.php';

$conexao=conectarBanco();

//Obtendo o ID via GET
$idCliente=$_GET["id"]?? null;
$cliente=null;
$msgErro="";

//Função local para buscar cliente por ID
function buscarClientePorId($idCliente, $conexao){
    $stmt = $conexao->prepare("SELECT id_cliente, nome, telefone, email, endereco, data_nascimento, genero, perfil FROM cliente WHERE id_cliente = :id");
    $stmt->bindParam(":id", $idCliente, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

//Se um ID foi enviado, busca o cliente no banco
if($idCliente && is_numeric($idCliente)){
    $cliente = buscarClientePorId($idCliente, $conexao);

    if(!$cliente){
        $msgErro="Erro: Cliente não encontrado.";
    }
}else{
    $msgErro="Digite o ID do cliente para buscar os dados.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cliente</title>
    <link rel="styleheet" href="style.css">
    <script>
        function habilitarEdicao(campo){
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>
</head>
<body>
    <h2>Atualizar Cliente</h2>

<!--Se houver erro, exibe a mensagem e o campo de buscar-->
    <?php if ($msgErro):?>
        <p style="color:red;"><?=htmlspecialchars($msgErro)?></p>
        <form action="atualizarCliente.php" method="GET">
            <label for="id">ID do Cliente:</label>
            <input tybe="number" id="id" name="id" required>
            <button type="submit">Buscar</button>
    </form>
    <?php else: ?>

<!--Se um cliente foi encontrado, exibe o formulário preenchido-->
        <form action="processarAtualizacao.php" method="POST">
            <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($cliente["id_cliente"])?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cliente["nome"])?>" readonly 
            onclick="habilitarEdicao('nome')">

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente["telefone"])?>" readonly 
            onclick="habilitarEdicao('telefone')">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente["email"])?>" readonly 
            onclick="habilitarEdicao('email')">

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($cliente["endereco"])?>" readonly 
            onclick="habilitarEdicao('endereco')">

            <label for="data_nascimento">Data de nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($cliente["data_nascimento"])?>" readonly 
            onclick="habilitarEdicao('data_nascimento')">

            <label for="genero">Genero:</label>
            <input type="text" id="genero" name="genero" value="<?= htmlspecialchars($cliente["genero"])?>" readonly 
            onclick="habilitarEdicao('genero')">

            <label for="perfil">Perfil:</label>
            <input type="text" id="perfil" name="perfil" value="<?= htmlspecialchars($cliente["perfil"])?>" readonly 
            onclick="habilitarEdicao('perfil')">



            <button type="submit">Atualizar Cliente</button>
        </form>

    <?php endif; ?>

</body>
</html>