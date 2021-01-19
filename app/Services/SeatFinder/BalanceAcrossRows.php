<?php

namespace App\Services\SeatFinder;

use App\Dto;
use App\Models;
use Ramsey\Collection\Collection;

class BalanceAcrossRows
{
    /**
     * @param Dto\Plane $plane
     * @param Dto\PlaneSeatsMap $planeSeatsMap
     * @param Dto\Customer $customer
     * @param Dto\BookingResult $bookingResult
     *
     * @return Dto\BookingResult
     */
    public function process(Dto\Plane $plane, Dto\PlaneSeatsMap $planeSeatsMap, Dto\Customer $customer, Dto\BookingResult $bookingResult)
    {
        $bookings = $bookingResult->getReservedSeats();

        $ticketsToBuy = $bookingResult->getTicketsToBuy();

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
                            return $this->buildResponse($ticketsToBuy, $bookings);
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

            }
        }

        return $this->buildResponse($ticketsToBuy, $bookings);
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
