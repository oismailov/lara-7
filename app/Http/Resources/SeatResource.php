<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SeatResource
 *
 * @method  string getName
 * @method  string getLocation
 *
 * @package App\Http\Resources
 */
class SeatResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'name' => $this->getName(),
            'location' => $this->getLocation(),
        ];
    }
}
