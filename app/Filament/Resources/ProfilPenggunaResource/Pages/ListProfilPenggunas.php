<?php

namespace App\Filament\Resources\ProfilPenggunaResource\Pages;

use App\Filament\Resources\ProfilPenggunaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfilPenggunas extends ListRecords
{
    protected static string $resource = ProfilPenggunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
