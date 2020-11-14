<?php

namespace App\Http\Requests;

use App\Models\MembeCardManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMembeCardManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('membe_card_management_edit');
    }

    public function rules()
    {
        return [
            'card_no'  => [
                'string',
                'required',
            ],
            'username' => [
                'string',
                'required',
            ],
            'merchant' => [
                'string',
                'required',
            ],
        ];
    }
}
