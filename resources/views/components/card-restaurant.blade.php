<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/images/' . $image) }}" class="card-img-top w-100" alt="Imagem do Restaurante">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $title }}</h5>
                    <p class="card-text">{{ $description }}</p>
                    
                    <div class="mb-3">
                        {{--  Componente de Rating  --}}
                        <x-rating :value="$classification" />
                    </div>

                    <div id="button-container" class="d-flex flex-column mt-3 gap-2 flex-grow-1">
                        <x-button variant="primary" size="sm">Salvar</x-button>
                        <x-button variant="secondary" icon="bi bi-cart" size="sm">Adicionar ao Carrinho</x-button>
                        <x-button variant="danger" disabled size="sm">Excluir</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>