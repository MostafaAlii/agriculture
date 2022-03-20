<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class DashboardController extends Controller {
    public function index() {
        // return view('dashboard.layouts.dashboard');
        // return view('dashboard');
        return view('dashboard.admin.dashboard_index');
    }
}
