<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlotaAutobusResource\Pages;
use App\Filament\Resources\FlotaAutobusResource\RelationManagers;
use App\Models\FlotaAutobus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlotaAutobusResource extends Resource
{
    protected static ?string $model = FlotaAutobus::class;

    protected static ?string $navigationIcon = 'tabler-bus';
    protected static ?string $modelLabel = 'Flota de autobuses';
    protected static ?string $navigationGroup = 'Transportes';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('marca')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Select::make('dueño')
                    ->options([
                        'AU' => 'AU',
                        'OCC' => 'OCC',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('numero_asientos')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('clase')
                    ->options([
                        'Primera clase' => 'Primera clase',
                        'Económico' => 'Económico',
                    ])
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('marca')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dueño')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_asientos')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('clase')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListFlotaAutobuses::route('/'),
            'create' => Pages\CreateFlotaAutobus::route('/create'),
            'edit' => Pages\EditFlotaAutobus::route('/{record}/edit'),
        ];
    }
}
