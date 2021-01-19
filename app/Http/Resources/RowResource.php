<?php

namespace App\Http\Resources;

use App\Dto\SubRow;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Collection\Collection;

/**
 * Class RowResource
 *
 * @method  int getId
 * @method  SubRow[]|Collection getSubRows
 *
 * @package App\Http\Resources
 */
class RowResource extends JsonResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'subRows' => SubRowResource::collection($this->getSubRows()->toArray())
        ];
    }
}
