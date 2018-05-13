@extends('base.v_master')
@section('title', 'List Jurnal')

@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')

<div id="input_cari">
    <form class="form-inline my-2 my-lg-0">
        @if ($cari != '')
            <input class="form-control mr-sm-2" name="cari" value="{{ $cari }}" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
        @else
            <input class="form-control mr-sm-2" name="cari" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-scondary my-2 my-sm-0" type="submit">Search</button>
        @endif
    </form>
</div>
<br>
<div id='list_file'>
    @if ($files->total() != 0)
        
        @foreach($files as $file)

        <div class="card">
            <h5 class="card-header">{{ $file->kategori }}</h5>
            <div class="card-body">
                <h5 class="card-title">{{ $file->judul }}</h5>
                <p class="card-text"><b>Size : </b>{{ human_filesize($file->size) }}</p>
                <p class="card-text"><b>By : </b>{{ $file->name }}</p>
                <a href="javascript:view('{{ route('admin.file', ['file_id'=> $file->id_file]) }}')" class="btn btn-primary">Detail</a>
            </div>
        </div>
        <br>
        @endforeach
        <br>
        
        <div colspan="5" class="pagination justify-content-center" align="center">{{ $files->appends(request()->query())->links() }}</div>
        
        
    @endif
</div>

<script>

show_kategori ();
function view( url ) {
    window.open(url, "_self");
}
</script>


@endsection('content')

