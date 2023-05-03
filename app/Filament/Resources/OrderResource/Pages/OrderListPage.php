<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Grid as LayoutGrid;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\SelectFilter;

class OrderListPage extends Page implements Tables\Contracts\HasTable 
{
    use Tables\Concerns\InteractsWithTable; 

    protected static string $resource = OrderResource::class;

    protected static string $view = 'filament.resources.order-resource.pages.order-list-page';

    protected function getTableQuery(): Builder
    {
        return Order::query();
    }
 
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('product.name'),
            Tables\Columns\TextColumn::make('customer.name'),
            Tables\Columns\TextColumn::make('order_date')
                ->date(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('product')->relationship('product','name')->searchable(),
            SelectFilter::make('customer')->relationship('customer','name')->searchable(),
            Filter::make('order_date')->form([
                DatePicker::make('order_date')
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['order_date'],
                        fn (Builder $query, $date): Builder => $query->whereDate('order_date', $date),
                    );
            })
        ];
    }

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }

    protected function getTableFiltersFormColumns(): int
    {
        return 3;
    }
}
