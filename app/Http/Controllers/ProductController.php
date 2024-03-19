<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();

        if($product->count() > 0 ) {
            return view('products.index', ['products' => $product]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records'
            ], 404);
        }
        //return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            $newProduct = Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'description' => $request->description
            ]);

            if($newProduct) {

                return redirect(route('products.index'));

            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Error!'
                ], 500);
            }
        }
    }

    public function edit($id){
        $products=Product::find($id);

        if($products){
            /*return response()->json([
                'status' => 422,
                'message' => $products
            ], 422); */
            
            return view('products.edit', ['product' => $products]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Error!'
            ], 500);
        }
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }else{
            $products=Product::find($id);
            if($products){
                $products->update([
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'description' => $request->description
                ]);
                return redirect(route('products.index'))->with('success', 'Product successfully updated');
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Error!'
                ], 500);
            }
        }
    }

    public function destroy($id){
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect(route('products.index'))->with('success', 'Product successfully deleted');
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Error!',
            ], 500);
        }
    }
};
