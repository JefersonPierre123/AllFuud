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
            $user = Auth::user();
            $client = null;
            $establishment = null;
            $clientName = null;
            $establishmentName = null;
            $addresses = null;
    
            if ($user) {
                if ($user->client_id) {
                    $client = Client::find($user->client_id);
                    $clientName = $client?->nome;
                    $addresses = $client?->addresses;
                }
    
                if ($user->establishment_id) {
                    $establishment = Establishment::find($user->establishment_id);
                    $establishmentName = $establishment?->nome_unidade;
                }
            }
    
            $view->with([
                'authUser' => $user,
                'client' => $client,
                'establishment' => $establishment,
                'clientName' => $clientName,
                'establishmentName' => $establishmentName,
                'addresses' => $addresses,
            ]);
        });
    }
}
