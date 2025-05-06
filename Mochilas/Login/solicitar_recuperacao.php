<?php
include "../conexao.php";
require __DIR__.'/phpmailer/src/PHPMailer.php';
require __DIR__.'/phpmailer/src/SMTP.php';
require __DIR__.'/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mensagem = '';

date_default_timezone_set('UTC');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));

    $stmt = $conn->prepare("SELECT * FROM tblcliente WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));
        // echo "DEBUG - Expira: $expira <br>" para testar bugs :p ; 

        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expira)");
        $stmt->execute([
            ':email' => $email,
            ':token' => $token,
            ':expira' => $expira
        ]);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'aplicacao715@gmail.com';
            $mail->Password   = 'kxbm kibr yxaa dpxk'; // senha de app (não é a senha do gmail)
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('aplicacao715@gmail.com', 'GMA Gifts');
            $mail->addAddress($email);

            $link = "http://localhost/Site%20principal/Mochilas/login/resetarsenha.php?token=$token";

            $mail->isHTML(true);
            $mail->Subject = 'Recuperar Senha';
            $mail->Body    = "
                <h2>Olá!</h2>
                <p>Para redefinir sua senha, clique no link abaixo:</p>
                <a href='$link' style='background-color: blue; padding: 6px 8px; color: white; font-weight: bold;'>Recuperar Senha</a>
                <p><small>Este link expira em 1 hora.</small></p>
            ";

            $mail->send();
            $mensagem = "Um link de recuperação foi enviado para seu e-mail.";
        } catch (Exception $e) {
            $mensagem = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
        }
    } else {
        $mensagem = "E-mail não encontrado.";
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
    }
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="email"] {
        width: 600px;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    input[type="submit"] {
        background-color:rgb(27, 48, 141);
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
<body>
<form method="post">
    Digite seu e-mail: <br />
    <input type="email" name="email" required> <br /><br /><br /><br />
    <input type="submit" value="Recuperar senha"><br />
    <p>Voltar para a página inicial? <a href="../mochilas.php">Página Inicial</a></p>
</form>
<p><?= htmlspecialchars($mensagem) ?></p>
</body>
</html>
