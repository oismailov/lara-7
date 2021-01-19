<?php

namespace App\Services\PlaneSeatsMap;

use App\Dto;
use App\Models;
use Ramsey\Collection\Collection;

/**
 * Class Service
 *
 * @package App\Services\PlaneSeatsMap
 */
class Service implements PlaneSeatsMap
{
    /**
     * @inheritDoc
     */
    public function build(Dto\Plane $planeDto): Dto\PlaneSeatsMap
    {
        /** @var Models\Plane $plane */
        $plane = Models\Plane::where('id', $planeDto->getId())->firstorFail();
        $singleRowsSeatsMap = Models\SingleRowSeatsMap::where('plane_type_id', $plane->type->id)->get();

        $rowsDto = new Collection(Dto\Row::class);

        for ($i = 1; $i <= $plane->rows_number; $i++) {
            $subRows = [];
            $subRowsCollection = new Collection(Dto\SubRow::class);
            /** @var Models\SingleRowSeatsMap $seatMap */
            foreach ($singleRowsSeatsMap as $seatMap) {
                $side = $seatMap->sub_row_location->side;
                $subRows[$side][] = [
                    'seat_id' => $seatMap->id,
                    'seat_location' => $seatMap->seat_location->name,
                    'seat_name' => $seatMap->seat->name
                ];
            }

            foreach ($subRows as $key => $subRow) {
                $seats = new Collection(Dto\Seat::class);
                foreach ($subRow as $seat) {
                    $seats->add(new Dto\Seat($seat['seat_id'], $seat['seat_name'], $seat['seat_location']));
                }

                $subRowsCollection->add(new Dto\SubRow($seats, $key));
            }

            $rowsDto->add(new Dto\Row($i, $subRowsCollection));
        }

        return new Dto\PlaneSeatsMap($rowsDto);
    }

    /**
     * Build subRow collection.
     *
     * @return Dto\SubRow[]|Collection
     */
    private function buildSubRow(): Collection
    {

    }
}
