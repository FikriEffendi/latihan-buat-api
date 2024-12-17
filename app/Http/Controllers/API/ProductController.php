<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ResponseFormatter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = auth()->user()->products->pluck('api_response');

        return ResponseFormatter::success($products);
        // dd($product); Untuk testing(debug) $product 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = auth()->user()->products()->findOrFail($id);

        return ResponseFormatter::success($product->api_response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
