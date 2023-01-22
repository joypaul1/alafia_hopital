<?php

namespace App\Http\Requests\SiteInfo;

use App\Models\SiteInfo;
use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Image;


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
            'name'                              => 'required|string',
            'email'                             => 'nullable|email',
            'mobile'                            => 'required',
            'logo'                              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width:130,max_height:40',
            'short_desc'                        => 'nullable',
            'country'                           => 'nullable|string',
            'currency'                          => 'nullable|string',
            'datetimezone'                      => 'nullable|string',
            'currency_symbol_placement'         => 'nullable|string',
            'date_format'                       => 'nullable|string',
            'accounting_method'                 => 'nullable|string',
            'currency_precision'                => 'nullable|string',
            'quantity_precision'                => 'nullable|string',
            'default_datatable_page_entries'    => 'nullable|string',
        ];
    }


    public function updateData ($request )
    {
        try {
            $data = $request->all();
            if($request->logo){
                $data['logo'] =  (new Image)->dirName('site_info')->file($request->logo)
                // ->resizeImage(130, 50)
                ->save();
            }
            $siteInfo = SiteInfo::updateOrCreate(['id'=> 1], $data);
            $siteInfo = SiteInfo::first()->toArray();
            session(['site_info' => $siteInfo]);

        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);

    }
}
