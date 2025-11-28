<?php
namespace Decorators;

class Seguro extends CustoDecorator {
    public function calculate(): float {
        return $this->base->calculate() + 200;
    }
}
