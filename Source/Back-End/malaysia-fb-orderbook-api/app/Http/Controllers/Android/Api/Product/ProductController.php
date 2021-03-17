<?php

namespace App\Http\Controllers\Android\Api\Product;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        try {
            $category_id = (int) $request->input('category_id');

            $products = Product::where('category_id', '=', $category_id)->orderBy('id', 'asc')->get();

            return CommonHelper::Response(true, "Products fetched successfully!", null, $products);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }
}
