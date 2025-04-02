<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoBoletoResource\Pages;
use App\Filament\Resources\TipoBoletoResource\RelationManagers;
use App\Models\TipoBoleto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoBoletoResource extends Resource
{
    protected static ?string $model = TipoBoleto::class;
    protected static ?string $modelLabel = 'Tipo de boletos';
    protected static ?string $navigationGroup = 'Boletos';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('tipo')
                ->label('Tipo de Boleto')
                ->required()
                ->maxLength(255)
                ->placeholder('Ejemplo: VIP, Estándar, Infantil'),

            Forms\Components\Textarea::make('descripcion')
                ->label('Descripción')
                ->rows(3)
                ->nullable()
                ->placeholder('Descripción breve del tipo de boleto'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('tipo')
                ->label('Tipo de Boleto')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('descripcion')
                ->label('Descripción')
                ->limit(50) // Muestra solo 50 caracteres en la tabla
                ->tooltip(fn ($record) => $record->descripcion), // Muestra descripción completa al pasar el mouse

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
            'index' => Pages\ListTipoBoletos::route('/'),
            'create' => Pages\CreateTipoBoleto::route('/create'),
            'edit' => Pages\EditTipoBoleto::route('/{record}/edit'),
        ];
    }
}
