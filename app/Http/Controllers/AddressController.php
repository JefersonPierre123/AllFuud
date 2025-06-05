<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
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
            'client_id' => 'required|exists:clients,id',
            'cep' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',
        ]);
    
        try {
            $client = Address::create([
                'client_id' => $request->client_id,
                'cep' => $request->cep,
                'estado' => $request->state,
                'cidade' => $request->city,
                'bairro' => $request->neighborhood,
                'endereco' => $request->street,
                'numero' => $request->number,
                'complemento' => $request->complement,
            ]);
    
            return redirect()->back()->with('success', 'Endereço cadastrado com sucesso!');
            
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
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'cep' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',
        ]);

        $address = Address::findOrFail($id);

        try {
            $address->update([
                'client_id' => $request->client_id,
                'cep' => $request->cep,
                'estado' => $request->state,
                'cidade' => $request->city,
                'bairro' => $request->neighborhood,
                'endereco' => $request->street,
                'numero' => $request->number,
                'complemento' => $request->complement,
            ]);

            return redirect()->back()->with('success', 'Endereço atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar endereço: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
