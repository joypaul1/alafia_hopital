<?php

namespace App\Http\Controllers\Backend\Pathology;


use App\Http\Controllers\Controller;
use App\Models\lab\LabInvoiceTestDetails;
use Illuminate\Http\Request;


class LabTestResultController extends Controller
{
    public function makeResult(Request $request)
    {
        return LabInvoiceTestDetails::where('id', $request->id)->with('testName')->first();

    }
}
