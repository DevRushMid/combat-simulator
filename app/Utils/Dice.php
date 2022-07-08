<?php


namespace App\Utils;


class Dice
{
    public static function getModifier(int $value): float
    {
        return  intval(round(($value - 10)/2,0, PHP_ROUND_HALF_DOWN));
    }

    public static function roll($number, $sides): array
    {
        $dice = [];
        for ($i = 0; $i < $number; $i++)
        {
            $dice[] = rand(1, $sides);
        }
        $dice['total'] = array_sum($dice);
        return $dice;
    }

    public static function rollExpression(string $expression)
    {
        $exp = explode('+', $expression);
        $dices = explode('d', array_shift($exp));
        $result = self::roll($dices[0], $dices[1]);

        if(!empty($exp))
        {
            $bonus = array_shift($exp);
            $result['bonus'] = $bonus;
            $result['total'] = $result['total'] + $bonus;
        }

        return $result;
    }
}
