<?php

use App\Livewire\DeleteProduk;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(DeleteProduk::class)
        ->assertStatus(200);
});
