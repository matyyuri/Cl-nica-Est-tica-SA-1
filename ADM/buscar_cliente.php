<?php
require_once 'conexao.php';

$conexao=conectarBanco();

//Consulta todos os clientes do banco
//Ordena por nome para melhor visualização
$sql="SELECT pk_cli, nome_cli, tele_cli , endereco, email_cli, data_nasc, genero, perfil
FROM cliente ORDER BY nome_cli ASC";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
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

    <h2>Todos os Clientes Cadastrados</h2>

    <?php if (!$clientes): ?>
        <p style="color:red;">Nenhum cliente encontrado no banco de dados.</p>
        <?php else: ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                    <th>Gênero</th>
                    <th>Perfil</th>
                </tr>

    <?php foreach ($clientes as $cliente):?>
    <tr>
        <td><?=htmlspecialchars($cliente['pk_cli'])?></td>
        <td><?=htmlspecialchars($cliente['nome_cli'])?></td>
        <td><?=htmlspecialchars($cliente['tele_cli'])?></td>
        <td><?=htmlspecialchars($cliente['endereco'])?></td>
        <td><?=htmlspecialchars($cliente['email_cli'])?></td>
        <td><?=htmlspecialchars($cliente['data_nasc'])?></td>
        <td><?=htmlspecialchars($cliente['genero'])?></td>
        <td><?=htmlspecialchars($cliente['perfil'])?></td>
        <td>
            <a href="atualizar_cliente.php?id=<?=$cliente['pk_cli']?>">Editar</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
    <footer class="l-footer">&copy; 2025 Iris Essence - Beauty Clinic. Todos os direitos reservados.</footer>
</body>
</html>