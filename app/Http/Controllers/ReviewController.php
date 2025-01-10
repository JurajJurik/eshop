<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $product    ->loadAvg('reviews','rating')
                    ->loadCount('reviews');
        
        $reviews = Review::where('product_id', '=', $product->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        foreach ($reviews as $review) {
            //dump($review);
            $media = $review->getMedia('reviews_photos');
            $review->push($media);
            //dd($review);
        }
        
        //$media = $post->getMedia('images');

        $reviewsCounts = $product->reviews->groupBy('rating')->map(function ($group) {
            return $group->count();
        });
        $counts = [];
        for ($i = 5; $i >= 1; $i--) {
            $counts[$i] = isset($reviewsCounts[$i]) ?: 0; 
        }

        return view('products.reviews.index', ['product' => $product, 'reviews' => $reviews, 'counts' => $counts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('products.reviews.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        //handled by livewire component
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
