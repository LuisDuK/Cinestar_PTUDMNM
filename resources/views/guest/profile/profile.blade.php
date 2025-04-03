<x-index-guest>
    <x-slot name="title">Cinestar-Thông tin tài khoản</x-slot>
    <style>
    .container {
        background-color: transparent !important;
    }
    </style>
    <div class="container">
        <div class="row justify-content-center" style="background-color: none;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thông tin tài khoản</div>

                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('account.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone ?? '' }}">
                            </div>

                            <button type="submit" class="btn btn-success">Cập nhật thông tin</button>
                        </form>

                    </div>
                </div>

                <!-- Form đổi mật khẩu -->
                <div class="card mt-3">
                    <div class="card-header">Đổi mật khẩu</div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                        <form action="{{ route('account.change-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" name="confirm_password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-index-guest>