<?php
namespace Factory;

use Domain\Crop;
use Strategies\CustoPadrao;
use Strategies\CustoOrganico;
use Strategies\CustoHidroponico;

class CropFactory {
    public static function createCrop(string $type, float $area): Crop {
        switch(strtolower($type)) {
            case 'milho':
                $crop = new Crop("Milho", $area);
                $crop->setCostStrategy(new CustoPadrao());
                return $crop;
            case 'soja':
                $crop = new Crop("Soja", $area);
                $crop->setCostStrategy(new CustoOrganico());
                return $crop;
            case 'alface':
                $crop = new Crop("Alface", $area);
                $crop->setCostStrategy(new CustoHidroponico());
                return $crop;
            default:
                throw new \Exception("Tipo de cultura desconhecido");
        }
    }
}
