<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResorce;
use App\Model\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }

    public function index()
    {
        return  ProductCollection::collection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->save();
        return response([
            'data'=> new ProductResorce($product)
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return new ProductResorce($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        $request['detail']=$request->description;
        unset($request['description']);
        $product->update( $request->all());
        return response([
            'data'=> new ProductResorce($product)
        ],Response::HTTP_CREATED);
    }

    public function destroy(Product $product)
    {
       $product->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
