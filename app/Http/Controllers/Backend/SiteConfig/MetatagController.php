<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;

class MetatagController extends Controller
{
    public function index() {
        if(auth('admin')->user()->can('view-meta-tag')){

        return view('backend.siteconfig.metatag.create', ['metatags' =>MetaTag::all() ]);
    }
    abort(403, 'Unauthorized action.');

   }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "name"    => "required|array",
                "name.*"  => "required|string|distinct",
                "description"  => "required|array",
                "description.*"  => "required|string",
            ]);
           
            if(!empty($request->ids)){
                $string= (implode(",",$request->ids));
                $integerIDs = array_map('intval', explode(',', $string));
                if($integerIDs){
                    MetaTag::whereNotIn('id', $integerIDs)->delete();
                }
                foreach ($request->name as $key => $value) {
                    MetaTag::updateOrCreate(['id' => $request->ids[$key] > 0 ? $request->ids[$key] : ($request->ids[array_key_last($request->ids)]+1)],
                    [
                        "name"          =>      $request->name[$key],
                        "description"   =>      $request->description[$key]
                    ]);
                }
            }else{
                foreach ($request->name as $key => $value) {
                    MetaTag::create([
                        "name"          =>      $value,
                        "description"   =>      $request->description[$key]
                    ]);
                }
            }
           
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Meta-Tag Configuration');

        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']); 
    }
}
