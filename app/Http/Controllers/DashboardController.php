<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return match ($request->user()->role) {
            Roles::ADMIN      => redirect()->route('dashboard.admin'),
            Roles::INSTRUCTOR => redirect()->route('dashboard.instructor'),
            Roles::MEMBER     => redirect()->route('dashboard.member'),
            default           => redirect()->route('login'),
        };
    }
}
