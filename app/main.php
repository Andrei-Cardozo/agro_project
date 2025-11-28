<?php
require_once __DIR__ . '/../autoload.php';

use Domain\Crop;
use Strategies\CustoPadrao;
use Strategies\CustoOrganico;
use Strategies\CustoHidroponico;
use Decorators\Subsidio;
use Decorators\Seguro;
use Factory\CropFactory;
use Infra\Logger;

// ===== CABEÇALHO =====
echo "\n============================================\n<br>";
echo "        SISTEMA DE PRODUÇÃO AGRÍCOLA        \n<br>";
echo "============================================\n<br>";
echo "Desenvolvido por: Andrei Cardozo\n<br>";
echo "E-mail: andrei.cardozo@unidavi.edu.br\<br>\n";
echo "--------------------------------------------\n<br>";

// Logger Singleton
$logger = Logger::getInstance();

// Criar crop via factory
$milho = CropFactory::createCrop("Milho", 10);

// ===== TESTE: STRATEGY =====
echo "\n>>> TESTE: Strategy (Cálculo de custos)\n<br>";

$milho->setCostStrategy(new CustoPadrao());
$logger->log("Milho com custo padrão: " . $milho->calculateCost());

$milho->setCostStrategy(new CustoOrganico());
$logger->log("Milho com custo orgânico: " . $milho->calculateCost());

// ===== TESTE: DECORATOR =====
echo "\n>>> TESTE: Decorator (Custos adicionais)\n";
$decorado = new Seguro(new Subsidio($milho));
$logger->log("Milho com subsídio + seguro: " . $decorado->calculate());

// ===== LINKS PARA TESTES =====
echo "<br>\n--------------------------------------------\n<br>";
echo " Testes disponíveis:\n<br>";
echo " 1) Teste geral (todos os padrões):\n<br>";
echo "      http://localhost/agroproject/tests/test_all.php\n\n<br>";
echo " 2) Teste do Observer:\n<br>";
echo "      http://localhost/agroproject/tests/observer_test.php\n<br>";
echo "--------------------------------------------\n<br>";

echo "\nExecução finalizada.\n\n<br>";

?>
<br><br>
<a href="../index.php" 
   style="
      display:inline-block;
      padding:12px 22px;
      background:#1d76d2;
      color:#fff;
      text-decoration:none;
      border-radius:8px;
      font-weight:600;
      transition:0.25s;
      font-family:Arial,sans-serif;
   "
   onmouseover="this.style.background='#145ea8'"
   onmouseout="this.style.background='#1d76d2'"
>
   ⬅ Voltar ao Início
</a>
