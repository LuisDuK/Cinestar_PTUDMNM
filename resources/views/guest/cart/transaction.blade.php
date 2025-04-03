<x-index-guest>
    <x-slot name="title">
        Lịch sử giao dịch
    </x-slot>

    <div class="giohang" style="background: white; padding-top:20px; text-align:center; padding-bottom:10px;">
        <h2 style="color:blue;">LỊCH SỬ GIAO DỊCH</h2>
        <div style="padding:10px;">
            <table id="trans-table" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th style="width: 12%; ">Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Phương thức thanh toán</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody id="tb-giohang">
                    @foreach ($orders as $order )
                    <tr>
                        <td>{{  $order->maDonHang}}</td>
                        <td>{{ $order->ngayDat }}</td>
                        <td>{{ number_format($order->tongTien, 0) }} VND</td>
                        <td>{{ $order->trangThai }}</td>
                        <td>{{ $order->phuongThucThanhToan }}</td>
                        <td><a href='{{route('ticket.detail', ['maDonHang'=> $order->maDonHang])  }}'>Xem chi
                                tiết</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
    $(document).ready(function() {
        $('#trans-table').DataTable({
            responsive: true,
            "bStateSave": true,
            language: {
                paginate: {
                    previous: "Trước",
                    next: "Tiếp"
                },
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ ",
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục"
            }
        });
    });
    </script>


</x-index-guest>