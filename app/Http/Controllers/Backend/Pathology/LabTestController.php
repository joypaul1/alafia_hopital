<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Pathology\Lab\StoreRequest;
use App\Models\lab\LabInvoice;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $labInvoices= LabInvoice::with('labTest.testName:id,name,category')->get()->map(function($query){
            // dd($query->labTest);
            $data['id'] = $query->id;
            $data['invoice_no'] = $query->invoice_no;
            $data['patient'] = $query->patient->name;
            $data['created_date'] = $query->date;
            $data['total_amount'] = $query->total_amount;
            $data['category'] = $query->labTest->pluck('testName.category')->unique()->all();
            $data['testName'] = $query->labTest->pluck('testName.name');
            $data['testName_id'] = $query->labTest->pluck('id');
            return $data;
        });


        return view('backend.pathology.labTest.index', compact('labInvoices'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pathology.labTest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $returnData = $request->storeData();
        if($returnData->getData()->status){
            (new LogActivity)::addToLog('Pathology Lab Test Invoice Created');
            return back()->with('success', $returnData->getData()->msg);
            // return response()->json(['success' =>$returnData->getData()->msg, 'status' =>true], 200) ;
        }
        return back()->with('error', $returnData->getData()->msg);

        // return response()->json(['error' =>$returnData->getData()->msg,'status' =>false], 400) ;

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
    public function destroy($id)
    {
        //
    }
}
