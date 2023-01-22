<?php

namespace App\Http\Requests\EmailConfiguration;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'driver'     =>'required',
            'host'       =>'required',
            'port'       =>'required',
            'username'   =>'required',
            'password'   =>'required',
            'encryption' =>'required',
            'from'       =>'required',
            // 'sendmail'   =>'required',
            // 'pretend'    =>'required',
        ];
    }
}
