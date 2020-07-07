<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Model\Tag;
use App\Model\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tages = Tag::all();
        return view('backend\admin\tag\index', compact('tages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend\admin\tag\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $request['slug'] = Str::slug($request->name);
        Tag::create($request->all());
        Toastr::success('Tag create successfully',
         'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
        
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
    public function edit(Tag $tag)
    {
        return view('backend\admin\tag\edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $request['slug'] = Str::slug($request->name);
        $tag->update($request->all());
        Toastr::success('Tag update successfully',
         'Success', ["positionClass" => "toast-top-right"]);
         return redirect()->route('backend.admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();
        Toastr::success('Tag delete successfully',
         'Success', ["positionClass" => "toast-top-right"]);

         return redirect()->back();
    }
}
