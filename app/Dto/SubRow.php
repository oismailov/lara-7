<?php

namespace App\Dto;

use Ramsey\Collection\Collection;

/**
 * Class SubRow
 *
 * @package App\Dto
 */
class SubRow
{
    /**
     * @var Collection|Seat[]
     */
    private Collection $seats;

    /**
     * @var string
     */
    private string $location;

    /**
     * SubRow constructor.
     *
     * @param Collection|Seat[] $seats
     * @param string $location
     */
    public function __construct(Collection $seats, string $location)
    {
        $this->seats = $seats;
        $this->location = $location;
    }

    /**
     * @return Collection|Seat[]
     */
    public function getSeats(): Collection
    {
        return $this->seats;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }
}
