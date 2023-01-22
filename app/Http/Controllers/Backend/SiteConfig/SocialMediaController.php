<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SocialMediaController extends Controller
{
    public function index()
    {
        return view('backend.siteconfig.socialmedia.index', ['socialmedia' => SocialMedia::first()]);
    }

    public function store(Request $request)
    {
        try {

            // DB::beginTransaction();
            if(SocialMedia::first()){
                SocialMedia::first()->udpate([
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'youtube' => $request->youtube,
                    'pinterest' => $request->pinterest,
                    'linkedin' => $request->linkedin,
                    'instagram' => $request->instagram,
                ]);
            }else{
                SocialMedia::create([
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'youtube' => $request->youtube,
                    'pinterest' => $request->pinterest,
                    'linkedin' => $request->linkedin,
                    'instagram' => $request->instagram,
                ]);
            }

            // DB::commit();
        } catch (\Exception $ex) {
            // DB::rollBack();
            return back()->with(['error' => $ex->getMessage() ]);
        }
        return back()->with(['success' =>"Data Updated Successfully." ]);

    }
}
