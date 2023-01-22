<?php

namespace App\Http\Requests\Pos\Register;


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
            'name' => ['required', Rule::unique('registers')
            ->ignore($this->id )
                ->where(function($query){
                return $query
                ->where('name', $this->name)
                ->orwhere('outlet_id', $this->outlet_id);
            })],
            'outlet_id'     => 'required|exists:outlets,id',
            'status'        => 'required|status',
            
        ];
    }
}
