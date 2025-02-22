<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Purchase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pembeli')
                    ->required(),
                Select::make('acara_id')
                    ->relationship('event','acara')
                    ->required(),
                Select::make('tiket_id')
                    ->relationship('ticket','tiket')
                    ->required(),
                Forms\Components\TextInput::make('jumlah_tiket')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_harga')
                    ->required()
                    ->numeric(),
                    Select::make('pembayaran')
                    ->options([
                        'Transfer' => 'Transfer',
                        'Kartu_kredit' => 'Kartu Kredit',
                        'e-Wallet' => 'e-Wallet',
                    ])
                    ->required(),
                
                Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Berhasil' => 'Berhasil',
                        'Gagal' => 'Gagal',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pembeli')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event.acara')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ticket.tiket')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_tiket')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_harga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pembayaran'),
                Tables\Columns\TextColumn::make('status'),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
