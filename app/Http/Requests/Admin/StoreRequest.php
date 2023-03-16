<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Image;
use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

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
            'email' => 'required|unique:admins,email',
            'mobile' => 'required|unique:admins,mobile',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'role_id' => 'required',

        ];
    }

    public function storeData($request)
    {
      
        try {
            $data = $request->validated();
            if($request->image){
                $data['image'] =  (new Image)->dirName('admin')->file($request->image)
                ->resizeImage(150, 150)
                ->save();
            }
            
            if($request->password){
                $data['password'] = Hash::make($request->password);
            }          
            if($request->role_id){
                $admin_role = Role::where('id', $request->role_id)->first();

            }          
            $admin= Admin::create($data);
            $admin->roles()->attach($admin_role);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
