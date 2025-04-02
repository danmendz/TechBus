<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificacionResource\Pages;
use App\Filament\Resources\NotificacionResource\RelationManagers;
use App\Models\Notificacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificacionResource extends Resource
{
    protected static ?string $model = Notificacion::class;
    protected static ?string $modelLabel = 'Notificaciones';
    protected static ?string $navigationGroup = 'Notificaciones';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('tipo')
                ->label('Tipo de Notificación')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('estatus_notificacion')
                ->label('Estatus de Notificación')
                ->options([
                    'pendiente' => 'Pendiente',
                    'enviado' => 'Enviado',
                    'leido' => 'Leído',
                ])
                ->required(),

            Forms\Components\Textarea::make('descripcion')
                ->label('Descripción')
                ->rows(3)
                ->nullable(),

            Forms\Components\FileUpload::make('imagen')
                ->label('Imagen')
                ->image()
                ->maxSize(1024) // Tamaño máximo de imagen en KB
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('tipo')
                ->label('Tipo de Notificación')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('estatus_notificacion')
                ->label('Estatus')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('descripcion')
                ->label('Descripción')
                ->limit(50) // Limita la longitud mostrada en la tabla
                ->tooltip(fn ($record) => $record->descripcion), // Muestra la descripción completa al pasar el ratón

            Tables\Columns\ImageColumn::make('imagen')
                ->label('Imagen')
                ->width(50) // Tamaño de la imagen en la tabla
                ->height(50), // Tamaño de la imagen en la tabla

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
            'index' => Pages\ListNotificacions::route('/'),
            'create' => Pages\CreateNotificacion::route('/create'),
            'edit' => Pages\EditNotificacion::route('/{record}/edit'),
        ];
    }
}
