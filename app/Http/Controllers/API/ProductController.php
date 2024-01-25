<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseController
{
    function index(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);

            $products = Product::paginate($limit, ['*'], 'page', $page);

            $details = [
                'currentPage' => $products->currentPage(),
                'perPage' => $products->perPage(),
                'totalPages' => $products->lastPage(),
                'totalProducts' => $products->total()
            ];

            return $this->sendResponse($products->items(), "Products data is Retrieved successfully", $details);

        } catch (\Exception $error) {
            return $this->sendError($error, "server error", 500);
        }
    }
}
