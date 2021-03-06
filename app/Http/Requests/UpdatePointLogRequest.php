<?php

namespace App\Http\Requests;

use App\Models\PointLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_log_edit');
    }

    public function rules()
    {
        return [
            'point_gain' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'username'   => [
                'string',
                'required',
            ],
            'title'      => [
                'string',
                'required',
            ],
        ];
    }
}
