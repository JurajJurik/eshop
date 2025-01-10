<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;

class CartManager extends Component
{
    #[Locked]
    public Product $product;

    //public $cartSize;

    //protected $listeners = ['productAddedToCart' => 'render'];

    public function addToCart(Product $product)
    {
        //dump($product);
        //Check if user is logged
        if (Auth::check()) {
            // saving products into cart db
            // ...
            return redirect()->back()->with('success', 'Product was added to cart.');
        }

        // Save cart information into session storage for non-logged users
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            //dump('test');
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

        //return redirect()->back()->with('success', 'Product was added to cart.');
        $this->dispatch('productAddedToCart');
    }

    public function render()
    {
        return view('livewire.cart-manager');
    }
}
