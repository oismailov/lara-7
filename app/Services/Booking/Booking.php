<?php

namespace App\Services\Booking;

use App\Dto;
use Ramsey\Collection\Collection;

/**
 * Interface Booking
 *
 * @package App\Services\Booking
 */
interface Booking
{
    /**
     * @param Dto\Plane $plane
     * @param Dto\PlaneSeatsMap $planeSeatsMap
     * @param Dto\Customer $customer
     *
     * @return Collection | Models\Booking[]
     */
    public function proceed(
        Dto\Plane $plane,
        Dto\PlaneSeatsMap $planeSeatsMap,
        Dto\Customer $customer
    );
}
