<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartPriceCounter extends Component
{
    public $products = [];
    public $quantity;

    public $totalPrice = 0;

    public $totalPriceWithoutVAT = 0;
    /**
     * Create a new component instance.
     */
    public function __construct($products, $quantity)
    {
        $this->products = $products;
        $this->quantity = $quantity;
        $this->calculatePrice($products, $quantity);
    }

    /**
     * Calculate price
     */
    public function calculatePrice($products, $quantity)
    {
        $price = 0;
        $priceWithoutVAT = 0;
        foreach ($products as $product) {
            $productPrice = $quantity[$product->id]['quantity'] * $product->price;
            $productPriceWithoutVAT = $quantity[$product->id]['quantity'] * $product->price_without_VAT;
            $price += $productPrice;
            $priceWithoutVAT += $productPriceWithoutVAT;
        }
        $this->totalPrice = $price;
        $this->totalPriceWithoutVAT = $priceWithoutVAT;

        return [$this->totalPrice, $this->totalPriceWithoutVAT];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-price-counter');
    }
}
