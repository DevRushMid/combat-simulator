<?php


namespace App\Services\Combat;


use App\Services\Characters\FindCharacterByName;

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
     * StartCombatHandler constructor.
     * @param FindCharacterByName $findCharacterByName
     */
    public function __construct(FindCharacterByName $findCharacterByName)
    {
        $this->findCharacterByName = $findCharacterByName;
    }

    public function handle(StartCombatQuery $query)
    {
        return ($this->findCharacterByName)($query->getCharacters()['combat_1']);
    }
}
