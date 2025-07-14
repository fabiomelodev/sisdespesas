<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportGeneralResource\Pages;
use App\Filament\Resources\ReportGeneralResource\RelationManagers;
use App\Helpers\MonthHelper;
use App\Models\ReportGeneral;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ReportGeneralResource extends Resource
{
    protected static ?string $model = ReportGeneral::class;

    protected static ?string $label = 'Relatório Geral';

    protected static ?string $pluralLabel = 'Relatórios Gerais';

    protected static ?string $navigationGroup = 'Relatórios Gerais';

    protected static ?int $navigationSort = 1;

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
                    ->columnSpan(9)
                    ->columns(12)
                    ->schema([
                        Select::make('month')
                            ->label('Mês')
                            ->options(MonthHelper::getMonths())
                            ->columnSpan(6),
                        Select::make('year')
                            ->label('Ano')
                            ->columnSpan(6)
                            ->options([
                                '2023' => '2023',
                                '2024' => '2024',
                                '2025' => '2025',
                                '2026' => '2026',
                            ]),
                        RichEditor::make('report')
                            ->label('Relatório')
                            ->columnSpan('full')
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
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
                Tables\Columns\TextColumn::make('month')
                    ->label('Mês / Ano')
                    ->formatStateUsing(fn(ReportGeneral $record): string => MonthHelper::getMonth($record->month) . ' de ' . $record->year),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('access')
                    ->label('Acessar')
                    ->url(fn(ReportGeneral $record) => route('report-general.show', $record))
                    ->openUrlInNewTab()
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
            'index' => Pages\ListReportGenerals::route('/'),
            'create' => Pages\CreateReportGeneral::route('/create'),
            'edit' => Pages\EditReportGeneral::route('/{record}/edit'),
        ];
    }
}
