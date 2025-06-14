<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduledClassController;
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
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        collect([
            'instructor' => 'instructor.dashboard',
            'member' => 'member.dashboard',
            'admin' => 'admin.dashboard',
        ])->each(function ($view, $uri) {
            Route::view($uri, $view)
                ->name("dashboard.$uri")
                ->middleware(["role:$uri"]);
        });
    });

Route::resource('/instructor/schedule', ScheduledClassController::class)->only(['index', 'create', 'store', 'destroy'])->middleware(['auth', 'role:instructor']);

/* Member routes */
//Route::middleware(['auth', 'role:member'])->group(function () {
//    Route::get('/member/dashboard', function () {
//        return view('member.dashboard');
//    })->name('member.dashboard');
//    Route::get('/member/book', [BookingController::class, 'create'])->name('booking.create');
//    Route::post('/member/bookings', [BookingController::class, 'store'])->name('booking.store');
//    Route::get('/member/bookings', [BookingController::class, 'index'])->name('booking.index');
//    Route::delete('/member/bookings/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
//});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
