<?php

namespace App\Http\Controllers;

use App\Data\ProductSearchData;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductSearchData $data)
    {
        return response()->json($this->productService->listProducts($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->productService->create($request->data()),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->productService->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        return response()->json(
            $this->productService->update($product, $request->data())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->delete($id);
        return response()->json(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
