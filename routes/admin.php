<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;


Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('admin/dashboard', function(){
        return view('backend.admin.dashboard');
    })->name('admin.dashboard');
});