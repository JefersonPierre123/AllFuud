<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('auth.user-registration-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('welcome')->with('success', 'Registro realizado com sucesso! Você está logado.');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('index')->with('success', 'Você foi desconectado com sucesso.');
    }
}