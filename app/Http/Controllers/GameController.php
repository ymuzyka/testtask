<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\GameInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function __construct(private GameInterface $service)
    {
    }

    public function play(Request $request): JsonResponse
    {
        $result = $this->service->play($request->session()->get('userId'));

        return response()->json([
            'random_number' => $result->getRandomNumber(),
            'is_win_number' => $result->isWinNumber(),
            'win_sum' => $result->getWinSum(),
        ]);
    }

    public function getHistory(Request $request): JsonResponse
    {
        return response()->json(['history' => $this->service->getHistory($request->session()->get('userId'))]);
    }
}
