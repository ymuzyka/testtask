<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Link;
use App\Repositories\LinkRepository;
use Ramsey\Uuid\Uuid;
use App\Interfaces\LinkInterface;

class LinkService Implements LinkInterface
{
    public function __construct(
        private LinkRepository $linkRepository
    ) {
    }

    public function create(int $userId): string
    {
        $link = $this->generateLink();
        $this->linkRepository->create($userId, $link);

        return $link;
    }

    public function deactivate(string $link, int $userId): void
    {
        $this->linkRepository->deactivate($link, $userId);
    }

    public function get(string $link): ?Link
    {
        return $this->linkRepository->get($link);
    }

    public function generateLink(): string
    {
        return Uuid::uuid4()->toString();
    }
}
