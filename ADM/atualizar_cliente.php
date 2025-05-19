<?php
require_once 'conexao.php';

$conexao=conectarBanco();

//Obtendo o ID via GET
$idCliente=$_GET["id"]?? null;
$cliente=null;
$msgErro="";

//Função local para buscar cliente por ID
function buscarClientePorId($idCliente, $conexao){
    $stmt = $conexao->prepare("SELECT pk_cli, nome_cli, tele_cli , endereco, email_cli, data_nasc, genero, perfil
    FROM cliente WHERE pk_cli = :id");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script>
        function habilitarEdicao(campo){
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>
</head>
<body>
<header>
        <nav>
            <ul>
                <a href="../html/index.html">
                  <img src="../imgs/logo.jpg" class="logo" alt="Logo">
                </a>
                <li><a href="../html/index.html">HOME</a></li>
                <li>
                    <a href="#">PROCEDIMENTOS FACIAIS</a>
                    <div class="submenu">
                        <a href="../html/limpezapele.html">Limpeza de Pele</a>
                        <a href="../html/labial.html">Preenchimento labial</a>
                        <a href="../html/microagulhamento.html">Microagulhamento</a>
                        <a href="../html/botoxfacial.html">Botox</a>
                        <a href="../html/acne.html">Tratamento para Acne</a>
                        <a href="../html/lipopapada.html">Lipo de papada</a>
                        <a href="../html/rinoplastia.html">Rinoplastia</a>
                    </div>
                </li>
                <li>
                    <a href="#">PROCEDIMENTOS CORPORAIS</a>
                    <div class="submenu">
                        <a href="../html/massagemmodeladora.html">Massagem Modeladora</a>
                        <a href="../html/drenagemlinfatica.html">Drenagem Linfática</a>
                        <a href="../html/depilacaolaser.html">Depilação a Laser</a>
                        <a href="../html/depilacaocera.html">Depilação de cera</a>
                        <a href="../html/abdominoplastia.html">Abdominoplastia</a>
                        <a href="../html/mamoplastia.html">Mamoplastia</a>
                        <a href="../html/gluteoplastia.html">Gluteoplastica</a>
                    </div>
                </li>

                <li><a href="../html/produtos.html">PRODUTOS</a></li>
                  
                |<li><a href="../html/agendamento.html">AGENDAR</a></li>|
                <li><a href="../html/login.html">LOGIN</a></li>|
                <li><a href="../html/cadastro.html">CADASTRO</a></li>|
            </ul>
        </nav>
    </header>

    <h2>Atualizar Cliente</h2>

<!--Se houver erro, exibe a mensagem e o campo de buscar-->
    <?php if ($msgErro):?>
        <p style="color:red;"><?=htmlspecialchars($msgErro)?></p>
        <form action="atualizar_cliente.php" method="GET">
            <label for="id">ID do Cliente:</label>
            <input tybe="number" id="id" name="id" required>
            <button type="submit">Buscar</button>
    </form>
    <?php else: ?>

<!--Se um cliente foi encontrado, exibe o formulário preenchido-->
        <form action="processar_atualizacao.php" method="POST">
            <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($cliente["pk_cli"])?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($cliente["nome_cli"])?>" readonly 
            onclick="habilitarEdicao('nome')">

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente["tele_cli"])?>" readonly 
            onclick="habilitarEdicao('telefone')">

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($cliente["endereco"])?>" readonly 
            onclick="habilitarEdicao('endereco')">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente["email_cli"])?>" readonly 
            onclick="habilitarEdicao('email')">

            <label for="data_nasc">Data de Nascimento:</label>
            <input type="date" id="data_nasc" name="data_nasc" value="<?= htmlspecialchars($cliente["data_nasc"])?>" readonly 
            onclick="habilitarEdicao('data_nasc')">

            <label for="genero">Gênero:</label>
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