<?php

namespace App\Dto;

/**
 * Class PlaneType
 *
 * @package App\Dto
 */
class PlaneType
{
    /**
     * @var string
     */
    private string $name;

    /**
     * PlaneType constructor
     * .
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
