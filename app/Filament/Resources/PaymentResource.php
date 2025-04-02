<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $modelLabel = 'Historial de pagos';
    protected static ?string $navigationGroup = 'Historial';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('payment_id')
                ->label('ID de Pago')
                ->required()
                ->maxLength(255)
                ->disabled(), // Si es generado automáticamente

            Forms\Components\TextInput::make('product_name')
                ->label('Nombre del Producto')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('quantity')
                ->label('Cantidad')
                ->numeric()
                ->minValue(1)
                ->required(),

            Forms\Components\TextInput::make('amount')
                ->label('Monto')
                ->numeric()
                ->prefix('$')
                ->required(),

            Forms\Components\Select::make('currency')
                ->label('Moneda')
                ->options([
                    'MXN' => 'Peso Mexicano',
                    'USD' => 'Dólar Americano',
                    'EUR' => 'Euro',
                ])
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('payer_name')
                ->label('Nombre del Pagador')
                ->maxLength(255)
                ->required(),

            Forms\Components\TextInput::make('payer_email')
                ->label('Correo del Pagador')
                ->email()
                ->required(),

            Forms\Components\Select::make('payment_status')
                ->label('Estado del Pago')
                ->options([
                    'pending' => 'Pendiente',
                    'complete' => 'Completado',
                    'failed' => 'Fallido',
                ])
                ->required()
                ->default('pendiente'),

            Forms\Components\Select::make('payment_method')
                ->label('Método de Pago')
                ->options([
                    'Paypal' => 'Paypal',
                    'Stripe' => 'Stripe',
                    'efectivo' => 'Efectivo',
                ])
                ->searchable()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('payment_id')
                ->label('ID de Pago')
                ->sortable()
                ->searchable()
                ->copyable(),

            Tables\Columns\TextColumn::make('product_name')
                ->label('Producto')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('quantity')
                ->label('Cantidad')
                ->sortable(),

            Tables\Columns\TextColumn::make('amount')
                ->label('Monto')
                ->money('MXN')
                ->sortable(),

            Tables\Columns\TextColumn::make('currency')
                ->label('Moneda')
                ->sortable(),

            Tables\Columns\TextColumn::make('payer_name')
                ->label('Pagador')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('payer_email')
                ->label('Correo')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('payment_status')
                ->label('Estado')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'pending' => 'Pendiente',
                    'complete' => 'Completado',
                    'failed' => 'Fallido',
                })
                ->sortable(),

            Tables\Columns\TextColumn::make('payment_method')
                ->label('Método')
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Fecha de Creación')
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
