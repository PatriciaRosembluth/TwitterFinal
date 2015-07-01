<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AnswerRequest extends Request {

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
			"content" => "required|max:140",
		];
    }

	public function messages()
	{
	    return [
	        'content.required' => 'The content field is required!!!',
	        'content.max' => 'The content field cant have more than 140 characters!!!!',

	    ];
	}
}
