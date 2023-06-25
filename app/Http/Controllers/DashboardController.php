<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\NFT;

class DashboardController extends Controller
{
    public function index()
{
    $usersCount = User::count();
    $nftsCount = NFT::count();

    return Inertia::render('Dashboard', [
        'users_count' => $usersCount,
        'nfts_count' => $nftsCount,
    ]);
}
}
