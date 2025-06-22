<?php
namespace App\Http\Controllers;

use App\Models\Client;
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
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $item['imagem'] = $product->imagem;
                $item['valor'] = $product->valor;
                $item['nome'] = $product->nome;
            } else {
                unset($item);
            }
        }
        $client = auth()->user()->client;
        if ($cart && $client) {
            $cart->client_id = $client->id;
            $cart->save();
        }
        return view('checkout.checkout', compact('cart', 'items'));
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

    public function saveAddress(Request $request)
    {
        $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
        $cart = Cart::where('token', $token)->first();
        $address = $cart ? $cart->address : [];

        $setAddress = [
            'cep' => $request->input('cep'),
            'rua' => $request->input('street'),
            'numero' => $request->input('number'),
            'complemento' => $request->input('complement'),
            'bairro' => $request->input('neighborhood'),
            'cidade' => $request->input('city'),
            'estado' => $request->input('state'),
        ];

        $cart = Cart::updateOrCreate(
            ['token' => $token],
            ['address' => $setAddress]
        );

        return redirect()->back()->with('success', 'Endereço salvo com sucesso!');
    }

    public function removeAddress(Request $request)
    {
        $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
        $cart = Cart::where('token', $token)->first();
        if ($cart) {
            $cart->address = null;
            $cart->save();
        }
        return redirect()->back()->with('success', 'Endereço removido com sucesso!');
    }

    public function removeItem(Request $request)
{
    $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
    $cart = Cart::where('token', $token)->first();

    if ($cart && isset($request->item_index)) {
        $items = $cart->items ?? [];
        unset($items[$request->item_index]);
        $cart->items = array_values($items);
        $cart->save();
    }

    return redirect()->route('cart.index')->with('success', 'Produto removido do carrinho!');
}

    public function showCheckoutResume(Request $request)
    {
        $token = $request->cookie('cart_token') ?? ($_COOKIE['cart_token'] ?? null);
        $cart = Cart::where('token', $token)->first();
        if (!$cart) {
            return redirect()->route('checkout')->with('error', 'Carrinho não encontrado.');
        }
        $client = Client::find($cart->client_id);
        $items = $cart->items;
        $address = $cart->address;

        setcookie('cart_token', '', time() - 3600, '/');
        
        return view('checkout.resume', compact('client', 'address', 'items'));
    }

}