<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDelegation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'uuid'],
            'start_date' => ['required', 'date_format:"Y-m-d H:i:s"'],
            'end_date' => ['required', 'date_format:"Y-m-d H:i:s"'],
            'country_code' => ['required', 'string', 'size:2']
        ];
    }
}
