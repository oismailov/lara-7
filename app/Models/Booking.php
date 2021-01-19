<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Booking
 *
 * @property string name
 * @property int row_number
 * @property int map_id
 * @property int plane_id
 *
 * @package App\Models
 */
class Booking extends Model
{
    public $fillable = [
        'name',
        'row_number',
        'map_id',
        'plane_id',
    ];

    /**
     * @return BelongsTo
     */
    public function single_row_seats_map(): BelongsTo
    {
        return $this->belongsTo(SingleRowSeatsMap::class, 'map_id');
    }
}
