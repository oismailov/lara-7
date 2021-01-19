<?php

namespace App\Dto;

/**
 * Class Plane
 *
 * @package App\Dto
 */
class Plane
{
    /**
     * @var int
     */
    private int $id;

    /**
     * Plane constructor
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
