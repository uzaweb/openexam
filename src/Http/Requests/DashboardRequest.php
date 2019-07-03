<?php

use Illuminate\Foundation\Http\FormRequest;

namespace Uzaweb\Openexam\Http\Requests;

class DashboardRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
		
		// return access()->hasRole(1);
	}
	
    /**
     * Get the validation rules that apply to the request.
     *
     * See more: https://laravel.com/docs/master/validation#available-validation-rules
     *
     * @return array
     */
	public function rules()
	{
		//TODO Update validation rules
		return [
				'title' => 'required|max:20',
				'detail' => 'required|max:250',
		];
	}
	
	/**
	 * Define custom error message.
	 * 
	 * @return array
	 */
	public function messages()
	{
		//TODO language system
		return [
				'title.required' => 'The "Openexam title" field is required.',
    			'title.max' => 'The "Openexam title" may not be greater than 20 characters.',
				'detail.required' => 'The "Openexam detail" field is required.',
    			'detail.max' => 'The "Openexam detail" may not be greater than 250 characters.',
		];
	}
}
