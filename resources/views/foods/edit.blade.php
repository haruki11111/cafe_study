<x-layouts::app :title="'食べ物編集'">

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">食べ物編集</h1>

        <form action="{{ route('foods.update', $food->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>料理名</label>
                <input type="text" name="name" value="{{ $food->name }}" class="border p-2 w-full">
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="mb-4">
                <label>ジャンル</label>
                <select name="genre" class="border p-2 w-full">
                    @foreach($genres as $genre)
                        <option value="{{ $genre }}" {{ $food->genre == $genre ? 'selected' : '' }}>
                            {{ $genre }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('genre')" />
            </div>

            <div class="mb-4">
                <label>価格</label>
                <input type="number" name="price" value="{{ $food->price }}" class="border p-2 w-full">
                <x-input-error :messages="$errors->get('price')" />
            </div>

            <div class="mb-4">
                <label>辛さ</label>
                    <select name="spicy" class="border p-2 w-full">
                        @foreach($spicyOptions as $option)
                            <option value="{{ $option['value'] }}" {{ $food->spicy == $option['value'] ? 'selected' : '' }}>
                                {{ $option['label'] }}
                            </option>
                        @endforeach
                    </select>
                <x-input-error :messages="$errors->get('spicy')" />
            </div>

            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">更新</button>
        </form>

        <div class="mt-4">
            <a href="{{ route('foods.index') }}" class="text-blue-500">戻る</a>
        </div>
    </div>

</x-layouts::app>