<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SingleRowSeatsMap
 *
 * @property  int id
 * @property  Seat seat
 * @property  SeatLocation seat_location
 * @property  SubRowLocation sub_row_location
 *
 * @package App\Models
 */
class SingleRowSeatsMap extends Model
{
    /**
     * @var string
     */
    protected $table = 'single_row_seats_map';

    /**
     * @return BelongsTo
     */
    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    /**
     * @return BelongsTo
     */
    public function sub_row_location(): BelongsTo
    {
        return $this->belongsTo(SubRowLocation::class);
    }

    /**
     * @return BelongsTo
     */
    public function seat_location(): BelongsTo
    {
        return $this->belongsTo(SeatLocation::class);
    }

    /**
     * @return BelongsTo
     */
    public function plane(): BelongsTo
    {
        return $this->belongsTo(Plane::class);
    }
}
