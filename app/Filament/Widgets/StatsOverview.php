<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\kegiatan;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();
        $kegiatan = kegiatan::where('user_id', $userId)->get();

        return [
            Stat::make('Total Kegiatan', $kegiatan->count())
                 ->description('seluruh kegiatanmu!')
                 ->color('gray'),
            Stat::make('Kegiatan Selesai', $kegiatan->where('status', 'Selesai')->count())
                ->description('selamat kamu telah menyelesaikan kegiatanmu!')
                 ->color('success'),
            Stat::make('Kegiatan Berjalan', $kegiatan->where('status', 'Sedang Berjalan')->count())
                 ->description('jangan lupa kerjakan ya!')
                 ->color('info'),
            Stat::make('Kegiatan Belum dimulai', $kegiatan->where('status', 'Belum Dimulai')->count())
                 ->description('segera bersiap untuk kegiatan ini ya!')
                 ->color('primary'),
            Stat::make('Kegiatan Tertunda', $kegiatan->where('status', 'Tertunda')->count())
                 ->description('yah.. kamu menunda sejumlah kegiatan')
                 ->color('danger'),
        ];
    }
}
