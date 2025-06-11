<div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2 p-2">
    <x-button variant="invisible" size="sm" href="{{ route('establishments.show', ['establishment' => $id]) }}">   
    <div class="card card-establishment card-body h-100">
        <div class="row g-0 h-100">
            <div class="col-4 col-img">
                <img src="{{ asset('storage/images/establishments/' . $image) }}" class="establishment-img" alt="Imagem do Estabelecimento">
            </div>
            <div class="col-8">
                <div class="card-body d-flex flex-column h-100">
                    <input type="hidden" name="establishment_id" value="{{ $id }}">
                    <!-- <h5 class="card-title">{{ $title }}</h5> -->
                    <h6 class="card-title mb-2 ">{{ $subtitle }}</h6>
                    <p class="card-subtitle mb-1 text-muted">{{ $category }}</p>
                    <p class="card-subtitle mb-1 text-muted">{{ $description }}</p>

                    <div class="mt-auto">
                        {{-- Componente de Rating --}}
                        <x-rating :value="$classification" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-button> 
</div>
