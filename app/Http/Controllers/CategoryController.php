<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=category::all();
        return view('category.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new category;
        $data->category_name= $request->category_name;
        // $data->id_user=$idu;
        $data->save();
        return redirect()->route('category.index')
                        ->with('success','Your data has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = category::where('id',$id)->first();
        return view ('category.edit',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        category::where('id',$id)->update(['category_name'=>$request->category_name]);
        return redirect()->route('category.index')
                        ->with('success','Your Data has Been Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete($category);
        return redirect()->route('category.index')
                        ->with('delete','Your Data Has Been Deleted Successfully');
    }
    // hapus sementara
    public function hapus($id)
    {
        $data = category::find($id);
        $data->delete();

        return redirect()->route('category.index')
                        ->with('delete','Your Data Has Been Deleted Successfully');
    }

    // sampah
    public function trash()
    {
        // mengampil data guru yang sudah dihapus 
        $data = category::onlyTrashed()->get();
        return view('category.trash',compact(['data']));
    }
}
