<x-app-layout>
    <section id="cart" class="section-p1">
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Cảm ơn bạn đã đăng ký, hãy nhấn nút gửi mail xác nhận để nhận mail xác thực tài khoản.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Một thư xác nhận đã được gửi vui lòng kiểm tra mail của bạn.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                {{-- <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button> --}}
                <button style="color: #fff; background-color: #088178;" class="normal">Gửi thư xác nhận</button>
            </div>
        </form>
<br><br>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
{{-- 
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button> --}}
            <button type="submit" style="color: #fff; background-color: #088178;" class="normal">Thoát</button>
        </form>
    </div>
    </section>
</x-app-layout>
