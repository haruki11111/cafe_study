<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;
use App\Models\StudyLog;

class DashboardController extends Controller
{
    public function index()
    {
        $studyMinutes = StudyLog::whereMonth('visited_at', now()->month)
            ->whereYear('visited_at', now()->year)
            ->sum('study_minutes');

        $bestCafe = Cafe::orderByDesc('rating')->first();

        $chartData = StudyLog::selectRaw(
                'visited_at, SUM(study_minutes) as total_minutes'
            )
            ->whereMonth('visited_at', now()->month)
            ->whereYear('visited_at', now()->year)
            ->groupBy('visited_at')
            ->orderBy('visited_at')
            ->get();

        return view('dashboard-cafe.index', compact(
            'studyMinutes',
            'bestCafe',
            'chartData'
        ));
    }
}
