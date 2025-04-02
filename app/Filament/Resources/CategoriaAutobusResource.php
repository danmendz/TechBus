<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaAutobusResource\Pages;
use App\Filament\Resources\CategoriaAutobusResource\RelationManagers;
use App\Models\CategoriaAutobus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriaAutobusResource extends Resource
{
    protected static ?string $model = CategoriaAutobus::class;
    protected static ?string $navigationGroup = 'Transportes';
    protected static ?string $modelLabel = 'Categoria de autobuses';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nombre')
                ->label('Nombre')
                ->required()
                ->maxLength(255)
                ->placeholder('Ingrese el nombre de la categoría'),

            Forms\Components\Textarea::make('descripcion')
                ->label('Descripción')
                ->rows(3)
                ->placeholder('Ingrese una descripción opcional')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('nombre')
                ->label('Nombre')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('descripcion')
                ->label('Descripción')
                ->limit(50)
                ->tooltip(fn ($record) => $record->descripcion),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Fecha de creación')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCategoriaAutobuses::route('/'),
            'create' => Pages\CreateCategoriaAutobus::route('/create'),
            'edit' => Pages\EditCategoriaAutobus::route('/{record}/edit'),
        ];
    }
}
