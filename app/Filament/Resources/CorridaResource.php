<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorridaResource\Pages;
use App\Filament\Resources\CorridaResource\RelationManagers;
use App\Models\Corrida;
use App\Models\Ruta;
use Doctrine\DBAL\Query;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CorridaResource extends Resource
{
    protected static ?string $model = Corrida::class;
    protected static ?string $modelLabel = 'Corridas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_ruta')
                ->label('Ruta')
                ->relationship('ruta', 'id') // Solo necesitamos el ID
                ->getOptionLabelFromRecordUsing(fn (Ruta $ruta) => 
                    "{$ruta->origen->nombre} - {$ruta->destino->nombre} - {$ruta->distancia}km : {$ruta->duracion_aproximada}min"
                )
                ->required(),

            Forms\Components\Select::make('id_autobus')
                ->label('Autobús')
                ->relationship('autobus', 'modelo') // Ajusta según el campo visible de Autobus
                ->searchable()
                ->required(),

            Forms\Components\Select::make('id_horario')
                ->label('Horario')
                ->relationship('horario', 'hora') // Ajusta según el campo visible de Horario
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('fecha')
                ->label('Fecha')
                ->required(),

            Forms\Components\Toggle::make('is_ida_vuelta')
                ->label('Es Ida y Vuelta')
                ->default(false),

            Forms\Components\Select::make('estatus_corrida')
                ->label('Estatus de la Corrida')
                ->options([
                    'programada' => 'Programada',
                    'en curso' => 'En curso',
                    'finalizada' => 'Finalizada',
                    'cancelada' => 'Cancelada',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('ruta.nombre') // Ajusta si el campo visible de Ruta es diferente
                ->label('Ruta')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('autobus.modelo') // Ajusta si el campo visible de Autobus es diferente
                ->label('Autobús')
                ->formatStateUsing(fn ($state, $record) => 
                    "{$state} - {$record->autobus->numero_serie}"
                )
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('horario.hora')
                ->label('Horario')
                ->dateTime('d/m/Y H:i')
                ->sortable(),

            Tables\Columns\TextColumn::make('fecha')
                ->label('Fecha')
                ->date()
                ->sortable(),

            Tables\Columns\IconColumn::make('is_ida_vuelta')
                ->label('Ida y Vuelta')
                ->boolean(),

            Tables\Columns\TextColumn::make('estatus_corrida')
                ->label('Estatus')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'programada' => 'warning',
                    'en curso' => 'info',
                    'finalizada' => 'success',
                    'cancelada' => 'danger',
                })
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
            'index' => Pages\ListCorridas::route('/'),
            'create' => Pages\CreateCorrida::route('/create'),
            'edit' => Pages\EditCorrida::route('/{record}/edit'),
        ];
    }
}
