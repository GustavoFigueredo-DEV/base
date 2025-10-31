<?php
include "../../app/config/conexao.php";

$sql = "SELECT * FROM aparelhos";
$result = mysqli_query($conn, $sql);
$aparelhos = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aparelhos</title>
</head>
<body>
    <h1>Aparelhos</h1>
    <?php if (count($aparelhos) === 0): ?>
    <?php else: ?>
        <a href="/aparelho/cadastrar.php">Cadastrar Aparelhos</a>
        <a href="/index.php">Aparelhos</a>
        <div class="produtos">
            <?php foreach ($aparelhos as $a): ?>
                <div class="aparelho">
                    <img src="https://placehold.co/200" alt="">
                    <h2><?= $a['marca'] ?></h2>
                    <p><?= $a['modelo'] ?></p>
                    <a href="./editar.php?id=<?= $a['id'] ?>">Editar</a>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</body>
</html>
