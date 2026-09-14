<?php

namespace App\Http\Controllers;

use App\Models\StudyLog;
use Illuminate\Http\Request;
use App\Models\Cafe;

class StudyLogController extends Controller
{
    public function index(Request $request)
    {
        $query = StudyLog::with('cafe');

        // カフェ名検索
        if ($request->filled('name')) {
            $query->whereHas('cafe', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        // 利用日（開始）
        if ($request->filled('from_date')) {
            $query->whereDate('visited_at', '>=', $request->from_date);
        }

        // 利用日（終了）
        if ($request->filled('to_date')) {
            $query->whereDate('visited_at', '<=', $request->to_date);
        }

        // 並び替え
        switch ($request->sort) {

            case 'study_minutes_desc':
                $query->orderByDesc('study_minutes');
                break;

            case 'satisfaction_desc':
                $query->orderByDesc('satisfaction');
                break;

            case 'visited_at_desc':
                $query->orderByDesc('visited_at');
                break;

            default:
                $query->orderByDesc('id');
        }

        $studyLogs = $query->get();

        return view('study_logs.index', compact('studyLogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cafes = Cafe::all();

        return view('study_logs.create', compact('cafes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cafe_id' => 'required|exists:cafes,id',
            'study_minutes' => 'required|integer|min:1|max:1440',
            'satisfaction' => 'required|integer|min:1|max:5',
            'visited_at' => 'required|date',
            'memo' => 'nullable|string|max:1000',
        ]);

        StudyLog::create($validated);

        return redirect()
            ->route('study-logs.index')
            ->with('message', '勉強記録を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudyLog $studyLog)
    {
        $studyLog->load('cafe');

        $stats = [
            'count' => $studyLog->cafe->studyLogs()->count(),
            'avg' => round($studyLog->cafe->studyLogs()->avg('study_minutes')),
            'max' => $studyLog->cafe->studyLogs()->max('study_minutes'),
        ];

        return view('study_logs.show', compact('studyLog', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudyLog $studyLog)
    {
        $cafes = Cafe::all();

        return view('study_logs.edit', compact('studyLog', 'cafes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudyLog $studyLog)
    {
        $validated = $request->validate([
            'cafe_id' => 'required|exists:cafes,id',
            'study_minutes' => 'required|integer|min:1|max:1440',
            'satisfaction' => 'required|integer|min:1|max:5',
            'visited_at' => 'required|date',
            'memo' => 'nullable|string|max:1000',
        ]);

        $studyLog->update($validated);

        return redirect()
            ->route('study-logs.index')
            ->with('message', '勉強記録を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudyLog $studyLog)
    {
        $studyLog->delete();

        return redirect()
            ->route('study-logs.index')
            ->with('message', '勉強記録を削除しました');
    }
}
