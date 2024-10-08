@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light position-absolute position-absolute top-50 start-50 translate-middle">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-6 border-end border-secondary">
                            <div class="text-center">
                                <img src="{{ asset('img/login2.png') }}" style="width:200px; height:200px;">
                                <div class="h1 fw-bold">{{ __('SISAD') }}</div>
                                <div class="h4">{{ __('Sistema de Adquisición de Datos') }}</div>
                            </div>
                        </div>
                        <div class="col col-md-6 my-4">
                            <div class="h4">{{ __('Datos de usuario') }}</div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label text-md-end">{{ __('Email Address') }}</label>
                        
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                        <input id="email" type="email" class="form-control bg-dark text-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label text-md-end">{{ __('Password') }}</label>
                                    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                        <input id="password" type="password" class="form-control bg-dark text-light @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="offset">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div class="offset">
                                        <button type="submit" class="btn btn-primary">
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
        </div>
    </div>
</div>
@endsection
