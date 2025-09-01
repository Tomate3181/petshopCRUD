<?php
session_start();
include "../connection/connection.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: i.php");
    exit();
}


if (isset($_POST['add'])) {
    $tipo = $_POST['animal_tipo'];
    $nome = $_POST['animal_nome'];
    $raca = $_POST['animal_raca'];
    $cpf = $_POST['fk_cliente_cpf'];

    $stmt = $conn->prepare("INSERT INTO animal (animal_tipo, animal_nome, animal_raca, fk_cliente_cpf) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $tipo, $nome, $raca, $cpf);
    $stmt->execute();
    $stmt->close();
    header("Location: animal.php");
    exit();
}


if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM animal WHERE animal_cod = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: animal.php");
    exit();
}


if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $nome = $_POST['animal_nome'];
    $raca = $_POST['animal_raca'];
    $stmt = $conn->prepare("UPDATE animal SET animal_nome=?, animal_raca=? WHERE animal_cod=?");
    $stmt->bind_param("ssi", $nome, $raca, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: animal.php");
    exit();
}


$query = "SELECT a.animal_cod, a.animal_nome, a.animal_raca, c.cliente_nome FROM animal a LEFT JOIN cliente c ON a.fk_cliente_cpf = c.cliente_cpf ORDER BY a.animal_nome ASC";
$result = $conn->query($query);


$clientes = $conn->query("SELECT cliente_cpf, cliente_nome FROM cliente ORDER BY cliente_nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais - Petshop Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/table.css">
</head>

<body>
    <div class="main-content">
        <a href="../home.php" class="modal-btn" style="margin-bottom: 20px;"><i class="fas fa-home"></i> Voltar para Home</a>
        <h1>Animais Cadastrados</h1>

        <button class="modal-btn" id="openModal"><i class="fas fa-plus"></i> Cadastrar Animal</button>

        <table>
            <tr>
                <th>Nome</th>
                <th>Raça</th>
                <th>Dono</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <form method="POST" action="animal.php">
                        <td><input type="text" name="animal_nome" value="<?= htmlspecialchars($row['animal_nome']) ?>"
                                required></td>
                        <td><input type="text" name="animal_raca" value="<?= htmlspecialchars($row['animal_raca']) ?>"
                                required></td>
                        <td><?= htmlspecialchars($row['cliente_nome']) ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?= $row['animal_cod'] ?>">
                            <button type="submit" name="update" class="edit-btn"><i class="fas fa-edit"></i></button>
                            <a href="animal.php?delete=<?= $row['animal_cod'] ?>" class="delete-btn"
                                onclick="return confirm('Deseja realmente excluir este animal?');"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Cadastrar Animal</h2>
            <form method="POST" action="animal.php">
                <label>Tipo:</label><br>
                <input type="text" name="animal_tipo" required><br><br>
                <label>Nome:</label><br>
                <input type="text" name="animal_nome" required><br><br>
                <label>Raça:</label><br>
                <input type="text" name="animal_raca" required><br><br>
                <label>Dono:</label><br>
                <select name="fk_cliente_cpf" required>
                    <option value="">Selecione</option>
                    <?php while ($c = $clientes->fetch_assoc()): ?>
                        <option value="<?= $c['cliente_cpf'] ?>"><?= htmlspecialchars($c['cliente_nome']) ?></option>
                    <?php endwhile; ?>
                </select><br><br>
                <button type="submit" name="add" class="modal-btn">Cadastrar</button>
            </form>
        </div>
    </div>

    <script>

        document.getElementById("openModal").onclick = function () {
            document.getElementById("modal").style.display = "block";
        }

        document.getElementById("closeModal").onclick = function () {
            document.getElementById("modal").style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById("modal")) {
                document.getElementById("modal").style.display = "none";
            }
        }
    </script>
</body>

</html>