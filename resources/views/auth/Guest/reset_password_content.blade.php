<x-index-guest>
    <x-slot name="title">
        Đổi mật khẩu
    </x-slot>
    <div class="container" style="width: 40%; text-align:center; margin:100px; margin-left: 400px;">
        <h3>Nhập lại mật khẩu</h3>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <table class="w-full border-collapse" style="text-align: left;">
                <!-- Email Address -->
                <tr>
                    <td class="pr-4 py-2 text-right">
                        <x-label for="email" :value="__('Email')" />
                    </td>
                    <td class="py-2">
                        <x-input id="email" class="block w-full" type="email" name="email"
                            style="margin-left:20px; width:300px;" :value="old('email', $request->email)" required
                            autofocus />
                    </td>
                </tr>

                <!-- Password -->
                <tr>
                    <td class="pr-4 py-2 text-right">
                        <x-label for="password" :value="__('Password')" />
                    </td>
                    <td class="py-2">
                        <x-input id="password" class="block w-full" type="password" name="password"
                            style="margin-left:20px; width:300px;" required />
                    </td>
                </tr>

                <!-- Confirm Password -->
                <tr>
                    <td class="pr-4 py-2 text-right">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    </td>
                    <td class="py-2">
                        <x-input id="password_confirmation" class="block w-full" type="password"
                            style="margin-left:20px; width:300px;" name="password_confirmation" required />
                    </td>
                </tr>

                <!-- Submit Button -->
                <tr>
                    <td></td>
                    <td class="py-2 text-right">
                        <x-button class="btn btn-success"> {{ __('Reset Password') }} </x-button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</x-index-guest>