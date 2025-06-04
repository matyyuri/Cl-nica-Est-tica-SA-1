<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cliente</title>
    <link rel="styleheet" href="style.css">
</head>
<body>
    <h2>Excluir Cliente</h2>
    <form action="processarDelacao.php" method="POST">
        <label for="id">ID do Cliente:</label>
        <input type="number" id="id" name="id" required>

        <button type="submit">Excluir Cliente</button>
    </form>
</body>
</html>