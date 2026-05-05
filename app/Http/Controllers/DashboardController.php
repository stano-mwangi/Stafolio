<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Visit;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $visitsTotal = Visit::count();
        $uniqueVisitors = Visit::distinct('ip_address')->count('ip_address');

        $topPages = Visit::select('page', DB::raw('count(*) as visits'))
            ->groupBy('page')
            ->orderByDesc('visits')
            ->limit(5)
            ->get();

        $recentVisits = Visit::orderByDesc('visited_at')
            ->limit(10)
            ->get();

        $eventCounts = Event::select('event_name', DB::raw('count(*) as total'))
            ->groupBy('event_name')
            ->orderByDesc('total')
            ->get();

        return view('dashboard', compact('visitsTotal', 'uniqueVisitors', 'topPages', 'recentVisits', 'eventCounts'));
    }
}
