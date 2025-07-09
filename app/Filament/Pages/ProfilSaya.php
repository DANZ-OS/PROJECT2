<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;


class ProfilSaya extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.pages.profil-saya';
    protected static ?string $navigationLabel = 'Profil Saya';
    protected static ?string $title = 'Profil Saya';

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();

        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'nim' => $user->nim,
            'jurusan' => $user->jurusan,
            'asal_kampus' => $user->asal_kampus,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100),

                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->required()
                    ->maxLength(20),

                Forms\Components\Select::make('jurusan')
                    ->label('Jurusan')
                    ->required()
                    ->options([
                        'Teknik Informatika' => 'Teknik Informatika',
                        'Sistem Informasi' => 'Sistem Informasi',
                        'Bisnis Digital' => 'Bisnis Digital',
                    ]),

                Forms\Components\TextInput::make('asal_kampus')
                    ->label('Asal Kampus')
                    ->required()
                    ->maxLength(100),
            ])
            ->statePath('data');
    }



    public function updateProfil(): void
    {
        $user = Auth::user();
        $validated = $this->form->getState();

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nim' => $validated['nim'],
            'jurusan' => $validated['jurusan'],
            'asal_kampus' => $validated['asal_kampus'],
        ]);

        Notification::make()
            ->title('Profil berhasil diperbarui.')
            ->success()
            ->send();
    }
}