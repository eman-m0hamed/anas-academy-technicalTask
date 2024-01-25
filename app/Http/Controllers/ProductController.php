<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    function index()
    {
        $products = Product::get();
        return view('products.index', ['products' =>$products]);
    }

    function greatPrice()
    {
        $products = Product::get()->where("price", ">=", 3000);
        return view('products.index', ['products' =>$products]);
    }

    function show($id){
        $product = Product::find($id);
        if(!$product){
            return view('products.show', ['notFound' => "This Product doesn't Exist"]);
        }
        return view('products.show', ['product' => $product]);
    }
    function create(){
        $categories = Category::get();
        return view('products.create', ['categories' => $categories]);

    }

    function store(Request $request){
        $request->validate([
            'name'=>'required|string',
            'price'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'quantity'=>'required|integer',
            'category_id'=>'required|integer|exists:categories,id',

        ]);
        $newProduct = $request->all();
        Product::create($newProduct);
        return redirect('products')->with('success', "The Product is Created Successfully");

    }

    function update($id){
        $product = Product::find($id);
        if(!$product){
            return view('products.edit', ['notFound' => "This Product doesn't Exist"]);
        }
        $categories = Category::get();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    function edit($id, Request $request){
        $product = Product::find($id);
        $request->validate([
            'name'=>'required|string',
            'price'=>'required',
            'quantity'=>'required|integer',
            'category_id'=>'required|integer',

        ]);
        $updatedProduct = $request->except(['_method', '_token']);
        $product->Update($updatedProduct);
        return redirect('products/'.$product->id)->with('success', "The Product is Updated Successfully");

    }

    function destroy($id){
        $product = Product::find($id)->delete();
        return redirect('products')->with('success', "The Product is Deleted Successfully");
    }


}
