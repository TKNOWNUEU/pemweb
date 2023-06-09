@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.beasiswa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.beasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.id') }}
                        </th>
                        <td>
                            {{ $beasiswa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.beasiswaname') }}
                        </th>
                        <td>
                            {{ $beasiswa->beasiswaname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nisn') }}
                        </th>
                        <td>
                            {{ $beasiswa->nisn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.jenis_kelamin') }}
                        </th>
                        <td>
                            {{ $beasiswa->jenis_kelamin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.jurusan') }}
                        </th>
                        <td>
                            {{ $beasiswa->jurusan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.beasiswa.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $beasiswa->fakultas }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.beasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection