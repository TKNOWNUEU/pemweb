@extends('layouts.main')

@section('content')

@auth
<p>Welcome <b>{{ Auth::user()->name }}</b></p>
<a class="btn btn-primary" href="{{ route('password') }}">Change Password</a>
<a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
<hr>
<p>V-Cash: <b>{{Auth::user()->virtual_cash}}</b></p>
<a href="{{route('payment')}}" class="btn btn-success">Pembayaran</a>
<a href="{{route('topup')}}" class="btn btn-info">Top Up</a>
<a href="{{route('transfer')}}" class="btn btn-warning">Transfer</a>
@endauth

@guest
<p>Masuk Dengan Akun</p>

<a class="btn btn-primary" href="{{ route('login') }}">Masuk</a>
<a class="btn btn-info" href="{{ route('register') }}">Daftar</a>

<p style="margin-top: 50px;">Masuk Sebagai Guest</p>

<a href="{{route('payment')}}" class="btn btn-success">Langsung Bayar</a>
<a href="{{route('transfer')}}" class="btn btn-warning">Transfer</a>
@endguest
@endsection