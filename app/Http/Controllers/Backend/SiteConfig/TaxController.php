<?php
namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tax\StoreRequest;
use App\Models\InvoicePrefix;
use App\Models\TaxSetting;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxDatas = TaxSetting::all();
        if($request->optionData){
            return TaxSetting::select('id', 'type', 'rate')->get();
        }
        $datas=  (object)[['name' =>'Percent', 'id' =>'percent' ],['name' =>'Flat', 'id' =>'flat' ]];
        return view('backend.siteconfig.tax.index',compact('datas', 'taxDatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.siteconfig.tax.index');
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
		    (new LogActivity)::addToLog('Tax-Setting Created');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        try {
            TaxSetting::where('id',$id)->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Tax setting Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
}
