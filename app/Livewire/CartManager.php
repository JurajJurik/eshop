<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use App\Models\Cart;

class CartManager extends Component
{
    #[Locked]
    public Product $product;

    public function addToCart(Product $product)
    {
        if (!Auth::check()) {
            // Save cart information into session storage for non-logged users
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $quantity = $cart[$product->id]['quantity'];
                $cart[$product->id] = [
                    'quantity' => $quantity
                ];
            }
            else {
                $cart[$product->id] = [
                    'quantity' => 1
                ];
            }

            session()->put('cart', $cart);

            $this->dispatch('productAddedToCart');
        }
        else
        {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id
            ]);
            $this->dispatch('productAddedToCart');
        }
    }

    public function render()
    {
        return view('livewire.cart-manager');
    }
}
