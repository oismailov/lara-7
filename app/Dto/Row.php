<?php

namespace App\Dto;

use Ramsey\Collection\Collection;

/**
 * Class Row
 *
 * @package App\Dto
 */
class Row
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var Collection|SubRow[]
     */
    private Collection $subRows;

    /**
     * Row constructor.
     *
     * @param int $id
     * @param Collection|SubRow[] $subRows
     */
    public function __construct(int $id, Collection $subRows)
    {
        $this->id = $id;
        $this->subRows = $subRows;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection|SubRow[]
     */
    public function getSubRows(): Collection
    {
        return $this->subRows;
    }
}
