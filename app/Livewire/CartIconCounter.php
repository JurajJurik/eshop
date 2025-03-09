<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\DB;

class CartIconCounter extends Component
{
    #[Locked]
    public $cartSize;

    protected $listeners = ['productAddedToCart'];

    public function mount()
    {
        if (!Auth::check()) {
            if (session('cart')) {
                $this->cartSize = count(session('cart'));
            }
        }
        else {
            $this->cartSize = count(Cart::where('user_id', '=', Auth::user()->id)
                                ->groupBy('product_id')
                                ->select('product_id', DB::raw('count(product_id) as quantity'))
                                ->get());
        }
    }
    public function productAddedToCart()
    {
        if (!Auth::check()) {
            if (session('cart')) {
                $this->cartSize = count(session('cart'));
            }
        }
        else {
            $this->cartSize = count(Cart::where('user_id', '=', Auth::user()->id)
                                ->groupBy('product_id')
                                ->select('product_id', DB::raw('count(product_id) as quantity'))
                                ->get());
        }
    }
}
