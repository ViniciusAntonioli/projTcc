<?php

session_start();

require __DIR__.'/phpmailer/src/PHPMailer.php';
require __DIR__.'/phpmailer/src/SMTP.php';
require __DIR__.'/phpmailer/src/Exception.php';

USE PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome_empresa = filter_input(INPUT_POST, 'nome_empresa', FILTER_SANITIZE_STRING);
    $razao_social = filter_input(INPUT_POST, 'razao_social', FILTER_SANITIZE_STRING);
    $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
    $responsavel = filter_input(INPUT_POST, 'responsavel', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'aplicacao715@gmail.com';
            $mail->Password   = 'kxbm kibr yxaa dpxk'; // senha de app (não é a senha do gmail)
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('aplicacao715@gmail.com', 'Sistema de Cadastro de Empresas'); // E-mail do remetente (pode ser o mesmo do usuário)
            $mail->addAddress('abdelmoghit587@uorak.com'); // Adicione o e-mail do destinatário aqui, no caso o administrador

            $mail->isHTML(true);
            $mail->Subject = 'Novo Cadastro de Empresa';
            $mail->Body = "
                <html lang='pt-BR'>
                <head>
                    <title>Cadastro de Empresa</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            color: #333;
                            padding: 20px;
                        }
                        h2 {
                            color: #007BFF;
                        }
                        p {
                            margin: 5px 0;
                        }
                    </style>
                </head>
                <body>
                    <h2>Cadastro de Empresa</h2>
                    <h3>Olá Admin,</h3>
                    <p>Uma nova empresa se cadastrou no sistema.</p>
                    <p><strong>Nome da Empresa:</strong> $nome_empresa</p>
                    <p><strong>Razão Social:</strong> $razao_social</p>
                    <p><strong>CNPJ:</strong> $cnpj</p>
                    <p><strong>Responsável:</strong> $responsavel</p>
                    <p><strong>E-mail:</strong> $email</p>
                    <p><strong>Telefone:</strong> $telefone</p>
                </body>
            ";
    


} catch (Exception $e) {
        echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
    }

    if($mail->send()){
        echo "E-mail enviado com sucesso!";
    } else {
        echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
    }

}


?>