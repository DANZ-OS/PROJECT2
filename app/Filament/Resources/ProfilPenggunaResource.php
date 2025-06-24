<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilPenggunaResource\Pages;
use App\Filament\Resources\ProfilPenggunaResource\RelationManagers;
use App\Models\ProfilPengguna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfilPenggunaResource extends Resource
{
    protected static ?string $model = ProfilPengguna::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListProfilPenggunas::route('/'),
            'create' => Pages\CreateProfilPengguna::route('/create'),
            'edit' => Pages\EditProfilPengguna::route('/{record}/edit'),
        ];
    }
}
