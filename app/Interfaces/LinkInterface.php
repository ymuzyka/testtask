<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Link;

interface LinkInterface
{
    public function get(string $link): ?Link;
    public function create(int $userId): string;
    public function deactivate(string $link, int $userId): void;
    public function generateLink(): string;
}
