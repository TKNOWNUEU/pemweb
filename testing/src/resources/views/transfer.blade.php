@extends('layouts.main')

@section('content')

@auth
<h4>Anda melakukan transfer sebagai <b>{{ Auth::user()->name }}</b></h4>
<hr>
<p>V-Cash: <b>{{Auth::user()->virtual_cash}}</b></p>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('transfer.action') }}" method="POST">
            @csrf
            <input type="radio" id="optionA" name="transfer_option" value="account">
            <label for="optionA">Rekening</label>
            <input type="radio" id="optionB" name="transfer_option" value="virtual_cash">
            <label for="optionB">V-Cash</label>
            <div class="mb-3">
                <label>No Rekening Penerima <span class="text-danger">*</span></label>
                <input class="form-control" type="account_number" name="account_number" value="{{ old('account_number') }}" />
            </div>
            <div class="mb-3">
                <label>Nominal <span class="text-danger">*</span></label>
                <input class="form-control" type="value" name="value" value="{{ old('value') }}" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Transfer</button>
                <a class="btn btn-danger" href="{{ route('home') }}">Kembali</a>
            </div>
        </form>

        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if(session('fail'))
        <p class="alert alert-danger">{{ session('fail') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
    </div>
</div>
@endauth

@guest
<h4>Anda melakukan transfer sebagai <b>guest</b></h4>
<hr>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('guest.transfer.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>No Rekening Penerima <span class="text-danger">*</span></label>
                <input class="form-control" type="account_number" name="account_number" value="{{ old('account_number') }}" />
            </div>
            <div class="mb-3">
                <label>Nominal <span class="text-danger">*</span></label>
                <input class="form-control" type="value" name="value" value="{{ old('value') }}" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Transfer</button>
                <a class="btn btn-danger" href="{{ route('home') }}">Kembali</a>
            </div>
        </form>

        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if(session('fail'))
        <p class="alert alert-danger">{{ session('fail') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
    </div>
</div> 
@endguest
@endsection