<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static ?string $modelLabel = 'Boletos vendidos';
    protected static ?string $navigationGroup = 'Boletos';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_corrida')
                ->label('Corrida')
                ->relationship('corrida', 'id') // Puedes cambiar 'id' por un campo más representativo
                ->searchable()
                ->required(),

            Forms\Components\Select::make('id_usuario')
                ->label('Usuario')
                ->relationship('usuario', 'name') // Ajusta si el campo visible del usuario es otro
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('codigo_referencia')
                ->label('Código de Referencia')
                ->required()
                ->unique()
                ->maxLength(255),

            Forms\Components\Textarea::make('detalles_compra')
                ->label('Detalles de Compra')
                ->rows(3)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('corrida.id') // Puedes cambiar 'id' por otro campo más descriptivo
                ->label('Corrida')
                ->sortable(),

            Tables\Columns\TextColumn::make('usuario.name') // Ajusta si el campo visible del usuario es otro
                ->label('Usuario')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('codigo_referencia')
                ->label('Código de Referencia')
                ->copyable()
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
