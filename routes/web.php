<?php

use App\Http\Controllers\posController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\EnterProduct;
use App\Livewire\Pos;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect("login");
});

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/product/create',EnterProduct::class)->name("product.create");
Route::get('/pos',Pos::class)->name("pos.index");

    // Route::resource("/product",productController::class);
    // Route::resource("/pos",posController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
