<x-index-admin>
    <x-slot name="title">Báo cáo</x-slot>
    <style>
    .card-body {
        background-color: white;
    }
    </style>
    <div class="schedule-container">
        <h2 class="mb-4 text-center" style="font-size:30px; margin-top:10px;">Dashboard Báo Cáo</h2>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">
                <label for="month" class="form-label me-2">Tháng:</label>
                <input type="month" style="background-color:white; color:black;" id="month" class="form-control"
                    value="{{ date('Y-m') }}">
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <label for="movie" class="form-label me-2">Chọn phim:</label>
                <select id="movie" class="form-control" style="background-color:white; color:black;">
                    <option value="">-- Chọn phim --</option>
                    <!-- Dữ liệu phim sẽ được load từ backend -->
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button class="btn btn-primary w-100" onclick="loadReport()">Xem báo cáo</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Doanh thu theo ngày</div>
                    <div class="card-body">
                        <canvas id="chartRevenueByDay"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Doanh thu theo phim</div>
                    <div class="card-body">
                        <canvas id="chartRevenueByMovie"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Doanh thu theo giờ</div>
                    <div class="card-body">
                        <canvas id="chartRevenueByHour"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    function renderChart(canvasId, label, data, labelKey, valueKey, chartType, isHorizontal = false) {
        let ctx = document.getElementById(canvasId).getContext('2d');

        // Kiểm tra nếu biểu đồ đã tồn tại, thì hủy nó trước
        if (window[canvasId] instanceof Chart) {
            window[canvasId].destroy();
        }

        window[canvasId] = new Chart(ctx, {
            type: chartType,
            data: {
                labels: data.map(item => item[labelKey]),
                datasets: [{
                    label: label,
                    data: data.map(item => item[valueKey]),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            },
            options: {
                indexAxis: isHorizontal ? 'y' : 'x'
            }
        });
    }


    function loadReport() {
        let month = document.getElementById('month').value;
        let movieId = document.getElementById('movie').value || ''; // Tránh null

        fetch(`/report/data?month=${month}&movie=${movieId}`)
            .then(response => response.json())
            .then(data => {
                renderChart('chartRevenueByDay', 'Doanh thu theo ngày', data.revenueByDay, 'day', 'revenue', 'bar');
                renderChart('chartRevenueByMovie', 'Doanh thu theo phim', data.revenueByMovie, 'movie', 'revenue',
                    'bar', true); // Biểu đồ ngang
                renderChart('chartRevenueByHour', 'Doanh thu theo suất chiếu', data.revenueByHour, 'suatChieu',
                    'revenue', 'bar');

            })
            .catch(error => console.error('Lỗi khi tải dữ liệu báo cáo:', error));
    }

    function loadMovies() {
        fetch(`/movies`)
            .then(response => response.json())
            .then(data => {
                let movieSelect = document.getElementById('movie');
                movieSelect.innerHTML = '<option value="">-- Chọn phim --</option>';
                data.forEach(movie => {
                    let option = document.createElement('option');
                    option.value = movie.id;
                    option.textContent = movie.name;
                    movieSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Lỗi khi tải danh sách phim:', error));
    }

    document.addEventListener("DOMContentLoaded", function() {
        loadMovies();
        loadReport();
    });

    document.getElementById('movie').addEventListener('change', loadReport);
    </script>

</x-index-admin>