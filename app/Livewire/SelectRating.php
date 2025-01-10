<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;


class SelectRating extends Component
{
    public Review $review;

    
    public $ratingSelected = 0;
    public $ratingPointed = 0;

 
    public function changeRating($rating)
    {
            $this->ratingPointed = $rating;
    }

    public function setRating($rating)
    {
        $this->ratingSelected = $rating;
        $this->dispatch('ratingSelected', rating: $this->ratingSelected);
    }

    public function render()
    {
        return view('livewire.select-rating');
    }
}
