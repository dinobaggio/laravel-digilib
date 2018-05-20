@extends('base.v_master_non')
@section('title', 'Selamat Datang di Digilib')

@section('nav_bar')
    @include('base.nav_mahasiswa')
@endsection('nav_bar')

@section('content')

<div id="form_edit_skripsi">
    @if ($skripsi != '')
    <form method="POST" action="{{ route('mahasiswa.edit_proses', ['file_id' => $skripsi->id_file]) }}" id="form_edit" enctype="multipart/form-data">
        @csrf 
        <input type="hidden" value="{{ $skripsi->id_file }}" name="id_file">
        <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Judul') }}</label>
    
                <div class="col-md-6">
                    <input id="judul" type="text" class="form-control" name="judul" value="{{ $skripsi->judul }}" placeholder="Judul" autofocus>
                </div>
            </div>
    
            <div class="form-group row">
                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>
    
                <div class="col-md-6">
                    <input id="file_data" type="file" class="form-control" name="file_data">
                </div>
            </div>
            
    
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
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
    @else
        <h2>Tidak Ada file / data</h2>
    @endif
    
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


<script>
function edit_proses () {
    let form_edit = document.getElementById('form_edit');
    let yakin = confirm('yakin ingin proses edit file?');
    if (yakin) {
        form_edit.submit();
    }
}

function view (url) {
    window.open(url, '_self')
}
</script>

@endsection('content')
