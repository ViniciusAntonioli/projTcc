<?php
include "../conexao.php";
session_start();

// Se já estiver logado, encerra a sessão e redireciona
if (isset($_SESSION['user_id'])) {
    session_destroy();
    header('Location: ../mochilas.php');
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);

    if (!empty($user) && !empty($pass)) {
        $sql = "SELECT id_cliente, nome_empresa, senha, cnpj, telefone FROM tblcliente WHERE nome_empresa = :user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($usuario && password_verify($pass, $usuario['senha'])) {
            $_SESSION['user_id'] = $usuario['id_cliente'];
            $_SESSION['name_user'] = $usuario['nome_empresa'];
            $_SESSION['cnpj'] = $usuario['cnpj'];
            $_SESSION['telefone'] = $usuario['telefone'];
            
            header('Location: ../mochilas.php');
            exit();
        } else {
            $error = 'Usuário ou senha incorretos.';
        }
    } else {
        $error = 'Preencha todos os campos!';
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
                <p>Esqueceu a senha? <a href="solicitar_recuperacao.php">Recuperar Senha</a></p>
                <p>Não tem uma conta? <a href="contactus.html">Contate-nos</a></p>
                <?php if (!empty($error)): ?>
                    <p id="wrong" style="color:red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <input style="
                width: 100%;
    height: 40px;
    background-color: rgb(78, 78, 216);
    color: #ffffff;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;" type="submit" value="Entrar" /> <br /><br /><br /><br /><br />
                <p>Voltar para a página inicial? <a href="../mochilas.php">Página Inicial</a></p>
            </form>
        </div>
    </div>
</body>
</html>