<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\DashboardContent;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index()
    {
        $achievements = Achievement::active()
            ->latest('date')
            ->limit(10)
            ->get()
            ->map(function ($achievement) {
                return [
                    'id' => $achievement->id,
                    'title' => $achievement->title,
                    'value' => $achievement->value,
                    'target_value' => $achievement->target_value,
                    'unit' => $achievement->unit,
                    'category' => $achievement->category,
                    'color' => $achievement->color,
                    'percentage' => $achievement->target_value ? 
                        round(($achievement->value / $achievement->target_value) * 100, 1) : null,
                ];
            });

        $content = DashboardContent::active()
            ->published()
            ->orderBy('display_order')
            ->limit(6)
            ->get();

        $presentations = Presentation::active()
            ->where('status', 'ready')
            ->with('user:id,name')
            ->latest()
            ->limit(4)
            ->get()
            ->map(function ($presentation) {
                return [
                    'id' => $presentation->id,
                    'title' => $presentation->title,
                    'total_slides' => $presentation->total_slides,
                    'thumbnail_path' => $presentation->thumbnail_path,
                    'user_name' => $presentation->user->name,
                    'created_at' => $presentation->created_at->format('M j, Y'),
                ];
            });

        return Inertia::render('dashboard', [
            'achievements' => $achievements,
            'content' => $content,
            'presentations' => $presentations,
            'stats' => [
                'total_achievements' => Achievement::active()->count(),
                'total_content' => DashboardContent::active()->count(),
                'total_presentations' => Presentation::active()->where('status', 'ready')->count(),
            ]
        ]);
    }
}