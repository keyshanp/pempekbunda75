<?php

namespace App\Filament\Resources\AppResource\Widgets;

use Filament\Widgets\ChartWidget;

class ProdukChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
