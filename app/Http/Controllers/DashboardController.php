<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\User;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
{
    $totalServices = Service::count();

    $activeServices = Service::where('status', 'active')->count();

    $inactiveServices = Service::where('status', 'inactive')->count();

    $totalCustomers = Customer::count();

    // Booking Statistics
    $totalBookings = Booking::count();

    $pendingBookings = Booking::where('status', 'pending')->count();

    $confirmedBookings = Booking::where('status', 'confirmed')->count();

    $completedBookings = Booking::where('status', 'completed')->count();

    $cancelledBookings = Booking::where('status', 'cancelled')->count();

    $totalRevenue = Booking::where('status', 'completed')
                           ->sum('price');
    $recentBookings = Booking::with(['customer', 'service'])
                         ->latest()
                         ->take(5)
                         ->get();
    $totalUsers = User::count();

    $totalAdmins = User::whereHas('userRole', function ($q) {
        $q->where('name', 'admin');
    })->count();
    
    $totalNormalUsers = User::whereHas('userRole', function ($q) {
        $q->where('name', 'user');
    })->count();
    
    $recentUsers = User::latest()
                             ->take(5)
                             ->get();  
    $recentActivityLogs = ActivityLog::with('user')
    ->latest()
    ->take(5)
    ->get();

    $totalLogs = ActivityLog::count();

$createdLogs = ActivityLog::where('action', 'created')->count();

$updatedLogs = ActivityLog::where('action', 'updated')->count();

$deletedLogs = ActivityLog::where('action', 'deleted')->count();

    return view('dashboard', compact(
        'totalServices',
        'activeServices',
        'inactiveServices',
        'totalCustomers',
        'totalBookings',
        'pendingBookings',
        'confirmedBookings',
        'completedBookings',
        'cancelledBookings',
        'totalRevenue',
        'recentBookings',
        'totalUsers',
        'totalAdmins',
        'totalNormalUsers',
        'recentUsers',
        'recentActivityLogs',
        'totalLogs',
    'createdLogs',
    'updatedLogs',
    'deletedLogs',
    'totalLogs',
    'createdLogs',
    'updatedLogs',
    'deletedLogs',
    ));
}
}
