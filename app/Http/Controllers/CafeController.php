<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;

class CafeController extends Controller
{

    private const QUIET_LEVELS = [
        1 => 'うるさい',
        2 => 'ややうるさい',
        3 => '普通',
        4 => 'やや静か',
        5 => 'とても静か',
    ];

    private const RATINGS = [
        1 => '★',
        2 => '★★',
        3 => '★★★',
        4 => '★★★★',
        5 => '★★★★★',
    ];

    public function index(Request $request)
    {

        $query = Cafe::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('station')) {
            $query->where('station', 'like', '%' . $request->station . '%');
        }

        if ($request->has('wifi')) {
            $query->where('wifi', 1);
        }

        if ($request->has('power_supply')) {
            $query->where('power_supply', 1);
        }

        if ($request->filled('quiet_level')) {
            $query->where('quiet_level', $request->quiet_level);
        }

        switch ($request->sort) {
            case 'rating_desc':
                $query->orderByDesc('rating');
                break;

            case 'price_asc':
                $query->orderBy('average_price');
                break;

            case 'quiet_desc':
                $query->orderByDesc('quiet_level');
                break;

            default:
                $query->latest();
                break;
        }

        $cafes = $query->get();

        return view('cafes.index', [
            'cafes' => $cafes,
            'quietLevels' => self::QUIET_LEVELS,
            'ratings' => self::RATINGS,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cafes.create', [
            'quietLevels' => self::QUIET_LEVELS,
            'ratings' => self::RATINGS,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'station' => 'nullable|string|max:255',
            'average_price' => 'nullable|integer|min:0|max:100000',
            'wifi' => 'boolean',
            'power_supply' => 'boolean',
            'quiet_level' => 'required|integer|min:1|max:5',
            'rating' => 'nullable|integer|min:1|max:5',
            'memo' => 'nullable|string|max:1000',
        ]);
        Cafe::create($validated);

        return redirect()->route('cafes.index')->with('message', '登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cafe $cafe)
    {
        return view('cafes.show', [
            'cafe' => $cafe,
            'quietLevels' => self::QUIET_LEVELS,
            'ratings' => self::RATINGS,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cafe $cafe)
    {
        return view('cafes.edit', [
            'cafe' => $cafe,
            'quietLevels' => self::QUIET_LEVELS,
            'ratings' => self::RATINGS,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cafe $cafe)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'station' => 'nullable|string|max:255',
            'average_price' => 'nullable|integer|min:0|max:100000',
            'wifi' => 'boolean',
            'power_supply' => 'boolean',
            'quiet_level' => 'required|integer|min:1|max:5',
            'rating' => 'nullable|integer|min:1|max:5',
            'memo' => 'nullable|string|max:1000',
        ]);
        $cafe->update($validated);

        return redirect()->route('cafes.index')->with('message', '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cafe $cafe)
    {
        $cafe->delete();
        return redirect()->route('cafes.index')->with('message', '削除しました');
    }
}
