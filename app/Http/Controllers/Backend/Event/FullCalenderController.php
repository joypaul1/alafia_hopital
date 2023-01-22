<?php

namespace App\Http\Controllers\Backend\Event;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('full-calender');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);
				(new LogActivity)::addToLog('Calender Event Created');
    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);
				(new LogActivity)::addToLog('Calender Event Updated');
    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
				$event = Event::find($request->id)->delete();
				(new LogActivity)::addToLog('Calender Event Deleted');
    			return response()->json($event);
    		}
    	}
    }
}
