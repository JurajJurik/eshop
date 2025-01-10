<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;
use App\Models\Product;

class CartProductCard extends Component
{
    #[Locked]
    public $productId;

    public Product $product;
    
    public $quantity;

    public function subQuantity($productId)
    {
        if (isset(session('cart')[$productId]) && $this->quantity > 1) 
        {
            $this->quantity--;
            $cart = session()->get('cart', []);
            $cart[$productId] = [
                'quantity' => $this->quantity
            ];
            session()->put('cart', $cart);
        }
    }

    public function addQuantity($productId)
    {
        if (isset(session('cart')[$productId]) && $this->quantity >= 1) 
        {
            $this->quantity++;
            $cart = session()->get('cart', []);
            $cart[$productId] = [
                'quantity' => $this->quantity
            ];
            session()->put('cart', $cart);
        }
    }

    public function render()
    {
        return view('livewire.cart-product-card');
    }
}
