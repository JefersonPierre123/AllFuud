<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'establishment_id' => 'required|exists:establishments,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'valor' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if (Auth::user()->establishment_id != $validated['establishment_id']) {
            return back()->with('error', 'Ação não autorizada.');
        }

        try {
            $product = DB::transaction(function () use ($request, $validated) {
                
                // 1. Cria o produto com a imagem nula para obter um ID primeiro.
                $product = Product::create([
                    'establishment_id' => $validated['establishment_id'],
                    'nome' => $validated['nome'],
                    'descricao' => $validated['descricao'],
                    'valor' => $validated['valor'],
                    'imagem' => null, // Imagem será definida em seguida
                ]);

                // 2. Se uma imagem foi enviada, agora salvamos com o nome correto.
                if ($request->hasFile('imagem')) {
                    $extension = $request->file('imagem')->getClientOriginalExtension();
                    // Usamos 'produto-' como prefixo para clareza
                    $imageName = 'produto-' . $product->id . '.' . $extension;

                    // Salva a imagem com o nome personalizado
                    $request->file('imagem')->storeAs('images/products', $imageName, 'public');

                    // 3. Atualiza o produto recém-criado com o nome da imagem.
                    $product->imagem = $imageName;
                    $product->save();
                }

                return $product;
            });

            return redirect()
                ->route('establishments.show', $product->establishment_id)
                ->with('success', 'Produto cadastrado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar produto: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'valor' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Inicialmente, preparamos os dados com tudo que foi validado.
        $dataToUpdate = $validated;

        if ($request->hasFile('imagem')) {
            // Se uma NOVA imagem foi enviada:
            
            // 1. (Opcional, mas recomendado) Deleta a imagem antiga para não acumular lixo.
            if ($product->imagem) {
                Storage::disk('public')->delete('products/' . $product->imagem);
            }

            // 2. Salva a nova imagem com o nome personalizado.
            $extension = $request->file('imagem')->getClientOriginalExtension();
            $imageName = 'produto-' . $product->id . '.' . $extension;
            $request->file('imagem')->storeAs('images/products', $imageName, 'public');

            // 3. Define o nome da nova imagem para ser salvo no banco.
            $dataToUpdate['imagem'] = $imageName;

        } else {
            // Se nenhum novo arquivo foi enviado, removemos a chave 'imagem'
            // do array para que o Eloquent não a atualize para null.
            unset($dataToUpdate['imagem']);
        }

        // 4. Atualiza o produto no banco de dados.
        $product->update($dataToUpdate);

        return redirect()
            ->route('establishments.show', $product->establishment_id)
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Desativa um produto específico.
     */
    public function deactivate(Product $product)
    {
        // Garante que apenas o dono pode desativar o produto
        $this->authorize('update', $product);

        $product->update(['ativo' => false]);

        return redirect()->back()->with('success', 'Produto desativado com sucesso.');
    }

    /**
     * Reativa um produto específico.
     */
    public function reactivate(Product $product)
    {
        // Garante que apenas o dono pode reativar o produto
        $this->authorize('update', $product);

        $product->update(['ativo' => true]);

        return redirect()->back()->with('success', 'Produto reativado com sucesso.');
    }
}
