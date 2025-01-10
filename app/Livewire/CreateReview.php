<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithFileUploads;


class CreateReview extends Component
{
    use WithFileUploads;
    public $rating;
    public $description = '';
    public $advantages = [];
    public $disadvantages = [];
    public $photos = [];
    public Product $product;
    public Review $review;

    protected function messages() 
    {
        return [
            'rating.required' => 'The :attribute is required.',
            'photos.*.mimes' => 'Only .jpeg and .jpg extension are enabled.',
            'photos.*.max' => 'File size can not exceed 4 MB.'
        ];
    }

    protected $listeners = ['ratingSelected', 'advantagesSaved', 'disadvantagesSaved'];
    public function ratingSelected($rating)
    {
        $this->rating = $rating;
    }

    public function advantagesSaved($advantages)
    {
        $this->advantages = $advantages;
    }

    public function disadvantagesSaved($disadvantages)
    {
        $this->disadvantages = $disadvantages;
    }

    public function save($product)
    {
        $this->advantages ? $this->advantages : [];
        $this->disadvantages ? $this->disadvantages : [];

        $validatedData = $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'nullable|string|max:65355',
            'advantages' => 'nullable|array',
            'advantages.*' => 'nullable|string|max:255',
            'disadvantages' => 'nullable|array',
            'disadvantages.*' => 'nullable|string|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'file|mimes:jpeg,jpg,JPG|max:4096'
        ]);

        $product = Product::findOrFail($product['id']);

        $review = Review::create([
            'rating' => $validatedData['rating'],
            'description' => $validatedData['description'],
            'advantages' => json_encode($validatedData['advantages']),
            'disadvantages' => json_encode($validatedData['disadvantages']),
            'product_id' => $product['id']
        ]);

        foreach ($validatedData['photos'] as $photo) {
            $review->addMedia($photo)->toMediaCollection('reviews_photos');
        }

        return redirect()->route('products.reviews.index', $product)->with('success', 'Review created sucessfully!');
    }

    public function render()
    {
        return view('livewire.create-review');
    }
}
