<?php
namespace Strategies;

use Domain\Crop;

interface CustoStrategy {
    public function calculate(Crop $crop): float;
}
