<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // É uma boa prática validar os campos antes de tentar a autenticação
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // Tenta autenticar o usuário
        if (Auth::attempt($credentials)) {
            // Regenera a sessão para previnir ataques de "session fixation" (boa prática)
            $request->session()->regenerate();

            // Pega o usuário autenticado
            $user = Auth::user();

            // --- INÍCIO DA LÓGICA DE REDIRECIONAMENTO ---

            // 1. Se o usuário tem um ID de estabelecimento, vai para a página do estabelecimento
            if ($user->establishment_id) {
                return redirect()->route('establishments.show', ['establishment' => $user->establishment_id]);
            }
            
            // 2. Se não, mas tem um ID de cliente, vai para a página inicial
            elseif ($user->client_id) {
                return redirect()->route('index');
            }

            // 3. Caso contrário (não tem nenhum dos dois), vai para o perfil
            else {
                return redirect()->route('profile.index');
            }
            
            // --- FIM DA LÓGICA DE REDIRECIONAMENTO ---
        }

        // Se a autenticação falhar, retorna para a página anterior com erro
        return back()->withErrors([
            'email' => 'As credenciais informadas não conferem.',
        ])->onlyInput('email'); // onlyInput() é mais seguro que withInput() pois não retorna a senha
    }
}