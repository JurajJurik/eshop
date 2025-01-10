<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$products = Product::all();

        $category = $request->query('category');
        $subcategory = $request->query('subcategory');
        $filter = request()->only('search');
        

        if ($category && !$subcategory) {
            $products = Product::where('category', '=', $category)
                                    ->withAvg('reviews','rating')
                                    ->withCount('reviews')
                                    ->filter($filter)
                                    ->paginate(9);
        }
        elseif ($category && $subcategory) {
            $products = Product::where('category', '=', $category)
                                    ->where('subcategory', '=', $subcategory)
                                    ->withAvg('reviews','rating')
                                    ->withCount('reviews')
                                    ->filter($filter)
                                    ->paginate(9);
        }
        else {
            $products = Product::filter($filter)
                                    ->withAvg('reviews','rating')
                                    ->withCount('reviews')
                                    ->paginate(9);
        }

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Product $product)
    {
        
        $product =  Product::with('reviews')
                    ->withAvg('reviews','rating')
                    ->withCount('reviews')
                    ->findOrFail($product->id);
        $reviewsCounts = $product->reviews->groupBy('rating')->map(function ($group) {
            return $group->count();
        });

        $counts = [];
        for ($i = 5; $i >= 1; $i--) {
            $counts[$i] = isset($reviewsCounts[$i]) ? $reviewsCounts[$i] : 0; 
        }
        return view('products.show', ['product' => $product, 'counts' => $counts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
