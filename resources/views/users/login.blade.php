@extends('layouts.auth')
@section('content')
<div class="login-block">
    <h1>Masuk ke Akun Kamu</h1>

    <form action="{{ url('login') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('post') }}

        <input type="hidden" name="remember" value="1">
        
        @include('partials.validation')


        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-email"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Alamat pos-el" value="{{ old('email') }}" autofocus="true">
            </div>
        </div>

        <hr class="hr-xs">

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-unlock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Sandi Lewat">
            </div>
        </div>

        <button class="btn btn-primary btn-block" type="submit">Masuk</button>

        <div class="login-footer">
            <h6>Atau masuk dengan sosial media</h6>
            <ul class="social-icons">
                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>

    </form>
</div>

<div class="login-links">
    <a class="pull-left" href="{{ route('password.request') }}">Lupa sandi lewat?</a>
    <a class="pull-right" href="{{ route('register') }}">Daftar akun baru</a>
</div>
@endsection