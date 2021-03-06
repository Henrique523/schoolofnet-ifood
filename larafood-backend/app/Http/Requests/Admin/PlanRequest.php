<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
        $url = $this->segment(3);


        return [
            'name' => "required|string|min:3|max:255|unique:plans,name,{$url},url",
            'description' => 'nullable|string|min:3',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        ];
    }
}
