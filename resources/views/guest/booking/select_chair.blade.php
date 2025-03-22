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
                        <div id="payment-method">
                            <label>Phương thức thanh toán:</label>
                            <div>
                                <input type="radio" id="momo" name="payment_method" value="momo" required>
                                <label for="momo">Quét mã MoMo</label>
                            </div>
                            <div>
                                <input type="radio" id="bank" name="payment_method" value="bank" required>
                                <label for="bank">Quét mã ngân hàng</label>
                            </div>
                        </div>
                        <div id="btn">
                            <button type="submit" id="checkout-button">THANH TOÁN</button>
                        </div>
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
    <div id="modal-payment" class="modal-payment">
        <div class="modal-content">
            <div style="display:flow;">
                <h3 style="float:left">Thanh toán</h3>
                <span class="close" id="close-modal" style="float:right;">&times;</span>
                <br style="clear:both;">
            </div>
            <div>
                <p><strong>Phim: </strong><span id="modal-title"></span></p>
                <p><strong>Lịch chiếu: </strong><span id="modal-showtime"></span></p>
                <p><strong>Tổng tiền: </strong><span id="modal-total-price"></span></p>

                <div id="qr-code" style="text-align:center;">
                    <img src="{{ asset('Resources/Images/DefaultPage/QR.jpg') }}" alt="Mã QR Thanh Toán">
                    <p><strong>Mã QR đã được tạo!</strong></p>
                </div>

                <form id="confirm-payment-form" style="text-align:center;">
                    <button type="submit" id="confirm-payment-ve" class="confirm-pay">Xác nhận thanh toán</button>
                </form>
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

    function startCountdown(duration) {
        console.log("Countdown started with duration:", duration);
        var countdownTimer = duration;
        var countdownElement = $('<p id="countdown-timer" style="font-weight: bold; color: red;"></p>');
        $('#qr-code').append(countdownElement);

        var interval = setInterval(function() {
            var minutes = Math.floor(countdownTimer / 60);
            var seconds = countdownTimer % 60;
            countdownElement.text(`Thời gian còn lại: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);
            countdownTimer--;

            if (countdownTimer < 0) {
                clearInterval(interval);
                countdownElement.text('Mã QR đã hết hạn. Vui lòng đặt lại vé.');
                $('#qr-code img').remove();
            }
        }, 1000);
    }

    $(document).ready(function() {
        console.log("Document is ready!");
        var selectedSeats = [];
        var movieData = @json($movie);
        var ticketPrice = movieData.ticket_price ?? 0;
        var showtimeId = movieData.showtimeId ?? 0;
        var totalPrice = 0;


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
            console.log("Ghế được nhấn:", $(this).attr('id'));
            var seatId = $(this).attr('id');
            if ($(this).hasClass('sold')) {
                alert('Ghế đã được đặt!');
                return;
            }
            $(this).toggleClass('activeseat');
            selectedSeats = $(this).hasClass('activeseat') ? [...selectedSeats, seatId] : selectedSeats
                .filter(seat => seat !== seatId);
            totalPrice = selectedSeats.length * ticketPrice;
            $('#selected-seat').text(selectedSeats.join(", "));
            $('#total-price').text(totalPrice);
            selectedSeats.length > 0 ? showOnBtn() : hideOnBtn();
        });

        $('#checkout-button').click(function(e) {
            e.preventDefault();
            var paymentMethod = $("input[name='payment_method']:checked").val();
            if (!paymentMethod) {
                alert('Vui lòng chọn phương thức thanh toán!');
                return;
            }

            var movieTitle = $('#title').text(); // ID của phần hiển thị tên phim
            var showtimeInfo = $('#schedule').text(); // ID của phần hiển thị lịch chiếu

            $('#modal-title').text(movieTitle);
            $('#modal-showtime').text(showtimeInfo);

            $('#modal-total-price').text(totalPrice);
            $('#qr-code').empty();
            startCountdown(5 * 60);
            $('#modal-payment').show();
        });

        $('#close-modal').click(function() {
            $('#modal-payment').hide();
        });

        $('#confirm-payment-form').click(function(e) {
            e.preventDefault();
            var formData = {
                seats_booked: selectedSeats.join(','),
                total_amount: totalPrice,
                payment_method: $("input[name='payment_method']:checked").val(),
                showtime_id: showtimeId
            };

            $.ajax({
                url: '{{ route("payment") }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Thanh toán thành công!');
                        window.location.href = '{{ route("order.details") }}?order_id=' +
                            response.order_id;
                    } else {
                        alert('Đã xảy ra lỗi, vui lòng thử lại.');
                    }
                },
                error: function() {
                    alert('Lỗi khi gửi thông tin thanh toán.');
                }
            });
        });
    });
    </script>
</x-index-guest>