<?php
session_start();
include "../connection/connection.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: i.php");
    exit();
}

// Cadastro de cliente via modal
if (isset($_POST['add'])) {
    $cpf = $_POST['cliente_cpf'];
    $nome = $_POST['cliente_nome'];
    $endereco = $_POST['cliente_endereco'];

    $stmt = $conn->prepare("INSERT INTO cliente (cliente_cpf, cliente_nome, cliente_endereco) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $cpf, $nome, $endereco);
    $stmt->execute();
    $stmt->close();
    header("Location: cliente.php");
    exit();
}

// Exclusão de cliente
if (isset($_GET['delete'])) {
    $cpf = $_GET['delete'];

    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM animal WHERE fk_cliente_cpf = ?");
    $stmt_check->bind_param("s", $cpf);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        echo "<script>alert('Não é possível excluir este cliente, pois possui animais cadastrados.');</script>";
    } else {
        $stmt = $conn->prepare("DELETE FROM cliente WHERE cliente_cpf = ?");
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $stmt->close();
        header("Location: cliente.php");
        exit();
    }
}

// Atualização de cliente
if (isset($_POST['update'])) {
    $cpf = $_POST['cpf'];
    $nome = $_POST['cliente_nome'];
    $endereco = $_POST['cliente_endereco'];

    $stmt = $conn->prepare("UPDATE cliente SET cliente_nome=?, cliente_endereco=? WHERE cliente_cpf=?");
    $stmt->bind_param("sss", $nome, $endereco, $cpf);
    $stmt->execute();
    $stmt->close();
    header("Location: cliente.php");
    exit();
}

// Listagem de clientes
$query = "SELECT cliente_cpf, cliente_nome, cliente_endereco FROM cliente ORDER BY cliente_nome ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Petshop Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/table.css">
</head>

<body>
    <div class="main-content">
        <a href="../home.php" class="modal-btn" style="margin-bottom: 20px;"><i class="fas fa-home"></i> Voltar para
            Home</a>
        <h1>Clientes Cadastrados</h1>

        <button class="modal-btn" id="openModalCliente"><i class="fas fa-plus"></i> Cadastrar Cliente</button>

        <table>
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <form method="POST" action="cliente.php">
                        <td><input type="text" name="cliente_nome" value="<?= htmlspecialchars($row['cliente_nome']) ?>"
                                required></td>
                        <td><input type="text" name="cliente_endereco"
                                value="<?= htmlspecialchars($row['cliente_endereco']) ?>" required></td>
                        <td>
                            <input type="hidden" name="cpf" value="<?= $row['cliente_cpf'] ?>">
                            <button type="submit" name="update" class="edit-btn"><i class="fas fa-edit"></i></button>
                            <a href="cliente.php?delete=<?= $row['cliente_cpf'] ?>" class="delete-btn"
                                onclick="return confirm('Deseja realmente excluir este cliente?');"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div id="modalCliente" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalCliente">&times;</span>
            <h2>Cadastrar Cliente</h2>
            <form method="POST" action="cliente.php">
                <label>CPF:</label><br>
                <input type="text" name="cliente_cpf" maxlength="11" required><br><br>
                <label>Nome:</label><br>
                <input type="text" name="cliente_nome" required><br><br>
                <label>Endereço:</label><br>
                <input type="text" name="cliente_endereco" required><br><br>
                <button type="submit" name="add" class="modal-btn">Cadastrar</button>
            </form>
        </div>
    </div>

    <script>
        const openModalCliente = document.getElementById("openModalCliente");
        const closeModalCliente = document.getElementById("closeModalCliente");
        const modalCliente = document.getElementById("modalCliente");

        openModalCliente.onclick = () => modalCliente.style.display = "block";
        closeModalCliente.onclick = () => modalCliente.style.display = "none";

        window.onclick = (event) => { if (event.target == modalCliente) modalCliente.style.display = "none"; }
    </script>
</body>

</html>