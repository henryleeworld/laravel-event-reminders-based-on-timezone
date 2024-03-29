<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'title'         => [
                'required'
            ],
            'start_time'    => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format')
            ],
            'registrants.*' => [
                'integer'
            ],
            'registrants'   => [
                'array'
            ],
            'timezone'   => [
                'timezone'
            ],
        ];

    }
}
