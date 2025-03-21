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

                    <form id="payment-form" method="post">
                        @csrf
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
                                <button type="submit">THANH TOÁN</button>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                <div class="dangnhap" style="color:white;">
                    <p>Đăng nhập để đặt vé</p>
                    <button class="btn btn-warning">
                        <a href="#" target="_blank"
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

                <!-- Thông tin khách hàng -->
                <p><strong>Tên khách hàng: </strong><span id="modal-customer-name"></span></p>
                <p><strong>SĐT: </strong><span id="modal-phone"></span></p>
                <p><strong>Email: </strong><span id="modal-email"></span></p>
                <p><strong>Tổng tiền: </strong><span id="modal-total-price">...</span></p>

                <div id="qr-code" style="text-align:center;">
                    <img src="Resources/Images/QR.jpg" alt="Mã QR Thanh Toán">
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
        $('#qr-code').append(countdownElement); // Đảm bảo phần tử #qr-code đã tồn tại trong DOM

        var interval = setInterval(function() {
            var minutes = Math.floor(countdownTimer / 60);
            var seconds = countdownTimer % 60;

            // Cập nhật hiển thị thời gian
            countdownElement.text(`Thời gian còn lại: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);

            countdownTimer--;

            // Hết thời gian
            if (countdownTimer < 0) {
                clearInterval(interval);
                countdownElement.text('Mã QR đã hết hạn. Vui lòng đặt lại vé.');
                $('#qr-code img').remove(); // Xóa mã QR sau khi hết hạn
            }
        }, 1000);
    }

    $(document).ready(function() {
        console.log("Document is ready!");

        var selectedSeats = [];
        var ticketPrice = <?php echo isset($ticketPrice) ? $ticketPrice : 0; ?>;
        var totalPrice = 0;
        var showtimeId = $seats;

        // Cập nhật các ghế đã đặt
        $.ajax({
            url: './modules/trangchu/ghedadat.php',
            type: 'GET',
            data: {
                showtime_id: showtimeId
            },
            success: function(response) {
                console.log("Response from server:",
                    response); // Kiểm tra dữ liệu trả về từ server

                // Kiểm tra nếu response là undefined hoặc không có trường bookedSeats
                if (typeof response !== 'object' || !response.hasOwnProperty(
                        'bookedSeats')) {
                    console.log('Dữ liệu không hợp lệ hoặc không có trường bookedSeats.');
                    return;
                }

                // Nếu response hợp lệ, xử lý dữ liệu bookedSeats
                if (response.bookedSeats && response.bookedSeats.length > 0) {
                    console.log("Booked seats:", response
                        .bookedSeats); // Log mảng bookedSeats

                    var bookedSeats = response.bookedSeats;
                    bookedSeats.forEach(function(seat) {
                        let seatId = seat;
                        console.log(`Checking seat: ${seatId}`); // Kiểm tra ghế
                        let targetSeat = $('#' + seatId);
                        console.log("Target seat element:",
                            targetSeat); // Kiểm tra phần tử ghế

                        if (targetSeat.length > 0) {
                            targetSeat.addClass('sold');
                            console.log(`Seat ${seatId} is marked as sold.`);
                        } else {
                            console.log('Không tìm thấy ghế:', seatId);
                        }
                    });
                } else {
                    console.log('Không có ghế đã đặt.');
                }
            },
            error: function(xhr, status, error) {
                console.log('Lỗi khi lấy dữ liệu ghế đã đặt', status, error);
            }


        });



        // Lắng nghe sự kiện click để chọn hoặc bỏ chọn ghế
        $('#table td div').click(function() {
            console.log("Click event triggered");
            var seatId = $(this).attr('id'); // Lấy ID của ghế được chọn
            console.log("Clicked on seat:", seatId);

            if ($(this).hasClass('sold')) {
                alert('Ghế đã được đặt!');
                return;
            } // Nếu ghế đã bán thì không thể chọn

            if ($(this).hasClass('activeseat')) {
                $(this).removeClass('activeseat'); // Bỏ chọn ghế
                selectedSeats = selectedSeats.filter(seat => seat !== seatId);
            } else {
                $(this).addClass('activeseat'); // Chọn ghế
                selectedSeats.push(seatId);
            }

            totalPrice = selectedSeats.length * ticketPrice;
            // Cập nhật thông tin ghế đã chọn và tổng tiền
            $('#selected-seat').text(selectedSeats.join(", "));
            $('#total-price').text(totalPrice);

            // Hiển thị hoặc ẩn các nút dựa trên số ghế đã chọn
            if (selectedSeats.length > 0) {
                showOnBtn();
            } else {
                hideOnBtn();
            }
        });

        // Lắng nghe sự kiện thanh toán
        $('#checkout-button').click(function(e) {
            e.preventDefault(); // Ngừng form submit

            // Lấy thông tin khách hàng
            var customerName = $('#first_name').val();
            var phone = $('#phone_number').val();
            var email = $('#email').val();

            // Lấy thông tin phim và lịch chiếu
            var movieTitle = $('#summary-details #title').text();
            var showtime = $('#summary-details #schedule').html();
            var totalPrice = $('#total-price').text();

            // Lấy phương thức thanh toán
            var paymentMethod = $("input[name='payment_method']:checked").val();
            if (!paymentMethod) {
                alert('Vui lòng chọn phương thức thanh toán!');
                return; // Ngừng xử lý nếu không chọn phương thức thanh toán
            }

            // Sao chép thông tin vào modal thanh toán
            $('#modal-payment #modal-title').text(movieTitle);
            $('#modal-payment #modal-showtime').html(showtime);
            $('#modal-payment #modal-total-price').text(totalPrice);

            // Hiển thị thông tin khách hàng trong modal
            $('#modal-payment #modal-customer-name').text(customerName);
            $('#modal-payment #modal-phone').text(phone);
            $('#modal-payment #modal-email').text(email);

            // Tạo dữ liệu QR Agribank
            var accountNumber = "4502205261434"; // Số tài khoản Agribank
            var currency = "704"; // Mã tiền tệ VND
            var qrData = `
        00|01
        01|12|AGB
        26|${accountNumber.length}|${accountNumber}
        52|0001
        53|${currency}
        54|${totalPrice}
        58|VN
        59|${customerName}
        60|Agribank
    `.trim().replace(/\n/g, '');

            // Sử dụng thư viện QRCode để tạo QR
            $('#qr-code').empty(); // Xóa mã QR cũ nếu có
            QRCode.toDataURL(qrData, function(err, url) {
                if (err) {
                    console.error("Error generating QR code", err);
                    alert('Đã xảy ra lỗi khi tạo mã QR');
                    return;
                }
                // Hiển thị mã QR trong modal


                var qrImage = `<img src="${url}" alt="Mã QR Thanh Toán Agribank">`;
                $('#qr-code').html(qrImage);
                startCountdown(5 * 60);
            });

            // Mở Modal thanh toán
            $('#modal-payment').show();
        });


        // Đóng Modal khi nhấn vào biểu tượng đóng (×)
        $('#close-modal').click(function() {
            $('#modal-payment').hide();
        });

        // Xử lý xác nhận thanh toán
        $('#confirm-payment-form').click(function(e) {
            e.preventDefault();

            var firstName = $("input[name='first_name']").val();
            var phoneNumber = $("input[name='phone_number']").val();
            var email = $("input[name='email']").val();

            // Kiểm tra thông tin khách hàng
            if (!firstName || !phoneNumber || !email) {
                alert("Vui lòng điền đầy đủ thông tin!");
                return;
            }

            var seatsBooked = selectedSeats.join(','); // Mảng ghế đã chọn thành chuỗi
            var totalAmount = $('#total-price').text();
            var paymentMethod = $("input[name='payment_method']:checked")
                .val(); // Lấy phương thức thanh toán

            // Gửi yêu cầu AJAX để lưu thông tin khách hàng, đơn hàng và chi tiết vé
            $.ajax({
                url: './modules/trangchu/xulythanhtoan.php',
                type: 'POST',
                data: {
                    first_name: firstName,
                    phone_number: phoneNumber,
                    email: email,
                    seats_booked: seatsBooked,
                    total_amount: totalAmount,
                    payment_method: paymentMethod,
                    showtime_id: showtimeId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status && response.status === 'success') {
                        alert('Thanh toán thành công!');
                        var order_id = response.order_id;
                        window.location.href =
                            'index.php?action=chitiet&maDonHang=' +
                            order_id;
                    } else {
                        console.log(response.status);
                        console.log("Unexpected response:", response);
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