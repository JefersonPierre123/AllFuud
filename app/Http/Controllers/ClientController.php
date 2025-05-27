<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = $request->validate([
            'cpf' => 'required|string|max:18',
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

            $clientId = $client->id;
    
            return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!')
                                     ->with('client_id', $client->id);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar: ' . $e->getMessage());
        }
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
    public function edit(string $id)
    {
        //
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
