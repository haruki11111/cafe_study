<?php

use App\Models\Cafe;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public Cafe $cafe;

    public bool $isFavorite = false;

    public function mount(Cafe $cafe): void
    {
        $this->cafe = $cafe;

        $this->isFavorite = Auth::user()
            ->favoriteCafes()
            ->whereKey($cafe->id) //モデルの主キーで絞り込むメソッド
            ->exists();
    }

    public function toggleFavorite(): void
    {
        Auth::user()
            ->favoriteCafes()
            ->toggle($this->cafe->id);

        $this->isFavorite = ! $this->isFavorite;
    }
};

?>

<div>
    <button
        wire:click="toggleFavorite"
        class="px-3 py-1 rounded border"
    >
        {{ $isFavorite ? '★ お気に入り済み' : '☆ お気に入り' }}
    </button>
</div>