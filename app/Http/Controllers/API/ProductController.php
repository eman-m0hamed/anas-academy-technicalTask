<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function index(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);

            $products = Product::paginate($limit, ['*'], 'page', $page);

            $response = [
                'success' => true,
                'currentPage' => $products->currentPage(),
                'perPage' => $products->perPage(),
                'totalPages' => $products->lastPage(),
                'totalProducts' => $products->total(),
                'products' => $products->items(),
                'message' => "Products data is Retrieved successfully",
            ];

            return response()->json($response, 200);
        } catch (\Exception $error) {
            $response = [
                'success' => false,
                'error' => "Server Error",
            ];
            return response()->json($response, 500);
        }
    }
}
