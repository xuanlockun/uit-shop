<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Do an web chill' }}</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
  <link rel="stylesheet" href="login.css">
  <script src="{{ asset('script.js') }}"></script>
</head>
<div class="big_login">
  <section class="section_login">
      <div class="container">
          <div class="user signinBx">
              <div class="imgBx">
                  <img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img1.jpg" alt="" />
              </div>
              <div class="formBx">
                  <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <h2>Sign In</h2>
                      <!-- Email Address -->
                      <input id="email" class="nes-input" type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus autocomplete="username">
                      @if ($errors->has('email'))
                          <div class="nes-text is-error">
                              @foreach ($errors->get('email') as $message)
                                  <p>{{ $message }}</p>
                              @endforeach
                          </div>
                      @endif

                      <!-- Password -->
                      <input id="password" class="nes-input" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                      @if ($errors->has('password'))
                          <div class="nes-text is-error">
                              @foreach ($errors->get('password') as $message)
                                  <p>{{ $message }}</p>
                              @endforeach
                          </div>
                      @endif

                      <input type="submit" class="nes-btn" value="Login">
                      <p class="signup">
                          Don't have an account ?
                          <a href="#" onclick="toggleForm();">Sign Up.</a>
                      </p>
                  </form>
              </div>
          </div>
          <div class="user signupBx">
              <div class="formBx">
                  <form method="POST" action="{{ route('register') }}">
                      @csrf
                      <h2>Create an account</h2>
                      <!-- Name -->
                      <input id="name" class="nes-input" type="text" name="name" value="{{ old('name') }}" placeholder="Nickname" required autofocus autocomplete="name" />
                      @if ($errors->has('name'))
                          <div class="nes-text is-error"> 
                              @foreach ($errors->get('name') as $message)
                                  <p>{{ $message }}</p>
                              @endforeach
                          </div>
                      @endif

                      <!-- Email Address -->
                      <input id="email" class="nes-input" type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" />
                      @if ($errors->has('email'))
                          <div class="nes-text is-error"> 
                              @foreach ($errors->get('email') as $message)
                                  <p>{{ $message }}</p>
                              @endforeach
                          </div>
                      @endif

                      <!-- Password -->
                      <input id="password" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                      @if ($errors->has('password'))
                          <div class="nes-text is-error"> 
                              @foreach ($errors->get('password') as $message)
                                  <p>{{ $message }}</p>
                              @endforeach
                          </div>
                      @endif

                      <!-- Password Confirmation -->
                      <input id="password_confirmation" class="nes-input" type="password" name="password_confirmation" placeholder="Password Confirmation" required autocomplete="new-password" />
                      @if ($errors->has('password_confirmation'))
                          <div class="nes-text is-error"> 
                              @foreach ($errors->get('password_confirmation') as $message)
                                  <p>{{ $message }}</p>
                              @endforeach
                          </div>
                      @endif

                      <input type="submit" class="nes-btn" value="Register">
                      <p class="signup">
                          Already have an account ?
                          <a href="#" onclick="toggleForm();">Sign in.</a>
                      </p>
                  </form>
              </div>
              <div class="imgBx">
                  <img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img2.jpg" alt="" />
              </div>
          </div>
      </div>
  </section>
</div>

<script>
function toggleForm() {
  const signinBox = document.querySelector('.signinBx');
  const signupBox = document.querySelector('.signupBx');
  signinBox.classList.toggle('active');
  signupBox.classList.toggle('active');
}
</script>