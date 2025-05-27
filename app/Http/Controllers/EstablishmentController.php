<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Establishment;
use App\Models\Product;

class EstablishmentController extends Controller
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
            'cnpj' => 'required|string|max:18',
            'name' => 'required|string|max:255',
            'unit_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:255',
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
            // 1. Cria o estabelecimento sem a imagem
            $establishment = Establishment::create([
                'imagem' => null, // será atualizada depois
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
    
            // 2. Se tiver imagem, salva com o nome personalizado
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $imageName = 'estabelecimento-' . $establishment->id . '.' . $extension;
    
                $request->file('image')->storeAs('images/establishments', $imageName, 'public');
    
                // 3. Atualiza o registro com o nome da imagem
                $establishment->update([
                    'imagem' => $imageName
                ]);
            }
    
            return redirect()->back()->with('success', 'Estabelecimento cadastrado com sucesso!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Busca o estabelecimento ou retorna 404 se não existir
        $establishment = Establishment::findOrFail($id);

        // Busca todos os produtos relacionados a este estabelecimento
        $products = Product::where('establishment_id', $id)->get();

        // Retorna uma view (por exemplo: establishments/show.blade.php) com os dados
        return view('establishments.show', compact('establishment', 'products'));
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
