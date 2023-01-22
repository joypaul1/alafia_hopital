<?php

namespace App\Http\Controllers\Backend\Item;

use App\Helpers\Image;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Item\Category;
use App\Models\Item\Item;
use App\Models\TaxSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Item\Home\StoreRequest;
use App\Http\Requests\Item\Home\UpdateRequest;
use App\Models\Item\Childcategory;
use App\Models\Item\Subcategory;
use App\Models\Item\Unit;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->optionData){
            return response()->json(['data' => Item::whereLike($request->optionData)
            ->select(['id','name','sku', 'unit_id', 'sell_price'])->with('unit:id,name')->take(15)->get()]);
           }
        $data = Item::select(['id','name','category_id','subcategory_id','childcategory_id','sku','unit_id','brand_id','status', 'sell_price'])
        ->with('category:id,name')->with('subcategory:id,name')
        ->when($request->category_id, function($query) use ($request){
            $query->where('category_id', $request->category_id);
        })
        ->when($request->subcategory_id, function($query) use ($request){
            $query->where('subcategory_id', $request->subcategory_id);
        })
        ->when($request->childcategory_id, function($query) use ($request){
            $query->where('childcategory_id', $request->childcategory_id);
        })
        ->when($request->unit_id, function($query) use ($request){
            $query->where('unit_id', $request->unit_id);
        })
        ->when($request->brand_id, function($query) use ($request){
            $query->where('brand_id', $request->brand_id);
        })
        ->get();


        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action ='<div class="dropdown">
                        <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu"><a href="'.route('backend.itemconfig.item.edit', $row).'" class="dropdown-item">
                            <i class="fa fa-edit mr-2" aria-hidden="true"></i> Edit
                        </a><div class="dropdown-divider"></div>
                        <a data-href="'.route('backend.itemconfig.item.destroy', $row).'" class="dropdown-item delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483">
                            <i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })
                ->editColumn('status', function($row){
                    return view('components.backend.forms.input.input-switch', ['status' => $row->status ]);
                })
                ->editColumn('category_id', function($row){
                    return optional($row->category)->name;
                })
                ->editColumn('subcategory_id', function($row){
                    return optional($row->subcategory)->name;
                })
                ->editColumn('childcategory_id', function($row){
                    return optional($row->childcategory)->name;
                })
                ->editColumn('unit_id', function($row){
                    return optional($row->unit)->name;
                })
                ->editColumn('brand_id', function($row){
                    return optional($row->brand)->name;
                })
                ->editColumn('sell_price', function($row){
                    return number_format($row->sell_price,2);
                })

                ->removeColumn(['id'])
                ->rawColumns(['action'])
                // ->make(true);
                 ->toJson();

        }
        return View::make('backend.item.home.index');
    }

    public function itemCount(Request $request)
    {
        dd($request->all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $taxs= TaxSetting::active()->get()->map(function($tax, $key){
            return [
                'id' => $tax->id,
                'name' => $tax->name.'('.$tax->rate.'/'.$tax->type.')',
            ];
        });
        $appilcationTax = [
        // ['name'=>'None', 'id' => null],
        ['name'=>'Included Tax (With Tax)', 'id' => 'included_tax'],
        ['name'=>'Excluded Tax (Without Tax)', 'id' =>'excluded_tax']];
        $product_types = [['name'=>'Single', 'id' => 'single']];

        return View::make('backend.item.home.create')->with([
        // 'categories' => Category::get(['id', 'name']),
        'countries' =>  Country::get(['name', 'id']),
        'appilcationTax'=> $appilcationTax,
        'product_types'=> $product_types,
        'taxs'=> $taxs,
        ]);
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
        $item = Item::whereId($id)->first();
        $taxs= TaxSetting::active()->get()->map(function($tax, $key){
            return [
                'id' => $tax->id,
                'name' => $tax->name.'('.$tax->rate.'/'.$tax->type.')',
            ];
        });
        $appilcationTax = [
        // ['name'=>'None', 'id' => null],
        ['name'=>'Included Tax (With Tax)', 'id' => 'included_tax'],
        ['name'=>'Excluded Tax (Without Tax)', 'id' =>'excluded_tax']];
        $product_types = [['name'=>'Single', 'id' => 'single']];
        $subcategories = Subcategory::where('category_id', $item->category_id)->get();
        $childcategories = Childcategory::where('subcategory_id', $item->subcategory_id)->get();
        return View::make('backend.item.home.edit', compact('item'))
        ->with([
            'subcategories' => $subcategories,
            'childcategories' => $childcategories,
            'countries' =>  Country::get(['name', 'id']),
            'appilcationTax'=> $appilcationTax,
            'product_types'=> $product_types,
            'taxs'=> $taxs,
            ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Item $item)
    {
        $returnData = $request->updateData();
        if($returnData->getData()->status){
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
    public function destroy($id)
    {
        try {
            Item::whereId($id)->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' =>$ex->getMessage()]);
        }
        (new LogActivity)::addToLog('Item Deleted');
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }


    public function itemInfo(Request $request)
    {
        $item = Item::whereId($request->item_id)->active()->first();
        $units = Unit::active()->select('id', 'name')->get();
        $taxs = TaxSetting::active()->select('id','name', 'type', 'rate')->get();
        return view('backend.item.home.itemInfo',compact('item', 'units', 'taxs'));
    }

    public function itemPosInfo(Request $request)
    {
        $item   = Item::whereId($request->item_id)->active()->first();
        $units  = Unit::active()->select('id', 'name')->get();
        $taxs   = TaxSetting::active()->select('id','name', 'type', 'rate')->get();
        return view('backend.item.home.itemPosInfo',compact('item', 'units', 'taxs'));
    }
}
