<?php

namespace App\Providers;

use Livewire\Livewire;
use App\Http\Livewire\GroupInvoices;
use App\Http\Livewire\SingleInvoices;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\CreateGroupServices;

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
        Livewire::component('create-group-services', CreateGroupServices::class);
        Livewire::component('single-invoices', SingleInvoices::class);
        Livewire::component('group-invoices', GroupInvoices::class);
    }
}
