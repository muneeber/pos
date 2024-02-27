<?php

use App\Http\Controllers\posController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\EnterProduct;
use App\Livewire\Pos;
use App\Livewire\ProductEdit;
use App\Livewire\Purchase;
use App\Livewire\Sales;
use App\Livewire\Stock;
use App\Livewire\TodaySaleReport;
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
Route::get('/product/edit/{id}',ProductEdit::class)->name("product.edit");
Route::get('/pos',Pos::class)->name("pos.index");
Route::get('/sales',Sales::class)->name("sales.index");
Route::get('/purchase',Purchase::class)->name("purchase.index");
Route::get('/stock',Stock::class)->name("stock.index");
Route::get('/todayssalesreport',TodaySaleReport::class)->name("tsr.index");


    // Route::resource("/product",productController::class);
    // Route::resource("/pos",posController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
