<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\InvoiceNumber;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\InvoicePrefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrefixController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if(auth('admin')->user()->can('view-prefix-system')){

    return view('backend.siteconfig.prefix.create');
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
    return view('backend.siteconfig.prefix.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      foreach ($request->except('_method', '_token') as $key => $value) {
        if ($value) {
          InvoicePrefix::updateOrCreate(['name' => $key, 'value' => $value]);
        } else {
          InvoicePrefix::where('name', $key)->delete();
        }
      }
    } catch (\Exception $ex) {
      return back()->with(['error' => $ex->getMessage()]);
    }
    session(['invoice_prefix' => $request->except('_method', '_token')]);

    (new LogActivity)::addToLog('Invoice Prefix Updated');
    return back()->with(['success' => 'Prefix updated Successfully']);
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
