<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LeaveRequest extends Request
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
        $rules = [
            'leave_type' => 'exists:leave_types',
            'leave_type_id' => 'required|numeric',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after:date_from',
            'applied_on' => 'required|date',
            'reason' => 'required|min:10'
        ];

        if ($this->getMethod() == 'PATCH') {
            return $rules;
        }

        $rules['user_id'] = 'required|numeric';

        return $rules;
    }
}
