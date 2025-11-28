<?php
// index.php — Tela de apresentação do trabalho
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Agrícola - Menu Inicial</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f3f3f3;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
            text-align: center;
        }

        h1 {
            margin-top: 0;
            font-size: 26px;
            color: #2a7a25;
        }

        p {
            color: #444;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            background: #2e8b57;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn:hover {
            background: #267147;
        }

        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🌱 Sistema de Produção Agrícola</h1>
    <p>Selecione uma das opções abaixo para visualizar as funcionalidades do projeto.</p>

    <a class="btn" href="app/main_interativo.php">▶ Executar Sistema Principal</a>
    <a class="btn" href="app/main.php">▶ Executar Teste Pré-definido</a>
    <a class="btn" href="tests/test_all.php">🧪 Teste Completo (Todos os Padrões)</a>
    <a class="btn" href="tests/observer_test.php">🔔 Teste do Observer</a>

    <div class="footer">
        Desenvolvido por <b>Andrei Cardozo</b> • 2025<br>
        Sistemas de Informação – UNIDAVI
    </div>
</div>

</body>
</html>
