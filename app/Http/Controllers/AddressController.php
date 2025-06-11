<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // 1. A validação já está correta, incluindo 'default' e 'identifier'
        $validated = $request->validate([
            'client_id'    => 'required|exists:clients,id',
            'cep'          => 'nullable|string|max:20',
            'state'        => 'nullable|string|max:50',
            'city'         => 'nullable|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'street'       => 'nullable|string|max:255',
            'number'       => 'nullable|string|max:10',
            'complement'   => 'nullable|string|max:255',
            'default'      => 'nullable|boolean',
            'identifier'   => 'required|string|max:255',
        ]);

        try {
            // 2. Inicia uma transação para garantir a integridade dos dados
            DB::transaction(function () use ($validated) {

                // 3. Lógica para garantir apenas um endereço padrão
                // Se o novo endereço for definido como padrão...
                if ($validated['default'] ?? false) {
                    // ...primeiro, removemos a marcação de 'padrão' de TODOS os outros endereços deste cliente.
                    Address::where('client_id', $validated['client_id'])
                        ->update(['padrao' => false]);
                }

                // 4. Cria o novo endereço usando os dados validados e mapeados
                Address::create([
                    'client_id'   => $validated['client_id'],
                    'padrao'      => $validated['default'] ?? false, // Garante que o valor seja salvo
                    'identificador' => $validated['identifier'],   // Garante que o valor seja salvo
                    'cep'         => $validated['cep'],
                    'estado'      => $validated['state'],
                    'cidade'      => $validated['city'],
                    'bairro'      => $validated['neighborhood'],
                    'endereco'    => $validated['street'],
                    'numero'      => $validated['number'],
                    'complemento' => $validated['complement'],
                ]);
            });

            return redirect()->back()->with('success', 'Endereço cadastrado com sucesso!');
            
        } catch (\Exception $e) {
            // A transação fará o rollback automaticamente em caso de erro
            return redirect()->back()->with('error', 'Erro ao cadastrar endereço: ' . $e->getMessage());
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
        // 1. Validação dos dados (adicionei o campo 'padrao')
        $validated = $request->validate([
            'client_id'    => 'required|exists:clients,id',
            'default'      => 'nullable|boolean', // Valida se o campo 'padrao' é booleano
            'cep'          => 'nullable|string|max:20',
            'state'        => 'nullable|string|max:50',
            'city'         => 'nullable|string|max:100',
            'neighborhood' => 'nullable|string|max:100',
            'street'       => 'nullable|string|max:255',
            'number'       => 'nullable|string|max:10',
            'complement'   => 'nullable|string|max:255',
            'identifier'   => 'required|string|max:255',
        ]);

        try {
            // Inicia uma transação para garantir a integridade dos dados
            DB::transaction(function () use ($validated, $id) {
                
                // Pega o endereço que será atualizado
                $address = Address::findOrFail($id);

                // 2. Lógica para garantir apenas um endereço padrão
                // Se o campo 'padrao' veio como 'true' na requisição...
                if ($validated['default'] ?? false) {
                    Address::where('client_id', $validated['client_id'])
                           ->where('id', '!=', $id) // ...em todos os outros endereços do cliente...
                           ->update(['padrao' => false]); // ...define 'padrao' como 'false'.
                }

                // 3. Atualiza o endereço com os dados validados
                // O ideal é que os nomes dos campos no formulário sejam os mesmos da sua tabela
                $address->update([
                    'client_id'     => $validated['client_id'],
                    'padrao'        => $validated['default'] ?? $address->padrao, // Mantém o valor atual se não for enviado
                    'cep'           => $validated['cep'],
                    'estado'        => $validated['state'],
                    'cidade'        => $validated['city'],
                    'bairro'        => $validated['neighborhood'],
                    'endereco'      => $validated['street'],
                    'numero'        => $validated['number'],
                    'complemento'   => $validated['complement'],
                    'identificador' => $validated['identifier'],
                ]);
            });

            return redirect()->back()->with('success', 'Endereço atualizado com sucesso!');

        } catch (\Exception $e) {
            // A transação fará o rollback automaticamente em caso de erro
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
