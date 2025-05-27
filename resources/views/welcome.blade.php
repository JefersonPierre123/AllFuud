@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($establishments as $establishment)
                <x-card-establishment         
                    :id="$establishment['id']"            
                    :image="$establishment['imagem']"
                    :title="$establishment['nome_franquia']"
                    :subtitle="$establishment['nome_unidade']"
                    :category="$establishment['categoria']"
                    :description="$establishment['descricao']"
                    :classification="$establishment['classificacao']"
                />
        @endforeach
    </div>
</div>

<x-user-registration-form />
<x-client-registration-form />
{{-- <x-establishment-registration-form /> --}}
@endsection