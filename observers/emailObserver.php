<?php
namespace Observers;

require_once __DIR__ . "/observer.php";

class EmailObserver implements Observer
{
    public function update(string $tipo, $payload): void
    {
        echo "[EMAIL] Tipo: {$tipo} | Dados: " . json_encode($payload) . "\n";
    }
}

