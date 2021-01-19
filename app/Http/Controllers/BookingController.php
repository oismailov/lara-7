<?php

namespace App\Http\Controllers;

use App\Dto;
use App\Http\Requests;
use App\Http\Resources\BookingResource;
use App\Models;
use App\Models\Booking;
use App\Models\Plane;
use App\Models\SingleRowSeatsMap;
use App\Services;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class BookingController
 *
 * @package App\Http\Controllers
 */
class BookingController extends Controller
{
    /**
     * @var Services\Booking\Booking
     */
    private Services\Booking\Booking $bookingService;
    /**
     * @var Services\PlaneSeatsMap\PlaneSeatsMap
     */
    private Services\PlaneSeatsMap\PlaneSeatsMap $planeSeatsMapService;

    /**
     * BookingController constructor.
     *
     * @param Services\PlaneSeatsMap\PlaneSeatsMap $planeSeatsMapService
     * @param Services\Booking\Booking $bookingService
     */
    public function __construct(
        Services\PlaneSeatsMap\PlaneSeatsMap $planeSeatsMapService,
        Services\Booking\Booking $bookingService
    )
    {
        $this->planeSeatsMapService = $planeSeatsMapService;
        $this->bookingService = $bookingService;
    }

    /**
     * @param Requests\CreateBooking $createBooking
     *
     * @return AnonymousResourceCollection
     */
    public function create(Requests\CreateBooking $createBooking): AnonymousResourceCollection
    {
        $planeDto = new Dto\Plane($createBooking->get('plane_id'));

        /** @var Plane $plane */
        $plane = Plane::where('id', $planeDto->getId())->firstOrfail();

        $planeSeatsMap = $this->planeSeatsMapService->build($planeDto);

        $bookedSeatsMap = SingleRowSeatsMap::where('plane_type_id', $plane->type->id)->pluck('id')->toArray();

        $bookings = Booking::whereIn('map_id', $bookedSeatsMap)->where('plane_id', $planeDto->getId())->get();

        $this->syncMap($bookings, $planeSeatsMap);

        $bookings = $this->bookingService->proceed(
            $planeDto,
            $planeSeatsMap,
            new Dto\Customer(
                $createBooking->get('name'),
                $createBooking->get('tickets')
            )
        );

        return BookingResource::collection($bookings->toArray());
    }

    /**
     * Remove booked seats from map.
     *
     * @param Booking $bookings
     * @param Dto\PlaneSeatsMap $planeSeatsMap
     */
    private function syncMap(Collection $bookings, Dto\PlaneSeatsMap $planeSeatsMap)
    {
        /** remove booked seats from map */
        if ($bookings->count() > 0) {
            foreach ($planeSeatsMap->getRows() as $row) {
                foreach ($row->getSubRows() as $subRow) {
                    foreach ($subRow->getSeats() as $seat) {
                        foreach ($bookings as $booking) {
                            if ($seat->getMapId() === $booking->map_id && $booking->row_number === $row->getId()) {
                                if ($seat->getLocation() == Models\Seat::WINDOW_SEAT_LOCATION) {
                                    $planeSeatsMap->decrementWindowSeats();
                                }

                                $subRow->getSeats()->remove($seat);
                            }
                        }
                    }
                }
            }
        }
    }
}
