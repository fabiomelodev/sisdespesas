<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FixedResource\Pages;
use App\Filament\Resources\FixedResource\RelationManagers;
use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Fixed;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FixedResource extends Resource
{
    protected static ?string $model = Fixed::class;

    protected static ?string $label = 'Fixo';

    protected static ?string $pluralLabel = 'Fixos';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('Despesas e Entradas');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columnSpan(9)
                    ->schema([
                        Select::make('type')
                            ->label('Tipo')
                            ->live()
                            ->required()
                            ->options([
                                'fixo'      => 'Fixo',
                                'parcelado' => 'Parcelado'
                            ]),
                        TextInput::make('title')
                            ->label('Título')
                            ->required(),
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->required(),
                        Select::make('due_date')
                            ->label('Dia de vencimento')
                            ->options(MonthHelper::getDays())
                            ->required()
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('number_installments')
                            ->label('Quantidade de parcelas')
                            ->numeric()
                            ->hidden(fn(Get $get) => $get('type') == 'parcelado' ? false : true),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->placeholder('Selecionar')
                            ->relationship('category', 'title')
                            ->required(),
                        Select::make('mean_payment_id')
                            ->label('Meio de pagamento')
                            ->placeholder('Selecionar')
                            ->relationship('meanPayment', 'title')
                            ->required(),
                        Select::make('status')
                            ->placeholder('Selecionar')
                            ->required()
                            ->options([
                                'inativo' => 'Inativo',
                                'ativo'   => 'Ativo'
                            ]),
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->displayFormat('d/m/Y')
                            ->disabled()
                            ->hiddenOn('create')
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn($state) => FormatCurrency::getFormatCurrency($state)),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'fixo'      => 'Fixo',
                        'parcelado' => 'Parcelado'
                    }),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Data de vencimento'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'inativo' => 'Inativo',
                        'ativo'   => 'Ativo'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'inativo' => 'danger',
                        'ativo'   => 'success'
                    })
            ])
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
            'index' => Pages\ListFixeds::route('/'),
            'create' => Pages\CreateFixed::route('/create'),
            'edit' => Pages\EditFixed::route('/{record}/edit'),
        ];
    }
}
