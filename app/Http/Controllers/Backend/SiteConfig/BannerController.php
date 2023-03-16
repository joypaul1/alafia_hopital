<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\StoreRequest;
use App\Http\Requests\Banner\UpdateRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-banner')){

    $banners = Banner::select('id', 'position', 'image')->paginate(10);
       return view('backend.siteconfig.banner.index', compact('banners'));
        }
        abort(403, 'Unauthorized action.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth('admin')->user()->can('create-banner')){

        return view('backend.siteconfig.banner.create');
        }
        abort(403, 'Unauthorized action.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $returnData = $request->storeData($request);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Banner Created');
            return back()->with(['success' => $returnData->getData()->msg  ]);
        }
        return back()->with(['error' =>$returnData->getData()->msg ]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner )
    {
        if(auth('admin')->user()->can('edit-banner')){

        return view('backend.siteconfig.banner.edit',compact('banner'));
        }
        abort(403, 'Unauthorized action.');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Banner $banner)
    {
         $returnData = $request->updateData($request, $banner);
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Banner Updated');

            return back()->with(['success' => $returnData->getData()->msg  ]);
        }
        return back()->with(['error' =>$returnData->getData()->msg ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        if(auth('admin')->user()->can('delete-banner')){

        try {
            (new Image)->deleteIfExists($banner->image);
            $banner->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Banner Deleted');

        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);   
    }
    abort(403, 'Unauthorized action.');

}
}

