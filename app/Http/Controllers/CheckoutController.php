<?php
namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function showCheckoutForm(Request $request)
    {
        $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
        $cart = Cart::where('token', $token)->first();
        $items = $cart ? $cart->items : [];

        return view('checkout.checkout-form', compact('items'));
        
    }

    public function createCart()
    {
        $uuid = Uuid::uuid4()->toString();
        
        
        //MOSTRAR ITEMS DA TABELA CARTS
        if($_COOKIE['cart_token'] ?? null) {
            //adicionar logica para adicionar mais produtos ao carrinho
            return redirect()->route('checkout')->with('success', 'Cart created!');
        }
        setcookie('cart_token', $uuid, time() + (60 * 60 * 24 * 7), '/');
        return redirect()->route('checkout')->with('success', 'Cart created!');
    }

}