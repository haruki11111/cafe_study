<x-layouts::app :title="'カフェ一覧'">

    <div class="p-6">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">
                カフェ一覧
            </h1>
        </div>

        @if (session('message'))
            <div class="flex justify-center mb-6">
                <div class="bg-green-100 border border-green-300 text-green-800 font-bold px-6 py-3 rounded-lg shadow">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <form method="GET" action="{{ route('cafes.index') }}" class="mb-6">

            <div class="flex flex-wrap gap-4 items-end">

                <div>
                    <label class="block text-sm font-medium mb-1">カフェ名</label>
                    <input type="text" name="name" value="{{ request('name') }}" class="border p-2 rounded w-64"
                        maxlength="255">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">最寄り駅</label>
                    <input type="text" name="station" value="{{ request('station') }}"
                        class="border p-2 rounded w-64" maxlength="255">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">静かさ</label>
                    <select name="quiet_level" class="border p-2 rounded">
                        <option value="">指定なし</option>

                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(request('quiet_level') == $i)>
                                {{ $quietLevels[$i] }}
                            </option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="flex gap-6 mt-4">

                <label>
                    <input type="checkbox" name="wifi" value="1" @checked(request('wifi'))>

                    Wi-Fiあり
                </label>

                <label>
                    <input type="checkbox" name="power_supply" value="1" @checked(request('power_supply'))>

                    コンセントあり
                </label>

            </div>

            <div>
                <label class="block text-sm font-medium mb-1">並び替え</label>

                <select name="sort" class="border p-2 rounded">

                    <option value="">指定なし</option>

                    <option value="rating_desc" @selected(request('sort') == 'rating_desc')>
                        全体評価 高い順
                    </option>

                    <option value="price_asc" @selected(request('sort') == 'price_asc')>
                        平均価格 安い順
                    </option>

                    <option value="quiet_desc" @selected(request('sort') == 'quiet_desc')>
                        静かさ 静か順
                    </option>

                </select>

            </div>

            <div class="mt-4">

                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded">
                    検索
                </button>

                <a href="{{ route('cafes.index') }}" class="px-4 py-2 bg-gray-300 rounded">
                    クリア
                </a>

            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">お気に入り</th>
                        <th class="border p-2">全体評価</th>
                        <th class="border p-2">カフェ名</th>
                        <th class="border p-2">最寄り駅</th>
                        <th class="border p-2 text-center">平均価格</th>
                        <th class="border p-2 text-center">Wi-Fi</th>
                        <th class="border p-2 text-center">コンセント</th>
                        <th class="border p-2 text-center">静かさ</th>
                    </tr>
                </thead>

                <tbody>
                    @if (!$cafes->isEmpty())
                        @foreach ($cafes as $cafe)
                            <tr>
                                <td class="border p-2 text-center">
                                    <livewire:favorite-button :cafe="$cafe" :key="'favorite-' . $cafe->id" />
                                </td>

                                <td class="border p-2 text-center">
                                    {{ $cafe->rating ? $ratings[$cafe->rating] : '-' }}
                                </td>

                                <td class="border p-2">
                                    <a href="{{ route('cafes.show', $cafe->id) }}" class="text-blue-500 underline">
                                        {{ $cafe->name }}
                                    </a>
                                </td>

                                <td class="border p-2">
                                    {{ $cafe->station }}
                                </td>

                                <td class="border p-2 text-center">
                                    {{ $cafe->average_price ? number_format($cafe->average_price) . '円' : '-' }}
                                </td>

                                <td class="border p-2 text-center">
                                    {{ $cafe->wifi ? '○' : '×' }}
                                </td>

                                <td class="border p-2 text-center">
                                    {{ $cafe->power_supply ? '○' : '×' }}
                                </td>

                                <td class="border p-2 text-center">
                                    {{ $quietLevels[$cafe->quiet_level] }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="border p-2 text-center">
                                該当するデータがありません
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>

        </div>

</x-layouts::app>
