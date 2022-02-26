<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use App\Models\SubCategory;
use App\Traits\ImageUpload;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ImageUpload,ResponseTrait;

    public function index(){
        $products=product::all();
        return view('admin.product.index',compact('products'));
    }
    public function add(){
        $categories=Category::all();
        $sub_category=SubCategory::all();

        return view('admin.product.add',compact('categories','sub_category'));
    }
    public function store(Request $request){
        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:products',
                'sub_category_id'        => 'required',
                'description'  => 'required|string|min:3|max:255',
                'after_sale'=>'required|numeric',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',
                'qty'     =>'required|numeric',
                'tax'     =>'required|numeric',


            ]);

        try {
            DB::beginTransaction();
            $image = $request->has('image') ? $this->uploadImage($request->file('image'),'uploaded/categories',50) : null;
//            if ($request->has('image')){
//                $image=$this->uploadImage($request->file('image'),'uploaded/categories',50);
//            }else{
//                $image=null;
//            }

            $product = product::create([
                'cate_id'=>$request['cate_id'],
                'sub_category_id'=>$request['sub_category_id'],
                'name' => $request['name'],
                'description' => $request['description'],
                'original_price' =>$request['original_price'],
                'after_sale'=>$request['after_sale'],
                'image'     => $image,
                'qty' => $request['qty'],
                'tax' => $request['tax'],
                'trending' => $request['trending'] == TRUE ? 1 : 0,

            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
            return  $this->returnError('error',400);

        }
        return  $this->returnSuccess('Product Added successfully',200);

    }

    public function edit($id){
        $product=product::findOrfail($id);
        $categories=Category::all();
        $sub_category=SubCategory::all();
        return view('admin.product.edit',compact('product','categories','sub_category'));
    }
    public function update(Request $request,$id){
//        dd($request['sub_category_id']);
        $product=product::findOrFail($id);

        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:products'. $id,
                'sub_category_id'        =>'required',
                'description'  => 'required|string|min:3|max:255',
                'original_price'=>'required|numeric',
                'after_sale'=>'required|numeric',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',
                'qty'     =>'required|numeric',
                'tax'     =>'required|numeric',


            ]);

        try {
            DB::beginTransaction();
            if ($request->has('image')){
                $image=$this->uploadImage($request->file('image'),'uploaded/categories',50);
            }else{
                $image=$product->image;
            }
            $product ->update([
                'cate_id'=>$request['cate_id'],
                'sub_category_id'=>$request['sub_category_id'],
                'name' => $request['name'],
                'description' => $request['description'],
                'original_price'=>$request->input('original_price'),
                'after_sale'=>$request['after_sale'],
                'image'     => $image,
                'qty' => $request['qty'],
                'tax' => $request['tax'],
                'trending' => $request['trending'] == TRUE ? 1 : 0,

            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
//            dd($exception->getMessage());
            return  $this->returnError('error',400);

        }
        return  $this->returnSuccess('Product updated successfully',201);
    }


    public function delete($id){
        $product=product::findOrFail($id);
        $product->delete();
        return  redirect('/products')->with('status','Product deleted successfully');


    }

}
