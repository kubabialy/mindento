<?php


namespace App\Http\Controllers;


use App\DTO\StoreDelegationDTO;
use App\Http\Requests\ListUserDelegations;
use App\Http\Requests\StoreDelegation;
use App\Models\Delegation;
use App\Services\Delegation\DelegationService;
use App\ValueObjects\ID;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DelegationController extends Controller
{
    private DelegationService $delegationService;

    public function __construct(DelegationService $delegationService)
    {
        $this->delegationService = $delegationService;
    }

    public function store(StoreDelegation $request)
    {
        $this->delegationService
            ->storeDelegation(new StoreDelegationDTO(
                new \DateTimeImmutable($request->start_date),
                new \DateTimeImmutable($request->end_date),
                new ID($request->user_id),
                $request->country_code
        ));

        return response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function listForUser(Request $request)
    {
        if (!$request->has('user_id') || empty($request->query('user_id'))) {
            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        }

        $delegations = $this->delegationService
            ->listUserDelegations(
                new ID($request->query('user_id'))
            );

        return new JsonResponse(
            $delegations->map(fn(Delegation $delegation) => $delegation->toResource())
        );
    }
}
