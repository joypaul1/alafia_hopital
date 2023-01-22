<?php

namespace App\Http\Controllers\Backend\Production;

use App\Http\Controllers\Controller;
use App\Models\Production\Production;
use App\Models\Production\ProductionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Production::active()->select(['id','name', 'date','status', 'approximate_sell', 'approximate_cost', 'approximate_profit'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<a  href="'.route('backend.production.edit', $row).'" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i></a>';
                    $action .='<button  data-href="'.route('backend.production.destroy', $row).'" type="button"
                    class="btn btn-sm btn-danger delete_check" data-toggle="tooltip" data-original-title="Delete" aria-describedby="tooltip64483"><i class="icon-trash" aria-hidden="true"></i>
                    </button >';
                    return $action;
                })
                ->editColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })->editColumn('approximate_sell', function ($row) {
                    return number_format($row->approximate_sell, 2);
                })->editColumn('approximate_cost', function ($row) {
                    return number_format($row->approximate_cost, 2);
                })->editColumn('approximate_profit', function ($row) {
                    return number_format($row->approximate_profit, 2);
                })
                ->removeColumn(['id'])
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('backend.production.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.production.create');

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
            DB::beginTransaction();
            // production
            $data = [];
            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['date'] = $request->date;
            $data['approximate_sell'] = $request->approximateSell;
            $data['approximate_cost']= $request->approximateCost;
            $data['approximate_profit'] = $request->approximateSell - $request->approximateCost;
            $production=  Production::create($data);

            // items
            for ($i=0; $i < count($request->pItem_id); $i++) {
                $item['item_id']    = $request->pItem_id[$i];
                $item['qty']        = $request->p_qty[$i];
                $item['price']      = $request->pu_price[$i];
                $item['total']      = $request->pu_price[$i] * $request->p_qty[$i];
                $v=$production->items()->create($item);
            }
            // materials
            for ($i=0; $i < count($request->mItem_id); $i++) {
                $item['item_id']    = $request->mItem_id[$i];
                $item['qty']        = $request->m_qty[$i];
                $item['price']      = $request->mu_price[$i];
                $item['total']      = $request->mu_price[$i] * $request->m_qty[$i];
                $production->materials()->create($item);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());

        }
        return redirect()->route('backend.production.index')->with('success', 'Production Created Successfully');

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
