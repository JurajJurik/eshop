<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\Locked;

class HelpfulCounter extends Component
{
    #[Locked]
    public $id;
    public Review $review;

    protected $listeners = ['review-incremented' => 'render'];
 
    public function increment(Review $review)
    {
        $review->update([
            'helpful' => $review->helpful + 1
        ]);
        $this->dispatch('review-incremented');
    }
    public function render()
    {
        return view('livewire.helpful-counter');
    }
}
