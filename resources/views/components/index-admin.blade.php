<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="https://cinestar.com.vn/pictures/logo/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/movie.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/employee.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/thongke.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon"
        href="{{ asset('Resources/Images/DefaultPage/favicon.ico') }}Resources/favicon.ico">
</head>

<body data-bs-theme="dark">
    <div class="wrapper">

        <div class="container-fluid">
            <nav class="navbar navbar-expand-sm">
                <a href="{{ route('admin.dashboard') }}" class="logo-link">
                    <img src="{{ asset('resources/images/DefaultPage/logocinestar.webp') }}" alt="Cinestar Logo"
                        class="logo-image" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <form class="d-flex ms-auto">
                        <input class="form-control me-2" type="text" placeholder="Search" />
                        <button class="btn btn-primary search" type="button" style="margin-right: 50px">
                            Search
                        </button>
                    </form>
                    <div class="profile ms-auto d-flex align-items-center">
                        <div id="nameUser">
                            {{ Auth::user()->name }}
                        </div>
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('storage/profile/'.Auth::user()->avatar) }}" alt="Logo" style="
                        width: 40px;
                        border: 1px solid white;
                        margin-left: 10px;
                        height: 40px;
                    " class="rounded-pill" />
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">Thông tin
                                            cá nhân</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        @php
        $userId = Auth::id();
        $permissions = DB::table('nhanvien_chucnang')->where('maNV', $userId)->pluck('maChucNang')->toArray();
        @endphp
        <div id="main">
            <div class="sidebar">
                <div class="list-group">

                    <a href="{{ route('admin.dashboard') }}" id="dashboard"
                        class="list-group-item list-group-item-action custom-text-color">DASHBOARD</a>

                    @if(in_array(1, $permissions))
                    <a href="{{ route('quanly.phim') }}" id="quanlyphim"
                        class="list-group-item list-group-item-action custom-text-color">QUẢN LÝ PHIM</a>
                    @endif
                    @if(in_array(3, $permissions))
                    <a href="{{ route('quanly.lichchieu') }}" id="quanlylichchieu"
                        class="list-group-item list-group-item-action custom-text-color">QUẢN LÝ LỊCH CHIẾU</a>
                    @endif
                    @if(in_array(2, $permissions))
                    <a href="{{ route('quanly.phongchieu') }}" id="quanlyphongchieu"
                        class="list-group-item list-group-item-action custom-text-color">QUẢN LÝ PHÒNG CHIẾU</a>
                    @endif

                    @if(in_array(4, $permissions))
                    <a href="#" id="quanlyve" class="list-group-item list-group-item-action custom-text-color">QUẢN LÝ
                        VÉ</a>
                    @endif
                    @if(in_array(7, $permissions))
                    <a href="{{ route('quanly.nhansu') }}" id="quanlynhansu"
                        class="list-group-item list-group-item-action custom-text-color">QUẢN LÝ NHÂN SỰ</a>
                    @endif
                    @if(in_array(9, $permissions))
                    <a href="#" id="baocao" class="list-group-item list-group-item-action custom-text-color">BÁO CÁO</a>
                    @endif
                    @if(in_array(6, $permissions))
                    <button type="button"
                        class="list-group-item list-group-item-action custom-text-color dropdown-toggle drop-phanquyen"
                        data-bs-toggle="dropdown">
                        PHÂN QUYỀN
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="list-group-item list-group-item-action custom-text-color" href="#">TÌM THEO NHÓM
                                QUẢN LÝ</a></li>
                        <li><a class="list-group-item list-group-item-action custom-text-color" href="#">TÌM THEO NHÂN
                                VIÊN</a></li>
                        <li><a href="{{ route('quanly.phanquyen.chucnang') }}"
                                class="list-group-item list-group-item-action custom-text-color" href="#">TÌM THEO NHÓM
                                CHỨC NĂNG</a></li>
                    </ul>
                    @endif
                </div>
            </div>
            <div class="content">
                {{$slot}}
            </div>

        </div>
    </div>

</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.querySelector('.drop-phanquyen');
    dropdown.addEventListener('click', function() {
        const dropdownMenu = dropdown.nextElementSibling;
        dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu
            .style.display === '' ? 'block' : 'none';
    });
});
</script>

</html>