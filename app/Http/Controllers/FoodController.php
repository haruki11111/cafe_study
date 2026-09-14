<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    private const GENRES = [
        '和食',
        '洋食',
        '中華',
        'イタリアン',
        'ファストフード',
        'スイーツ',
        '漢飯',
    ];

    private const SPICY_OPTIONS = [
        ['value' => 0, 'label' => '辛くない'],
        ['value' => 1, 'label' => '辛い'],
        ['value' => 2, 'label' => '非常に辛い'],
        ['value' => 3, 'label' => '激辛'],
        ['value' => 4, 'label' => '超激辛'],
    ];

    public function index(Request $request)
    {
        $query = Food::query();

        if (request('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        if (request('genre')) {
            $query->where('genre', request('genre'));
        }

        if (request('price_min')) {
            $query->where('price', '>=', request('price_min'));
        }

        if (request('price_max')) {
            $query->where('price', '<=', request('price_max'));
        }

        if (request('spicy') !== null && request('spicy') !== '') {
            $query->where('spicy', request('spicy'));
        }

        $foods = $query->get();

        return view('foods.index', [
            'foods' => $foods,
            'genres' => self::GENRES,
            'spicyOptions' => self::SPICY_OPTIONS,
            'genreOptions' => array_map(fn ($genre) => ['value' => $genre, 'label' => $genre], self::GENRES),
        ]);
    }

    public function create()
    {
        return view('foods.create', [
            'genres' => self::GENRES,
            'spicyOptions' => self::SPICY_OPTIONS,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'genre' => 'required|string|max:50',
            'price' => 'required|integer|min:0|max:9999999',
            'spicy' => 'required|integer|between:0,4',
        ]);
        Food::create($validated);

        $request->session()->flash('message', '保存しました');
        return redirect()->route('foods.index');
    }

    public function edit(Food $food)
    {
        return view('foods.edit', [
            'food' => $food,
            'genres' => self::GENRES,
            'spicyOptions' => self::SPICY_OPTIONS,
        ]);
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'genre' => 'required|string|max:50',
            'price' => 'required|integer|min:0|max:9999999',
            'spicy' => 'required|integer|between:0,4',
        ]);
        $food->update($validated);

        $request->session()->flash('message', '保存しました');
        return redirect()->route('foods.index');
    }

    public function destroy(Request $request, Food $food)
    {
        $food->delete();

        $request->session()->flash('message', '削除しました');
        return redirect()->route('foods.index');
    }
}
