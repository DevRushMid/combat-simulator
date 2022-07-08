<?php


namespace App\Services\Combat;


use App\Services\Characters\FindCharacterByName;
use App\Services\Rolls\Initiative;
use App\Utils\Dice;

/**
 * Class StartCombatHandler
 * @package App\Services\Combat
 */
class StartCombatHandler
{
    /**
     * @var FindCharacterByName
     */
    private FindCharacterByName $findCharacterByName;

    /**
     * @var Initiative
     */
    private Initiative $initiative;

    /**
     * StartCombatHandler constructor.
     * @param FindCharacterByName $findCharacterByName
     * @param Initiative $initiative
     */
    public function __construct(FindCharacterByName $findCharacterByName,
                                Initiative $initiative)
    {
        $this->findCharacterByName = $findCharacterByName;
        $this->initiative = $initiative;
    }

    public function handle(StartCombatQuery $query)
    {
        $combat = [];
        $character1 = ($this->findCharacterByName)($query->getCharacters()['combat_1']);
        $initiative1 = ($this->initiative)($character1['dexterity']);

        $character2 = ($this->findCharacterByName)($query->getCharacters()['combat_2']);
        $initiative2 = ($this->initiative)($character2['dexterity']);

        $combat[$initiative1] = $character1;
        $combat[$initiative2] = $character2;
        krsort($combat);
        $active_combat = true;
        $report = [];
        $round = 1;

        while($active_combat)
        {
            $current_char = current($combat);
            $action = $this->getAction($current_char['actions']);

            //getTarget
            $next = next($combat);
            if(!$next)
            {
                $next = reset($combat);
            }
            $target = $next;

            $report[] = 'Rodada: '. $round;

            $atk = Dice::roll(1,20) + $action['attack_bonus'];

            if($atk < $target['armor_class'])
            {
                $report[] = $current_char['name'] . ' Errou: ' . $atk;
                continue;
            }

            $damage = Dice::rollExpression($action['damage']['damage_dice']);
            $target['hit_points'] = $target['hit_points']  - $damage;

            $report[] = $current_char['name'] . ' Acertou: '. $atk;
            $report[] = 'Dano: ' . $damage;


            //Testa fim do combate

        }

        return $report;
    }


    public function getAction(array $actions)
    {
        $num_actions = count($actions);
        return $actions[rand(0, $num_actions -1)];
    }

}
