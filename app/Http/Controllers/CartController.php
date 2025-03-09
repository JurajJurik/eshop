<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = collect([]);
        $quantity = null;
        
        if (!Auth::check()) 
        {
            if (session('cart')) {
                $quantity = session('cart');
                foreach (session('cart') as $key => $value) {
                    $productIds[] = $key;
                }
                $products = Product::whereIn('id', $productIds)->get();
            }
        }
        else 
        {   
            $cartProducts = Cart::where('user_id', '=', Auth::user()->id)
                            ->groupBy('product_id')
                            ->select('product_id', DB::raw('count(product_id) as quantity'))
                            ->get();
            
            foreach ($cartProducts as $key => $cartProduct) {
                $productIds[] = $cartProduct->product_id;
                $quantity[$cartProduct->product_id] = ['quantity' => $cartProduct->quantity];
            }
            $products = Product::whereIn('id', $productIds)->get(); 
        }
        return view('cart.index', ['products' => $products, 'quantity' => $quantity]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
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
    public function update(Request $request, $productId)
    {
        if ($request->event == 'remove') {
            if (!Auth::check()) {
                if (isset(session('cart')[$productId])) 
                {
                    $cart = session()->get('cart', []);
                    unset($cart[$productId]);
                    session()->put('cart', $cart);
                }
            }
            else {
                Cart::where('user_id', '=', Auth::user()->id)
                        ->where('product_id','=', $productId)
                        ->delete();
            }
        }
        elseif ($request->event == 'sub') {
            if (!Auth::check()) {
                if (isset(session('cart')[$productId]) && session('cart')[$productId]['quantity'] > 1) 
                {
                    $cart = session()->get('cart', []);
                    $cart[$productId] = [
                        'quantity' => $cart[$productId]['quantity'] - 1
                    ];
                    session()->put('cart', $cart);
                }
            }
            else {
                Cart::where('user_id', '=', Auth::user()->id)
                        ->where('product_id','=', $productId)
                        ->take(1)
                        ->delete();
            }
        }
        elseif ($request->event == 'add') {
            if (!Auth::check()) {
                if (isset(session('cart')[$productId]) && session('cart')[$productId]['quantity'] >= 1) 
                {
                    $cart = session()->get('cart', []);
                    $cart[$productId] = [
                        'quantity' => $cart[$productId]['quantity'] + 1
                    ];
                    session()->put('cart', $cart);
                }
            }
            else {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId
                ]);
            }
        }
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function subQuantity()
    {
        // $quantity--;
        // if (!Auth::check()) {
        //     if (isset(session('cart')[$productId]) && $quantity > 1) 
        //     {
        //         $cart = session()->get('cart', []);
        //         $cart[$productId] = [
        //             'quantity' => $quantity
        //         ];
        //         session()->put('cart', $cart);
        //     }
        // }
        // else {
        //     Cart::where('user_id', '=', Auth::user()->id)
        //             ->where('product_id','=', $productId)
        //             ->take(1)
        //             ->delete();
        // }
        // return redirect()->route('cart.index');
    }
}
