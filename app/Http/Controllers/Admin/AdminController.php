<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
    return view('admin.dashboard', [
        'totalUsuarios' => 25,
        'totalDoctores' => 10,
        'totalCitas' => 50
    ]);
}
}
