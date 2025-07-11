<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for fulfilling order address.
     */
    public function address()
    { 
        if (!session()->get('cart')) {
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty! Add product, please.');
        }
        if (Auth::check()) {
            return view('orders.address',['user' => Auth::user()->load('address')]);
        }
        return view('orders.address');
    }

    /**
     * Validate order address
     */
    public function validateAddress(Request $request)
    {
        $validatedData = $this->validation($request);

        session()->put('order_address', $validatedData);

        //return view('orders.delivery', ['validatedAddress' => $validatedData]);
        return redirect()->route('delivery');
    }

    /**
     * Show the form for fulfilling order delivery
     */
    public function delivery()
    {
        if (!session()->get('cart')) {
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty! Add product, please.');
        }   
        // if (Auth::check()) {
        //     return view('orders.address',['user' => Auth::user()->load('address')]);
        // }
        return view('orders.delivery');
    }

    /**
     * Validate payment and delivery method
     */
    public function validateMethods(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method' => 'required|in:'  . implode(',', User::$paymentMethod),
            'delivery_method' => 'required|in:'  . implode(',', User::$deliveryMethod),
        ]);

        switch ($validatedData['payment_method']) {
            case 'credit or debit card':
                $payment_fee = 0;
                break;
            case 'google pay':
                $payment_fee = 0;
                break;
            case 'account transfer':
                $payment_fee = 0;
                break;
            case 'cryptocurrency':
                $payment_fee = 0;
                break;
            case 'cash on delivery':
                $payment_fee = 1;
                break;
        }

        switch ($validatedData['delivery_method']) {
            case 'delivery box':
                $delivery_fee = 3;
                break;
            case 'personal pickup - shop':
                $delivery_fee = 0;
                break;
            case 'personal pickup - partner shop':
                $delivery_fee = 0;
                break;
            case 'home delivery':
                $delivery_fee = 4;
                break;
        }

        $validatedData['payment_fee'] = $payment_fee;
        $validatedData['delivery_fee'] = $delivery_fee;

        session()->put('order_methods', $validatedData);

        return redirect()->route('summary');
    }

    /**
     * Show summary of the order
     */
    public function summary(Request $request)
    {
        if (!session()->get('cart')) {
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty! Add product, please.');
        }

        $productQuantities = array();
        foreach (session()->get('cart') as $id => $quantity) {
            $productIds[] = $id;
            $productQuantities[$id] = $quantity;
        }
        $products = Product::whereIn('id', $productIds)->get(); 

        $orderData = new \stdClass();
        $orderData->products = $products;
        $orderData->quantities = $productQuantities;
        $orderData->address = session()->get('order_address');
        $orderData->methods = session()->get('order_methods');

        return view('orders.summary', ['orderData' => $orderData]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|regex:/^\+?\d+$/|max:255',
            'street' => 'required|string|max:255',
            'street_number' => 'required|string|regex:/^[a-zA-Z0-9\/]+$/|max:255',
            'post_code' => 'required|string|regex:/^[0-9-]+$/|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'shipping_street' => 'exclude_unless:different_address,true|string|max:255',
            'shipping_street_number' => 'exclude_unless:different_address,true|string|regex:/^[a-zA-Z0-9\/]+$/|max:255',
            'shipping_post_code' => 'exclude_unless:different_address,true|string|regex:/^[0-9-]+$/|max:255',
            'shipping_city' => 'exclude_unless:different_address,true|string|max:255',
            'shipping_country' => 'exclude_unless:different_address,true|string|max:255',
        ]);

        //$validatedData = $this->validation($request);

        $cartProducts = Cart::where('user_id', '=', Auth::user()->id)
                            ->groupBy('product_id')
                            ->select('product_id', DB::raw('count(product_id) as quantity'))
                            ->get();
            
        foreach ($cartProducts as $key => $cartProduct) {
            $productIds[] = $cartProduct->product_id;
            $quantity[$cartProduct->product_id] = ['quantity' => $cartProduct->quantity];
        }
        $products = Product::whereIn('id', $productIds)->get(); 

        $price = 0;
        $priceWithoutVAT = 0;
        foreach ($products as $product) {
            $productPrice = $quantity[$product->id]['quantity'] * $product->price;
            $productPriceWithoutVAT = $quantity[$product->id]['quantity'] * $product->price_without_VAT;
            $price += $productPrice;
            $priceWithoutVAT += $productPriceWithoutVAT;
        }

        $order_address = [
            'street' => $validatedData['street'],
            'street_number' => $validatedData['street_number'],
            'post_code' => $validatedData['post_code'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country']
        ];

        if ($request['different_address']) {
            $shipping_address = [
                'shipping_street' => $validatedData['shipping_street'],
                'shipping_street_number' => $validatedData['shipping_street_number'],
                'shipping_post_code' => $validatedData['shipping_post_code'],
                'shipping_city' => $validatedData['shipping_city'],
                'shipping_country' => $validatedData['shipping_country']
            ];
        }
        else {
            $shipping_address = null;
        }

        $order = Order::create([
            'invoice_number' => date('Ymd') . rand(1000, 9999) . date('His'),
            'user_id' => Auth::user()->id,
            'name' => $validatedData['first_name'] . " " . $validatedData['last_name'],
            'email' => $validatedData['email'],
            'currency' => 'EUR',
            'products' => json_encode($products),
            'quantity' => json_encode($quantity),
            'total_price_without_VAT' => $priceWithoutVAT,
            'total_price' => $price,
            'order_address' => json_encode($order_address),
            'shipping_address' => json_encode($shipping_address) ?? null,
            'order_status' => 'created'
        ]);

        return view('orders.delivery', ['validatedAddress' => $validatedData]);
    }

    /**
     * Validate method
     */
    private function validation($request)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|regex:/^\+?\d+$/|max:255',
            'street' => 'required|string|max:255',
            'street_number' => 'required|string|regex:/^[a-zA-Z0-9\/]+$/|max:255',
            'post_code' => 'required|string|regex:/^[0-9-]+$/|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'shipping_street' => 'exclude_unless:different_address,true|string|max:255',
            'shipping_street_number' => 'exclude_unless:different_address,true|string|regex:/^[a-zA-Z0-9\/]+$/|max:255',
            'shipping_post_code' => 'exclude_unless:different_address,true|string|regex:/^[0-9-]+$/|max:255',
            'shipping_city' => 'exclude_unless:different_address,true|string|max:255',
            'shipping_country' => 'exclude_unless:different_address,true|string|max:255',
        ]);
    }

    /**
     * Display payment page
     */
    public function paymentOrder(Request $request)
    {

        return view('orders.payment');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Order $order)
    {
        return view('payments.payment');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
