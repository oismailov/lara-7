<?php

namespace App\Dto;

use App\Models;
use Ramsey\Collection\Collection;

/**
 * Class BookingResult
 *
 * @package App\Dto
 */
class BookingResult
{
    /**
     * @var int
     */
    private int $ticketsToBuy;
    /**
     * @var Models\Booking[] | Collection
     */
    private $reservedSeats;

    /**
     * BookingResult constructor.
     *
     * @param int $ticketsToBuy
     * @param Collection | Models\Booking[] $reservedSeats
     */
    public function __construct(int $ticketsToBuy, Collection $reservedSeats)
    {
        $this->ticketsToBuy = $ticketsToBuy;
        $this->reservedSeats = $reservedSeats;
    }

    /**
     * @return int
     */
    public function getTicketsToBuy(): int
    {
        return $this->ticketsToBuy;
    }

    /**
     * @return Collection | Models\Booking[]
     */
    public function getReservedSeats(): Collection
    {
        return $this->reservedSeats;
    }
}
