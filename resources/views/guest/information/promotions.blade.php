<x-index-guest>
    <x-slot name="title">{{ __("Khuyến mãi") }}</x-slot>
    <section class="promotions">
        <h1>KHUYẾN MÃI</h1>
        <div class="promotion-slider" id="promotionSlider">
            <div class="promotion-item">
                <img src="Resources/Images/Defaultpage/chien-dia-tu-thi.webp" alt="Ngày Thành Viên" />
                <div class="promotion-text">
                    <h3>Ngày Thành Viên</h3>
                    <p>
                        Áp dụng giá 45K/2D và 55K/3D cho khách hàng là thành viên
                        Cinestar vào thứ 4 hàng tuần.
                    </p>
                </div>
            </div>
            <div class="promotion-item">
                <img src="Resources/Images/Defaultpage/km1.webp" alt="Học Sinh Sinh Viên" />
                <div class="promotion-text">
                    <h3>Học Sinh Sinh Viên</h3>
                    <p>Đồng giá 45K/ vé 2D cho HSSV tại mọi cụm rạp Cinestar.</p>
                </div>
            </div>
            <div class="promotion-item">
                <img src="Resources/Images/Defaultpage/km2.webp" alt="Ưu Đãi Trước 10h" />
                <div class="promotion-text">
                    <h3>Ưu Đãi Trước 10h</h3>
                    <p>Đồng giá 45K trước 10h sáng.</p>
                </div>
            </div>
            <div class="promotion-item">
                <img src="Resources/Images/Defaultpage/km3.jpeg" alt="Ưu Đãi Sau 10h" />
                <div class="promotion-text">
                    <h3>Ưu Đãi Sau 10h</h3>
                    <p>Đồng giá 45K sau 10h tối.</p>
                </div>
            </div>
        </div>
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
        <button class="show-all-btn"><b>TẤT CẢ ƯU ĐÃI</b></button>
    </section>
    <section class="members">
        <div class="member-card">
            <img src="Resources/Images/DefaultPage/thanhvien-cfriend.webp" alt="Thành viên C'FRIEND" />
            <div class="member-info">
                <h3>THÀNH VIÊN C'FRIEND</h3>
                <p>Thẻ C'Friend nhiều ưu đãi cho thành viên mới.</p>
                <button class="member-info-btn"><b>TÌM HIỂU NGAY</b></button>
            </div>
        </div>
        <div class="member-card">
            <img src="Resources/Images/DefaultPage/thanhvien-cvip.webp" alt="Thành viên C'VIP" />
            <div class="member-info">
                <h3>THÀNH VIÊN C'VIP</h3>
                <p>Thẻ VIP CineStar mang đến sự ưu đãi độc quyền.</p>
                <button class="member-info-btn"><b>TÌM HIỂU NGAY</b></button>
            </div>
        </div>
    </section>
</x-index-guest>