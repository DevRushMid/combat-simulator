<?php


namespace App\Services\Combat;

/**
 * Class StartCombatQuery
 * @package App\Services\Combat
 */
class StartCombatQuery
{
    /**
     * @var array
     */
    private array $characters;

    /**
     * StartCombatQuery constructor.
     * @param array $characters
     */
    public function __construct(array $characters)
    {
        $this->characters = $characters;
    }

    public function getCharacters(): array
    {
        return $this->characters;
    }
}
