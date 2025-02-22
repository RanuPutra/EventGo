<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('acara_id')
                    ->label('Nama Acara')
                    ->relationship('event','acara')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('acara')
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('deskripsi')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('tanggal_acara')
                            ->required(),
                        Forms\Components\TextInput::make('lokasi')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('max_kapasitas')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),
                Select::make('tiket')
                    ->options([
                        'VIP' => 'Vip',
                        'Regular' => 'Regular',
                        'EarlyBird' => 'EarlyBird',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('harga_tiket')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('max_kapasitas')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Habis' => 'Habis',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.acara')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tiket')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga_tiket')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_kapasitas')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
