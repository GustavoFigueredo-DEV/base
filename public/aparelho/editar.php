<?php
include "../app/config/conexao.php";

$ok =  null;
$erro = null;
$p = null;

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $s = $conn->prepare("Select nome, descricao, preco, quantidade from PRODUTOS where id =? ");
    $s->bind_param("i", $id);
    $s->execute();
    $p = $s->get_result()->fetch_assoc() ?: null;
    $s->close();
}

if ($p && ($_SERVER['REQUEST_METHOD']) === "POST") {
    if (isset($_POST['salvar'])) {
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $preco = trim($_POST['preco'] ?? '');
        $quantidade = trim($_POST['quantidade'] ?? '');
        if($nome === '' || $descricao === '' || $preco === '' || $quantidade === '' ){
            $erro = "Preencha os campos necessários";
        }else{
            $preco = (float)$preco;
            $quantidade = (int)$quantidade;

            $s = $conn->prepare("UPDATE PRODUTOS SET nome=?, descricao=?, preco=?, quantidade=? WHERE id=?");
            $s->bind_param("ssdii", $nome, $descricao, $preco, $quantidade, $id);
            $ok = $s->execute() ? "Atualizado com sucesso" : "Erro ao atualizar";
            $s->close();
            $p = ['nome' => $nome, 'descricao' => $descricao, 'preco' => $preco, 'quantidade' => $quantidade];
            header("Location: index.php");
        }
    }
    if (isset($_POST['excluir']) && !$erro) {
        $s = $conn->prepare("DELETE FROM PRODUTOS WHERE id=?");
        $s->bind_param("i", $id);
        $s->execute();
        if ($s->affected_rows > 0){
            $ok = "Produto excluído.";
            $p = null;
        }else{
            $erro = "Falha ao excluir.";
        }
        $s->close();
        header("Location: index.php");
    }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Editar/Excluir Produto</title>
</head>

<body>

    <h2>Editar/Excluir Produto</h2>

    <!-- Mensagens opcionais (use apenas uma, se quiser) -->
    <?php if (!empty($ok)):?>
        <p><?= $ok ?></p>
    <?php endif; ?>

    <!-- FORM 1: Edição -->
     <?php if($p) : ?>
    <form method="post">
        <label>nome</label>
        <input name="nome" required value="<?= $_POST['nome'] ?? ($p['nome'] ?? '')?>">

        <label>preço</label>
        <input name="preco" type="number" step="0.01" inputmode="decimal" required value="<?= $_POST['preco'] ?? ($p['preco'] ?? '')?>">

        <label>quantidade</label>
        <input name="quantidade" type="number" min="0" required value="<?= $_POST['quantidade'] ?? ($p['quantidade'] ?? '')?>">

        <label>descrição</label>
        <input name="descricao" required value="<?= $_POST['descricao'] ?? ($p['descricao'] ?? '')?>">

        <button name="salvar" value="1">Salvar</button>
        <a href="index.php">Cancelar</a>
    </form>

    <form method="post">
        <button name="excluir" value="1">Excluir</button>
    </form>
    <?php else : ?>
    <p>Produto não encontrado.</p>
    <p><a href="index.php">Voltar</a></p>
<?php endif; ?>
</body>

</html>