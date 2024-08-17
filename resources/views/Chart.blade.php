<x-layouts.mainLayout>
    <div class="container">
        <div class="my-2">
            <x-error-success-message :$errors />
        </div>
        <div>
            <div class="fs-2">気分の波 <span class="fs-6 ms-2">ー 過去１ヶ月の気分の波を知ることができます ー</span></div>
        </div>
        <div class="mt-5 mb-5">
            <canvas id="myChart" width="400" height="100"></canvas>
        </div>
    </div>
    @push('scripts')
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: '感情ポイント',
                        data: @json($data),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
</x-layouts.mainLayout>
