<?php

namespace App\Modules\Lophoc\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLophocRequest extends FormRequest
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
            'mota' => 'required|string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'username is required',
            'name.string'   => 'name will be a string',
            'mota.required' => 'email is required',
            'mota.string'   => 'address will be a string',
            
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->commonRequest->validateCommonBadRequest($validator);
        
    }
}
