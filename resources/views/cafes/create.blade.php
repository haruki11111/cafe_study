<x-layouts::app :title="'カフェ登録'">

    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            カフェ登録
        </h1>

        <form action="{{ route('cafes.store') }}" method="POST"
            onsubmit="document.getElementById('submitBtn').disabled=true;">

            @csrf

            <div class="mb-4">
                <label>カフェ名</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full" required placeholder="例: スターバックス 渋谷店">
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="mb-4">
                <label>最寄り駅</label>
                <input type="text" name="station" value="{{ old('station') }}" class="border p-2 w-full" required placeholder="例: 渋谷駅">
                <x-input-error :messages="$errors->get('station')" />
            </div>

            <div class="mb-4">
                <label>平均価格</label>
                <input type="text" name="average_price" value="{{ old('average_price') }}" class="border p-2 w-full" placeholder="半角数値で入力してください">
                <x-input-error :messages="$errors->get('average_price')" />
            </div>

            <div class="mb-4">
                <label class="block mb-2">Wi-Fi</label>

                <label class="mr-4">
                    <input type="radio" name="wifi" value="1" {{ old('wifi', '1') == '1' ? 'checked' : '' }}>
                    あり
                </label>

                <label>
                    <input type="radio" name="wifi" value="0" {{ old('wifi') === '0' ? 'checked' : '' }}>
                    なし
                </label>

                <x-input-error :messages="$errors->get('wifi')" />
            </div>

            <div class="mb-4">
                <label class="block mb-2">コンセント</label>

                <label class="mr-4">
                    <input type="radio" name="power_supply" value="1"
                        {{ old('power_supply', '1') == '1' ? 'checked' : '' }}>
                    あり
                </label>

                <label>
                    <input type="radio" name="power_supply" value="0"
                        {{ old('power_supply') === '0' ? 'checked' : '' }}>
                    なし
                </label>
            </div>

            <div class="mb-4">
                <label>静かさ</label>

                <select name="quiet_level" class="border p-2 w-full">

                    <option value="">選択してください</option>

                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" @selected(old('quiet_level') == $i)>
                            {{ $quietLevels[$i] }}
                        </option>
                    @endfor

                </select>

                <x-input-error :messages="$errors->get('quiet_level')" />
            </div>

            <div class="mb-4">
                <label>全体評価</label>

                <select name="rating" class="border p-2 w-full">

                    <option value="">選択してください</option>

                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" @selected(old('rating') == $i)>
                            {{ $ratings[$i] }}
                        </option>
                    @endfor

                </select>

                <x-input-error :messages="$errors->get('rating')" />
            </div>

            <div class="mb-4">
                <label>メモ</label>

                <textarea name="memo" class="border p-2 w-full" rows="4">{{ old('memo') }}</textarea>

                <x-input-error :messages="$errors->get('memo')" />
            </div>

            <button id="submitBtn" type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                保存
            </button>

        </form>

        <div class="mt-4">
            <a href="{{ route('cafes.index') }}" class="text-blue-500">
                戻る
            </a>
        </div>

    </div>

</x-layouts::app>
