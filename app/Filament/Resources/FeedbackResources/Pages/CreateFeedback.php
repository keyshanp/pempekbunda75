<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateFeedback extends CreateRecord
{
    protected static string $resource = FeedbackResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Feedback Created')
            ->body('Feedback baru telah berhasil ditambahkan.')
            ->icon('heroicon-o-check-circle')
            ->send();
    }
}