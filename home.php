<?php
session_start();

include "./connection/connection.php";

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Petshop</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./Css/home.css">]
</head>

<body>

    <div class="sidebar">
        <div class="logo">
            <h2>Petshop Admin</h2>
        </div>
        <div class="decoration" style="--rotation: 20deg; --duration: 6s; --offset-x: 15px; --offset-y: -10px;">🐾</div>
        <div class="decoration" style="--rotation: -30deg; --duration: 7s; --offset-x: -18px; --offset-y: 12px;">🦴
        </div>
        <div class="decoration" style="--rotation: 10deg; --duration: 6.5s; --offset-x: 10px; --offset-y: -15px;">🐾
        </div>
        <div class="decoration" style="--rotation: 45deg; --duration: 8s; --offset-x: 20px; --offset-y: -8px;">🦴</div>
        <div class="decoration" style="--rotation: -15deg; --duration: 5.5s; --offset-x: -12px; --offset-y: 10px;">🐾
        </div>
        <div class="decoration" style="--rotation: 30deg; --duration: 6.8s; --offset-x: 17px; --offset-y: -7px;">🐕
        </div>
        <div class="decoration" style="--rotation: -25deg; --duration: 7.2s; --offset-x: -14px; --offset-y: 9px;">🐶
        </div>
        <div class="decoration" style="--rotation: 15deg; --duration: 6.3s; --offset-x: 13px; --offset-y: -11px;">🐾
        </div>
        <div class="decoration" style="--rotation: -40deg; --duration: 8.1s; --offset-x: -19px; --offset-y: 6px;">🦴
        </div>
        <div class="decoration" style="--rotation: 5deg; --duration: 7.5s; --offset-x: 11px; --offset-y: -13px;">🐕‍🦺
        </div>
        <nav>
            <ul>
                <li><a href="./Cliente/cliente.php"><i class="fas fa-users"></i> Clientes</a></li>
                <li><a href="./Animal/animal.php"><i class="fas fa-paw"></i> Animais</a></li>
                <li><a href="./Agendamento/agendamento.php"><i class="fas fa-calendar-alt"></i> Agendamentos</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <header>
            <h1>Bem-vindo, ADM <span style="color: var(--primary-color);"><?= htmlspecialchars($usuario) ?></span></h1>
            <a href="home.php?logout=1" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Sair
            </a>
        </header>

        <div class="content-area">
            <p>Vai ter, hum coisas... aqui</p>
        </div>

        <footer>
            © <?= date('Y') ?> Petshop - Sistema de Administração. Todos os direitos reservados.
        </footer>
    </div>

</body>

</html>