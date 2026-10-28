<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Order;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Compute real statistics from database
        $totalConcerts = Concert::count();
        $totalUsers = User::where('role', 'customer')->count();
        $totalTicketCategories = TicketCategory::count();
        
        $categories = TicketCategory::all();
        $totalAvailableStock = $categories->sum('remaining_stock');
        $totalSoldTickets = $categories->sum('sold_count');

        $totalOrders = Order::count();
        $pendingOrders = Order::where('payment_status', 'Menunggu Pembayaran')->count();
        $paidOrders = Order::where('payment_status', 'Dibayar')->count();
        $cancelledOrders = Order::where('payment_status', 'Dibatalkan')->count();
        $totalRevenue = Order::where('payment_status', 'Dibayar')->sum('total_amount');

        // Recent concerts
        $recentConcerts = Concert::with('ticketCategories')
            ->latest()
            ->take(5)
            ->get();

        // Recent orders
        $recentOrders = Order::with(['user', 'concert', 'ticketCategory'])
            ->latest()
            ->take(6)
            ->get();

        // Sales data by concert for chart
        $concertSalesData = Concert::with('ticketCategories')
            ->where('status', '!=', 'Draft')
            ->get()
            ->map(function ($c) {
                return [
                    'name' => $c->name,
                    'sold' => $c->total_sold_tickets,
                    'available' => $c->total_available_stock,
                ];
            });

        return view('dashboard.index', compact(
            'totalConcerts',
            'totalUsers',
            'totalTicketCategories',
            'totalAvailableStock',
            'totalSoldTickets',
            'totalOrders',
            'pendingOrders',
            'paidOrders',
            'cancelledOrders',
            'totalRevenue',
            'recentConcerts',
            'recentOrders',
            'concertSalesData'
        ));
    }
}
