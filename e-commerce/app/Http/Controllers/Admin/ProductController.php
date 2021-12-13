<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ImageUpload;

    public function index(){
        $products=product::all();
        return view('admin.product.index',compact('products'));
    }
    public function add(){
        $categories=Category::all();
        return view('admin.product.add',compact('categories'));
    }
    public function store(Request $request){
        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:products',
                'slug'         => 'required|string|min:3|max:255',
                'small_description'  => 'required|string|min:3|max:255',
                'description'  => 'required|string|min:3|max:255',
                'original_price'=>'required|numeric',
                'selling_price'=>'required|numeric',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',
                'qty'     =>'required|numeric',
                'tax'     =>'required|numeric',
                'meta_title'  => 'required|string|min:3|max:255',
                'meta_keywords'  => 'required|string|min:3|max:255',
                'meta_description'  => 'required|string|min:3|max:255',

            ]);

        try {
            DB::beginTransaction();
            if ($request->has('image')){
                $image=$this->uploadImage($request->file('image'),'uploaded/categories',50);
            }else{
                $image=null;
            }
            $product = product::create([
                'cate_id'=>$request['cate_id'],
                'name' => $request['name'],
                'slug' => $request['slug'],
                'small_description' => $request['small_description'],
                'description' => $request['description'],
                'original_price'=>$request->input('original_price'),
                'selling_price'=>$request['selling_price'],
                'image'     => $image,
                'qty' => $request['qty'],
                'tax' => $request['tax'],
                'status' => $request['status'] == TRUE ? 1 : 0,
                'trending' => $request['trending'] == TRUE ? 1 : 0,
                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
//            return  redirect()->back()->with('error', 'something wrong happened');

        }
        return  redirect('/products')->with('status','Product Added successfully');
    }

    public function edit($id){
        $product=product::findOrfail($id);
        $categories=Category::all();
        return view('admin.product.edit',compact('product','categories'));
    }
    public function update(Request $request,$id){
        $product=product::findOrFail($id);

        //validation
        $request->validate(
            [
                'name'        => 'required|string|min:3|max:255,unique:products'. $id,
                'slug'         => 'required|string|min:3|max:255',
                'small_description'  => 'required|string|min:3|max:255',
                'description'  => 'required|string|min:3|max:255',
                'original_price'=>'required|numeric',
                'selling_price'=>'required|numeric',
                'image'          => 'nullable|file|mimes:png,jpg,jpeg,svg',
                'qty'     =>'required|numeric',
                'tax'     =>'required|numeric',
                'meta_title'  => 'required|string|min:3|max:255',
                'meta_keywords'  => 'required|string|min:3|max:255',
                'meta_description'  => 'required|string|min:3|max:255',

            ]);

        try {
            DB::beginTransaction();
            if ($request->has('image')){
                $image=$this->uploadImage($request->file('image'),'uploaded/categories',50);
            }else{
                $image=null;
            }
            $product ->update([
                'cate_id'=>$request['cate_id'],
                'name' => $request['name'],
                'slug' => $request['slug'],
                'small_description' => $request['small_description'],
                'description' => $request['description'],
                'original_price'=>$request->input('original_price'),
                'selling_price'=>$request['selling_price'],
                'image'     => $image,
                'qty' => $request['qty'],
                'tax' => $request['tax'],
                'status' => $request['status'] == TRUE ? 1 : 0,
                'trending' => $request['trending'] == TRUE ? 1 : 0,
                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
            ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
//            dd($exception->getMessage());
            return  redirect()->back()->with('error', 'something wrong happened');

        }
        return  redirect('/products')->with('status','Product updated successfully');
    }


    public function delete($id){
        $product=product::findOrFail($id);
        $product->delete();
        return  redirect('/products')->with('status','Product deleted successfully');


    }

}
