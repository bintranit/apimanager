<?php

namespace App\Modules\Thanhvien\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateThanhvienRequest extends FormRequest
{

    private $commonRequest;

    public function __construct(CommonRequest $commonRequest)
    {
        $this->commonRequest = $commonRequest;
    }
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
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:50', //email
            'position' =>'required|string|max:30',
            'lophoc_id' => 'required|integer|exists:lophocs,id', //check id company
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'username is required',
            'name.string'   => 'name will be a string',
            'email.required' => 'email is required',
            'email.email' => 'email is wrong',
            'position.required' => 'position is required',
            'position.string'   => 'position will be a string',
            'lophoc_id.required' => 'lophoc_id is required',
            'lophoc_id.integer' => 'lophoc_id is integer',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->commonRequest->validateCommonBadRequest($validator);
        
    }
}
