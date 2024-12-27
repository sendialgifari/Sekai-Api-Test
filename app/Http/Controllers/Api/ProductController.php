<?php

namespace App\Http\Controllers\Api;

//import model Product
use App\Models\Product;

use App\Http\Controllers\Controller;

//import resource ProductResource
use App\Http\Resources\ProductResource;

//import Http request
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all products
        $products = Product::with(['user'])->latest()->paginate(5);

        //return collection of products as a resource
        return new ProductResource(true, 'List Data Products', $products);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'serial_number'   => 'required',
            'user_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return new ProductResource(false, 'error', $validator->errors());
        }

        //create product
        $product = new Product;
        $product->name = $request->name;
        $product->serial_number = $request->serial_number;
        $product->user_id = $request->user_id;
        $product->save();

        //return response
        return new ProductResource(true, 'Data Product Berhasil Ditambahkan!', $product);
    }

    public function show($id)
    {
        //find product by ID
        $product = Product::with(['user'])->find($id);

        //return single product as a resource
        return new ProductResource(true, 'Detail Data Product!', $product);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'serial_number'   => 'required',
            'user_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return new ProductResource(false, 'error', $validator->errors());
        }

        //find product by ID
        $product = Product::find($id);
        $product->name = $request->name;
        $product->serial_number = $request->serial_number;
        $product->user_id = $request->user_id;
        $product->save();

        //return response
        return new ProductResource(true, 'Data Product Berhasil Diubah!', $product);
    }

    public function destroy($id)
    {

        //find product by ID
        $product = Product::find($id);
        //delete product
        $product->delete();

        //return response
        return new ProductResource(true, 'Data Product Berhasil Dihapus!', null);
    }
}