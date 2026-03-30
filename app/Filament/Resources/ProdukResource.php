<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationGroup = 'Manajemen Data';
    
    protected static ?string $navigationLabel = 'Produk';
    
    protected static ?string $modelLabel = 'Produk';
    
    protected static ?string $pluralModelLabel = 'Manajemen Produk';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_produk')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->live(onBlur: true),
                
                Textarea::make('deskripsi')
                    ->label('Deskripsi Produk')
                    ->maxLength(65535)
                    ->rows(5)
                    ->columnSpanFull(),
                
                TextInput::make('harga')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->maxValue(999999999)
                    ->minValue(0)
                    ->columnSpan(2),
                
                TextInput::make('stok')
                    ->label('Stok')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->columnSpan(2),
                
                // GAMBAR - Upload dengan nama file unik
                FileUpload::make('gambar')
                    ->label('Gambar Produk')
                    ->image()
                    ->directory('produk')
                    ->disk('public')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('500')
                    ->imageResizeTargetHeight('500')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->getUploadedFileNameForStorageUsing(function ($file) {
                        // Buat nama file unik dengan timestamp
                        $extension = $file->getClientOriginalExtension();
                        return time() . '_' . uniqid() . '.' . $extension;
                    }),
                
                Toggle::make('status')
                    ->label('Tersedia')
                    ->default(true)
                    ->inline(false)
                    ->columnSpanFull(),
            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🔥 GAMBAR - PAKAI CUSTOM HTML (SEPERTI CODE LAMA YANG BEKERJA)
                TextColumn::make('gambar_preview')
                    ->label('Foto')
                    ->getStateUsing(function ($record) {
                        if (!$record->gambar) {
                            return '<div style="width:50px;height:50px;background:#f3f4f6;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:12px;">NO IMG</div>';
                        }
                        
                        // 🔥 PAKAI asset('storage/' . $record->gambar) SEPERTI CODE LAMA
                        $url = asset('storage/' . $record->gambar);
                        
                        return "
                        <div style='position:relative;'>
                            <img src='{$url}' 
                                 alt='Gambar Produk' 
                                 style='width:50px;height:50px;object-fit:cover;border-radius:8px;border:2px solid #e5e7eb;'
                                 onerror=\"this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHJ4PSI4IiBmaWxsPSIjRjNGNEY2Ii8+PHRleHQgeD0iNTAiIHk9IjUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM5Q0EzQUYiIHRleHQtYW5jaG9yPSJlbmQiIGR5PSItMjAiPk5PIEk8L3RleHQ+PHRleHQgeD0iNTAiIHk9IjUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM5Q0EzQUYiIHRleHQtYW5jaG9yPSJlbmQiIGR5PSItNSI8L3RleHQ+PC9zdmc+'\">
                            <div style='position:absolute;bottom:-5px;right:-5px;background:#3b82f6;color:white;border-radius:50%;width:20px;height:20px;display:flex;align-items:center;justify-content:center;font-size:10px;'>📷</div>
                        </div>
                        ";
                    })
                    ->html()
                    ->alignCenter()
                    ->searchable(false)
                    ->sortable(false),
                
                TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                
                TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state . ' pcs')
                    ->badge()
                    ->color(fn ($state) => $state > 10 ? 'success' : ($state > 0 ? 'warning' : 'danger')),
                
                IconColumn::make('status')
                    ->label('Tersedia')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                // DEBUG: Lihat path gambar
                TextColumn::make('gambar_path')
                    ->label('Path')
                    ->getStateUsing(fn ($record) => $record->gambar)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}