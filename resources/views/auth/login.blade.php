<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
</head>

<body>
    <div class='bold-line'></div>
    <div class='container'>
        <div class='window'>
            <div class='overlay'></div>
            <div class='content'>
                <div class='welcome'>BeautyCall</div>
                <div class='subtitle'>First you need to register or login for using our services.</div>
                <div class='input-fields'>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type='text' placeholder='Email' class='input-line full-width @error(' email') is-invalid @enderror' name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input type='password' placeholder='Password' class='input-line full-width @error(' password') is-invalid @enderror' name="password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                </div> --}}
                <button type="submit" class='ghost-round full-width'>Login</button>
                </form>
            </div>
            <div class='spacing'><span class='highlight'><a href="{{ route('register') }}">Register</a></span></div>

            <div class='spacing'>
                <span class='highlight'>
                    <a href="{{ route('admin.register') }}">Work with us</a>
                </span>
            </div> 
        </div>
    </div>
    </div>
</body>
</html>
