<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Order;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Handles the admin dashboard and its summary statistics.
 */
class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics computed from the database.
     */
    public function index()
    {
        // Compute the main counters: concerts, customers and ticket categories.
        $totalConcerts = Concert::count();
        $totalUsers = User::where('role', 'customer')->count();
        $totalTicketCategories = TicketCategory::count();

        // Sum the remaining stock and sold tickets across all categories.
        $categories = TicketCategory::all();
        $totalAvailableStock = $categories->sum('remaining_stock');
        $totalSoldTickets = $categories->sum('sold_count');

        // Count orders grouped by payment status.
        $totalOrders = Order::count();
        $pendingOrders = Order::where('payment_status', 'Menunggu Pembayaran')->count();
        $paidOrders = Order::where('payment_status', 'Dibayar')->count();
        $cancelledOrders = Order::where('payment_status', 'Dibatalkan')->count();
        $totalRevenue = Order::where('payment_status', 'Dibayar')->sum('total_amount');

        // Fetch the five latest concerts (eager load to avoid N+1 queries).
        $recentConcerts = Concert::with('ticketCategories')
            ->latest()
            ->take(5)
            ->get();

        // Fetch the six latest orders along with their relations.
        $recentOrders = Order::with(['user', 'concert', 'ticketCategory'])
            ->latest()
            ->take(6)
            ->get();

        // Build the sales data per concert for the chart (drafts are ignored).
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

        // Pass all variables to the dashboard view.
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
