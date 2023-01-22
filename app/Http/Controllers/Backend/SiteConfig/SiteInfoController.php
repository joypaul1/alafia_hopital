<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\LogActivity;
use App\Helpers\Timezone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SiteInfo\UpdateRequest;
use App\Models\Country;
use App\Models\Currency;
use App\Models\SiteInfo;


class SiteInfoController extends Controller
{

    public function index()
    {
        $stockMethods = (object)[['id'=> 'FIFO' , 'name'=>"FIFO (First In First Out)" ], ['id'=> 'LIFO' , 'name'=>"LIFO (Last In First Out)" ]];

        return view('backend.siteconfig.home.index',
        ['siteInfo' => SiteInfo::first(), 'dateTimeZone' => (new Timezone)::generate_timezone_list(),
        'countries' =>  Country::get(['name']), 'currencies' => Currency::get(['name'])]);
    }

    public function update(UpdateRequest $request)
    {
        $returnData = $request->updateData($request);
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('Site Information Configuration');
            return back()->with(['success' => $returnData->getData()->msg]);
        }
        return back()->with(['error' => $returnData->getData()->msg]);
    }



}
