<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationHistoryResource\Pages;
use App\Filament\Resources\NotificationHistoryResource\RelationManagers;
use App\Models\NotificationHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationHistoryResource extends Resource
{
    protected static ?string $model = NotificationHistory::class;
    protected static ?string $modelLabel = 'Historial de incidencias';
    protected static ?string $navigationGroup = 'Notificaciones';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_notificacion')
                ->label('Notificación')
                ->relationship('notificacion', 'tipo') // Puedes cambiar 'tipo' por otro campo representativo
                ->searchable()
                ->required(),

            Forms\Components\Select::make('id_corrida')
                ->label('Corrida')
                ->relationship('corrida', 'id') // Cambia 'id' por un campo más representativo
                ->searchable()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('notificacion.tipo') // Ajusta 'tipo' si es otro campo representativo
                ->label('Notificación')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('corrida.id') // Cambia 'id' por un campo más representativo
                ->label('Corrida')
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
            'index' => Pages\ListNotificationHistories::route('/'),
            'create' => Pages\CreateNotificationHistory::route('/create'),
            'edit' => Pages\EditNotificationHistory::route('/{record}/edit'),
        ];
    }
}
