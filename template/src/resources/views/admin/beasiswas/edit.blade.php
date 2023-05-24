@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.beasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.beasiswas.update", [$beasiswa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="beasiswaname">{{ trans('cruds.beasiswa.fields.beasiswaname') }}</label>
                <input class="form-control {{ $errors->has('beasiswaname') ? 'is-invalid' : '' }}" type="text" name="beasiswaname" id="beasiswaname" value="{{ old('beasiswaname', $beasiswa->beasiswaname) }}" required>
                @if($errors->has('beasiswaname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beasiswaname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.beasiswaname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nisn">{{ trans('cruds.beasiswa.fields.nisn') }}</label>
                <input class="form-control {{ $errors->has('nisn') ? 'is-invalid' : '' }}" type="text" name="nisn" id="nisn" value="{{ old('nisn', $beasiswa->nisn) }}" required>
                @if($errors->has('nisn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nisn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.nisn_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jenis_kelamin">{{ trans('cruds.beasiswa.fields.jenis_kelamin') }}</label>
                <input class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" type="text" name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin', $beasiswa->jenis_kelamin) }}" required>
                @if($errors->has('jenis_kelamin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jenis_kelamin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.jenis_kelamin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jurusan">{{ trans('cruds.beasiswa.fields.jurusan') }}</label>
                <input class="form-control {{ $errors->has('jurusan') ? 'is-invalid' : '' }}" type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', $beasiswa->jurusan) }}" required>
                @if($errors->has('jurusan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jurusan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fakultas">{{ trans('cruds.beasiswa.fields.fakultas') }}</label>
                <input class="form-control {{ $errors->has('fakultas') ? 'is-invalid' : '' }}" type="text" name="fakultas" id="fakultas" value="{{ old('fakultas', $beasiswa->fakultas) }}" required>
                @if($errors->has('fakultas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fakultas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.beasiswa.fields.fakultas_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection