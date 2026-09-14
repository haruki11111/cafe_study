<x-layouts::app :title="'ダッシュボード'">

    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6">
            📚 ダッシュボード
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-blue-100 rounded-lg shadow p-4">
                <div class="flex items-center gap-3">
                    <div class="text-3xl">⏰</div>

                    <div>
                        <div class="text-sm text-gray-600">
                            今月の勉強時間
                        </div>

                        <div class="text-2xl font-bold">
                            {{ floor($studyMinutes / 60) }}時間
                            {{ $studyMinutes % 60 }}分
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-100 rounded-lg shadow p-4">
                <div class="flex items-center gap-3">
                    <div class="text-3xl">🏆</div>

                    <div>
                        <div class="text-sm text-gray-600">
                            満足度No.1カフェ
                        </div>

                        <div class="text-xl font-bold">
                            {{ $bestCafe->name ?? 'なし' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex gap-4">

                <a href="{{ route('study-logs.create') }}" class="px-5 py-3 bg-blue-500 text-white rounded-lg">

                    勉強記録を追加

                </a>

                <a href="{{ route('study-logs.index') }}" class="px-5 py-3 bg-green-500 text-white rounded-lg">

                    勉強記録一覧

                </a>

                <a href="{{ route('cafes.index') }}" class="px-5 py-3 bg-gray-600 text-white rounded-lg">

                    カフェ一覧

                </a>

                <a href="{{ route('favorite-cafe.index') }}" class="px-5 py-3 bg-gray-600 text-white rounded-lg">

                    お気に入りカフェ一覧

                </a>

            </div>

        </div>

        <div class="mt-8 bg-white rounded-lg shadow p-6">

            <h2 class="text-xl font-bold mb-4">
                今月の勉強時間の推移
            </h2>

            <p class="text-sm text-gray-500 mb-4">
                縦軸：勉強時間（分）　横軸：利用日
            </p>

            <div class="h-120">
                <canvas id="studyChart"></canvas>
            </div>

        </div>
        
    </div>


        <script>
            function drawChart() {
                const labels = @json(
                    $chartData->map(function ($item) {
                        return \Carbon\Carbon::parse($item->visited_at)->format('n/j');
                    }));

                const data = @json($chartData->pluck('total_minutes'));

                new Chart(document.getElementById('studyChart'), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '勉強時間（分）',
                            data: data,
                            fill: false,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 30
                                },
                            }
                        }
                    }
                });
            }

            document.addEventListener('livewire:navigated', drawChart);
        </script>

</x-layouts::app>
