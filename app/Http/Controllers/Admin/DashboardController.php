<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(AdminDashboardService $dashboard): View
    {
        return view('admin.dashboard.index', [
            'admin' => Auth::guard('admin')->user(),
            'cpu' => $dashboard->cpuUsage(),
            'cloudflare' => $dashboard->cloudflareStatus(),
            'securityFeatures' => $dashboard->securityFeatures(),
        ]);
    }
}
