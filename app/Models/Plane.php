<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Plane
 *
 * @property int id
 * @property int rows_number
 * @property PlaneType type
 *
 * @package App\Models
 */
class Plane extends Model
{
    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(PlaneType::class);
    }
}
