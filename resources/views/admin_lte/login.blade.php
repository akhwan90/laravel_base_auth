@extends('admin_lte.layouts.depan')
@section('title', 'Login User')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>
    </div>
    
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">@yield('title')</p>
            @if (!empty($errors->first()))
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            @if (!empty(session('notif')))
                {!! session('notif') !!}
            @endif

            
            <form action="{{ url('/login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
            
            <a href="{{ url('/register') }}" class="text-center">Pendaftaran Akun</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
