<?php

namespace App\Http\Requests\Reference;

use App\Helpers\Image;
use App\Models\Reference;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'required|string',
            'email' => 'nullable|unique:references,email',
            'mobile' => 'nullable|unique:references,mobile',
            'commission' => 'nullable',
        ];
    }

    public function storeData($request)
    {

        try {
            $data = $request->validated();
            $id =Reference::create($data)->id;
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully', 'reference_id' => $id]);
    }
}
