<?php

namespace App\Http\Resources;

use App\Models\SingleRowSeatsMap;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BookingResource
 *
 * @property string name
 * @property int row_number
 * @property SingleRowSeatsMap single_row_seats_map
 *
 * @package App\Http\Resources
 */
class BookingResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'seat' => $this->single_row_seats_map->seat->name . $this->row_number
        ];
    }
}
