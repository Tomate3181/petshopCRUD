<?php
session_start();

include "./conexao.php";

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
            <h2>Helvetic PET</h2>
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
            <h1>Bem-vindo</h1>
        </header>

        <footer>
            © <?= date('Y') ?> Petshop - Sistema de Administração. Todos os direitos reservados.
        </footer>
    </div>

</body>

</html>