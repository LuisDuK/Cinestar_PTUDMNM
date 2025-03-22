<x-index-guest>
    <x-slot name="title">
        Lịch sử giao dịch
    </x-slot>
    <style>
    /* CSS giữ nguyên */
    .table-gh {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
        background-color: #f9f9f9;
    }

    .table-gh th,
    .table-gh td {
        padding: 12px 15px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .table-gh th {
        background-color: rgb(164, 94, 239);
        color: white;
        font-weight: bold;
    }

    .table-gh tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .pagination {
        text-align: center;
        margin-top: 10px;
    }

    .pagination a {
        margin: 0 5px;
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #ddd;
    }

    .pagination a.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination ul {
        list-style: none;

    }
    </style>

    <div class="giohang" style="background: white; padding-top:20px; text-align:center; padding-bottom:10px;">
        <h2>GIỎ HÀNG</h2>
        <div>
            <table class="table-gh">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Phương thức thanh toán</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody id="tb-giohang">

                </tbody>
            </table>
        </div>
        <div class="pagination" id="pagination" style="justify-content: center; align-items: center;">
            {!! $orders->appends(request()->query())->links() !!}
        </div>

    </div>

    <script>
    $(document).ready(function() {
        function loadOrderData(page) {
            $.ajax({
                url: '{{ route("get.trans.table") }}?page=' + page,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#tb-giohang').html(response.orderHTML);
                    if (response.paginationHTML.trim() !== '') {
                        $('#pagination').html(response.paginationHTML);
                    } else {
                        $('#pagination').html(
                            '<ul class="pagination"><li><a class="btn-page" href="#">1</a></li></ul>'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi tải dữ liệu:", error);
                }
            });
        }

        // Khi bấm vào phân trang
        $(document).on('click', '#pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadOrderData(page);
        });

        // Load dữ liệu trang đầu tiên
        loadOrderData(1);
    });
    </script>


</x-index-guest>