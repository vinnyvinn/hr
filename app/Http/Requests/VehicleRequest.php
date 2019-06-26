<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VehicleRequest extends Request
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
            'user_id' => 'required',
            'vehicle_type' => 'required',
            'vehicle_number' => 'required',
            'vehicle_model' => 'required',
            'vehicle_description' => 'required',
            'vehicle_purchase_date' => 'required'
        ];
    }
}
