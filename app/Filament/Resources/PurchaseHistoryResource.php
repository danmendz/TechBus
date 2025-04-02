<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseHistoryResource\Pages;
use App\Filament\Resources\PurchaseHistoryResource\RelationManagers;
use App\Models\PurchaseHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseHistoryResource extends Resource
{
    protected static ?string $model = PurchaseHistory::class;
    protected static ?string $modelLabel = 'Historial de compras';
    protected static ?string $navigationGroup = 'Historial';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_usuario')
                ->label('Usuario')
                ->relationship('usuario', 'name') // Cambia 'name' si el campo visible es otro
                ->searchable()
                ->required(),

            Forms\Components\Select::make('id_corrida')
                ->label('Corrida')
                ->relationship('corrida', 'id') // Puedes cambiar 'id' por un campo descriptivo
                ->searchable()
                ->required(),

            Forms\Components\Select::make('id_payment')
                ->label('Pago')
                ->relationship('payment', 'payment_id') // Cambia 'payment_id' si es otro campo representativo
                ->searchable()
                ->required(),

            Forms\Components\Select::make('id_ticket')
                ->label('Ticket')
                ->relationship('ticket', 'codigo_referencia') // Cambia 'codigo_referencia' si es otro campo representativo
                ->searchable()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('usuario.name') // Ajusta 'name' si es otro campo representativo
                ->label('Usuario')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('corrida.id') // Cambia 'id' por otro campo más representativo
                ->label('Corrida')
                ->sortable(),

            Tables\Columns\TextColumn::make('payment.payment_id') // Cambia 'payment_id' si es otro campo representativo
                ->label('Pago')
                ->sortable(),

            Tables\Columns\TextColumn::make('ticket.codigo_referencia') // Cambia 'codigo_referencia' si es otro campo representativo
                ->label('Ticket')
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
            'index' => Pages\ListPurchaseHistories::route('/'),
            'create' => Pages\CreatePurchaseHistory::route('/create'),
            'edit' => Pages\EditPurchaseHistory::route('/{record}/edit'),
        ];
    }
}
