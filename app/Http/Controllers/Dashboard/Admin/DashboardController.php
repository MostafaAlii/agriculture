<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Events\Dashboard\MyEvent;
use App\Http\Controllers\Controller;
class DashboardController extends Controller {
    public function index() {
        event(new MyEvent('agricultre project', auth()->user()->firstname . ' ' . auth()->user()->lastname));
        return view('dashboard.admin.dashboard_index');
    }
}
