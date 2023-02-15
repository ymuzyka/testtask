<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Game;
use App\Services\DTO\GameDTO;
use Illuminate\Support\Collection;

class GameRepository
{
    private const HISTORY_GAMES = 3;

    public function getGameHistory(int $userId): Collection
    {
        return Game::query()->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->limit(self::HISTORY_GAMES)
            ->get();
    }

    public function saveGameResult(GameDTO $gameDTO): void
    {
        $result = new Game();
        $result->user_id = $gameDTO->getUserId();
        $result->random_number = $gameDTO->getRandomNumber();
        $result->win_sum = $gameDTO->getWinSum();
        $result->is_win_number = $gameDTO->isWinNumber();
        $result->save();
    }
}
