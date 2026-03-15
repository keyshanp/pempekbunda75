<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\HtmlString;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Customer Reviews';

    protected static ?string $navigationGroup = 'Manajemen Data';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'kode_pesanan';

    protected static ?string $slug = 'feedback';

    public static function getGloballySearchableAttributes(): array
    {
        return ['kode_pesanan', 'review', 'user_name', 'user_email'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('👤 Customer Information')
                    ->schema([
                        TextInput::make('user_name')
                            ->label('Nama Customer')
                            ->disabled()
                            ->dehydrated(false),
                        
                        TextInput::make('user_email')
                            ->label('Email Customer')
                            ->disabled()
                            ->dehydrated(false),
                        
                        TextInput::make('kode_pesanan')
                            ->label('Order Code')
                            ->disabled()
                            ->dehydrated(false),
                        
                        TextInput::make('rating')
                            ->label('Rating')
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(fn ($state) => str_repeat('⭐', $state) . " ({$state}/5)"),
                    ])
                    ->columns(2),
                
                Section::make('💬 Feedback Details')
                    ->schema([
                        TagsInput::make('tags')
                            ->label('Button yang Dipencet')
                            ->disabled()
                            ->dehydrated(false),
                        
                        Textarea::make('review')
                            ->label('Review Customer')
                            ->rows(5)
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_pesanan')
                    ->label('Order')
                    ->searchable()
                    ->copyable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary')
                    ->toggleable(),
                
                TextColumn::make('user_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->user_email)
                    ->toggleable(),
                
                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->badge()
                    ->color('warning')
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('tags')
                    ->label('Tags')
                    ->formatStateUsing(function ($state) {
                        if (empty($state) || !is_array($state)) {
                            return '-';
                        }
                        return implode(', ', $state);
                    })
                    ->badge()
                    ->separator(',')
                    ->limitList(3)
                    ->expandableLimitedList()
                    ->toggleable(),
                
                TextColumn::make('review')
                    ->label('Review')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->review)
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('rating')
                    ->label('Filter Rating')
                    ->options([
                        5 => '5 ⭐⭐⭐⭐⭐',
                        4 => '4 ⭐⭐⭐⭐',
                        3 => '3 ⭐⭐⭐',
                        2 => '2 ⭐⭐',
                        1 => '1 ⭐',
                    ])
                    ->multiple(),
                
                Filter::make('created_at')
                    ->label('Rentang Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->color('info'),

                DeleteAction::make()
                    ->label('Hapus')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Order & Customer')
                    ->schema([
                        TextEntry::make('kode_pesanan')
                            ->label('Order ID')
                            ->copyable()
                            ->weight(FontWeight::Bold),
                        TextEntry::make('user_name')
                            ->label('Nama Customer'),
                        TextEntry::make('user_email')
                            ->label('Email Customer')
                            ->copyable(),
                        TextEntry::make('rating')
                            ->label('Rating')
                            ->formatStateUsing(fn ($state) => str_repeat('⭐', $state) . " ({$state}/5)"),
                        TextEntry::make('created_at')
                            ->label('Tanggal')
                            ->dateTime('d M Y H:i'),
                    ]),

                InfolistSection::make('Feedback')
                    ->schema([
                        TextEntry::make('tags')
                            ->label('Tags')
                            ->formatStateUsing(function ($state) {
                                if (empty($state) || !is_array($state)) {
                                    return '-';
                                }
                                return implode(', ', $state);
                            }),
                        TextEntry::make('review')
                            ->label('Review')
                            ->formatStateUsing(fn ($state) => $state ?? '-'),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'view' => Pages\ViewFeedback::route('/{record}'),
        ];
    }
}
