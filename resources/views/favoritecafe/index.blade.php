<x-layouts::app :title="'お気に入りカフェ一覧'">

    <div class="p-6">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">
                お気に入りカフェ一覧
            </h1>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">カフェ名</th>
                        <th class="border p-2">最寄り駅</th>
                        <th class="border p-2 text-center">平均価格</th>
                        <th class="border p-2 text-center">Wi-Fi</th>
                        <th class="border p-2 text-center">コンセント</th>
                    </tr>
                </thead>

                <tbody>
                    @if (!$cafes->isEmpty())
                        @foreach ($cafes as $cafe)
                            <tr>

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
