<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContractTemplateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'duration' => 'required',
            'contract_parameter' => 'required',
            'contract_type' => 'required',
            'payment' => 'required',
            'payment_frequency' => 'required',
            'gross_amount' => 'required'

        ];
    }
}
