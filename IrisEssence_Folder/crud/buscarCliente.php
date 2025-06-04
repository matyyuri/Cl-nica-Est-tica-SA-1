<?php
require_once 'conexao.php';

$conexao=conectarBanco();

//Consulta todos os clientes do banco
//Ordena por nome para melhor visualização
$sql="SELECT id_cliente, nome, telefone, email, endereco, data_nascimento, genero, perfil
FROM cliente ORDER BY nome ASC";
$stmt=$conexao->prepare($sql);
$stmt->execute();
$clientes= $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="styleheet" href="style.css">
</head>
<body>
    <h2>Todos os Clientes Cadastrados</h2>

    <?php if (!$clientes): ?>
        <p style="color:red;">Nenhum cliente encontrado no banco de dados.</p>
        <?php else: ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Endereço</th>
                    <th>Data de Nascimento</th>
                    <th>Genero</th>
                    <th>Perfil</th>
                </tr>

    <?php foreach ($clientes as $cliente):?>
    <tr>
        <td><?=htmlspecialchars($cliente['id_cliente'])?></td>
        <td><?=htmlspecialchars($cliente['nome'])?></td>
        <td><?=htmlspecialchars($cliente['telefone'])?></td>
        <td><?=htmlspecialchars($cliente['email'])?></td>
        <td><?=htmlspecialchars($cliente['endereco'])?></td>
        <td><?=htmlspecialchars($cliente['data_nascimento'])?></td>
        <td><?=htmlspecialchars($cliente['genero'])?></td>
        <td><?=htmlspecialchars($cliente['perfil'])?></td>
        <td>
            <a href="atualizarCliente.php?id=<?=$cliente['id_cliente']?>">Editar</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>