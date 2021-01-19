<?php

namespace App\Http\Resources;

use App\Dto\Seat;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Collection\Collection;

/**
 * Class SubRowResource
 *
 * @method  string getLocation
 * @method  Collection|Seat[] getSeats
 *
 * @package App\Http\Resources
 */
class SubRowResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'location' => $this->getLocation(),
            'seats' => SeatResource::collection($this->getSeats()->toArray()),
        ];
    }
}
