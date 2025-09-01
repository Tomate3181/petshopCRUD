<?php
session_start();

include "./connection/connection.php";

if (isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit();
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    if ($senha === "admin") {
        $_SESSION['usuario'] = $usuario;
        header("Location: home.php");
        exit();
    } else {
        $erro = "Senha incorreta! Por favor, tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Petshop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./Css/login.css">
</head>

<body>
    <div class="decoration" style="--rotation: 20deg; --duration: 6s; --offset-x: 15px; --offset-y: -10px;">🐾</div>
    <div class="decoration" style="--rotation: -30deg; --duration: 7s; --offset-x: -18px; --offset-y: 12px;">🦴</div>
    <div class="decoration" style="--rotation: 10deg; --duration: 6.5s; --offset-x: 10px; --offset-y: -15px;">🐾</div>
    <div class="decoration" style="--rotation: 45deg; --duration: 8s; --offset-x: 20px; --offset-y: -8px;">🦴</div>
    <div class="decoration" style="--rotation: -15deg; --duration: 5.5s; --offset-x: -12px; --offset-y: 10px;">🐾</div>
    <div class="decoration" style="--rotation: 30deg; --duration: 6.8s; --offset-x: 17px; --offset-y: -7px;">🐕</div>
    <div class="decoration" style="--rotation: -25deg; --duration: 7.2s; --offset-x: -14px; --offset-y: 9px;">🐶</div>
    <div class="decoration" style="--rotation: 15deg; --duration: 6.3s; --offset-x: 13px; --offset-y: -11px;">🐾</div>
    <div class="decoration" style="--rotation: -40deg; --duration: 8.1s; --offset-x: -19px; --offset-y: 6px;">🦴</div>
    <div class="decoration" style="--rotation: 5deg; --duration: 7.5s; --offset-x: 11px; --offset-y: -13px;">🐕‍🦺</div>

    <div class="login-box">
        <h2>Login Petshop</h2>
        <form method="POST" action="">
            <div class="input-group">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="usuario" placeholder="Usuário" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit">Entrar</button>
            <?php if ($erro): ?>
                <p class="error"><?= $erro ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>