<?php


namespace App\Services\Characters;


use App\Infrastructure\Repositories\HTTP\HTTPDnd5eRepository;

class FindCharacterByName
{
    /**
     * @var HTTPDnd5eRepository
     */
    private HTTPDnd5eRepository $repository;

    /**
     * FindCharacterByName constructor.
     * @param HTTPDnd5eRepository $repository
     */
    public function __construct(HTTPDnd5eRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $name)
    {
        return $this->repository->getMonsterByName($name);
    }
}
