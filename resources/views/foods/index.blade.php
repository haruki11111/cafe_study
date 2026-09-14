<x-layouts::app :title="'食べ物一覧'">

    <div class="p-6">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">
                食べ物一覧
            </h1>
            @if (session('message'))
                <div class="text-blue-800 font-bold mb-4 text-lg">
                    {{ session('message') }}
                </div>
            @endif
            <a href="{{ route('foods.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                新規登録
            </a>
        </div>

        <form method="GET" action="{{ route('foods.index') }}" class="mb-4 space-y-2">

            <input type="text" name="name" value="{{ request('name') }}" placeholder="料理名"
                class="border p-2 rounded">

            <select name="genre" class="border p-2 rounded">
                @foreach ($genreOptions as $key => $opt)
                    <option value="{{ $opt['value'] }}" @selected(request('genre') == $opt['value'])>
                        {{ $opt['label'] }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="最低価格"
                class="border p-2 rounded">

            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="最高価格"
                class="border p-2 rounded">

            <select name="spicy" class="border p-2 rounded">
                @foreach ($spicyOptions as $key => $opt)
                    <option value="{{ $key }}" @selected(request('spicy') == $key)>
                        {{ $opt['label'] }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded">
                検索
            </button>

            <a href="{{ route('foods.index') }}" class="px-4 py-2 bg-gray-300 rounded">
                クリア
            </a>

        </form>

        <table class="w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">料理名</th>
                    <th class="border p-2">ジャンル</th>
                    <th class="border p-2">価格</th>
                    <th class="border p-2">辛さ</th>
                    <th class="border p-2">操作</th>
                </tr>
            </thead>

            <tbody>
                @if (!$foods->isEmpty())
                    @foreach ($foods as $food)
                        <tr>
                            <td class="border p-2">{{ $food->id }}</td>
                            <td class="border p-2">{{ $food->name }}</td>
                            <td class="border p-2">{{ $food->genre }}</td>
                            <td class="border p-2">{{ $food->price }}</td>
                            <td class="border p-2">{{ $spicyOptions[$food->spicy]['label'] ?? '' }}</td>
                            <td class="border p-2">
                                <a href="{{ route('foods.edit', $food->id) }}" class="text-blue-500">
                                    編集
                                </a>

                                <form action="{{ route('foods.destroy', $food->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-2"
                                        onclick="return confirm('本当に削除しますか？')">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="border p-2 text-center">該当するデータがありません</td>
                    </tr>
                @endif
            </tbody>

        </table>

    </div>

</x-layouts::app>
