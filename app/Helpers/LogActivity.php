<?php 

namespace App\Helpers;

use App\Models\LogActivity as BackendLogActivity;
use Illuminate\Support\Facades\Request;

class LogActivity
{

    public static function addToLog($subject)
    {
    	$log 				= [];
    	$log['subject'] 	= $subject;
    	$log['date'] 		= date("Y-m-d H:i:s");
    	$log['url']			= Request::fullUrl();
    	$log['method'] 		= Request::method();
    	$log['ip'] 			= Request::ip();
    	$log['agent'] 		= Request::header('user-agent');
    	$log['admin_id'] 	=  auth('admin')->id() ?? 1;
    	BackendLogActivity::insert($log);
    }


    public static function logActivityLists()
    {
    	return BackendLogActivity::latest()->get();
    }
}