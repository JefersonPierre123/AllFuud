<div class="col-12 col-md-4 mb-4">
    <div class="card h-100">
        <img src="{{ asset('storage/images/establishments/' . $image) }}" class="card-img-top w-100" alt="Imagem do Estabelecimento">

        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $title }}</h5>
            <h6 class="card-subtitle"> {{$subtitle}} </h6>
            <p class="card-text"><strong>Categoria:</strong> {{ $category }}</p>
            <p class="card-text">{{ $description }}</p>

            <div class="mb-3">
                {{-- Componente de Rating --}}
                <x-rating :value="$classification" />
            </div>

            <div id="button-container" class="d-flex flex-column mt-3 gap-2 mt-auto">
                <x-button variant="primary" size="sm">Visitar Estabelecimento</x-button>
            </div>

        </div>
    </div>
</div>
