<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

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


    function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'quantity' => 'required|integer',
                'category_id' => 'required|integer|exists:categories,id',

            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->errors(), "Please Validate Error", 400);
            }

            $input = $request->all();
            $newProduct = Product::create($input);
            return $this->sendResponse($newProduct, "The Product is Created Successfully");
        } catch (\Exception $error) {
            return $this->sendError($error, "server error", 500);
        }
    }
}
