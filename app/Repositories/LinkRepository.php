<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Link;

class LinkRepository
{
    public function create(int $userId, string $linkString): void
    {
        $link = new Link();
        $link->link = $linkString;
        $link->user_id = $userId;
        $link->save();
    }

    public function deactivate(string $link, int $userId): void
    {
        /** @var Link|null $link */
        $link = Link::query()->where('link', '=', $link)
            ->where('user_id', '=', $userId)
            ->first();

        if ($link === null) {
            return;
        }

        $link->is_deactivated = true;
        $link->deactivated_at = now();
        $link->save();
    }

    public function get(string $link): ?Link
    {
        /** @var Link|null $link */
        $link = Link::query()->where('link', '=', $link)
            ->where('is_deactivated', '=', false)
            ->where('created_at', '>=', now()->subDays(7))
            ->first();

        return $link;
    }
}
