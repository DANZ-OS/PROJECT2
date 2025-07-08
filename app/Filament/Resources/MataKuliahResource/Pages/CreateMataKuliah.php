<?php

namespace App\Filament\Resources\MataKuliahResource\Pages;

use App\Filament\Resources\MataKuliahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMataKuliah extends CreateRecord
{
    protected static string $resource = MataKuliahResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
