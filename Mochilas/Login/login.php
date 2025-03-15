<?php
include "../conexao.php";
session_start(); // Inicia a sessão antes de qualquer saída

if (isset($_SESSION['user_id'])) {
    // Se já estiver logado, redireciona para a página inicial
    session_destroy();
    header('Location: ../mochilas.php');

    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);

    if (!empty($user) && !empty($pass)) {
        $sql = "SELECT id_cliente, nome_empresa, senha FROM tblcliente WHERE nome_empresa = :user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario['nome_empresa'] == $user && $usuario['senha'] == $pass) {
            
            $_SESSION['user_id'] = $usuario['id_cliente'];
            $_SESSION['name_user'] = $usuario['nome_empresa'];
            header('Location: ../mochilas.php');
            exit();
        } else {
            echo "<script>alert('Usuário ou senha incorretos!');</script>";
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Página de Login</title>
</head>
<body>
    <div class="main">
        <div class="container">
            <h1>Login</h1>
            <form method="post" action="login.php">
                Usuário: <input type="text" name="user" required /> <br /><br />
                Senha: <input type="password" name="pass" required /> <br /><br />
                <input type="submit" value="Entrar" />
            </form>
        </div>
    </div>
</body>
</html>