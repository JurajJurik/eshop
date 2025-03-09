<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (session('cart'))
        {
            $user_id = Auth::user()->id;
            $productsInsert = [];
            foreach (session('cart') as $key => $value) {
                for ($i=1; $i <= $value['quantity']; $i++) { 
                    array_push($productsInsert, [
                        'user_id' => $user_id, 
                        'product_id' => $key,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
            Cart::insert($productsInsert);
            session()->forget('cart');
        }

        return redirect()->intended(route('products.index', absolute: false))->with('success', 'You were successfully logged-in!');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('products.index'));
    }
}
