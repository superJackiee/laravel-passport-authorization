@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="login btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form method="GET" action="{{ URL::to('home')}}" id="home">
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('.login').click(function (e) {
        e.preventDefault()
        var data = $('form').serialize()
        $.ajax({
            url: '/api/login',
            type: 'POST',
            data: data,
            success: function(response, status) {
                console.log(response)
                localStorage.setItem('user', response.user)
                localStorage.setItem('token', response.access_token)
                $('#home').submit();
            }
        })
    })
    // $('.teams').click(function () {
    //     const token = localStorage.getItem('token')
    //     if (!token) {
    //         alert("You are unauthorized user")
    //         return
    //     }
    //     $.ajax({
    //         url: '/api/teams',
    //         type: 'GET',
    //         data: {},
    //         headers: {
    //             Authorization: 'Bearer ' + token
    //         },
    //         success: function(response) {
    //             console.log('###############', response)
    //         }
    //     })
    // })
    // $('.resetPass').click(function () {
    //     const token = localStorage.getItem('token')
    //     if (!token) {
    //         alert("You are unauthorized user")
    //         return
    //     }
    //     $.ajax({
    //         url: '/api/reset-password',
    //         type: 'POST',
    //         data: {
    //             new_password: '12345567'
    //         },
    //         headers: {
    //             Authorization: 'Bearer ' + token
    //         },
    //         success: function(response) {
    //             if (response.success)
    //                 alert("Password Reset Successfully")
    //         }
    //     })
    // })
</script>
@endsection
