<?php
namespace Domain;

require_once __DIR__ . '/../decorators/custo_calculavel.php';

use Strategies\CustoStrategy;
use Decorators\CustoCalculavel;

class Crop implements CustoCalculavel {

    private $name;
    private $area;
    private $costStrategy;

    // === SUPORTE PARA OBSERVER ===
    private $observers = [];

    public function __construct(string $name, float $area) {
        $this->name = $name;
        $this->area = $area;
    }

    // ==== MÉTODOS DO OBSERVER ====

    public function attach($observer) {
        $this->observers[] = $observer;
    }

    public function detach($observer) {
        $this->observers = array_filter(
            $this->observers,
            fn($obs) => $obs !== $observer
        );
    }

    private function notifyObservers($message) {
        foreach ($this->observers as $obs) {
            $obs->update($message);
        }
    }

    // ==== GETTERS ====

    public function getName(): string {
        return $this->name;
    }

    public function getArea(): float {
        return $this->area;
    }

    // ==== STRATEGY ====

    public function setCostStrategy(CustoStrategy $strategy) {
        $this->costStrategy = $strategy;
    }

    public function calculate(): float {
        if (!$this->costStrategy) {
            throw new \Exception("Strategy não definida!");
        }

        $resultado = $this->costStrategy->calculate($this);

        // dispara eventos do Observer
        $this->notifyObservers("Cálculo finalizado para {$this->name}: R$ {$resultado}");

        return $resultado;
    }

    public function calculateCost(): float {
        return $this->calculate();
    }
}
