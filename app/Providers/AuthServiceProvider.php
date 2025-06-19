<?php

namespace App\Providers;

use App\Models\Establishment;
use App\Models\Product;
use App\Models\Client;
use App\Models\Address;
use App\Policies\EstablishmentPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ClientPolicy;
use App\Policies\AddressPolicy;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Establishment::class => EstablishmentPolicy::class,
        Product::class => ProductPolicy::class,
        Client::class => ClientPolicy::class,
        Address::class => AddressPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}