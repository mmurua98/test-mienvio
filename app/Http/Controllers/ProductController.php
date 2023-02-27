<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $byName = $request->get('byName');
        $min_price = $request->get('min_price');
        $max_price = $request->get('max_price');

        //$products = Product::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('name', 'ASC')->ByName($byName)->FilterPrice($min_price, $max_price)->get();
        // $products = DB::table('products')
        //                     ->where('price', '>=', '%'.$min_price.'%')
        //                     ->where('price', '<=', '%'.$max_price.'%')
        //                     ->where('name', 'LIKE', '%'.$byName.'%')
        //                     ->get();
        
        //dd($products);
        return view('index', compact('products', 'byName', 'min_price', 'max_price'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
            ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        
        return Response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
            ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        return Response()->json($product);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Response()->json($product);
    }
}
