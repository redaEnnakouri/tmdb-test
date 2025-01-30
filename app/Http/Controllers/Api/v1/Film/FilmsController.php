<?php

namespace App\Http\Controllers\Api\v1\Film;

use App\Actions\Films\GetAllFilmsAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FilmsController extends Controller
{


    /**
     * @param GetAllFilmsAction $action
     * @return JsonResponse
     */
    public function index(GetAllFilmsAction $action): JsonResponse
    {

        return response()->json($action->execute(request()->only('search')));
    }
}
