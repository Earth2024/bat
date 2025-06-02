<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});