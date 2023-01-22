<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuickPage\StoreRequest;
use App\Http\Requests\QuickPage\UpdateRequest;
use App\Models\QuickPage;

class QuickPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quickPages = QuickPage::select('id', 'position', 'slug', 'name', 'status')->paginate(10);
        $quick_page = QuickPage::active()->select('id', 'name', 'slug', 'position')->orderBy('position')->get();
        session(['quick_page' => $quick_page]);
       return view('backend.siteconfig.quickpage.index', compact('quickPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.siteconfig.quickpage.create');
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
		    (new LogActivity)::addToLog('Quick-Page Created');
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
    public function edit(QuickPage $quickPage )
    {
        return view('backend.siteconfig.quickpage.edit',compact('quickPage'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, QuickPage $quickPage)
    {
        $returnData = $request->updateData($request, $quickPage);
        if($returnData->getData()->status){
		    (new LogActivity)::addToLog('Quick-Page Updated');
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
    public function destroy(QuickPage $quickPage)
    {
        try {
            $quickPage->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Quick-Page Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
}
