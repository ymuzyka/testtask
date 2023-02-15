<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Services\DTO\GameDTO;
use Illuminate\Support\Collection;

interface GameInterface
{
    public function play(int $userId): GameDTO;
    public function getHistory(int $userId): Collection;
}
