<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TravelPerdiemRequest extends Request
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
            'department_id'=>'required',
            'travel_mode_id'=>'required',
            'from_location'=>'required',
            'to_location'=>'required',
            'fare'=>'required'
        ];
    }
}
