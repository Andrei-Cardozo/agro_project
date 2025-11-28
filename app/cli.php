<?php
require_once __DIR__ . '/../autoload.php';

use Factory\CropFactory;
use Strategies\CustoPadrao;
use Strategies\CustoOrganico;
use Strategies\CustoHidroponico;
use Decorators\Subsidio;
use Decorators\Seguro;
use Decorators\SubsidioSeguro;
use Observers\EmailObserver;
use Observers\Notifier;


function lerInput(string $prompt): string {
    echo $prompt;
    return trim(fgets(STDIN));
}

function escolherOpcao(array $opcoes, string $prompt): string {
    do {
        echo $prompt . "\n";
        foreach ($opcoes as $key => $valor) {
            echo "  [$key] $valor\n";
        }
        $input = trim(fgets(STDIN));
        if (array_key_exists($input, $opcoes)) {
            return $opcoes[$input];
        }
        echo "Opção inválida! Tente novamente.\n";
    } while (true);
}

echo "=====================================\n";
echo "      SISTEMA DE CULTIVOS - CLI\n";
echo "      Desenvolvido por Andrei Cardozo\n";
echo "=====================================\n\n";

// Configurar Notifier/Observer
$registrarEmail = strtolower(lerInput("Deseja receber notificações por email? (s/n): "));
$notifier = new Notifier();
if ($registrarEmail === 's') {
    $email = lerInput("Informe seu email: ");
    $emailObserver = new EmailObserver($email);
    $notifier->registrar($emailObserver);
}

$culturasCriadas = [];

do {
    // Escolher cultura
    $tipos = ['1' => 'Milho', '2' => 'Soja', '3' => 'Alface'];
    $tipoEscolhido = escolherOpcao($tipos, "Escolha a cultura:");

    // Área plantada
    do {
        $area = lerInput("Informe a área plantada (em hectares): ");
        if (is_numeric($area) && $area > 0) break;
        echo "Área inválida! Digite um número positivo.\n";
    } while (true);

    // Criar crop via factory
    $crop = CropFactory::createCrop($tipoEscolhido, (float)$area);

    // Escolher Strategy
    $strategies = ['1' => 'Padrão', '2' => 'Orgânico', '3' => 'Hidroponico'];
    $strategyEscolhida = escolherOpcao($strategies, "Escolha a estratégia de custo:");

    switch ($strategyEscolhida) {
        case 'Padrão':
            $crop->setCostStrategy(new CustoPadrao());
            break;
        case 'Orgânico':
            $crop->setCostStrategy(new CustoOrganico());
            break;
        case 'Hidroponico':
            $crop->setCostStrategy(new CustoHidroponico());
            break;
    }

    // Aplicar Decorators
    $decorators = ['1' => 'Nenhum', '2' => 'Subsidio', '3' => 'Seguro', '4' => 'Subsidio + Seguro'];
    $decorEscolhido = escolherOpcao($decorators, "Deseja aplicar algum benefício:");

    $decorado = $crop;
    switch ($decorEscolhido) {
        case 'Subsidio':
            $decorado = new Subsidio($crop);
            break;
        case 'Seguro':
            $decorado = new Seguro($crop);
            break;
        case 'Subsidio + Seguro':
            $decorado = new SubsidioSeguro(new Subsidio($crop));
            break;
    }

    $custoFinal = $decorado->calculate();

    // Notificar observer
    if ($registrarEmail === 's') {
        $notifier->notificar("Custo calculado", ["crop" => $crop->getName(), "custo" => $custoFinal]);
    }

    echo "\n=====================================\n";
    echo "Cultura criada com sucesso!\n";
    echo "-------------------------------------\n";
    echo "Nome: " . $crop->getName() . "\n";
    echo "Área: " . $crop->getArea() . " ha\n";
    echo "Custo estimado: R$ " . number_format($custoFinal, 2, ',', '.') . "\n";
    echo "=====================================\n\n";

    $culturasCriadas[] = [
        'nome' => $crop->getName(),
        'area' => $crop->getArea(),
        'custo' => $custoFinal
    ];

    $continuar = strtolower(lerInput("Deseja adicionar outra cultura? (s/n): "));
} while ($continuar === 's');

echo "\n=========== RESUMO FINAL ===========\n";
foreach ($culturasCriadas as $c) {
    echo "- " . $c['nome'] . " | Área: " . $c['area'] . " ha | Custo: R$ " . number_format($c['custo'], 2, ',', '.') . "\n";
}
echo "=====================================\n";
echo "Programa finalizado.\n";
