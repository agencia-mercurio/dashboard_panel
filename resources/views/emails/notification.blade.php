<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <title>E-mail de Contato</title>
</head>
<body style="font-family: 'Inter', sans-serif; background: #f5f5f5;height: auto;display: grid;">
    <div style="background: #fff; padding: 1.5rem; margin: 1rem 2rem 2rem 2rem; border-radius: 10px; box-shadow: 1px 1px 5px rgba(0, 0, 0, .2);">
        <h2 style="margin: 0;">Olá!</h2>
        <p style="margin-top: 1rem;">Você recebeu uma nova mensagem de contato:</p>
        <ul style="margin-bottom: 1rem;">
            <li><strong>Nome:</strong> {{ $data['name'] }}</li>
            <li><strong>Telefone:</strong> {{ $data['phone'] }}</li>
            <li><strong>E-mail:</strong> {{ $data['email'] }}</li>
        </ul>
        <p style="margin-bottom: 1rem;"><strong>Mensagem:</strong></p>
        <p style="margin-bottom: 1rem;">{{ $data['message'] }}</p>
    </div>
    <div style="display: grid; margin-top: 1rem; row-gap: 1rem; justify-content: center;">
        <img src="https://siopifacil.com.br/logo.png" alt="Mercúro Marketing" style="margin:auto; max-width: 100%; height: auto;height: 40px;">
        <div style="padding: 1rem;font-size: 10px; color: rgba(0, 0, 0, .6); text-transform: uppercase; text-align: center;">{{ $data['now'] }}</div>
    </div>
</body>
</html>