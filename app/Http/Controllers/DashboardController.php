<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $data['title'] = 'Dashboard';
        return view('dashboard', $data);
    }

    public function template() {
        return view('menu.home');
    }
}
