<?php
require_once __DIR__ . '/../autoload.php';

use Factory\CropFactory;
use Strategies\CustoPadrao;
use Strategies\CustoOrganico;
use Strategies\CustoHidroponico;
use Decorators\Subsidio;
use Decorators\Seguro;

// ---------- PROCESSAMENTO ----------
$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["cultura"] ?? null;
    $area = (float)($_POST["area"] ?? 0);
    $estrategia = $_POST["estrategia"] ?? null;
    $beneficio = $_POST["beneficio"] ?? null;

    // Criar objeto base
    $crop = CropFactory::createCrop($nome, $area);

    // Strategy
    $strategies = [
        "padrao" => new CustoPadrao(),
        "organico" => new CustoOrganico(),
        "hidro" => new CustoHidroponico()
    ];

    $crop->setCostStrategy($strategies[$estrategia]);

    // Decorators
    $final = $crop;
    if ($beneficio === "subsidio") $final = new Subsidio($final);
    if ($beneficio === "seguro") $final = new Seguro($final);
    if ($beneficio === "ambos") $final = new Seguro(new Subsidio($final));

    $resultado = $final->calculate();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Agrícola – Modo Visual</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f5f7;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 520px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.08);
        }
        h2 {
            margin-top: 0;
            text-align: center;
            color: #1d76d2;
        }
        label { font-weight: bold; margin-top: 12px; display: block; }
        select, input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        button {
            width: 100%;
            margin-top: 18px;
            padding: 12px;
            background: #1d76d2;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: .25s;
        }
        button:hover {
            background: #145ea8;
        }
        .resultado {
            margin-top: 25px;
            padding: 20px;
            border-radius: 10px;
            background: #e8f4ff;
            border-left: 5px solid #1d76d2;
        }
        .voltar {
            text-align: center;
            display: block;
            margin-top: 25px;
            color: #1d76d2;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Sistema Agrícola – Cálculo de Custo</h2>

    <form method="POST">

        <label>Cultura</label>
        <select name="cultura" required>
            <option value="Milho">Milho</option>
            <option value="Soja">Soja</option>
            <option value="Alface">Alface</option>
        </select>

        <label>Área Plantada (ha)</label>
        <input type="number" step="0.1" name="area" required>

        <label>Estratégia de custo</label>
        <select name="estrategia" required>
            <option value="padrao">Padrão</option>
            <option value="organico">Orgânico</option>
            <option value="hidro">Hidroponico</option>
        </select>

        <label>Benefícios</label>
        <select name="beneficio" required>
            <option value="nenhum">Nenhum</option>
            <option value="subsidio">Subsídio</option>
            <option value="seguro">Seguro</option>
            <option value="ambos">Subsídio + Seguro</option>
        </select>

        <button type="submit">Calcular</button>
    </form>

    <?php if ($resultado !== null): ?>
        <div class="resultado">
            <h3>Resultado</h3>
            <p><strong>Custo final:</strong>  
                R$ <?= number_format($resultado, 2, ',', '.') ?>
            </p>
        </div>
    <?php endif; ?>

    <a href="../index.php" class="voltar">⬅ Voltar ao Início</a>

</div>

</body>
</html>
