<?php

namespace App\Http\Controllers\Backend\SiteConfig;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Models\EmailConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\StoreRequest;

class EmailConfigurationController extends Controller
{
    public function index() {

        return view('backend.siteConfig.emailConfig.create', ['emailConfig' =>EmailConfiguration::first() ]);
    }

    public function store(Request $request)
    {
        try {
            if ($request->document) {
                $document = (new Image)->dirName('email-document')->file($request->document)
               ->save();
                EmailConfiguration::updateOrCreate(['id'=>1],
                [
                    "document"      =>    $document,
                ]);
            }
                EmailConfiguration::updateOrCreate(['id'=>1],
                [
                    "driver"        =>      $request->driver,
                    "host"          =>      $request->host,
                    "port"          =>      $request->port,
                    "encryption"    =>      $request->encryption,
                    "user_name"     =>      $request->user_name,
                    "password"      =>      $request->password,
                    "sender_name"   =>      $request->sender_name,
                    "sender_email"  =>      $request->sender_email
                ]);
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Email-Configuration');

        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
}
