<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DepartmentRequest extends Request
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
		switch($this->method())
		{
			case 'POST':
			{
				return [
					'department' => 'required|min:2|unique:departments,department'
				];
			}
			case 'PATCH':
			{
				return [
					'department' => 'required|min:2|unique:departments,department,'.$this->get('id')
				];
			}
		}
    }
}
