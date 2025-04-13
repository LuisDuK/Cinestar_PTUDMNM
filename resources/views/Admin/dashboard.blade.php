<x-index-admin>
    <x-slot name="title">Dashboard</x-slot>
    <div class="movies-container">
        <div class="dashboard">
            <h1>Dashboard</h1>

            <div class="statics">
                <a class="item" href="{{ route('quanly.phanquyen.chucnang') }}">
                    <h2>{{ $totalNV }}</h2>
                    <p>Nhân viên</p>
                </a>
                <div class="item">
                    <h2>{{ $totalKH }}</h2>
                    <p>Khách hàng</p>
                </div>
                <div class="item">
                    <h2>{{ number_format($totalRevenue, 2) }} VND</h2>
                    <p>Doanh thu</p>
                </div>
                <a class="item" href="{{ route('quanly.lichchieu') }}">
                    <h2>{{ $totalSuatChieu }}</h2>
                    <p>Suất chiếu</p>
                </a>
            </div>

            <div class="charts">
                <canvas id="revenueChart"></canvas>
                <h2>Biểu đồ doanh thu</h2>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const revenueData = @json($revenueValues);
        const revenueLabels = @json($revenueLabels);

        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: revenueData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            }
        });
    });
    </script>
</x-index-admin>