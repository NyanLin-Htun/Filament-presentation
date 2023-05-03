<?php

namespace App\Providers;

use App\Filament\Resources\OrderResource;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;

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
        $this->customNavigation();
    }

    // http://127.0.0.1:8000/admin/customers

    public function customNavigation()
    {
        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Orders')
                    ->url(route('filament.resources.orders.index'))
                    ->isActiveWhen(fn () => request()->routeIs('filament.resources.orders.index'))
                    ->icon('heroicon-o-presentation-chart-line')
                    ->activeIcon('heroicon-s-presentation-chart-line'),
            ]);
        });
    }
}
