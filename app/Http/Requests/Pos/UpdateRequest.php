<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('suppliers')
            ->ignore($this->id )
                ->where(function($query){
                return $query
                ->where('name', $this->name)
                ->where('mobile', $this->mobile)
                ->orwhere('email', $this->email);
            })],
            'company_name'      => 'nullable|string',
            'mobile'            => 'required|string',
            'email'             => 'nullable|email:rfc,dns',
            'country'           => 'nullable|exists:countries,id',
            'province'          => 'nullable|string',
            'city'              => 'nullable|string',
            'postal_code'       => 'nullable|string',
            'address_line_1'    => 'nullable|string',
            'address_line_2'    => 'nullable|string',
        ];
    }
}
