<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Establishment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Pega os dados que o Controller JÁ enviou para a View
            $viewData = $view->getData();
            
            // Só executa a lógica de busca se o usuário estiver logado
            if ($user = Auth::user()) {
                $variablesToShare['authUser'] = $user;

                // LÓGICA DO CLIENTE:
                // Só busca o cliente do usuário se a view já não tiver uma variável 'client'
                if ($user->client_id && !isset($viewData['client'])) {
                    $client = Client::find($user->client_id);
                    $variablesToShare['client'] = $client;
                    $variablesToShare['clientName'] = $client?->nome;
                    $variablesToShare['addresses'] = $client?->addresses;
                }

                // LÓGICA DO ESTABELECIMENTO:
                // Só busca o estabelecimento do usuário se a view já não tiver uma variável 'establishment'
                if ($user->establishment_id && !isset($viewData['establishment'])) {
                    $establishment = Establishment::find($user->establishment_id);
                    $variablesToShare['establishment'] = $establishment;
                    $variablesToShare['establishmentName'] = $establishment?->nome_unidade;
                }
                
                $view->with($variablesToShare);
            }
        });
    }
}
