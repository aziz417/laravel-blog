<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Model\Category;
use App\Model\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();

        return view('backend\admin\category\index', compact('categories'));
    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|unique:categories',
            'img' => 'required|mimes:jpg,png,jpeg,bmp'
        ]);
        //get form image
        $image = $request->file('img');
        $slug = Str::slug($request->name);

        if(isset($image)){
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();

            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check category directory exists
            if(!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }

            //resize image for category
            $category = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category);

             //check category slider directory exists
             if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //resize image for category slider upload
            $slider = Image::make($image)->resize(500, 333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }else{
            $imageName = 'default.png';
        }

        $request['slug'] = $slug;
        $request['image'] = $imageName;

        if(Category::create($request->all())){
            Toastr::success('Category create successfully',
                'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('backend.admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'img' => 'mimes:jpg,png,bmp,jpeg',
        ]);
        $slug = Str::slug($request->name);
        $image = $request->file('img');
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check category directory exist
            if(!Storage::disk('public')->exists('category')){
             //create category directory
                Storage::disk('public')->makeDirectory('category');
            }
            
            //old image delete for category
            if(Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/'.$category->image);
            }
            // resize image
            $categoryImage = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$categoryImage);

            // check category slider directory exist
            if(!Storage::disk('public')->exists('category/slider')){
                //create category slider directory
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //old image delete for slider
            if(Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

            // resize image
            $slider = Image::make($image)->resize(500, 333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }else{
            $imageName = $category->image;
        }

        $request['image'] = $imageName;
        $request['slug']  = $slug;
        if($category->update($request->all())) {
            Toastr::success('Category update successfully',
                'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('backend.admin.category.index');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        //old image delete for category
        if(Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
        }
        //old image delete for slider
        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        if(Category::destroy($id)){
            Toastr::success('Category delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
