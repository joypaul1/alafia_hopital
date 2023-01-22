<?php

namespace App\Http\Requests\Item\Row;

use App\Helpers\Image;
use App\Models\Item\Row;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'name' => 'required|string|unique:rows,name',
            'rack_id' => 'required|exists:racks,id',
            'note' => 'nullable|string',
        ];
    }

    public function storeData($request)
    {
      
        try {
            DB::beginTransaction();
            $data = $request->validated();
            // if($request->image){
            //     $data['image'] =  (new Image)->dirName('row')->file($request->image)
            //     ->resizeImage(500, 500)
            //     ->save();
            // }
          
            Row::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
