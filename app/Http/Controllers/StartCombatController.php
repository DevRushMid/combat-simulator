<?php

namespace App\Http\Controllers;

use App\Http\Requests\Combat\StartCombatRequest;
use App\Services\Combat\StartCombatHandler;
use App\Services\Combat\StartCombatQuery;
use Illuminate\Http\Response;

/**
 * Class CombatController
 * @package App\Http\Controllers
 */
class StartCombatController extends Controller
{
    /**
     * @var StartCombatHandler
     */
    private StartCombatHandler $handler;

    public function __construct(StartCombatHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Handle the incoming request.
     *
     * @param StartCombatRequest $request
     * @return Response
     */
    public function __invoke(StartCombatRequest $request): Response
    {
        return new Response($this->handler->handle(new StartCombatQuery(
            $request->all()
        )))
        ;
    }
}
