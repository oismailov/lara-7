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
}
