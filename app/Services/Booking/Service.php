<?php

namespace App\Services\Booking;

use App\Dto;
use App\Models;
use App\Services\SeatFinder\BalanceAcrossRows;
use App\Services\SeatFinder\SingleRow;

/**
 * Class Service
 *
 * @package App\Services\Booking
 */
class Service implements Booking
{
    /**
     * @inheritDoc
     */
    public function proceed(Dto\Plane $plane, Dto\PlaneSeatsMap $planeSeatsMap, Dto\Customer $customer)
    {
        $bookingResult = (new SingleRow())->process($plane, $planeSeatsMap, $customer);

        if ($bookingResult->getTicketsToBuy() > 0) {
            (new BalanceAcrossRows())->process($plane, $planeSeatsMap, $customer, $bookingResult);
        }

        return $bookingResult->getReservedSeats();


    }

    /**
     * @param Dto\Booking $booking
     *
     * @return Models\Booking
     */
    private function buy(Dto\Booking $booking): Models\Booking
    {
        return Models\Booking::create([
            'name' => $booking->getName(),
            'row_number' => $booking->getRowNumber(),
            'map_id' => $booking->getMapId(),
            'plane_id' => $booking->getPlaneId()
        ]);
    }
}
