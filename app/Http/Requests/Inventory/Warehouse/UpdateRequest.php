<?php

namespace App\Http\Requests\Inventory\Warehouse;

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('ware_houses')
            ->ignore($this->warehouse->id)
                ->where(function($query){
                return $query
                ->where('name', $this->name)
                ->where('mobile', $this->mobile)
                ->orwhere('email', $this->email);
            })],
            'company_name'      => 'nullable|string',
            'mobile'            => 'required|string|unique:ware_houses,mobile,'.$this->supplier->id,
            'email'             => 'nullable|email:rfc,dns|unique:ware_houses,email,'.$this->supplier->id,
            'country_id'        => 'nullable|exists:countries,id',
            'province'          => 'nullable|string',
            'city'              => 'nullable|string',
            'postal_code'       => 'nullable|string',
            'address_line_1'    => 'nullable|string',
            'address_line_2'    => 'nullable|string',
        ];
    }
}
