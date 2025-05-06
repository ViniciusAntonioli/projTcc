<?php
include "../conexao.php";

$token = $_GET['token'] ?? '';
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novaSenha = htmlspecialchars(trim($_POST['nova_senha']));
    $confirmSenha = htmlspecialchars(trim($_POST['confirma_senha']));
    $token = htmlspecialchars(trim($_POST['token']));

    if ($novaSenha === $confirmSenha) {
        $sql = "SELECT email FROM password_resets WHERE token = :token AND expires_at > GETUTCDATE()";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       // echo "DEBUG - Token: $token <br>";
       // echo $stmt->rowCount();
        if ($row) {
            $email = $row['email'];
            //echo "DEBUG - Token 2: $token <br>";

            $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

            $sqlUpdate = "UPDATE tblcliente SET senha = :senha WHERE email = :email";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->execute([
                ':senha' => $senhaCriptografada,
                ':email' => $email
            ]);

            // Remove o token
            $conn->prepare("DELETE FROM password_resets WHERE token = :token")
                 ->execute([':token' => $token]);

            $msg = "Senha redefinida com sucesso!";
            sleep(5);
            header('Location: login.php');
            exit;

        } else {
            $msg = "Token inválido ou expirado.";
        }
    } else {
        $msg = "As senhas não coincidem.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
        align-items: center;
        height: 100vh;
    }
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 1200px;
        width: 600px;
        margin: auto;
    }
    input[type="password"] {
        width: 400px;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    input[type="submit"] {
        background-color: rgb(27, 48, 141);
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<body>
<form method="POST">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    Nova senha:<br> <input type="password" name="nova_senha" required><br><br>
    Confirmar senha:<br> <input type="password" name="confirma_senha" required><br><br>
    <input type="submit" value="Redefinir senha">
    <p>Página de login <a href='login.php'>Página Inicial</a></p>
</form>

<p align="center"><?= htmlspecialchars($msg) ?></p>
</body>
</html>
