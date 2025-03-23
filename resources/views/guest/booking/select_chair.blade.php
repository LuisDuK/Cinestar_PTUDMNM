<x-index-guest>
    <x-slot name="title">
        Đặt ghế
    </x-slot>

    <div class="datghe" style="margin-bottom:40px;">
        <div id="nav-seat">
            <ul>
                <li><a href="#" id="first">CHỌN LỊCH CHIẾU</a></li>
                <li><a href="#" id="second">CHỌN NGÀY</a></li>
                <li><a href="#" id="third">THANH TOÁN</a></li>
            </ul>
        </div>
        <div id="whole-main">
            <div id="hall">
                <div id="trapezoid"></div>
                <table border="1">
                    @php
                    $alphabet = range('A', 'Z');
                    @endphp

                    @foreach ($seats as $seat)
                    @for ($i = 1; $i <= $seat->soHang; $i++)
                        <tr id="row" value="{{ $i }}">
                            <!-- Nhãn hàng ghế -->
                            <td class="row-label">
                                {{ $alphabet[$i - 1] }}
                            </td>
                            @for ($j = 1; $j <= $seat->soGhe; $j++)
                                <td id="col">
                                    <div id="{{ $alphabet[$i - 1] . $j }}"></div>
                                </td>
                                @endfor
                        </tr>
                        @endfor
                        @endforeach
                </table>
            </div>
            <div id="summary-details">
                <div id="summary">Thông tin chi tiết</div>

                @if ($movie)
                <div id="box">
                    <div id="image">
                        <img src="{{ asset('Resources/' . $movie->movie_image) }}" alt="Movie Image">
                    </div>
                    <div id="description">
                        <div id="title">{{ $movie->movie_title }}</div>
                        <div id="schedule">
                            <br>{{ date('d M Y  h:i a', strtotime($movie->start_time)) }}
                        </div>
                    </div>
                </div>
                <div id="seat">GHẾ(S): <div id="selected-seat">...</div>
                </div>
                <div id="total">TỔNG TIỀN: <div id="total-price">...</div>
                </div>
                @endif

                @if ($user)
                <div id="customer-info">
                    <input type="hidden" name="first_name" value="{{ $user['hoTen'] ?? '' }}" readonly>
                    <input type="hidden" name="phone_number" value="{{ $user['soDienThoai'] ?? '' }}" readonly>
                    <input type="hidden" name="email" value="{{ $user['email'] ?? '' }}" readonly>
                    <div id="show-payment">
                        <form method="POST" id="payment-form" action="">
                            @csrf
                            <div id="payment-method">

                                <label>Phương thức thanh toán:</label>
                                <div>
                                    <input type="radio" id="momo" name="payment_method" value="momo" required>
                                    <label for="momo">Thanh toán MoMo</label>
                                </div>
                                <div>
                                    <input type="radio" id="vnpay" name="payment_method" value="vnpay" required>
                                    <label for="vnpay">Thanh toán VNPAY</label>
                                </div>
                                <div>
                                    <input type="radio" id="vnpay" name="payment_method" value="vnpay" required>
                                    <label for="vnpay">Thanh toán PayPal</label>
                                </div>
                            </div>

                            <div id="btn">
                                <!--<button type="submit" id="checkout-button">THANH TOÁN</button>-->
                                <button type="submit" class="btn btn-success">THANH TOÁN</button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="dangnhap" style="color:white;">
                    <p>Đăng nhập để đặt vé</p>
                    <button class="btn btn-warning">
                        <a href="{{ route('auth') }}" target="_blank"
                            style="text-decoration:none; color:black; font-weight: bold; font-size: 15px; ">ĐĂNG
                            NHẬP</a>
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
    console.log("Before ready function");

    function showOnBtn() {
        document.getElementById('third').style.backgroundColor = 'white';
        document.getElementById('third').style.color = 'hsl(228, 13%, 15%)';
        document.getElementById('show-payment').style.opacity = '1';
        document.getElementById('show-payment').style.pointerEvents = "all";
    }

    function hideOnBtn() {
        document.getElementById('third').style.backgroundColor = 'hsl(228, 13%, 15%)';
        document.getElementById('third').style.color = 'white';
        document.getElementById('show-payment').style.opacity = '0';
    }

    $(document).ready(function() {
        console.log("Document is ready!");
        var selectedSeats = [];
        var movieData = @json($movie);
        var ticketPrice = movieData.ticket_price ?? 0;
        var showtimeId = movieData.showtimeId ?? 0;
        var totalPrice = 0;
        var selectedPaymentMethod = "VNPAY";

        $.ajax({
            url: '{{ route("bookedseats") }}',
            type: 'GET',
            data: {
                showtime_id: showtimeId
            },
            success: function(response) {
                if (!response || !response.bookedSeats) {
                    console.log('Không có dữ liệu ghế đã đặt.');
                    return;
                }
                response.bookedSeats.forEach(function(seat) {
                    $('#' + seat).addClass('sold');
                });
            },
            error: function() {
                console.log('Lỗi khi lấy dữ liệu ghế đã đặt');
            }
        });

        $(document).on('click', 'table tr td div', function() {
            var seatId = $(this).attr('id');

            // Kiểm tra xem ghế đã được đặt chưa
            if ($(this).hasClass('sold')) {
                alert('Ghế đã được đặt!');
                return;
            }

            // Thêm hoặc xóa ghế khỏi giỏ hàng
            $(this).toggleClass('activeseat');
            var seatIndex = selectedSeats.indexOf(seatId);

            if ($(this).hasClass('activeseat')) {
                if (seatIndex === -1) {
                    selectedSeats.push(seatId); // Thêm ghế vào giỏ
                }
            } else {
                if (seatIndex !== -1) {
                    selectedSeats.splice(seatIndex, 1); // Xóa ghế khỏi giỏ
                }
            }

            // Cập nhật thông tin giỏ hàng
            var cartData = {
                seats: selectedSeats,
                totalPrice: selectedSeats.length * ticketPrice,
                movieTitle: movieData.movie_title,
                showtimeId: showtimeId,
                ticketPrice: ticketPrice,
                paymentMethod: selectedPaymentMethod
            };
            console.log(cartData);
            // Gửi giỏ hàng lên server
            $.ajax({
                url: '{{ route("update.cart") }}', // route để lưu giỏ hàng
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cart: cartData // Gửi tất cả thông tin giỏ hàng lên server
                },
                success: function(response) {
                    console.log("Giỏ hàng đã được cập nhật", response);
                }
            });

            // Cập nhật thông tin hiển thị
            $('#selected-seat').text(selectedSeats.join(", "));
            $('#total-price').text(cartData.totalPrice);

            // Hiển thị hoặc ẩn nút thanh toán
            selectedSeats.length > 0 ? showOnBtn() : hideOnBtn();
        });
        document.getElementById('payment-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
            if (selectedPayment === "momo") {
                this.action = "{{ route('momo.payment') }}";
            } else if (selectedPayment === "vnpay") {
                this.action = "{{ route('vnpay.payment') }}";
            } else if (selectedPayment === "paypal") {
                this.action = "{{ route('paypal.payment') }}";
            } else {
                alert("Vui lòng chọn phương thức thanh toán");
                return;
            }
            var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();
            var cartData = {
                seats: selectedSeats,
                totalPrice: selectedSeats.length * ticketPrice,
                movieTitle: movieData.movie_title,
                showtimeId: showtimeId,
                ticketPrice: ticketPrice,
                paymentMethod: selectedPaymentMethod // Thêm phương thức thanh toán vào giỏ hàng
            };

            // Gửi giỏ hàng lên server
            $.ajax({
                url: '{{ route("update.cart") }}', // route để lưu giỏ hàng
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cart: cartData // Gửi tất cả thông tin giỏ hàng lên server
                },
                success: function(response) {
                    console.log("Giỏ hàng đã được cập nhật", response);
                    // Sau khi giỏ hàng đã được cập nhật, submit form
                    this.submit();
                }.bind(this)
            });
            this.submit();
        });
    });
    </script>
</x-index-guest>