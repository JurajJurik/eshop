<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $product    ->load('reviews')
                    ->loadAvg('reviews','rating')
                    ->loadCount('reviews');
        $reviewsCounts = $product->reviews->groupBy('rating')->map(function ($group) {
            return $group->count();
        });
        $counts = [];
        for ($i = 5; $i >= 1; $i--) {
            $counts[$i] = isset($reviewsCounts[$i]) ? $reviewsCounts[$i] : 0; 
        }
        return view('products.reviews.index', ['product' => $product, 'counts' => $counts]);
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
    public function show(string $id)
    {
        //
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
