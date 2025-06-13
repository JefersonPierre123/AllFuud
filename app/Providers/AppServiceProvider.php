<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Establishment;
use Illuminate\Support\Facades\URL;

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
            $viewData = $view->getData();
            $variablesToShare = []; // 👈 INICIALIZE O ARRAY AQUI FORA
    
            if ($user = Auth::user()) {
                $variablesToShare['authUser'] = $user;
    
                if ($user->client_id && !isset($viewData['client'])) {
                    $client = Client::find($user->client_id);
                    $variablesToShare['client'] = $client;
                    $variablesToShare['clientName'] = $client?->nome;
                    $variablesToShare['addresses'] = $client?->addresses;
                }
    
                if ($user->establishment_id && !isset($viewData['establishment'])) {
                    $establishment = Establishment::find($user->establishment_id);
                    $variablesToShare['establishment'] = $establishment;
                    $variablesToShare['establishmentName'] = $establishment?->nome_unidade;
                }
            }
            
            // 👈 CHAME O 'with' AQUI FORA, para que sempre execute
            // Se o usuário não estiver logado, ele passará um array vazio.
            if (!empty($variablesToShare)) {
                $view->with($variablesToShare);
            }
        });
    }
}
