<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Support\Enums\ActionSize;

class ProfilSaya extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.pages.profil-saya';
    protected static ?string $navigationLabel = 'Profil Saya';
    protected static ?string $title = 'Profil Saya';

    public ?array $data = [];
    public bool $isEditing = false;

    public function mount(): void
    {
        $user = Auth::user();
        $this->data = [
            'name' => $user->name,
            'email' => $user->email,
            'nim' => $user->nim,
            'jurusan' => $user->jurusan,
            'asal_kampus' => $user->asal_kampus,
        ];
        
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(100)
                    ->disabled(! $this->isEditing),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(100)
                    ->disabled(! $this->isEditing),

                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->required()
                    ->maxLength(20)
                    ->disabled(! $this->isEditing),

                Forms\Components\Select::make('jurusan')
                    ->label('Jurusan')
                    ->required()
                    ->options([
                        'Teknik Informatika' => 'Teknik Informatika',
                        'Sistem Informasi' => 'Sistem Informasi',
                        'Bisnis Digital' => 'Bisnis Digital',
                    ])
                    ->disabled(! $this->isEditing),

                Forms\Components\TextInput::make('asal_kampus')
                    ->label('Asal Kampus')
                    ->required()
                    ->maxLength(100)
                    ->disabled(! $this->isEditing),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->label('Edit Profil')
                ->icon('heroicon-o-pencil')
                ->color('primary')
                ->size(ActionSize::Large)
                ->visible(! $this->isEditing)
                ->action(function () {
                    $this->isEditing = true;
                }),

            Action::make('cancel')
                ->label('Batal')
                ->icon('heroicon-o-x-mark')
                ->color('gray')
                ->size(ActionSize::Large)
                ->visible($this->isEditing)
                ->action(function () {
                    $this->isEditing = false;
                    // Reset form ke data asli
                    $this->form->fill($this->data);
                }),

            Action::make('save')
                ->label('Simpan Perubahan')
                ->icon('heroicon-o-check')
                ->color('success')
                ->size(ActionSize::Large)
                ->visible($this->isEditing)
                ->action(function () {
                    $this->updateProfil();
                }),
        ];
    }

    public function updateProfil(): void
    {
        $user = Auth::user();
        $validated = $this->form->getState();

        // Validasi email unik (kecuali untuk user saat ini)
        if ($validated['email'] !== $user->email) {
            $emailExists = \App\Models\User::where('email', $validated['email'])
                ->where('id', '!=', $user->id)
                ->exists();
            
            if ($emailExists) {
                Notification::make()
                    ->title('Email sudah digunakan.')
                    ->danger()
                    ->send();
                return;
            }
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nim' => $validated['nim'],
            'jurusan' => $validated['jurusan'],
            'asal_kampus' => $validated['asal_kampus'],
        ]);

        // Update data lokal
        $this->data = $validated;
        $this->isEditing = false;

        Notification::make()
            ->title('Profil berhasil diperbarui.')
            ->success()
            ->send();
    }

    public function getUserData(): array
    {
        return $this->data;
    }
}