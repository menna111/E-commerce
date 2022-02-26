<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ImageUpload;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    use ImageUpload,ResponseTrait;



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

                'description'  => 'required|string|min:3|max:255',

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

                'description' => $request['description'],

                'popular' => $request['popular'] == TRUE ? 1 : 0,

                'image'     => $image,
            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
            return $this->returnError('some thing wrong',400);

        }

        return $this->returnSuccess('added successfully',200);
    }



    public function edit($id){
        $category=Category::findOrFail($id);
        return view('admin.Category.edit',compact('category','id'));
    }


    public function update(Request $request,$id){
        $category=Category::findOrFail($id);
        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:categories,id,' . $id,

                'description'  => 'required|string|min:3|max:255',

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
                'description' => $request['description'],

                'popular' => $request['popular'] == TRUE ? 1 : 0,

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
        $category=Category::findOrFail($id);
        $category->delete();
      return   redirect('/category')->with('success','deleted successfully');
    }
}
