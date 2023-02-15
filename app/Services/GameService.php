<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\GameRepository;
use App\Services\DTO\GameDTO;
use Exception;
use Illuminate\Support\Collection;
use App\Interfaces\GameInterface;

class GameService Implements GameInterface
{
    private const MIN = 0;
    private const MAX = 1000;

    public function __construct(
        private GameRepository $gameRepository,
    ) {
    }

    /**
     * @throws Exception
     */
    public function play(int $userId): GameDTO
    {
        $randomNumber = $this->getRandomNumber();
        $isWinNumber = $this->isWinNumber($randomNumber);
        $winSum = $isWinNumber ? $this->getWinSum($randomNumber) : 0;

        $gameDTO = new GameDTO($userId, $randomNumber, $winSum, $isWinNumber);

        $this->gameRepository->saveGameResult($gameDTO);

        return $gameDTO;
    }

    public function getHistory(int $userId): Collection
    {
        return $this->gameRepository->getGameHistory($userId);
    }

    private function getRandomNumber(): int
    {
        return rand(self::MIN, self::MAX);
    }

    private function getWinSum(int $number): int
    {
        $result = match (true) {
            $number > 900 => $number * 0.7,
            ($number > 600 && $number <= 900) => $number * 0.5,
            ($number > 300 && $number <= 600) => $number * 0.3,
            default => $number * 0.1
        };

        return (int)$result;
    }

    private function isWinNumber(int $number): bool
    {
        return $number % 2 === 0;
    }
}
