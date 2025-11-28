<?php
namespace Strategies;

use Domain\Crop;

class CustoPadrao implements CustoStrategy {
    public function calculate(Crop $crop): float {
        return $crop->getArea() * 1000;
    }
}
