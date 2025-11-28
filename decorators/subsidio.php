<?php
namespace Decorators;

class Subsidio extends CustoDecorator {
    public function calculate(): float {
        return $this->base->calculate() * 0.9; // 10% desconto
    }
}

