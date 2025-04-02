<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrecioBoletoResource\Pages;
use App\Filament\Resources\PrecioBoletoResource\RelationManagers;
use App\Models\PrecioBoleto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrecioBoletoResource extends Resource
{
    protected static ?string $model = PrecioBoleto::class;
    protected static ?string $modelLabel = 'Precio de boletos';
    protected static ?string $navigationGroup = 'Boletos';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_tipo_boleto')
                ->label('Tipo de Boleto')
                ->relationship('tipoBoleto', 'tipo') // Ajusta si el campo visible de TipoBoleto es otro
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('precio')
                ->label('Precio')
                ->numeric()
                ->prefix('$')
                ->step(0.01) // Permite decimales
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('tipoBoleto.tipo') // Ajusta si el campo visible de TipoBoleto es otro
                ->label('Tipo de Boleto')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('precio')
                ->label('Precio')
                ->money('MXN') // Formato de moneda en pesos mexicanos
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Fecha de Creación')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
        ->filters([])
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
            'index' => Pages\ListPrecioBoletos::route('/'),
            'create' => Pages\CreatePrecioBoleto::route('/create'),
            'edit' => Pages\EditPrecioBoleto::route('/{record}/edit'),
        ];
    }
}
