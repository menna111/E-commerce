<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\ImageUpload;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subcategoryController extends Controller
{
    use ImageUpload,ResponseTrait;

    public function index(){
        $subcategories=SubCategory::all();
        return view('admin.subcategory.index',compact('subcategories'));
    }

    public function add(){
        return view('admin.subcategory.add');
    }


    public function store(Request $request){

        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:categories',
                'description'  => 'required|string|min:3|max:255',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',

            ]);

        try {
            DB::beginTransaction();
            if ($request->has('image')){
                $image=$this->uploadImage($request->file('image'),'uploaded/subcategories',50);
            }else{
                $image=null;
            }
             SubCategory::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'image'     => $image,


            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
//            dd($exception->getMessage());
            return  redirect()->back()->with('error', 'something wrong happened');

        }
        return $this->returnSuccess('added successfully',200);
    }


    public function edit($id){
        $subcategory=SubCategory::whereId($id)->first();
        return view('admin.subcategory.edit',compact('subcategory','id'));


    }


    public function update(Request $request,$id){
        $category=SubCategory::findOrFail($id);
        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:sub_categories,id,' . $id,
                'description'  => 'required|string|min:3|max:255',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',

            ]);
        DB::beginTransaction();
        if ($request->has('image')){
            $image=$this->uploadImage($request->file('image'),'uploaded/subcategories',50);
        }else{
            $image=$category->image;
        }
        try{
            $category -> update([

                'name' => $request['name'],
                'description' => $request['description'],
                'image'     => $image,
            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
//            dd($exception->getMessage());
        }
        return $this->returnSuccess('updated successfully',201);
    }


    public function delete($id){
        $category=SubCategory::findOrFail($id);
        $category->delete();
        return   redirect('/sub_category')->with('success','deleted successfully');
    }



}
