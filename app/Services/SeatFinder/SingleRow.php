<?php

namespace App\Services\SeatFinder;

use App\Dto;
use App\Models;
use Ramsey\Collection\Collection;

class SingleRow
{
    /**
     * @param Dto\Plane $plane
     * @param Dto\PlaneSeatsMap $planeSeatsMap
     * @param Dto\Customer $customer
     *
     * @return Dto\BookingResult
     */
    public function process(Dto\Plane $plane, Dto\PlaneSeatsMap $planeSeatsMap, Dto\Customer $customer)
    {
        $bookings = new Collection(Models\Booking::class);

        $ticketsToBuy = $customer->getTickets();

        foreach ($planeSeatsMap->getRows() as $row) {
            foreach ($row->getSubRows() as $subRow) {
                /**
                 * check if there is enough seats in sub row
                 */
                if ($customer->getTickets() <= $subRow->getSeats()->count()) {
                    foreach ($subRow->getSeats() as $seat) {
                        /**
                         * check if requested tickets have been bought
                         */
                        if ($ticketsToBuy == 0) {
                            return $this->buildResponse($ticketsToBuy, $bookings);
                        }

                        /**
                         * if there is no window seat in sub row - move further
                         */
                        if ($planeSeatsMap->getWindowSeats() > 0 && $subRow->getSeats()->first()->getLocation() !== Models\Seat::WINDOW_SEAT_LOCATION) {
                            continue 2;
                        }

                        $bookings->add(Models\Booking::create([
                            'name' => $customer->getName(),
                            'row_number' => $row->getId(),
                            'map_id' => $seat->getMapId(),
                            'plane_id' => $plane->getId()
                        ]));

                        $ticketsToBuy--;
                    }

                    return $this->buildResponse($ticketsToBuy, $bookings);
                }
            }
        }

        return $this->buildResponse($ticketsToBuy, $bookings);
    }

    /**
     * @param int $ticketsToBuy
     * @param Collection $bookings
     *
     * @return Dto\BookingResult
     */
    private function buildResponse(int $ticketsToBuy, Collection $bookings)
    {
        return new Dto\BookingResult($ticketsToBuy, $bookings);
    }
}
