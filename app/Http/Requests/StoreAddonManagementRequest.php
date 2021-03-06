<?php

namespace App\Http\Requests;

use App\Models\AddonManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddonManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('addon_management_create');
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'title'       => [
                'string',
                'required',
            ],
            'price'       => [
                'string',
                'required',
            ],
            'is_enable'   => [
                'required',
            ],
            'item'        => [
                'string',
                'required',
            ],
        ];
    }
}
