<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetaResource\Pages;
use App\Filament\Resources\MetaResource\RelationManagers;
use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Expense;
use App\Models\Meta;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MetaResource extends Resource
{
    protected static ?string $model = Meta::class;

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('Geral');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columns(12)
                    ->columnSpan(9)
                    ->schema([
                        Select::make('category_id')
                            ->label('Categoria')
                            ->relationship('category', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id))
                            ->required()
                            ->columnSpan('full'),
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->columnSpan('full')
                            ->required()
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        Select::make('month')
                            ->label('Mes')
                            ->options(MonthHelper::getMonths())
                            ->required(),
                        Select::make('year')
                            ->label('Ano')
                            ->default(Carbon::now()->year)
                            ->required()
                            ->options([
                                '2023' => '2023',
                                '2024' => '2024',
                                '2025' => '2025'
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoria'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Meta / Despesa')
                    ->badge()
                    ->color(function (Meta $record): string {
                        $expenseCategory = Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
                            ->selectRaw('categories.title, SUM(expenses.value) as total')
                            ->where('expenses.user_id', Auth::user()->id)
                            ->whereMonth('expenses.pay_day', $record->month)->groupBy('categories.id')
                            ->whereYear('expenses.pay_day', $record->year)->groupBy('categories.id')
                            ->orderBy('title', 'asc')
                            ->first();

                        if ($record->value < $expenseCategory->total) {
                            return 'danger';
                        }

                        return 'success';
                    })
                    ->formatStateUsing(function (Meta $record): string {
                        $expenseCategory = Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
                            ->selectRaw('categories.title, SUM(expenses.value) as total')
                            ->where('expenses.user_id', Auth::user()->id)
                            ->whereMonth('expenses.pay_day', $record->month)->groupBy('categories.id')
                            ->whereYear('expenses.pay_day', $record->year)->groupBy('categories.id')
                            ->orderBy('title', 'asc')
                            ->first();

                        return FormatCurrency::getFormatCurrency($expenseCategory->total) . ' / ' . FormatCurrency::getFormatCurrency($record->value);
                    }),
                Tables\Columns\TextColumn::make('month')
                    ->label('Mês / Ano')
                    ->formatStateUsing(fn(Meta $record): string => MonthHelper::getMonth($record->month) . ' de ' . $record->year)
            ])
            ->defaultSort('month', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMetas::route('/'),
            'create' => Pages\CreateMeta::route('/create'),
            'edit' => Pages\EditMeta::route('/{record}/edit'),
        ];
    }
}
