<?php
namespace Decorators;

class SubsidioSeguro extends CustoDecorator {
    public function calculate(): float {
        // primeiro aplica subsídio (20% off), depois taxa de 200
        return ($this->base->calculate() * 0.8) + 200;
    }
}
