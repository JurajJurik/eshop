<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Locked;

class CartIconCounter extends Component
{
    #[Locked]
    public $cartSize;

    protected $listeners = ['productAddedToCart'];

    public function mount()
    {
        if (session('cart')) {
            $this->cartSize = count(session('cart'));
        }
    }
    public function productAddedToCart()
    {
        if (session('cart')) { 
            $this->cartSize = count(session('cart'));
        }
    }

    // public function render()
    // {
    //     return view('livewire.cart-icon-counter');
    // }
}
