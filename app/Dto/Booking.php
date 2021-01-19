<?php

namespace App\Dto;

/**
 * Class Booking
 *
 * @package App\Dto
 */
class Booking
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $rowNumber;

    /**
     * @var int
     */
    private int $mapId;

    /**
     * @var int
     */
    private int $planeId;

    /**
     * Customer constructor.
     *
     * @param string $name
     * @param int $rowNumber
     * @param int $mapId
     * @param int $planeId
     */
    public function __construct(string $name, int $rowNumber, int $mapId, int $planeId)
    {
        $this->name = $name;
        $this->rowNumber = $rowNumber;
        $this->mapId = $mapId;
        $this->planeId = $planeId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getRowNumber(): int
    {
        return $this->rowNumber;
    }

    /**
     * @return int
     */
    public function getMapId(): int
    {
        return $this->mapId;
    }

    /**
     * @return int
     */
    public function getPlaneId(): int
    {
        return $this->planeId;
    }
}
