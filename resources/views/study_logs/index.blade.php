<x-layouts::app :title="'勉強記録一覧'">

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">
            勉強記録一覧
        </h1>

        @if (session('message'))
            <div class="flex justify-center mb-6">
                <div class="bg-green-100 border border-green-300 text-green-800 font-bold px-6 py-3 rounded-lg shadow">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <form method="GET" action="{{ route('study-logs.index') }}"
            class="bg-gray-50 border rounded-lg p-4 mb-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-1">
                        カフェ名
                    </label>

                    <input type="text"
                        name="name"
                        value="{{ request('name') }}"
                        class="border rounded p-2 w-full" maxlength="255">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        利用日（開始）
                    </label>

                    <input type="date"
                        name="from_date"
                        value="{{ request('from_date') }}"
                        class="border rounded p-2 w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        利用日（終了）
                    </label>

                    <input type="date"
                        name="to_date"
                        value="{{ request('to_date') }}"
                        class="border rounded p-2 w-full">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        並び替え
                    </label>

                    <select name="sort"
                        class="border rounded p-2 w-full">

                        <option value="">指定なし</option>

                        <option value="study_minutes_desc"
                            @selected(request('sort') == 'study_minutes_desc')>
                            勉強時間 長い順
                        </option>

                        <option value="satisfaction_desc"
                            @selected(request('sort') == 'satisfaction_desc')>
                            満足度 高い順
                        </option>

                        <option value="visited_at_desc"
                            @selected(request('sort') == 'visited_at_desc')>
                            利用日 新しい順
                        </option>

                    </select>
                </div>

            </div>

            <div class="mt-4 flex gap-2">

                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded">
                    検索
                </button>

                <a href="{{ route('study-logs.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded">
                    クリア
                </a>

            </div>

        </form>

        <div class="overflow-x-auto">

            <table class="w-full border border-gray-300 bg-white">

                <thead>

                    <tr class="bg-gray-100">
                        <th class="border p-2">カフェ</th>
                        <th class="border p-2">勉強時間</th>
                        <th class="border p-2">満足度</th>
                        <th class="border p-2">利用日</th>
                        <th class="border p-2">勉強内容</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($studyLogs as $studyLog)

                        <tr class="hover:bg-gray-50">

                            <td class="border p-2">
                                <a href="{{ route('study-logs.show', $studyLog->id) }}"
                                    class="text-green-600 hover:underline">
                                    {{ $studyLog->cafe->name }}
                                </a>
                            </td>

                            <td class="border p-2">
                                {{ $studyLog->study_minutes }} 分
                            </td>

                            <td class="border p-2 text-center">
                                {{ $studyLog->satisfaction }}
                            </td>

                            <td class="border p-2">
                                {{ $studyLog->visited_at->format('Y/m/d') }}
                            </td>

                            <td class="border p-2">
                                {{ $studyLog->memo }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5"
                                class="border p-6 text-center text-gray-500">
                                該当するデータがありません
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-layouts::app>