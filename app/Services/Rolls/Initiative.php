<?php


namespace App\Services\Rolls;

use App\Utils\Dice;

class Initiative
{
    public function __invoke(string $initiative)
    {
        $value = Dice::getModifier($initiative);
        $result = Dice::roll(1,20);
        return $result['total'] + $value;
    }
}
