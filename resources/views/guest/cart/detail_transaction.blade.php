<x-index-guest>
    <x-slot name="title">
        Lịch sử giao dịch
    </x-slot>
    @if(session('success'))
    <script>
    alert("{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
    <script>
    alert("{{ session('error') }}");
    </script>
    @endif
    <div class="chitietdonhang" style="background:white; padding-left:50px; padding-top:20px; padding-bottom:40px;">
        <h2>Thông tin đơn hàng</h2>
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;">
                <p><strong>Mã đơn hàng:</strong> {{ $order->maDonHang }}</p>
                <p><strong>Ngày đặt:</strong> {{ $order->ngayDat }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->tongTien, 0, ',', '.') }} VND</p>
                <p><strong>Trạng thái:</strong> {{ $order->donHangTrangThai }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order->phuongThucThanhToan }}</p>

                <p><strong>Phim:</strong> {{ $order->phimTen }}</p>
                <p><strong>Ngày chiếu:</strong> {{ $order->ngayChieu }}</p>
                <p><strong>Giờ bắt đầu:</strong> {{ $order->suatChieu }}</p>
                <p><strong>Loại hình chiếu:</strong> {{ $order->loaiChieu }}</p>
                <p><strong>Giá vé:</strong> {{ number_format($order->giave, 0, ',', '.') }} VND</p>
                <p><strong>Danh sách ghế đã đặt:</strong> {{ $order->danh_sach_ghes_da_dat }}</p>
            </div>

            <div style="flex: 0 0 50%; text-align: center;">
                <div id="qr-code" style="justify-items: center;"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
    var maDonHang = "{{ $order->maDonHang }}";

    if (maDonHang.trim() !== "") {
        var qrData = '{{ url("order/detail/" . $order->maDonHang) }}';
        var qrcode = new QRCode(document.getElementById("qr-code"), {
            text: qrData,
            width: 350,
            height: 350
        });

        var qrTitle = document.createElement('h4');
        qrTitle.innerText = "Mã QR vé";
        document.getElementById("qr-code").appendChild(qrTitle);
    } else {
        console.log("Mã đơn hàng không hợp lệ");
    }
    </script>

</x-index-guest>