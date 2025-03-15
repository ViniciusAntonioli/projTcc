<?php
header('Content-Type: application/json'); // Define o cabeçalho para JSON

// Verifica se o formulário foi enviado via POST
if ($_POST) {
    // Sanitiza e valida o e-mail
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // E-mail válido, envia uma resposta de sucesso
        $response = [
            'status' => 'success',
            'message' => "Obrigado por se inscrever com o e-mail: " . htmlspecialchars($email) . "!"
        ];

        // Aqui você pode adicionar lógica para armazenar o e-mail em um banco de dados ou arquivo

        // (Opcional) Log do e-mail para rastreamento
        // file_put_contents('newsletter_log.txt', "$email\n", FILE_APPEND);
    } else {
        // Mensagem de erro para e-mail inválido
        $response = [
            'status' => 'error',
            'message' => "E-mail inválido. Por favor, tente novamente."
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => "Método de envio inválido."
    ];
}

echo json_encode($response); // Retorna a resposta em JSON
?>