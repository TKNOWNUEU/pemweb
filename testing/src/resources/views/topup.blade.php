@extends('layouts.main')

@section('content')

@auth
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('top.up.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Top Up <span class="text-danger">*</span></label>
                <input class="form-control" type="virtual_cash" name="virtual_cash" value="{{ old('virtual_cash') }}" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Isi V-Cash</button>
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
@endsection