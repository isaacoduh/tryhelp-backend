<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Category::all();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $data
        ]);
    }

    public function show(Request $request, $id)
    {
        $data = Category::with('products')->where('id',$id)->get();

        return response()->json([
            'message' => 'Data Retrieved',
            'data' => $data
        ]);
    }
}
