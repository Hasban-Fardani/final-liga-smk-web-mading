<!-- The only way to do great work is to love what you do. - Steve Jobs -->
@extends('layout.admin')
@section('content')
    <div class="px-6 pt-3 pb-20 w-full">
        <div class="flex">
            <h2 class="text-3xl font-medium">Dashboard</h2>
            <button class="bg-blue-500 text-sm text-white px-4 py-1 ml-6 rounded-md hover:bg-blue-700" onclick="exportToPDF()">
                PDF
            </button>
        </div>
        <div class="border-t-2 border-gray-300 mt-2 mb-6"></div>

        <div class="flex flex-col gap-6 px-3 w-[800px]" id="content">
            {{-- card list --}}
            <div>
                <h3 class="text-xl font-medium">Overview</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 mt-2">
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">PENGUNJUNG (TOTAL)</h2>
                            <p class="text-lg">{{ $total_visitors }}</p>
                        </div>
                        <i class="fa-solid fa-users text-4xl"></i>
                    </div>
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">POSTINGAN (TOTAL)</h2>
                            <p class="text-lg">{{ $total_posts }}</p>
                        </div>
                        <i class="fa-solid fa-newspaper text-4xl"></i>
                    </div>
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">POSTINGAN (PENDING)</h2>
                            <p class="text-lg">{{ $total_pending_posts }}</p>
                        </div>
                        <i class="fa-solid fa-stopwatch text-4xl"></i>
                    </div>
                    <div class="bg-gray-100 rounded-md flex justify-between items-center gap-1 lg:max-w-[270px] h-24 px-4 ">
                        <div>
                            <h2 class="text-lg capitalize">CONTENT CREATOR</h2>
                            <p class="text-lg">{{ $total_creators }}</p>
                        </div>
                        <i class="fa-solid fa-user text-4xl"></i>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-medium">Statistik Pengunjung</h3>
                <form action="#">
                    <select name="month" id="">
                        <option value="{{ $month }}">bulan</option>
                    </select>
                </form>
                <div class="max-h-96 w-full">
                    <div class="flex flex-col md:flex-row items-center gap-4 mt-2">
                        <div class="w-full md:w-2/3">
                            <canvas id="statistik_pengunjung" width="500" height="200"></canvas>
                        </div>
                        <div class="w-full md:w-1/3">
                            <canvas id="kategori_pengunjung" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <h3 class="text-xl font-medium">Data Pengunjung</h3>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Waktu</th>
                        <th>IP Address</th>
                        <th>Browser</th>
                        {{-- <th>Platform</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors_table as $visitor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($visitor->user)
                                    {{ $visitor->user->username }}
                                @else
                                   -
                                @endif
                            </td>
                            <td>{{ $visitor->visited_at }}</td>
                            <td>{{ $visitor->ip_address }}</td>
                            <td>{{ $visitor->user_agent }}</td>
                            {{-- <td>{{ $visitor->platform }}</td> --}}
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
@endpush

@push('js')
    <script>
        var statistik_pengunjung = document.getElementById('statistik_pengunjung').getContext('2d');

        const lastDay = new Date(new Date().getFullYear(), {{ $month }}, 0).getDate();

        const data_statistik_pengunjung = {
            // all days of the month
            labels: Array.from({
                length: lastDay
            }, (_, i) => i + 1),
            datasets: [{
                label: 'Visitors',
                data: @json($visitors),
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const pie_data = @json($visitors_categories);
        const data_kategori_pengunjung = {
            labels: pie_data[0],
            datasets: [{
                label: 'Kategori',
                data: pie_data[1],

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


        const content = document.getElementById("content");
        function exportToPDF() {
            const opt = {
                margin: 0,
                filename: 'dashboard.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            html2pdf().set(opt).from(content).save();
        }
    </script>
@endpush
