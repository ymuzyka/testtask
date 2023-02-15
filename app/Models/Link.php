<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $link
 * @property boolean $is_deactivated
 * @property DateTime $created_at
 * @property DateTime $deactivated_at
 */
class Link extends Model
{
    protected $table = 'link';

    protected $fillable = [
        'user_id',
        'link',
        'is_deactivated',
        'created_at',
        'deactivated_at',
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
