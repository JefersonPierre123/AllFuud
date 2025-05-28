<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        echo $credentials['email'];
        echo $credentials['password'];

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended(route('index'));
        }

        return back()->withErrors([
            'email' => 'As credenciais informadas não conferem.',
        ])->withInput();
    }
}