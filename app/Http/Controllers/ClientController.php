<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;	

class ClientController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cpf' => 'required|unique:clients|string|max:18',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birth_date' => 'nullable|date|max:1000',
            'phone' => 'required|string|max:20',
        ]);
    
        try {
            $client = Client::create([
                'cpf' => $request->cpf,
                'nome' => $request->name,
                'sobrenome' => $request->surname,
                'nascimento' => $request->birth_date,
                'telefone' => $request->phone,
            ]);
    
            if (Auth::check()) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $user->client_id = $client->id;
                $user->save();
            }
    
            return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $validated = $request->validate([
            'cpf' => 'required|string|max:18',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birth_date' => 'nullable|date|max:1000',
            'phone' => 'required|string|max:20',
        ]);
    
        try {
            $client->update([
                'cpf' => $request->cpf,
                'nome' => $request->name,
                'sobrenome' => $request->surname,
                'nascimento' => $request->birth_date,
                'telefone' => $request->phone,
            ]);
    
            return redirect()->back()->with('success', 'Cliente atualizado com sucesso!');
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }
}
