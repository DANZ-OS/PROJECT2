<?php

namespace App\Filament\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Data\EventData;
use App\Models\Kegiatan;
use Filament\Forms;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class CalendarWidget extends FullCalendarWidget
{
    // Hubungkan model agar bisa create/edit/delete dari kalender
    public \Illuminate\Database\Eloquent\Model | string | null $model = Kegiatan::class;

    // Ambil data kegiatan dan tampilkan berdasarkan deadline
    public function fetchEvents(array $fetchInfo): array
    {
        // Get the currently authenticated user's ID
        $userId = Auth::id();

        return Kegiatan::query()
            ->where('user_id', $userId) // Filter by the logged-in user's ID
            ->whereDate('deadline', '>=', $fetchInfo['start'])
            ->whereDate('deadline', '<=', $fetchInfo['end'])
            ->get()
            ->map(fn (Kegiatan $item) => EventData::make()
                ->id($item->id)
                ->title($item->nama)
                ->start($item->deadline)
                ->end($item->deadline) // karena cuma satu tanggal
            )
            ->toArray();
    }

    // Konfigurasi tampilan kalender
    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridMonth,dayGridWeek',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }

    // Form input kalau user buat/edit dari kalender
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\Textarea::make('deskripsi'),
            Forms\Components\DateTimePicker::make('deadline')->required(),
            Forms\Components\Select::make('jenis')
                ->options(Kegiatan::JENIS_OPTIONS)->required(),
            Forms\Components\Select::make('prioritas')
                ->options(Kegiatan::PRIORITAS_OPTIONS),
            Forms\Components\Select::make('status')
                ->options(Kegiatan::STATUS_OPTIONS),
            // Automatically set user_id to the current user when creating
            Forms\Components\Hidden::make('user_id')
                ->default(Auth::id())
                ->dehydrated(true), // Ensure it's saved to the database
        ];
    }
}