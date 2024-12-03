<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UberResource\Pages;
use App\Filament\Resources\UberResource\RelationManagers;
use App\Helpers\MonthHelper;
use App\Models\Uber;
use Filament\Forms;
use Filament\Forms\Components\{DatePicker, Section, Select, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Filament\Actions;

class UberResource extends Resource
{
    protected static ?string $model = Uber::class;

    protected static ?string $label = 'Uber';

    protected static ?int $navigationSort = 3;

    public static function getPluralLabel(): ?string
    {
        return 'Uber - ' . MonthHelper::getMonth(Carbon::now()->month);
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Despesas e Entradas');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columnSpan(9)
                    ->columns(12)
                    ->schema([
                        DatePicker::make('pay_day')
                            ->label('Data de pagamento')
                            ->displayFormat('d/m/Y')
                            ->required(fn(Get $get) => $get('type') == 'inconstante' ?: false)
                            ->columnSpan('full'),
                        Select::make('level')
                            ->label('Nível')
                            ->columnSpan(4)
                            ->options([
                                0 => 'Não urgente',
                                1 => 'Pouco urgente',
                                2 => 'Urgente'
                            ]),
                        Select::make('route_initial')
                            ->label('Corrida inicial')
                            ->relationship('routes', 'name')
                            ->columnSpan(4),
                        Select::make('route_final')
                            ->label('Corrida final')
                            ->relationship('routes', 'name')
                            ->columnSpan(4)
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$'),
                        Select::make('automobile')
                            ->label('Automóvel')
                            ->placeholder('Selecionar')
                            ->options([
                                'car'        => 'Carro',
                                'motorcycle' => 'Moto'
                            ]),
                        Select::make('means_payment')
                            ->label('Meio de pagamento')
                            ->placeholder('Selecionar')
                            ->options([
                                'Crédito'  => 'Crédito',
                                'Débito'   => 'Débito',
                                'Dinheiro' => 'Dinheiro',
                                'Pix'      => 'Pix'
                            ]),
                        Select::make('bank_id')
                            ->label('Banco')
                            ->relationship('bank', 'title', function (Builder $query) {
                                $query->where('user_id', Auth::user()->id);
                            })
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('bank.icon_bank')
                    ->label('Banco'),
                Tables\Columns\TextColumn::make('automobile')
                    ->label('Automóvel')
                    ->formatStateUsing(fn($state): string => match ($state) {
                        'car'        => 'Carro',
                        'motorcycle' => 'Moto'
                    }),
                Tables\Columns\TextColumn::make('level')
                    ->label('Nível')
                    ->badge()
                    ->formatStateUsing(fn($state): string => match ($state) {
                        0 => 'Não urgente',
                        1 => 'Pouco urgente',
                        2 => 'Urgente'
                    }),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data de pagamento')
                    ->dateTime('d/m/y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . $state),
            ])->defaultSort('pay_day', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->filters([
                //
            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUbers::route('/'),
            'create' => Pages\CreateUber::route('/create'),
            'edit' => Pages\EditUber::route('/{record}/edit'),
        ];
    }
}
