<?php
namespace Domain;

require_once __DIR__ . '/../decorators/custo_calculavel.php'; // inclui a interface

use Strategies\CustoStrategy;
use Decorators\CustoCalculavel; // agora PHP sabe onde está a interface


class Crop implements CustoCalculavel {
    private $name;
    private $area; // hectares
    private $costStrategy;

    public function __construct(string $name, float $area) {
        $this->name = $name;
        $this->area = $area;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getArea(): float {
        return $this->area;
    }

    public function setCostStrategy(CustoStrategy $strategy) {
        $this->costStrategy = $strategy;
    }

    // Novo método para os decorators
    public function calculate(): float {
        if (!$this->costStrategy) {
            throw new \Exception("Strategy não definida!");
        }
        return $this->costStrategy->calculate($this);
    }

    // Mantido para uso direto
    public function calculateCost(): float {
        return $this->calculate();
    }
}
