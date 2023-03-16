<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Image;
use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DB;
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
            'name' => 'required|string',
            //'password' => ['nullable', new MatchOldPassword($this->admin)],
            'email' => ['required', Rule::unique('admins')->ignore($this->admin->id)],
            'mobile' => ['required', Rule::unique('admins')->ignore($this->admin->id)],
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function updateData($request ,$admin)
    {
        try {
            $data = $request->validated();
           // unset($data['password']);
            if(!empty($request->image)){
                $data['image'] =  (new Image)->dirName('admin')->file($request->image)
                ->resizeImage(150, 150)
                ->deleteIfExists($admin->image)
                ->save();
            }
            if(($request->filled('password'))){
                $data['password'] = Hash::make($request->password);
            }   
            if($request->role_id){
                DB::table('admins_roles')->where('admin_id',$admin->id)->delete();
                $admin_role = Role::where('id', $request->role_id)->first();

            }      
            // dd($data);
            $admin->update($data);
            $admin->roles()->attach($admin_role);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
