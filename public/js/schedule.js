// Chức năng cho phép kéo thả phần tử
function allowDrop(event) {
    event.preventDefault();
}

// Chức năng xử lý khi kéo phim
function drag(event) {
    event.dataTransfer.setData("text/plain", event.target.dataset.movieId);
}

function drop(event) {
    event.preventDefault();

    const movieId = event.dataTransfer.getData("text/plain"); // Cùng kiểu dữ liệu
    const movieElement = document.querySelector(`[data-movie-id="${movieId}"]`);

    if (movieElement) {
        const movieName = movieElement.textContent.trim();
        const cinema = event.target.closest(".schedule-cinema");

        if (cinema) {
            let movieContainer = cinema.querySelector(".movie-in-cinema");
            if (!movieContainer) {
                movieContainer = document.createElement("div");
                movieContainer.classList.add("movie-in-cinema");
                cinema.appendChild(movieContainer);
            }

            movieContainer.innerHTML = `<h2>${movieName}</h2> <p>(Mã phim: ${movieId})</p>`;
        }
    } else {
        console.error(`Không tìm thấy phần tử phim với ID: ${movieId}`);
    }
}

// Hiển thị modal thông báo
function showModal(message, duration = 3000) {
    const modal = document.getElementById("schedule-modal");
    const messageElement = document.getElementById(
        "schedule-notification-message"
    );
    const closeButton = document.querySelector(".schedule-close-button");

    if (!modal || !messageElement) return;

    // Kiểm tra nếu có message, nếu không thì hiển thị thông báo mặc định
    messageElement.textContent = message ? message : "Thông báo mặc định";

    modal.style.display = "block";

    // Sử dụng opacity và transition để làm hiệu ứng xuất hiện
    modal.style.opacity = "1";
    modal.style.transition = "opacity 0.5s ease-in-out";

    const hideTimeout = setTimeout(() => {
        modal.style.opacity = "0"; // Ẩn dần
        setTimeout(() => {
            modal.style.display = "none";
        }, 500); // Chờ 0.5 giây để hiệu ứng fade-out hoàn thành
    }, duration);

    if (closeButton) {
        closeButton.onclick = () => {
            clearTimeout(hideTimeout);
            modal.style.opacity = "0";
            setTimeout(() => {
                modal.style.display = "none";
            }, 500);
        };
    }
}

function saveSchedule() {
    const scheduleData = [];

    document.querySelectorAll(".schedule-cinema").forEach((cinema) => {
        const cinemaId = cinema.getAttribute("data-cinema-id");
        const movieElement = cinema.querySelector(".movie-title");
        const loaiHinhChieuSelect = cinema.querySelector(".loaiHinhChieu");
        const giaVeInput = cinema.querySelector(".giaVe");
        const dateInput = document.querySelector("#schedule-choose-date"); // Lấy ngày chiếu
        const timeInput = document.querySelector(
            'input[name="gioChieu"]:checked'
        ); // Lấy giờ bắt đầu

        // Lấy mã phim hiện tại
        const movieId = movieElement?.getAttribute("data-movie-id") || null;

        // Lấy loại hình chiếu
        const loaiHinhChieu = loaiHinhChieuSelect
            ? loaiHinhChieuSelect.value
            : "2D";

        // Lấy giá vé
        const giaVe = giaVeInput ? parseFloat(giaVeInput.value) || 0 : 0;

        // Lấy ngày chiếu & giờ bắt đầu
        const date = dateInput ? dateInput.value : null;
        const time = timeInput ? timeInput.value : null;

        // Lấy trạng thái trước đó từ HTML
        const previousData = cinema.getAttribute("data-previous");

        const previousState = previousData ? JSON.parse(previousData) : null;
        console.log("📌 Previous State", previousState);
        console.log("Phim sau cập nhập: ", movieId);
        console.log("Phim trước cập nhập: ", previousState.maPhim);
        let status = null;

        if (!movieId && previousState && previousState.maPhim) {
            status = "delete"; // Phim bị xóa
        } else if (
            movieId &&
            (!previousState || Number(previousState.maPhim) !== Number(movieId))
        ) {
            status = "insert"; // Phim mới
        } else if (
            movieId &&
            previousState &&
            Number(previousState.maPhim) === Number(movieId)
        ) {
            if (
                previousState.loaiHinhChieu !== loaiHinhChieu ||
                previousState.giaVe !== giaVe
            ) {
                status = "update"; // Cập nhật loại hình chiếu hoặc giá vé
            }
        }
        console.log(status);
        if (status) {
            scheduleData.push({
                maPhim: movieId,
                maPhongChieuPhim: cinemaId,
                ngayChieu: date,
                gioBatDau: time,
                loaiHinhChieu: loaiHinhChieu,
                giaVe: giaVe,
                status: status,
            });
        }
    });

    if (scheduleData.length === 0) {
        alert("Không có thay đổi nào cần lưu.");
        return;
    }

    // Lấy CSRF token từ meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Gửi AJAX request
    $.ajax({
        url: "/admin/quanlylichchieu/save",
        type: "POST",
        data: JSON.stringify({ schedules: scheduleData }),
        contentType: "application/json",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        },
        success: function (response) {
            console.log("📌 Server Response:", response);

            if (Array.isArray(response) && response.length > 0) {
                showModal(response[0].message); // Lấy message từ phần tử đầu tiên
            } else {
                showModal("❌ Không có thông báo từ server!");
            }
            console.log("✅ Lưu thành công, cập nhật trạng thái mới...");

            // Cập nhật trạng thái mới
            document.querySelectorAll(".schedule-cinema").forEach((cinema) => {
                const movieElement = cinema.querySelector(".movie-title");
                const movieId = movieElement?.dataset.movieId || null;
                const loaiHinhChieuElement = cinema.querySelector(
                    "select[name^='loaiHinhChieu']"
                );
                const giaVeElement = cinema.querySelector(
                    "input[name^='giaVe']"
                );

                if (movieId && loaiHinhChieuElement && giaVeElement) {
                    const newState = {
                        maPhim: movieId,
                        loaiHinhChieu: loaiHinhChieuElement.value,
                        giaVe: parseFloat(giaVeElement.value) || 0,
                    };
                    cinema.dataset.previous = JSON.stringify(newState);
                    console.log("📌 Trạng thái mới:", newState);
                } else {
                    cinema.dataset.previous = "";
                    console.log("❌ Reset trạng thái");
                }
            });
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            showModal("Lỗi kết nối tới server. Vui lòng thử lại.");
        },
    });
}

// Gán sự kiện cho các phần tử khi DOM đã tải xong
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".schedule-btn").forEach((movie) => {
        movie.addEventListener("dragstart", drag);
    });
    document.querySelectorAll(".schedule-btn").forEach((item) => {
        item.addEventListener("dragstart", function (event) {
            console.log("Bắt đầu kéo:", event.target.innerText);
            event.dataTransfer.setData(
                "text/plain",
                event.target.dataset.movieId
            );
        });
    });

    document.querySelectorAll(".schedule-cinema").forEach((cinema) => {
        cinema.addEventListener("dragover", function (event) {
            event.preventDefault(); // QUAN TRỌNG: Cho phép thả phim vào
            event.dataTransfer.dropEffect = "move";
        });
    });

    document.querySelectorAll(".delete-movie").forEach((button) => {
        button.addEventListener("click", removeMovie);
    });

    const saveButton = document.querySelector(".btn-save-schedule");
    if (saveButton) {
        saveButton.addEventListener("click", saveSchedule);
    }
    document.querySelectorAll(".schedule-cinema").forEach((dropzone) => {
        dropzone.addEventListener("dragover", function (event) {
            event.preventDefault(); // Cho phép thả
            this.style.backgroundColor = "#f0f0f0"; // Highlight khi kéo vào
        });

        dropzone.addEventListener("dragleave", function () {
            this.style.backgroundColor = ""; // Trở lại bình thường
        });

        dropzone.addEventListener("drop", function (event) {
            event.preventDefault();
            let movieId = event.dataTransfer.getData("text/plain");
            console.log(
                "Thả phim ID:",
                movieId,
                "vào",
                this.querySelector("h2").innerText
            );
            this.style.backgroundColor = "";
        });
    });
    const scheduleCinemaSections =
        document.querySelectorAll(".schedule-cinema");
    const movieListSection = document.querySelector(".schedule-movies-section"); // Khu vực danh sách phim

    // ✅ Xử lý khi kéo phim vào phòng
    scheduleCinemaSections.forEach((section) => {
        section.addEventListener("dragover", function (event) {
            event.preventDefault();
        });

        section.addEventListener("drop", function (event) {
            event.preventDefault();
            const movieId = event.dataTransfer.getData("text/plain");
            const movieElement = document.querySelector(
                `[data-movie-id="${movieId}"]`
            );
            if (!movieElement) return;

            const movieTitle = movieElement.innerText.trim();

            // ✅ Kiểm tra xem phòng đã có phần movie-details chưa
            let movieDetails = section.querySelector(".movie-details");
            if (!movieDetails) {
                movieDetails = document.createElement("div");
                movieDetails.classList.add("movie-details");
                movieDetails.innerHTML = `
                <p class="movie-title" draggable="true" data-movie-id="${movieId}">${movieTitle}</p>
            `;
                section.appendChild(movieDetails);
            } else {
                const titleElement = movieDetails.querySelector(".movie-title");
                titleElement.innerText = movieTitle;
                titleElement.setAttribute("data-movie-id", movieId);
                titleElement.setAttribute("draggable", "true");
            }

            // ✅ Gán sự kiện kéo cho phim trong phòng
            const titleElement = section.querySelector(".movie-title");
            titleElement.addEventListener("dragstart", function (e) {
                e.dataTransfer.setData("text/plain", movieId);
                e.dataTransfer.effectAllowed = "move";

                // ✅ Đánh dấu phòng hiện tại bị kéo ra
                section.setAttribute("data-current-drag", "true");
            });

            // ✅ Đánh dấu phòng có phim này
            section.setAttribute("data-has-movie", movieId);
        });
    });

    // ✅ Xử lý khi kéo phim ra ngoài
    movieListSection.addEventListener("dragover", function (event) {
        event.preventDefault();
    });

    movieListSection.addEventListener("drop", function (event) {
        event.preventDefault();
        const movieId = event.dataTransfer.getData("text/plain");

        // 🔍 Xác định phòng nào vừa bị kéo phim ra
        const draggedOutSection = document.querySelector(
            `.schedule-cinema[data-current-drag="true"]`
        );

        if (draggedOutSection) {
            // ❌ Xóa phim khỏi đúng phòng đang kéo ra
            const movieDetails =
                draggedOutSection.querySelector(".movie-details");
            if (movieDetails) {
                const titleElement = movieDetails.querySelector(".movie-title");
                titleElement.innerText = "Chưa có phim";
                titleElement.removeAttribute("data-movie-id");
                titleElement.removeAttribute("draggable");
            }

            // ❌ Xóa chỉ đánh dấu phòng bị kéo ra, không ảnh hưởng phòng khác
            draggedOutSection.removeAttribute("data-has-movie");
            draggedOutSection.removeAttribute("data-current-drag");
        }
    });
    document.querySelectorAll(".movie-title").forEach((movie) => {
        movie.setAttribute("draggable", "true");

        movie.addEventListener("dragstart", function (event) {
            event.dataTransfer.setData(
                "text/plain",
                event.target.dataset.movieId
            );
            event.target.closest(".schedule-cinema").dataset.currentDrag =
                "true";
        });
    });
    document
        .querySelector(".movie-list")
        .addEventListener("drop", function (event) {
            event.preventDefault();
            const movieId = event.dataTransfer.getData("text/plain");

            const draggedOutSection = document.querySelector(
                `.schedule-cinema[data-current-drag="true"]`
            );

            if (draggedOutSection) {
                const movieDetails =
                    draggedOutSection.querySelector(".movie-details");
                if (movieDetails) {
                    movieDetails.remove(); // Xóa hoàn toàn thông tin phim khỏi HTML
                }

                // Xóa các thuộc tính liên quan để phòng trở về trạng thái trống
                draggedOutSection.removeAttribute("data-has-movie");
                draggedOutSection.removeAttribute("data-current-drag");
                draggedOutSection.dataset.previous = JSON.stringify({
                    maPhim: null,
                    loaiHinhChieu: "",
                    giaVe: 0,
                });
            }
        });
});
