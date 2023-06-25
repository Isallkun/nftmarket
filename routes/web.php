<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\DashboardController;
use App\Models\NFT;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NFTController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $usersCount = User::count();
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'usersCount' => $usersCount
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('nfts', NFTController::class);
});

Route::post('login-web3', \App\Actions\LoginUsingWeb3::class);

Route::get('/nfts/{id}', function ($id) {
    $nft = NFT::find($id);

    // Memeriksa apakah NFT ditemukan
    if (!$nft) {
        return response()->json(['message' => 'NFT not found'], 404);
    }

    // Memeriksa apakah pengguna saat ini adalah pemilik NFT
    if ($nft->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Pengguna diizinkan untuk melihat NFT mereka
    return response()->json($nft);
})->middleware('auth:sanctum');

Route::delete('/api/nfts/{id}', [NFTController::class, 'destroy']);
