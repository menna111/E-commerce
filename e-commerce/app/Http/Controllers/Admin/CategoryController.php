<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    use ImageUpload,\App\Traits\ResponseTrait;


    public function index(){
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }


    public function add(){
        return view('admin.category.add');
    }


    public function store(Request $request){

         //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:categories',
                'slug'         => 'required|string|min:3|max:255',
                'description'  => 'required|string|min:3|max:255',
                'meta_title'  => 'required|string|min:3|max:255',
                'meta_keywords'  => 'required|string|min:3|max:255',
                'meta_description'  => 'required|string|min:3|max:255',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',

            ]);


        try {
            DB::beginTransaction();
            if ($request->has('image')){
                $image=$this->uploadImage($request->file('image'),'uploaded/categories',50);
            }else{
                $image=null;
            }
            $category = Category::create([
                'name' => $request['name'],
                'slug' => $request['slug'],
                'description' => $request['description'],
                'status' => $request['status'] == TRUE ? 1 : 0,
                'popular' => $request['popular'] == TRUE ? 1 : 0,
                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
                'image'     => $image,
            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
//            dd($exception->getMessage());
            return  redirect()->back()->with('error', 'something wrong happened');

        }
        return  redirect('/categories')->with('status','Category Added successfully');
    }



    public function edit($id){
        $category=Category::findOrFail($id);
        return view('admin.Category.edit',compact('category'));
    }


    public function update(Request $request,$id){
        $category=Category::findOrFail($id);
        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:categories,id,' . $id,
                'slug'         => 'required|string|min:3|max:255',
                'description'  => 'required|string|min:3|max:255',
                'meta_title'  => 'required|string|min:3|max:255',
                'meta_keywords'  => 'required|string|min:3|max:255',
                'meta_description'  => 'required|string|min:3|max:255',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',

            ]);
        DB::beginTransaction();
        if ($request->has('image')){
            $image=$this->uploadImage($request->file('image'),'uploaded/categories',50);
        }else{
            $image=$category->image;
        }
        try{
        $category -> update([

               'name' => $request['name'],
                'slug' => $request['slug'],
                'description' => $request['description'],
                'status' => $request['status'] == TRUE ? 1 : 0,
                'popular' => $request['popular'] == TRUE ? 1 : 0,
                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
                'image'     => $image,
        ]);
           DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
//            dd($exception->getMessage());
        }
        return redirect('/categories')->with('success','updated successfully');
    }


    public function delete($id){
        $category=Category::findOrFail($id);
        $category->delete();
      return   redirect('/categories')->with('success','deleted successfully');
    }
}
