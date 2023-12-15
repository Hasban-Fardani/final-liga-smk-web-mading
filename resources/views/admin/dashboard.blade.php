<!-- The only way to do great work is to love what you do. - Steve Jobs -->
@extends('layout.admin')
@section('content')
    <div class="px-6 py-3 w-full md:w-[90%]" id="content">
        <h2 class="text-3xl font-medium">Dashboard</h2>
        <div class="border-t-2 border-gray-300 mb-6"></div>

        <div class="flex flex-col gap-3">
            {{-- card list --}}
            <div>
                <h3>Overview</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">PENGUNJUNG (TOTAL)</h2>
                            <p>{{ $total_visitors }}</p>
                        </div>
                        <i class="fa-solid fa-user text-4xl"></i>
                    </div>
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">POSTINGAN (TOTAL)</h2>
                            <p>{{ $total_posts }}</p>
                        </div>
                        <i class="fa-solid fa-newspaper text-4xl"></i>
                    </div>
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">POSTINGAN (PENDING)</h2>
                            <p>{{ $total_pending_posts }}</p>
                        </div>
                        <i class="fa-solid fa-newspaper text-4xl"></i>
                    </div>
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">CONTENT CREATOR</h2>
                            <p>{{ $total_creators }}</p>
                        </div>
                        <i class="fa-solid fa-user text-4xl"></i>
                    </div>
                </div>
            </div>

            <div>
                <h3>Statistik Pengunjung</h3>
                <div class="max-h-96 w-full">
                    <div class="flex items-center">
                        <div class="w-2/3">
                            <canvas id="statistik_pengunjung"></canvas>
                        </div>
                        <div class="w-1/3">
                            <canvas id="kategori_pengunjung"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var statistik_pengunjung = document.getElementById('statistik_pengunjung').getContext('2d');

        const lastDay = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

        const data_statistik_pengunjung = {
            // all days of the month
            labels: Array.from({
                length: lastDay
            }, (_, i) => i + 1),
            datasets: [{
                label: 'Visitors',
                data: [500, 1000, 750, 1250, 900, 1500],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const data_kategori_pengunjung = {
            labels: ['Kategori 1', 'Kategori 2', 'Kategori 3', 'Kategori 4', 'Kategori 5'],
            datasets: [{
                label: 'Kategori',
                data: [500, 1000, 750, 1250, 900],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ]
            }]
        }

        const lineChart = new Chart(statistik_pengunjung, {
            type: 'line',
            data: data_statistik_pengunjung,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true
            }
        });

        const pieChart = new Chart(kategori_pengunjung, {
            type: 'pie',
            data: data_kategori_pengunjung,
            options: {
                responsive: true
            }
        })
    </script>
@endpush
