<x-layouts::app :title="'勉強記録登録'">

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            勉強記録登録
        </h1>

        <form action="{{ route('study-logs.store') }}" method="POST">

            @csrf

            <div class="mb-4">
                <label>カフェ</label>
                <select name="cafe_id" class="border p-2 w-full">

                    <option value="">選択してください</option>

                    @foreach ($cafes as $cafe)
                        <option value="{{ $cafe->id }}">
                            {{ $cafe->name }}
                        </option>
                    @endforeach

                </select>

                <x-input-error :messages="$errors->get('cafe_id')" />
            </div>

            <div class="mb-4">
                <label>勉強時間（分）</label>
                <input type="number"
                       name="study_minutes"
                       class="border p-2 w-full" min="1" max="1440">

                <x-input-error :messages="$errors->get('study_minutes')" />
            </div>

            <div class="mb-4">
                <label>満足度</label>

                <select name="satisfaction" class="border p-2 w-full">
                    <option value="">選択してください</option>

                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">
                            {{ $i }}
                        </option>
                    @endfor

                </select>

                <x-input-error :messages="$errors->get('satisfaction')" />
            </div>

            <div class="mb-4">
                <label for="visited_at">利用日</label>

                <input type="date"
                       id="visited_at"
                       name="visited_at"
                       class="border p-2 w-full">

                <x-input-error :messages="$errors->get('visited_at')" />
            </div>

            <div class="mb-4">
                <label>勉強内容</label>

                <textarea name="memo"
                          rows="4"
                          class="border p-2 w-full"></textarea>

                <x-input-error :messages="$errors->get('memo')" />
            </div>

            <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded">
                保存
            </button>

        </form>

        <div class="mt-4">

            <a href="{{ route('study-logs.index') }}"
                class="text-blue-500">
                戻る
            </a>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $('#visited_at').on('click', function() {
            if (this.showPicker) {
                this.showPicker();
            }
        });
    </script>

</x-layouts::app>