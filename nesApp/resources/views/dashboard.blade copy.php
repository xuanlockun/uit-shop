<x-app-layout>
    {{-- <p>hi</p> --}}
    {{-- @if ($customer) 
    <h1>Thông tin khách hàng</h1>
    <p>Tên: {{ $customer->name }}</p>
    <p>Email: {{ $customer->user->email }}</p> 
    @else
    <p>Bạn chưa có thông tin khách hàng.  <a href="/customer/create">Tạo ngay</a></p> 
    @endif --}}
    {{-- <p>{{ $customer->fullname }}</p> --}}
    {{-- @include('profile.partials.update-profile-information-form') --}}
    <div class="nes-container with-title">
        <p class="title">Profile Information</p>
        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div >
                <label for="fullname">Fullname: </label>
                <input type="text" id="fullname" class="nes-input" name="fullname" value="{{ old('fullname', $customer ? $customer->fullname : '') }}" required> 
            </div>
            <div>
                <label for="birth">Date of birth: </label>
                <input type="date" id="birth" class="nes-input" name="birth" value="{{ old('birth', $customer ? $customer->birth : '') }}" placeholder="mm-dd-yyyy" min="1997-01-01" max="2030-12-31"> 
            </div>
            <div>
                <label for="phone">Phone number:</label>
                <input type="text" id="phone" class="nes-input" name="phone" value="{{ old('phone', $customer ? $customer->phone : '') }}"> 
            </div>
            <div>
                <label for="address">Addrress:</label>
                <input type="text" id="address" class="nes-input" name="address" value="{{ old('address', $customer ? $customer->address : '') }}">
            </div>
            <br>
            <div style="display: flex; justify-content: center; gap: 10px;">
            <button type="submit"  class="nes-btn is-primary">Save</button>
        </form>
        <br>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            
                <button type="submit" class="nes-btn">
                    {{ __('Log Out') }}
                </button>
            </form>
            </div>
    </div>
    {{-- @foreach ( $customer as $a )
    @endforeach --}}
    {{-- <p class="nes-text is-error">{{ $customer }}</p> --}}
    {{-- <p>{{ Auth::user()->customer()->fullname }}</p>  --}}
    <br>
    <div class="nes-container with-title">
        <p class="title">Container.is-centered</p>
        @include('profile.partials.update-profile-information-form')
        {{-- <p>Good morning. Thou hast had a good night's sleep, I hope.</p> --}}
    </div>
    <br>
    <div class="nes-container with-title">
        <p class="title">Change Password</p>
        @include('profile.partials.update-password-form')
    </div>

                            <!-- Authentication -->
</x-app-layout>


