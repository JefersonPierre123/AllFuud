@extends('layouts.app');

@section('content')

@if (is_null($authUser->client_id) && is_null($authUser->establishment_id))
{{-- Escolha de tipo de cadastro --}}
    <div class="mb-4">
        <label for="user_type" class="form-label">Selecione o tipo de cadastro:</label>
        <select id="user_type" class="form-select" onchange="handleFormSelection(this.value)">
            <option selected disabled>Escolha uma opção</option>
            <option value="client">Cliente</option>
            <option value="establishment">Estabelecimento</option>
        </select>
    </div>

    {{-- Container dinâmico para o formulário escolhido --}}
    <div id="form-container"></div>

    <script>
        function handleFormSelection(value) {
            const container = document.getElementById('form-container');

            if (value === 'client') {
                container.innerHTML = `{!! view('components.client-registration-form', [
                    'routeSuffix' => 'store',
                    'method' => 'POST',
                    'routeParams' => []
                ])->render() !!}`;
            } else if (value === 'establishment') {
                container.innerHTML = `{!! view('components.establishment-registration-form', [
                    'routeSuffix' => 'store',
                    'method' => 'POST',
                    'routeParams' => []
                ])->render() !!}`;
            } else {
                container.innerHTML = '';
            }
        }
    </script>

@elseif ($authUser->client_id)
    {{-- Usuário é cliente --}}
    <x-client-registration-form 
        routeSuffix="update" 
        method="PUT" 
        :routeParams="[$authUser->client_id]" 
        :client="$authUser->client"/>

@elseif ($authUser->establishment_id)
    {{-- Usuário é estabelecimento --}}
    <x-establishment-registration-form 
        routeSuffix="update" 
        method="PUT" 
        :routeParams="[$authUser->establishment_id]" 
        :establishment="$authUser->establishment"/>
@endif

@endsection
