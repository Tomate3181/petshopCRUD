<?php
session_start();
include "../connection/connection.php";

// Busca clientes e animais para os dropdowns do modal
$clientes = $conn->query("SELECT cliente_cpf, cliente_nome FROM cliente ORDER BY cliente_nome ASC");
$animais = $conn->query("SELECT animal_cod, animal_nome FROM animal ORDER BY animal_nome ASC");

// Cadastro de agendamento via modal
if (isset($_POST['add'])) {
    $procedimento = $_POST['agendamento_procedimento'];
    $data = $_POST['agendamento_data'];
    $cliente = $_POST['fk_cliente_cpf'];
    $animal = $_POST['fk_animal_code'];

    $stmt = $conn->prepare("INSERT INTO agendamento (agendamento_procedimento, agendamento_data, fk_cliente_cpf, fk_animal_code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $procedimento, $data, $cliente, $animal);
    $stmt->execute();
    $stmt->close();
    header("Location: agendamento.php");
    exit();
}

// Exclusão
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM agendamento WHERE agendamento_code = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: agendamento.php");
    exit();
}

// Atualização
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $procedimento = $_POST['agendamento_procedimento'];
    $stmt = $conn->prepare("UPDATE agendamento SET agendamento_procedimento = ? WHERE agendamento_code = ?");
    $stmt->bind_param("si", $procedimento, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: agendamento.php");
    exit();
}

// Listagem de agendamentos
$query = "
SELECT a.agendamento_code, a.agendamento_procedimento, a.agendamento_data, 
       an.animal_nome, c.cliente_nome
FROM agendamento a
LEFT JOIN animal an ON a.fk_animal_code = an.animal_cod
LEFT JOIN cliente c ON a.fk_cliente_cpf = c.cliente_cpf
ORDER BY a.agendamento_data ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Petshop Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/table.css">
</head>

<body>
    <div class="main-content">
        <a href="../home.php" class="modal-btn" style="margin-bottom: 20px;"><i class="fas fa-home"></i> Voltar para
            Home</a>
        <h1>Agendamentos Cadastrados</h1>

        <button class="modal-btn" id="openModalAgendamento"><i class="fas fa-plus"></i> Cadastrar Agendamento</button>

        <table>
            <tr>
                <th>Procedimento</th>
                <th>Data</th>
                <th>Nome do Animal</th>
                <th>Nome do Cliente</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <form method="POST" action="agendamento.php">
                        <td><input type="text" name="agendamento_procedimento"
                                value="<?= htmlspecialchars($row['agendamento_procedimento']) ?>" required></td>
                        <td><?= htmlspecialchars($row['agendamento_data']) ?></td>
                        <td><?= htmlspecialchars($row['animal_nome']) ?></td>
                        <td><?= htmlspecialchars($row['cliente_nome']) ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?= $row['agendamento_code'] ?>">
                            <button type="submit" name="update" class="edit-btn"><i class="fas fa-edit"></i></button>
                            <a href="agendamento.php?delete=<?= $row['agendamento_code'] ?>" class="delete-btn"
                                onclick="return confirm('Deseja realmente excluir este agendamento?');"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div id="modalAgendamento" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalAgendamento">&times;</span>
            <h2>Cadastrar Agendamento</h2>
            <form method="POST" action="agendamento.php">
                <label>Procedimento:</label>
                <input type="text" name="agendamento_procedimento" required><br><br>
                <label>Data:</label>
                <input type="date" name="agendamento_data" required><br><br>
                <label>Cliente:</label>
                <select name="fk_cliente_cpf" required>
                    <option value="">Selecione</option>
                    <?php while ($c = $clientes->fetch_assoc()): ?>
                        <option value="<?= $c['cliente_cpf'] ?>"><?= htmlspecialchars($c['cliente_nome']) ?></option>
                    <?php endwhile; ?>
                </select><br><br>
                <label>Animal:</label>
                <select name="fk_animal_code" required>
                    <option value="">Selecione</option>
                    <?php while ($a = $animais->fetch_assoc()): ?>
                        <option value="<?= $a['animal_cod'] ?>"><?= htmlspecialchars($a['animal_nome']) ?></option>
                    <?php endwhile; ?>
                </select><br><br>
                <button type="submit" name="add" class="modal-btn">Cadastrar</button>
            </form>
        </div>
    </div>

    <script>
        const openModalAgendamento = document.getElementById("openModalAgendamento");
        const closeModalAgendamento = document.getElementById("closeModalAgendamento");
        const modalAgendamento = document.getElementById("modalAgendamento");

        openModalAgendamento.onclick = () => modalAgendamento.style.display = "block";
        closeModalAgendamento.onclick = () => modalAgendamento.style.display = "none";
        window.onclick = (event) => { if (event.target == modalAgendamento) modalAgendamento.style.display = "none"; }
    </script>
</body>

</html>