<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = auth()->user()->products();
        if (!is_null(request()->search)) {
            $query->where('name', 'LIKE', '%' . request()->search . '%');
        }

        // $products = $query->get()->pluck('api_response');
        // $products = $query->paginate(request()->per_page);
        $products = $query->paginate(10);
        $products->getCollection()->transform(function ($item) {
            return $item->api_response;
        });

        return ResponseFormatter::success($products);
        // dd($product); Untuk testing(debug) $product 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), $this->getValidation());

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $product = auth()->user()->products()->create([
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
        ]);

        return $this->show($product->id);
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
        $validator = Validator::make(request()->all(), $this->getValidation());

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $product = auth()->user()->products()->findOrFail($id);

        $product->update([
            'name' => request()->name,
            'description' => request()->description,
            'price' => request()->price,
        ]);

        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = auth()->user()->products()->findOrFail($id);

        $product->delete();

        return ResponseFormatter::success([
            'is_deleted' => true,
        ]);
    }

    public function getValidation()
    {
        return [
            'name' => "required|min:2|max:20|",
            'description' => "nullable|max:200",
            'price' => "required|numeric"
        ];
    }
}
