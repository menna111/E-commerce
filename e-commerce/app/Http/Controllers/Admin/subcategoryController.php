<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subcategoryController extends Controller
{
    use ImageUpload;
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
        return  redirect('/sub_category/add')->with('status','sub Category Added successfully');
    }
}
