<?php

namespace App\Dto;

/**
 * Class Seat
 *
 * @package App\Dto
 */
class Seat
{
    /**
     * @var int
     */
    private int $mapId;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $location;

    /**
     * Seat constructor.
     *
     * @param int $mapId
     * @param string $name
     * @param string $location
     */
    public function __construct(int $mapId, string $name, string $location)
    {
        $this->mapId = $mapId;
        $this->name = $name;
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getMapId(): int
    {
        return $this->mapId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

}
