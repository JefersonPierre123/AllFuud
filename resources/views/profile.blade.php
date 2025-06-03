@extends('layouts.app');

@section('content')

@if (is_null($authUser->client_id) && is_null($authUser->establishment_id))
    <div class="mb-4">
        <label for="user_type" class="form-label">Selecione o tipo de cadastro:</label>
        <select id="user_type" class="form-select">
            <option selected disabled>Escolha uma opção</option>
            <option value="client">Cliente</option>
            <option value="establishment">Estabelecimento</option>
        </select>
    </div>

    <div id="form-container">
        <div id="client-form" style="display: none;">
            @include('components.client-registration-form', [
                'routeSuffix' => 'store',
                'method' => 'POST',
                'routeParams' => []
            ])
        </div>

        <div id="establishment-form" style="display: none;">
            @include('components.establishment-registration-form', [
                'routeSuffix' => 'store',
                'method' => 'POST',
                'routeParams' => []
            ])
        </div>
    </div>

@elseif ($authUser->client_id)
    {{-- Usuário é cliente --}}
    <x-client-registration-form 
        routeSuffix="update" 
        method="PUT" 
        :routeParams="[$authUser->client_id]" 
        :client="$authUser->client"
        :clientId="$authUser->client_id"/>

@elseif ($authUser->establishment_id)
    {{-- Usuário é estabelecimento --}}
    <x-establishment-registration-form 
        routeSuffix="update" 
        method="PUT" 
        :routeParams="[$authUser->establishment_id]" 
        :establishment="$authUser->establishment"/>
@endif

@push('scripts')
    <script src="{{ asset('js/render-profile-form.js') }}"></script>
@endpush

@endsection
