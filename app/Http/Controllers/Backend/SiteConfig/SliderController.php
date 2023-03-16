<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreRequest;
use App\Http\Requests\Slider\UpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-slider')){

        $sliders = Slider::select('id', 'text','position', 'image')->paginate(10);
        return view('backend.siteconfig.slider.index', compact('sliders'));
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
        if(auth('admin')->user()->can('create-slider')){

        return view('backend.siteconfig.slider.create');
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
		    (new LogActivity)::addToLog('Slider Created');
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
    public function edit(Slider $slider )
    {
        if(auth('admin')->user()->can('edit-slider')){

        return view('backend.siteconfig.slider.edit',compact('slider'));
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
    public function update(UpdateRequest $request, Slider $slider)
    {
      
        $returnData = $request->updateData($request, $slider);
        if($returnData->getData()->status){
		    (new LogActivity)::addToLog('Slider Updated');
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
    public function destroy(Slider $slider)
    {
        if(auth('admin')->user()->can('delete-slider')){

            try {
                (new Image)->deleteIfExists($slider->image);
                $slider->delete();
            } catch (\Exception $ex) {
                return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
            }
            (new LogActivity)::addToLog('Slider Deleted');
            return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);   
    
        }
        
        abort(403, 'Unauthorized action.');

   
    }
}
