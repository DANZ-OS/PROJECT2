<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KegiatanResource\Pages;
use App\Models\Kegiatan;
use App\Models\MataKuliah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),
                
            Forms\Components\Select::make('mata_kuliah_id')
                ->relationship('mataKuliah', 'nama')
                ->required(),
                
            Forms\Components\Textarea::make('deskripsi')
                ->maxLength(65535)
                ->nullable(),
                
            Forms\Components\Select::make('jenis')
                ->options(Kegiatan::JENIS_OPTIONS)
                ->required(),
                
            // SOLUSI PASTI JALAN:
            Forms\Components\DateTimePicker::make('deadline')
                ->seconds(false)
                ->displayFormat('d/m/Y H:i')
                ->required(),
                
            Forms\Components\Select::make('prioritas')
                ->options(Kegiatan::PRIORITAS_OPTIONS)
                ->required(),
                
            Forms\Components\TextInput::make('estimasi_jam')
                ->numeric()
                ->required(),
                
            Forms\Components\Select::make('status')
                ->options(Kegiatan::STATUS_OPTIONS)
                ->default('Belum Dimulai')
                ->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('mataKuliah.nama')
                    ->label('Mata Kuliah')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('jenis')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('deadline')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('prioritas'),
                
                Tables\Columns\TextColumn::make('status')
            ])
            ->filters([
                // Filter tanggal manual
                Filter::make('deadline')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until')
                            ->default(now()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('deadline', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('deadline', '<=', $date)
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKegiatans::route('/'),
            'create' => Pages\CreateKegiatan::route('/create'),
            'edit' => Pages\EditKegiatan::route('/{record}/edit')
        ];
    }
}
