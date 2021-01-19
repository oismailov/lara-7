<?php

namespace App\Services\Booking;

use App\Dto;
use App\Models;
use Ramsey\Collection\Collection;

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
        $bookings = new Collection(Models\Booking::class);

        $ticketsToBuy = $customer->getTickets();

        foreach ($planeSeatsMap->getRows() as $row) {
            $subRowLocationWithWindowSeat = $this->pickSubRowWithWindowSeat($row);
            foreach ($row->getSubRows() as $subRow) {
                /**
                 * split tickets in same sub row location.
                 */
                if ($subRow->getLocation() == $subRowLocationWithWindowSeat) {
                    foreach ($subRow->getSeats() as $seat) {
                        /**
                         * check if requested tickets have been bought
                         */
                        if ($ticketsToBuy == 0) {
                            break 2;
                        }
                        $bookings->add($this->buy(new Dto\Booking(
                            $customer->getName(),
                            $row->getId(),
                            $seat->getMapId(),
                            $plane->getId()
                        )));

                        $ticketsToBuy--;
                    }
                }
//                /**
//                 * check if there is enough seats in sub row
//                 */
//                if ($customer->getTickets() <= $subRow->getSeats()->count()) {
//                    foreach ($subRow->getSeats() as $seat) {
//                        /**
//                         * check if requested tickets have been bought
//                         */
//                        if ($i == 0) {
//                            break 3;
//                        }
//
//                        /**
//                         * if there is no window seat in sub row - move further
//                         */
//                        if ($subRow->getSeats()->first()->getLocation() !== Models\Seat::WINDOW_SEAT_LOCATION) {
//                            continue 2;
//                        }
//
//                        $bookings->add(Models\Booking::create([
//                            'name' => $customer->getName(),
//                            'row_number' => $row->getId(),
//                            'map_id' => $seat->getMapId(),
//                            'plane_id' => $plane->getId()
//                        ]));
//
//                        $i--;
//                    }
//                    break 2;
//                }
            }
        }

        return $bookings;
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

    /**
     * @param Dto\Row $row
     *
     * @return string|null
     */
    private function pickSubRowWithWindowSeat(Dto\Row $row): ?string
    {
        $subRowLocation = null;
        $row->getSubRows()->map(function ($subRow) use (&$subRowLocation) {
            /** @var Dto\SubRow $subRow */
            $subRow->getSeats()->map(function ($seat) use (&$subRowLocation, $subRow) {
                /** @var Dto\Seat $seat */
                if (!$subRowLocation && $seat->getLocation() == Models\Seat::WINDOW_SEAT_LOCATION) {
                    $subRowLocation = $subRow->getLocation();
                }
            });
        });

        return $subRowLocation;
    }
}
