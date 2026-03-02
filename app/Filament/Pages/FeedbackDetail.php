<?php

namespace App\Filament\Pages;

use App\Models\Feedback;
use Filament\Pages\Page;
use Filament\Actions;

class FeedbackDetail extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static string $view = 'filament.pages.feedback-detail';
    
    protected static ?string $slug = 'feedback-detail/{record}';
    
    protected static bool $shouldRegisterNavigation = false;
    
    public ?Feedback $record = null;
    
    public function mount($record): void
    {
        $this->record = Feedback::with('order')->findOrFail($record);
    }
    
    public function getTitle(): string
    {
        return 'Detail Feedback: ' . ($this->record->kode_pesanan ?? 'Unknown');
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('kembali')
                ->label('Kembali ke Daftar')
                ->icon('heroicon-o-arrow-left')
                ->url('/admin/feedback')
                ->color('gray'),
                
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->record($this->record)
                ->requiresConfirmation()
                ->successRedirectUrl('/admin/feedback'),
        ];
    }
    
    /**
     * Helper methods untuk mengakses data dengan aman
     */
    public function getTags(): array
    {
        if (!$this->record) {
            return [];
        }
        
        $tags = $this->record->tags;
        if (is_string($tags)) {
            $tags = json_decode($tags, true) ?? [];
        }
        
        return is_array($tags) ? $tags : [];
    }
    
    public function getReview(): string
    {
        return $this->record?->review ?? '';
    }
    
    public function getRating(): int
    {
        return (int) ($this->record?->rating ?? 0);
    }
    
    public function getOrderItems(): array
    {
        if (!$this->record || !$this->record->order) {
            return [];
        }
        
        $items = $this->record->order->items;
        if (is_string($items)) {
            $items = json_decode($items, true) ?? [];
        }
        
        return is_array($items) ? $items : [];
    }
    
    public function getPaymentMethod(): string
    {
        if (!$this->record || !$this->record->order) {
            return 'QRIS';
        }
        
        $payment = $this->record->order->payment;
        if (is_string($payment)) {
            $payment = json_decode($payment, true) ?? [];
        }
        
        return $payment['metode'] ?? 'QRIS';
    }
    
    public function getDeliveryMethod(): string
    {
        if (!$this->record || !$this->record->order) {
            return 'Pickup';
        }
        
        $delivery = $this->record->order->delivery;
        if (is_string($delivery)) {
            $delivery = json_decode($delivery, true) ?? [];
        }
        
        return $delivery['metode'] ?? 'Pickup';
    }
    
    public function getShippingCost(): int
    {
        if (!$this->record || !$this->record->order) {
            return 0;
        }
        
        $delivery = $this->record->order->delivery;
        if (is_string($delivery)) {
            $delivery = json_decode($delivery, true) ?? [];
        }
        
        return (int) ($delivery['shipping_cost'] ?? 0);
    }
}