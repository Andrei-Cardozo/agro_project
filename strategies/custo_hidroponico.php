<?php
namespace Strategies;

use Domain\Crop;

class CustoHidroponico implements CustoStrategy {
    public function calculate(Crop $crop): float {
        return $crop->getArea() * 2000;
    }
}
