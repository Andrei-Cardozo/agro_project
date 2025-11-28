<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) require_once $file;
});

// Incluindo todos os arquivos
require_once '../domain/crop.php';
require_once '../strategies/custo_strategy.php';
require_once '../strategies/custo_padrao.php';
require_once '../strategies/custo_organico.php';
require_once '../strategies/custo_hidroponico.php';
require_once '../decorators/custo_calculavel.php';
require_once '../decorators/custo_decorator.php';
require_once '../decorators/subsidio.php';
require_once '../decorators/seguro.php';
require_once '../factory/crop_factory.php';
require_once '../observers/observer.php';
require_once '../observers/emailObserver.php';
require_once '../observers/notifier.php';


// Namespaces conforme seus arquivos
use domain\Crop;
use strategies\CustoPadrao;
use strategies\CustoOrganico;
use strategies\CustoHidroponico;
use decorators\Subsidio;
use decorators\Seguro;
use factory\CropFactory;
use Observers\Notifier;
use Observers\EmailObserver;

// Criar Notifier e adicionar observador
$notifier = new Notifier();
$emailObs = new EmailObserver();
$notifier->registrar($emailObs);


echo "<h2>=== TESTE STRATEGY ===</h2>";

$milho = new Crop("Milho", 10);
$milho->setCostStrategy(new CustoPadrao());
echo "Milho com custo padrão: " . $milho->calculate() . "<br>";

$milho->setCostStrategy(new CustoOrganico());
echo "Milho com custo orgânico: " . $milho->calculate() . "<br>";

$milho->setCostStrategy(new CustoHidroponico());
echo "Milho com custo hidroponico: " . $milho->calculate() . "<br>";

echo "<h2>=== TESTE DECORATOR ===</h2>";

$soja = new Crop("Soja", 5);
$soja->setCostStrategy(new CustoPadrao());

$decorado = new Seguro(new Subsidio($soja));
echo "Soja com subsídio e seguro: " . $decorado->calculate() . "<br>";

$soja_apenas_subsidio = new Subsidio($soja);
echo "Soja apenas com subsídio: " . $soja_apenas_subsidio->calculate() . "<br>";

$soja_apenas_seguro = new Seguro($soja);
echo "Soja apenas com seguro: " . $soja_apenas_seguro->calculate() . "<br>";

echo "<h2>=== TESTE FACTORY METHOD ===</h2>";

$crop1 = CropFactory::createCrop("Milho", 8);
echo $crop1->getName() . " custo via factory: " . $crop1->calculate() . "<br>";

$crop2 = CropFactory::createCrop("Soja", 12);
echo $crop2->getName() . " custo via factory: " . $crop2->calculate() . "<br>";

$crop3 = CropFactory::createCrop("Alface", 3);
echo $crop3->getName() . " custo via factory: " . $crop3->calculate() . "<br>";


echo "<h2>=== TESTE OBSERVER ===</h2>";
// Exemplo: notificar quando o custo do milho é calculado
$milhoCost = $milho->calculate();
$notifier->notificar("Custo calculado", ["crop" => $milho->getName(), "custo" => $milhoCost]);

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
