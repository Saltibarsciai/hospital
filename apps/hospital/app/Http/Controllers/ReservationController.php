<?php

namespace App\Http\Controllers;

use App\Actions\ReservationAction;
use App\Http\Requests\ReservationPostRequest;

class ReservationController extends Controller
{
    /**
     * @var ReservationAction
     */
    private $reservationAction;

    public function __construct(ReservationAction $reservationAction)
    {
        $this->reservationAction = $reservationAction;
    }

    public function create(ReservationPostRequest $request)
    {
        $request->validated();
        return $this->reservationAction->reserveIfApplicable($request);
    }
}
