<x-layouts::app :title="'カフェ詳細'">

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">
            カフェ詳細
        </h1>

        <table class="w-full border border-gray-300">

            <tr>
                <th class="border p-2 bg-gray-100 w-48">カフェ名</th>
                <td class="border p-2">{{ $cafe->name }}</td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">最寄り駅</th>
                <td class="border p-2">{{ $cafe->station }}</td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">平均価格</th>
                <td class="border p-2">{{ $cafe->average_price ? number_format($cafe->average_price) . '円' : '-' }}</td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">Wi-Fi</th>
                <td class="border p-2">
                    {{ $cafe->wifi ? 'あり' : 'なし' }}
                </td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">コンセント</th>
                <td class="border p-2">
                    {{ $cafe->power_supply ? 'あり' : 'なし' }}
                </td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">静かさ</th>
                <td class="border p-2">
                    {{ $quietLevels[$cafe->quiet_level] }}
                </td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">全体評価</th>
                <td class="border p-2">
                    {{ $cafe->rating ? $ratings[$cafe->rating] : '-' }}
                </td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">メモ</th>
                <td class="border p-2">
                    {{ $cafe->memo }}
                </td>
            </tr>

        </table>

        <div class="mt-6 flex gap-2">

            <a href="{{ route('cafes.edit', $cafe->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                編集
            </a>

            <form action="{{ route('cafes.destroy', $cafe->id) }}" method="POST"
                onsubmit="return confirm('本当に削除しますか？')">

                @csrf
                @method('DELETE')

                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">
                    削除
                </button>

            </form>

            <a href="{{ route('cafes.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                一覧へ戻る
            </a>

        </div>

    </div>

</x-layouts::app>
