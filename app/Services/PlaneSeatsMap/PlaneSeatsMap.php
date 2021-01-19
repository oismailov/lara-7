<?php

namespace App\Services\PlaneSeatsMap;

use App\Dto;

/**
 * Interface PlaneSeatsMap
 *
 * @package App\Services\PlaneSeatsMap
 */
interface PlaneSeatsMap
{
    /**
     * Build seats map based on plane type.
     *
     * @param Dto\Plane $planeDto
     *
     * @return Dto\PlaneSeatsMap
     */
    public function build(Dto\Plane $planeDto): Dto\PlaneSeatsMap;
}
