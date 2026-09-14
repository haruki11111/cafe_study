<x-layouts::app :title="'勉強記録詳細'">

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">
            勉強記録詳細
        </h1>

        <table class="w-full border border-gray-300 mb-8">

            <tr>
                <th class="border p-2 bg-gray-100">カフェ名</th>
                <td class="border p-2">{{ $studyLog->cafe->name }}</td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">勉強時間</th>
                <td class="border p-2">{{ $studyLog->study_minutes }} 分</td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">満足度</th>
                <td class="border p-2">★ {{ $studyLog->satisfaction }}</td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">利用日</th>
                <td class="border p-2">{{ $studyLog->visited_at->format('Y/m/d') }}</td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">勉強内容</th>
                <td class="border p-2">{{ $studyLog->memo }}</td>
            </tr>

        </table>

        <h2 class="text-xl font-bold mb-4">
            このカフェでの勉強実績
        </h2>

        <table class="w-full border border-gray-300 mb-8">

            <tr>
                <th class="border p-2 bg-gray-100 w-40">
                    平均勉強時間
                </th>
                <td class="border p-2">
                    {{ $stats['avg'] ?? 0 }} 分
                </td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">
                    利用回数
                </th>
                <td class="border p-2">
                    {{ $stats['count'] }} 回
                </td>
            </tr>

            <tr>
                <th class="border p-2 bg-gray-100">
                    最高記録
                </th>
                <td class="border p-2">
                    {{ $stats['max'] ?? 0 }} 分
                </td>
            </tr>

        </table>

        <div class="mt-6 flex gap-3">

            <a href="{{ route('study-logs.edit', $studyLog->id) }}"
                class="w-28 text-center px-4 py-2 bg-blue-500 text-white rounded">
                編集
            </a>

            <form action="{{ route('study-logs.destroy', $studyLog->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <button type="submit" class="w-28 px-4 py-2 bg-red-500 text-white rounded"
                    onclick="return confirm('本当に削除しますか？')">

                    削除

                </button>

            </form>

            <a href="{{ route('study-logs.index') }}"
                class="w-28 text-center px-4 py-2 bg-gray-500 text-white rounded">

                一覧へ戻る

            </a>

        </div>

    </div>

</x-layouts::app>
