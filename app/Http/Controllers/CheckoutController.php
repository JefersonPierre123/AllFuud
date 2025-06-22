<?php
namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use App\Models\Cart;
use App\Models\Product;

class CheckoutController extends Controller
{

    public function showCart(Request $request)
    {
        $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
        $cart = Cart::where('token', $token)->first();
        $items = $cart ? $cart->items : [];

        return view('cart.cart', compact('items'));
    }
    public function showCheckoutForm(Request $request)
    {
        $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
        $cart = Cart::where('token', $token)->first();
        $items = $cart ? $cart->items : [];

        return view('checkout.checkout-form', compact('items'));

    }

    public function createCart(Request $request)
    {
        $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
        if (!$token) {
            $token = Uuid::uuid4()->toString();
            setcookie('cart_token', $token, time() + (60 * 60 * 24 * 7), '/');
        }

        $cart = Cart::where('token', $token)->first();

        $product = Product::find($request->input('product_id'));

        $items = $cart ? $cart->items : [];

        $found = false;

        foreach ($items as &$item) {
            if ($item['product_id'] == $product->id) {
                // Product already in cart, increment quantity
                $item['quantidade'] = isset($item['quantidade']) ? $item['quantidade'] + 1 : 2;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            // Product not in cart, add it
            $newItem = [
                'product_id' => $product->id,
                'nome' => $product->nome,
                'valor' => $product->valor,
                'quantidade' => '1',
                'imagem' => $product->imagem,
            ];

            $items[] = $newItem;
        }

        $cart = Cart::updateOrCreate(
            ['token' => $token],
            ['items' => $items]
        );

        return redirect()->route('cart.index')->with('success', 'Cart created!');
    }

}