<?php
namespace Strategies;

use Domain\Crop;

class CustoOrganico implements CustoStrategy {
    public function calculate(Crop $crop): float {
        return $crop->getArea() * 1500;
    }
}
