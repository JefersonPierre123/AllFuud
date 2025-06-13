@props([
    'routeSuffix',
    'method' => 'POST',
    'routeParams' => [],
    'product' => null,
])

<div class="card card-custom">
    <form action="{{ route('products.' . $routeSuffix, $routeParams) }}" method="POST" class="container mt-4" enctype="multipart/form-data">

        @if (in_array(strtoupper($method), ['PUT', 'PATCH']))
            @method($method)
        @endif
            @csrf

        <h2 class="text-dark mb-4"><i class="bi bi-person-fill-add me-2"></i>Cadastro de Produtos</h2>

        <input type="hidden" id="establishment_id" name="establishment_id" value="{{ $establishment->id }}">
        
        <div class="row g-3">
            <div class="col-md-12">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input 
                    type="text" 
                    name="nome" 
                    id="nome" 
                    class="form-control"
                    value="{{ old('nome', $product->nome ?? '') }}"
                    required
                >
            </div>

            <div class="col-md-12">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea 
                    name="descricao" 
                    id="descricao" 
                    class="form-control" 
                    rows="3"
                >{{ old('descricao', $product->descricao ?? '') }}</textarea>
            </div>
            
            <div class="col-md-6">
                <label for="valor" class="form-label">Valor (R$)</label>
                <input 
                    type="number" 
                    name="valor" 
                    id="valor" 
                    class="form-control"
                    step="0.01"
                    min="0"
                    placeholder="19.99"
                    value="{{ old('valor', $product->valor ?? '') }}"
                    required
                >
            </div>

            <div class="col-md-12">
                <label for="imagem" class="form-label">Imagem do Produto</label>
                <input 
                    type="file" 
                    name="imagem" 
                    id="imagem" 
                    class="form-control"
                    accept="image/*"
                >
                <small class="form-text text-muted">Deixe em branco para manter a imagem atual (ao editar).</small>
            </div>
            
            {{-- Mostra a imagem atual, se estiver editando um produto que já tem uma --}}
            @if($product && $product->imagem)
                <div class="col-12 mt-3">
                    <label class="form-label">Imagem Atual:</label><br>
                    <img src="{{ asset(path: 'storage/images/products/' . $product->imagem) }}" alt="{{ $product->nome }}" style="max-width: 150px; border-radius: 8px;">
                </div>
            @endif
        </div>
    
        <div class="mt-4 mb-4">
            <x-button variant="primary" type="submit" size="lg">
                <i class="bi bi-send-fill me-1"></i> 
                {{-- 4. Texto do botão atualizado --}}
                @if($method === 'POST') Cadastrar @else Atualizar @endif Produto
            </x-button>
            <x-button variant="secondary" size="lg" onclick="closeProductForm()"> {{-- Idealmente renomear a função JS --}}
                <i class="bi bi-x-circle me-1"></i> Cancelar
            </x-button>
        </div>
    </form>
</div>
