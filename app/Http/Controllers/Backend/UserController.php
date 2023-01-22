<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            return response()->json(['data' => User::
            whereLike($request->optionData)
            ->whereLike($request->optionData, 'mobile')
            ->whereLike( $request->optionData, 'email')
            ->select(['id','name','mobile', 'email'])->take(5)->get()]);
        }
        $users=User::get();
        return view('backend.user.index',compact('users'));

    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'mobile' => 'required|numeric',
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        User::updateOrCreate(['mobile' => $request->mobile],
        [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make('12345678'),
        ]);

        (new LogActivity)::addToLog('User Added');

        return back()->with(['success' => 'Data Saved Successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $visa=Visa::where('user_id',$id)->first();
        // return view('backend.user.view',compact('visa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::where('id',$id)->first();
        return view('backend.user.edit',compact('user'));
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
        $directory = 'uploads\user';

        $validated_data = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable',
            'address' => 'nullable|string',
            'mobile' => 'nullable|numeric',
        ]);

        $user = User::find($id);
        User::updateOrCreate(['id' => $id],
        [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make('12345678'),
        ]);
        (new LogActivity)::addToLog('User Updated');

        return back()->with(['success' => 'Data Saved Successfully']);

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
