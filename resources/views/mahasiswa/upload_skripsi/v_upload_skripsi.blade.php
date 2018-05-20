@extends('base.v_master_non')
@section('title', 'Selamat Datang di Digilib')

@section('nav_bar')
    @include('base.nav_mahasiswa')
@endsection('nav_bar')

@section('content')
<div id="form_upload_jurnal">
    
    <center class="mb-5">
        <h2>Upload Jurnal</h2>
    </center>

    <form method="POST" action="{{ route('mahasiswa.upload_skripsi') }}" id="form_upload" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Judul') }}</label>

            <div class="col-md-6">
                <input id="judul" type="text" class="form-control" name="judul" value="{{ old('judul') }}" placeholder="Judul" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="file_data" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>

            <div class="col-md-6">
                <input id="file_data" type="file" class="form-control" name="file_data">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Upload') }}
                </button>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection('content')

