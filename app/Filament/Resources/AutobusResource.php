<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutobusResource\Pages;
use App\Filament\Resources\AutobusResource\RelationManagers;
use App\Models\Autobus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AutobusResource extends Resource
{
    protected static ?string $model = Autobus::class;

    protected static ?string $navigationIcon = 'tabler-bus';
    protected static ?string $navigationGroup = 'Transportes';
    protected static ?int $navigationSort = 2;
    
    public static function getNavigationBadge(): ?string
    {
        return Autobus::getModel()->where('estatus_autobus', 'Disponible')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_usuario')
                ->relationship(name: 'usuario', titleAttribute: 'name')
                ->native(false)
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Select::make('id_flota')
                ->relationship(name: 'flota', titleAttribute: 'dueño')
                ->native(false)
                ->required(),
            Forms\Components\TextInput::make('numero_serie')
                ->required()
                ->maxLength(20),
            Forms\Components\TextInput::make('placa')
                ->required()
                ->maxLength(40),
            Forms\Components\TextInput::make('modelo')
                ->required()
                ->maxLength(100),

            Forms\Components\Select::make('estatus_autobus')
                ->options([
                    'Disponible' => 'Disponible', 
                    'En reparacion' => 'En reparacion', 
                    'Fuera de servicio' => 'Fuera de servicio', 
                ])
                ->native(false)
                ->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('usuario.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('flota.dueño')
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero_serie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('placa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modelo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estatus_autobus')
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
                SelectFilter::make('estatus_autobus')
                ->options([
                    'Disponible' => 'Disponible',
                    'Fuera de servicio' => 'Fuera de servicio',
                    'En reparacion' => 'En reparación',
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAutobuses::route('/'),
            'create' => Pages\CreateAutobus::route('/create'),
            'edit' => Pages\EditAutobus::route('/{record}/edit'),
        ];
    }
}
