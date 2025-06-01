@props([
    'establishment' => null,
])
        
{{-- Grupo: Endereço --}}
    <div class="row g-3">
        <div class="col-md-4">
            <label for="cep" class="form-label">CEP</label>
                <input 
                    type="text" 
                    name="cep" 
                    id="cep" 
                    class="form-control" 
                    placeholder="00000-000" 
                    onblur="buscarEndereco()" 
                    value="{{ old('cep', $establishment->cep ?? '') }}"
                    required
                >
        </div>
        <div class="col-md-4">
            <x-select-uf />
        </div>
        <div class="col-md-6">
            <label for="city" class="form-label">Cidade</label>
            <input type="text" name="city" id="city" class="form-control" required readonly>
        </div>
        <div class="col-md-8">
            <label for="neighborhood" class="form-label">Bairro</label>
            <input type="text" name="neighborhood" id="neighborhood" class="form-control" required readonly>
        </div>
        <div class="col-md-8">
            <label for="street" class="form-label">Endereço</label>
            <input type="text" name="street" id="street" class="form-control" required readonly>
        </div>
        <div class="col-md-8">
            <label for="number" class="form-label">Número</label>
            <input type="text" name="number" id="number" class="form-control" placeholder="0000" 
                value="{{ old('number', $establishment->numero ?? '') }}"
                required>
        </div>
        <div class="col-md-8">
            <label for="complement" class="form-label">Complemento</label>
            <input type="text" name="complement" id="complement" class="form-control" placeholder="Esquina"
                value="{{ old('complement', $establishment->complemento ?? '') }}"
                required>
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('js/cep.js') }}"></script>
@endpush