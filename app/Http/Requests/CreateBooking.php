<?php

namespace App\Http\Requests;

use App\Models\Plane;
use App\Models\PlaneType;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateBooking
 *
 * @property string name
 * @property string plane_type
 * @property int seats
 *
 * @package App\Http\Requests
 */
class CreateBooking extends FormRequest
{
    /**
     * @{inheritDoc}
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:70|min:2',
            'plane_id' => 'required|integer|exists:' . Plane::class . ',id',
            'tickets' => 'required|integer|min:1|max:7',
        ];
    }
}
