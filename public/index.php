<?php include "../app/config/conexao.php";
include "../app/config/auth.php"




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Olá, <?= $USUARIO['nome']?>. Bem vindo ao sistema</h3>

    <form action="aparelho/index.php" method="post">
        <button type="submit">Cadastrar aparelho</button>
    </form>
</body>

</html>