<?php

namespace App\Http\Controllers;

use App\courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $idu= Auth::user()->id;
        $data=courier::all();
        return view('courier.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courier.createcourier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new courier;
        $data->courier= $request->courier;
        // $data->id_user=$idu;
        $data->save();
        return redirect()->route('courier.index') ->with('success','Your data has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function show(courier $courier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = courier::where('id',$id)->first();
        return view ('courier.editcourier',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        courier::where('id',$id)->update(['courier'=>$request->courier]);
        return redirect()->route('courier.index')->with('success','Your Data has Been Edited Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy(courier $courier)
    {
        $courier->delete($courier);
        return redirect()->route('courier.index')
                        ->with('delete','Your Data Has Been Deleted Successfully');
    }

    public function hapus($id)
    {
        $data = courier::find($id);
        $data->delete();

        return redirect()->route('courier.index')
                        ->with('delete','Your Data Has Been Deleted Successfully');
    }

    // sampah
    public function trash()
    {
        // mengampil data guru yang sudah dihapus 
        $data = courier::onlyTrashed()->get();
        return view('courier.trash',compact(['data']));
    }
}
