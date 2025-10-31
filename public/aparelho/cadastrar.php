<?php
include '../../app/config/conexao.php';

if (isset($_POST['method']) && $_POST['method'] === 'cadastrar') {
    $marca = trim($_POST['nome'] ?? null);
    $modelo = trim($_POST['preco'] ?? null);
    $quantidade = trim($_POST['quantidade'] ?? null);
    $descricao = trim($_POST['descricao'] ?? null);

    $preco = str_replace(',', '.', $preco);
    $preco = (float)$preco;
    $quantidade = (int)$quantidade;
    $descricao = (string)$descricao;

    $query = "INSERT INTO PRODUTOS (nome, preco, quantidade, descricao) VALUES (?, ?, ?, ?)";
    $insercaoStmt = $conn->prepare($query);
    $insercaoStmt->bind_param('sdis', $nome, $preco, $quantidade, $descricao);
    if ($insercaoStmt->execute()) {
        $sucesso = "Produto cadastrado com sucesso!";
        header("Location: index.php"); exit;
    } else {
        $erro = "Erro ao cadastrar o produto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cadastrar novo aparelho</h1>
    <?php if (isset($sucesso)): ?>
        <p style="color: green;"><?= $sucesso; ?></p>
    <?php endif; ?>
    <?php if (isset($erro)): ?>
        <p style="color: red;"><?= $erro; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="hidden" name="method" value="cadastrar" />
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required value="<?php echo $_POST['nome'] ?? ''; ?>"/>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" required step="0.01" value="<?php echo $_POST['preco'] ?? ''; ?>"/>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required><?php echo $_POST['descricao'] ?? ''; ?></textarea>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required value="<?php echo $_POST['quantidade'] ?? ''; ?>" />
        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>