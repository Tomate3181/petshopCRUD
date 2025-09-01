<?php
session_start();

include "./conexao.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>PetShop | Dashboard</title>
  <link rel="stylesheet" href="Css/home.css">
</head>
<body>
  <div class="navbar">
    <div class="logo">🐾 PetShop</div>
    <nav>
      <ul>
        <li><a href="home.php" class="active">Início</a></li>
        <li><a href="Cliente/cliente.php">Clientes</a></li>
        <li><a href="Animal/animal.php">Animais</a></li>
        <li><a href="Agendamento/agendamento.php">Agendamentos</a></li>
      </ul>
    </nav>
    <button class="logout-btn">Sair</button>
  </div>

  <div class="main-content">
    <header>
      <h1>Bem-vindo ao Painel</h1>
      <p>Gerencie clientes, pets e agendamentos de forma simples e rápida.</p>
    </header>

    <div class="cards">
      <div class="card">
        <h2>Clientes</h2>
        <p>Gerencie todos os tutores cadastrados.</p>
        <a href="Cliente/cliente.php" class="card-btn">Ver clientes</a>
      </div>
      <div class="card">
        <h2>Animais</h2>
        <p>Acompanhe os pets cadastrados no sistema.</p>
        <a href="Animal/animal.php" class="card-btn">Ver animais</a>
      </div>
      <div class="card">
        <h2>Agendamentos</h2>
        <p>Veja e edite os procedimentos agendados.</p>
        <a href="Agendamento/agendamento.php" class="card-btn">Ver agendamentos</a>
      </div>
    </div>

    <section class="welcome">
      <h2>Sobre o sistema</h2>
      <p>Este sistema foi desenvolvido para facilitar a gestão do seu PetShop,
         permitindo visualizar clientes, animais e agendamentos em um só lugar.</p>
    </section>
  </div>

  <footer>
    © 2025 PetShop - Todos os direitos reservados
  </footer>
</body>
</html>
