<?php


namespace App\Infrastructure\Repositories\HTTP;


class HTTPDnd5eRepository extends HTTPRepositoryBase
{
    private const BASE_URI = 'https://www.dnd5eapi.co/api/';
    private const MONSTER_URI = 'monsters/%s';

    public function getMonsterByName(string $name)
    {
        $response = $this->get(sprintf(self::BASE_URI . self::MONSTER_URI, $name));

        return $response->body;
    }
}
