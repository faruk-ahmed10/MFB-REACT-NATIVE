<?php

namespace App\Http\Controllers\Android\Api\Category;

use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        try {

            $categories = Category::orderBy('id', 'asc')->get();

            return CommonHelper::Response(true, "Categories fetched successfully!", null, $categories);
        } catch (Exception $e) {
            return CommonHelper::Response(false, $e->getMessage(), 'UNKNOWN', null);
        }
    }
}
