<?php

namespace App\Filament\Resources\ProfilPenggunaResource\Pages;

use App\Filament\Resources\ProfilPenggunaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilPengguna extends EditRecord
{
    protected static string $resource = ProfilPenggunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
