<?php

namespace App\Dto;

use Ramsey\Collection\Collection;

/**
 * Class PlaneSeatsMap
 *
 * @package App\Dto
 */
class PlaneSeatsMap
{
    /**
     * @var Collection | Row[]
     */
    private Collection $rows;
    /**
     * @var int
     */
    private int $windowSeats;

    /**
     * PlaneSeatsMap constructor.
     *
     * @param Row[]|Collection $rows
     */
    public function __construct(Collection $rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return Row[]|Collection
     */
    public function getRows(): Collection
    {
        return $this->rows;
    }

    /**
     * @return int
     */
    public function getWindowSeats(): int
    {
        return $this->windowSeats;
    }

    /**
     * @param int $windowSeats
     *
     * @return $this
     */
    public function setWindowSeats(int $windowSeats): self
    {
        $this->windowSeats = $windowSeats;

        return $this;
    }

    public function decrementWindowSeats(): void
    {
        $this->windowSeats--;
    }
}
