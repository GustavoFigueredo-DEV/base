<?php include '../app/config/auth.php';

if (estaLogado()) {
    header('Location: ../aparelhos/index.php');
    exit;
}

$erro = false;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user = trim ($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    if (login($USUARIO, $user, $email, $senha)) {
        header("Location: ../aparelhos/index.php");
        exit;
    }
    $erro = true;
}

?>

<!DOCTYPE html> 
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="loginFormContainer">

            <form method="post" class="loginForm">
                <div class="loginLogo">
                    <img src="" alt="">
                    <h1>Login</h1>
                </div>
                <div class="campo">
                    <label for="">Nome</label>
                    <input type="text" name="nome">
                </div>

                <div class="campo">
                    <label for="">Email</label>
                    <input type="email" name="email">
                </div>

                <div class="campo">
                    <label for="">Senha</label>
                    <input type="password" name="senha">
                </div>
                <button type="submit">Entrar</button>
            </form>
        </div>
        <?php if ($erro): ?>
            <p>Email ou senha invalidos</p>
        <?php endif; ?>
    </div>
</body>

</html>