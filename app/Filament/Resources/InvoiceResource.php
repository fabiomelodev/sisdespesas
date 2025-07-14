<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $label = 'Fatura';

    protected static ?string $pluralLabel = 'Faturas';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('Créditos');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 9
                    ])
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->disabled()
                            ->hiddenOn('create'),
                        DatePicker::make('referential_date')
                            ->label('Data de referência')
                            ->required(),
                        DatePicker::make('due_date')
                            ->label('Data de vencimento')
                            ->required()
                    ]),
                Section::make()
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 3
                    ])
                    ->schema([
                        Select::make('card_credit_id')
                            ->label('Cartão')
                            ->required()
                            ->relationship('cardCredit', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id)->where('status', 1)),
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->disabled(),
                        Select::make('status')
                            ->required()
                            ->options([
                                'pendente' => 'Pendente',
                                'pago'     => 'Pago'
                            ]),
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->disabled()
                            ->hiddenOn('create'),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('cardCredit.title')
                    ->label('Cartão de crédito'),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Data de vencimento')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn($state): string => 'R$ ' . $state),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pendente' => 'Pendente',
                        'pago'     => 'Pago'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'pendente' => 'danger',
                        'pago'     => 'success'
                    })
            ])->defaultSort('due_date', 'desc')
            ->filters([
                Filter::make('month')
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 6
                    ])
                    ->columns([
                        'default' => 2
                    ])
                    ->form([
                        Select::make('month')
                            ->label('Mês')
                            ->columnSpan(1)
                            ->options([
                                '01' => 'Janeiro',
                                '02' => 'Fevereiro',
                                '03' => 'Março',
                                '04' => 'Abril',
                                '05' => 'Maio',
                                '06' => 'Junho',
                                '07' => 'Julho',
                                '08' => 'Agosto',
                                '09' => 'Setembro',
                                '10' => 'Outubro',
                                '11' => 'Novembro',
                                '12' => 'Dezembro',
                            ])
                            ->default(Carbon::now()->addMonth()->format('m')),
                        Select::make('year')
                            ->label('Ano')
                            ->columnSpan(1)
                            ->options([
                                '2024' => '2024',
                                '2025' => '2025'
                            ])
                            ->default(date('Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['month'],
                                fn(Builder $query, $month): Builder => $query->whereMonth('due_date', $month),
                            )
                            ->when(
                                $data['year'],
                                fn(Builder $query, $year): Builder => $query->whereYear('due_date', $year),
                            );
                    }),
                SelectFilter::make('card_credit_id')
                    ->label('Cartão')
                    ->relationship('cardCredit', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id)->where('status', 1))
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 3
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'pendente' => 'Pendente',
                        'pago'     => 'Pago',
                    ])
                    ->columnSpan([
                        'default' => 'full',
                        'md' => 3
                    ]),
            ], FiltersLayout::AboveContentCollapsible)
            ->filtersFormWidth(MaxWidth::ExtraLarge)
            ->filtersFormColumns(12)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            RelationManagers\CreditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
