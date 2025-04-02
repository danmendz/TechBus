<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsientoResource\Pages;
use App\Filament\Resources\AsientoResource\RelationManagers;
use App\Models\Asiento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AsientoResource extends Resource
{
    protected static ?string $model = Asiento::class;
    protected static ?string $navigationGroup = 'Transportes';
    protected static ?string $modelLabel = 'Asientos de autobús';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('numero_asiento')
                ->label('Número de Asiento')
                ->required()
                ->numeric()
                ->placeholder('Ingrese el número de asiento'),

            Forms\Components\Select::make('estatus_asiento')
                ->label('Estatus')
                ->options([
                    'disponible' => 'Disponible',
                    'ocupado' => 'Ocupado',
                    'reservado' => 'Reservado',
                ])
                ->required(),

                Forms\Components\Select::make('id_autobus')
                    ->label('Autobús')
                    ->relationship('autobus', 'modelo')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->modelo} - {$record->numero_serie}")
                    ->searchable(['modelo', 'numero_serie'])
                    ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('numero_asiento')
                ->label('Número de Asiento')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('estatus_asiento')
                ->label('Estatus')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'disponible' => 'success',
                    'ocupado' => 'danger',
                    'reservado' => 'warning',
                }),

            Tables\Columns\TextColumn::make('autobus.modelo')
                ->label('Autobús')
                ->formatStateUsing(fn ($state, $record) => 
                    "{$state} - {$record->autobus->numero_serie}"
                )
                ->sortable()
                ->searchable(),

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
            'index' => Pages\ListAsientos::route('/'),
            'create' => Pages\CreateAsiento::route('/create'),
            'edit' => Pages\EditAsiento::route('/{record}/edit'),
        ];
    }
}
