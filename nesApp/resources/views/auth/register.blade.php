<x-app-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">Nickname:</label>
            <input id="name" class="nes-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @if ($errors->has('name'))
                <div class="nes-text is-error"> 
                @foreach ($errors->get('name') as $message)
                    <p>{{ $message }}</p>
                @endforeach
                </div>
            @endif
        </div>

        <div>
            <label for="email">Email:</label>
            <input id="email" class="nes-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" />
            @if ($errors->has('email'))
                <div class="nes-text is-error"> 
                @foreach ($errors->get('email') as $message)
                    <p>{{ $message }}</p>
                @endforeach
                </div>
            @endif
        </div>

        <div>
            <label for="password">Password:</label>
            <input id="password" class="nes-input" type="password" name="password" required autofocus autocomplete="new-password" />
            @if ($errors->has('password'))
                <div class="nes-text is-error"> 
                @foreach ($errors->get('password') as $message)
                    <p>{{ $message }}</p>
                @endforeach
                </div>
            @endif
        </div>

        <div>
            <label for="password_confirmation">Password Confirmation:</label>
            <input id="password_confirmation" class="nes-input" type="password" name="password_confirmation" required autofocus autocomplete="new-password" />
            @if ($errors->has('password_confirmation'))
                <div class="nes-text is-error"> 
                @foreach ($errors->get('password_confirmation') as $message)
                    <p>{{ $message }}</p>
                @endforeach
                </div>
            @endif
        </div>
        <br>
        <a href="{{ route('login') }}">Already registered?</a>
        <button class="nes-btn" type="submit">Register</button>
    </form>
</x-app-layout>
