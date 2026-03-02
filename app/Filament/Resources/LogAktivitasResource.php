<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogAktivitasResource\Pages;
use App\Models\LogAktivitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;

class LogAktivitasResource extends Resource
{
    protected static ?string $model = LogAktivitas::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Log Aktivitas';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 99;
    protected static ?string $modelLabel = 'Log Aktivitas';
    protected static ?string $pluralModelLabel = 'Log Aktivitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Aktivitas')
                    ->schema([
                        Forms\Components\TextInput::make('user_name')
                            ->label('User')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('action')
                            ->label('Aksi')
                            ->disabled(),
                            
                        Forms\Components\TextInput::make('model')
                            ->label('Model')
                            ->disabled(),
                            
                        Forms\Components\TextInput::make('model_id')
                            ->label('ID Model')
                            ->disabled(),
                            
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull()
                            ->disabled(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Data Perubahan')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Textarea::make('old_data')
                            ->label('Data Lama')
                            ->json()
                            ->rows(5)
                            ->disabled(),
                            
                        Forms\Components\Textarea::make('new_data')
                            ->label('Data Baru')
                            ->json()
                            ->rows(5)
                            ->disabled(),
                    ])
                    ->columns(2),
                    
                Forms\Components\Section::make('Informasi Teknis')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->label('IP Address')
                            ->disabled(),
                            
                        Forms\Components\TextInput::make('user_agent')
                            ->label('User Agent')
                            ->disabled(),
                            
                        Forms\Components\TextInput::make('created_at')
                            ->label('Waktu')
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('action')
                    ->label('')
                    ->icon(fn (string $state): string => match ($state) {
                        'create' => 'heroicon-o-plus-circle',
                        'update' => 'heroicon-o-pencil',
                        'delete' => 'heroicon-o-trash',
                        'login' => 'heroicon-o-arrow-right-on-rectangle',
                        'logout' => 'heroicon-o-arrow-left-on-rectangle',
                        default => 'heroicon-o-bell',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'create' => 'success',
                        'update' => 'warning',
                        'delete' => 'danger',
                        'login' => 'info',
                        'logout' => 'primary',
                        default => 'gray',
                    }),
                
                TextColumn::make('user_name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->description(fn (LogAktivitas $record): string => $record->model ?: '-'),
                
                BadgeColumn::make('action')
                    ->label('Aksi')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'create' => 'Tambah',
                        'update' => 'Ubah',
                        'delete' => 'Hapus',
                        'login' => 'Login',
                        'logout' => 'Logout',
                        default => $state,
                    })
                    ->colors([
                        'success' => 'create',
                        'warning' => 'update',
                        'danger' => 'delete',
                        'info' => 'login',
                        'primary' => 'logout',
                    ])
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->description(fn (LogAktivitas $record): string => $record->created_at->diffForHumans()),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('action')
                    ->label('Filter Aksi')
                    ->options([
                        'create' => 'Tambah Data',
                        'update' => 'Ubah Data',
                        'delete' => 'Hapus Data',
                        'login' => 'Login',
                        'logout' => 'Logout',
                    ]),
                
                Tables\Filters\SelectFilter::make('model')
                    ->label('Filter Model')
                    ->searchable()
                    ->options(function () {
                        return LogAktivitas::query()
                            ->distinct('model')
                            ->whereNotNull('model')
                            ->pluck('model', 'model')
                            ->toArray();
                    }),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn ($query, $date) => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn ($query, $date) => $query->whereDate('created_at', '<=', $date)
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $count = $records->count();
                            $records->each->delete();
                            
                            // Log penghapusan
                            \App\Models\LogAktivitas::create([
                                'user_id' => auth()->id(),
                                'user_name' => auth()->user()->name,
                                'action' => 'delete',
                                'model' => 'LogAktivitas',
                                'description' => "Menghapus {$count} log aktivitas secara massal",
                            ]);
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada log aktivitas')
            ->emptyStateDescription('Aktivitas akan tercatat secara otomatis.')
            ->emptyStateIcon('heroicon-o-clipboard-document-list')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Refresh')
                    ->url(route('filament.admin.resources.log-aktivitases.index'))
                    ->icon('heroicon-o-arrow-path')
                    ->button(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLogAktivitas::route('/'),
            'view' => Pages\ViewLogAktivitas::route('/{record}'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() > 0 ? static::getModel()::count() : null;
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }
}