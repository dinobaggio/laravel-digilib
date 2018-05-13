@extends('base.v_master')
@section('title', 'Upload File')

@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')

<div id="form_upload_file">
    <form method="POST" action="{{ route('admin.upload_proses') }}" id="form_upload" enctype="multipart/form-data">
    {{csrf_field()}}
    
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Judul') }}</label>

            <div class="col-md-6">
                <input id="judul" type="text" class="form-control" name="judul" value="{{ old('judul') }}" placeholder="Judul" autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="kategori" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>
            <div class="col-md-6">
                <select name="kategori" id="tagKategori" class="form-control" value="{{ old('kategori') }}" onchange="tampil_abstrak()">
                    <option value="">Pilih Kategori</option>
                    <option value="ebook">E-Book</option>
                    <option value="jurnal">Jurnal</option>
                    <option value="artikel">Artikel</option>
                    <option value="skripsi">Skripsi</option>
                </select>
            </div>
        </div>

        <div class="form-group row" id="divAbstrak" style="display:none;">
            <label for="abstrak" class="col-md-4 col-form-label text-md-right">{{ __('Abstrak') }}</label>

            <div class="col-md-6">
                <textarea type="text" class="form-control" name="abstrak" placeholder="Abstrak ..." > </textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="abstrak" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>

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



<script>
tampil_abstrak();
function upload_proses () {
    let form_upload = document.getElementById('form_upload');
    let yakin = confirm('yakin ingin proses upload file?');
    if (yakin) {
        form_upload.submit();
    }
}

function tampil_abstrak () {
    let kategori = document.getElementById('tagKategori');
    let abstrak = document.getElementById('divAbstrak');
    if (kategori.value == 'jurnal') {
        abstrak.style.display = '';
    } else {
        abstrak.style.display = 'none';
    }
}
</script>

@endsection('content')
