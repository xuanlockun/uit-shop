{{-- <x-app-layout>
    <!-- Session Status -->
    @if(session('status'))
    <div class="nes-text is-success">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="nes-field">
            <label for="email">Email:</label>
            <input id="email" class="nes-input" type="email" name="email" value="<?php echo old('email'); ?>" required autofocus autocomplete="username">
            @if ($errors->has('email'))
            <div class="nes-text is-error">
                @foreach ($errors->get('email') as $message)
                    <br>
                    <p>{{ $message }}</p>
                @endforeach
            </div>
        @endif
        </div>

        <!-- Password -->
        <div class="">
            <label for="password">Password:</label>
            <input id="password" class="nes-input" type="password" name="password" required autocomplete="current-password">
            
            <?php if ($errors->has('password')): ?>
                <div class="mt-2">
                    <?php foreach ($errors->get('password') as $message): ?>
                        <p><?php echo $message; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        
        </div>

        <!-- Remember Me -->
        <div class="">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="nes-checkbox" name="remember">
                <span class="nes-text">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        </div>
        <div style="align-items: center;">
        <button type="submit" class="nes-btn">Log in</button>
        </div>
    </form>
</x-app-layout> --}}

<x-app-layout>
    @include('auth.login_temp')
</x-app-layout>