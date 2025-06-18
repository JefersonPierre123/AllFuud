<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Establishment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * @method Response authorize($ability, $arguments = [])
 */
class EstablishmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cnpj' => 'required|string|max:18|unique:establishments,cnpj',
            'name' => 'required|string|max:255',
            'unit_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255|unique:establishments,email_contato',
            'cep' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);
    
        try {
            $establishment = Establishment::create([
                'imagem' => null,
                'cnpj' => $request->cnpj,
                'nome_franquia' => $request->name,
                'nome_unidade' => $request->unit_name,
                'descricao' => $request->description,
                'categoria' => $request->category,
                'telefone' => $request->phone,
                'email_contato' => $request->contact_email,
                'cep' => $request->cep,
                'estado' => $request->state,
                'cidade' => $request->city,
                'bairro' => $request->neighborhood,
                'endereco' => $request->street,
                'numero' => $request->number,
                'complemento' => $request->complement,
            ]);
    
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $imageName = 'estabelecimento-' . $establishment->id . '.' . $extension;
    
                $request->file('image')->storeAs('images/establishments', $imageName, 'public');
    
                $establishment->update([
                    'imagem' => $imageName
                ]);
            }
    
            if (Auth::check()) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $user->establishment_id = $establishment->id;
                $user->save();
            }
    
            return redirect()->back()->with('success', 'Estabelecimento cadastrado com sucesso!');
        
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Establishment $establishment)
    {
        $this->authorize('view', $establishment);

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        $isOwner = $user && $user->can('update', $establishment);

        if ($isOwner) {
            $establishment->load(['products' => function ($query) {
                $query->orderBy('ativo', 'desc')->orderBy('nome', 'asc');
            }]);
        } else {
            $establishment->load(['products' => function ($query) {
                $query->where('ativo', true)->orderBy('nome', 'asc');
            }]);
        }
        return view('establishments.show', compact('establishment'));

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Establishment $establishment)
    {
        $this->authorize('update', $establishment);

        $validated = $request->validate([
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cnpj' => 'required|string|max:18',
            'name' => 'required|string|max:255',
            'unit_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255|unique:establishments,email_contato,' . $establishment->id,
            'cep' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);
    
        try {
            $dataToUpdate = [
                'cnpj' => $validated['cnpj'],
                'nome_franquia' => $validated['name'],
                'nome_unidade' => $validated['unit_name'],
                'descricao' => $validated['description'],
                'categoria' => $validated['category'],
                'telefone' => $validated['phone'],
                'email_contato' => $validated['contact_email'],
                'cep' => $validated['cep'],
                'estado' => $validated['state'],
                'cidade' => $validated['city'],
                'bairro' => $validated['neighborhood'],
                'endereco' => $validated['street'],
                'numero' => $validated['number'],
                'complemento' => $validated['complement'],
            ];

            if ($request->hasFile('image')) {
                if ($establishment->imagem) {
                    Storage::disk('public')->delete('images/establishments/' . $establishment->imagem);
                }

                $extension = $request->file('image')->getClientOriginalExtension();
                $imageName = 'estabelecimento-' . $establishment->id . '-' . time() . '.' . $extension;
                $request->file('image')->storeAs('images/establishments', $imageName, 'public');
                $dataToUpdate['imagem'] = $imageName;
            }

            $establishment->update($dataToUpdate);

            return redirect()->back()->with('success', 'Estabelecimento atualizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro inesperado ao atualizar o estabelecimento.');
        }
    }
}
