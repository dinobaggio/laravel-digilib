@extends('base.v_master_non')
@section('title', 'Detail File')


@section('nav_bar')
    @include('base.nav_non_user')
@endsection('nav_bar')

@section('content')


<div id="detail_file" style="overflow:auto">
@if ($file)
    
    <div id="main1" class="main1">
        <p><b>Judul :</b> {{ $file->judul }}</p>
        <p><b>Kategori :</b> {{ $file->kategori }}</p>
        <p><b>Uploader :</b> {{ $file->name }}</p>
        @if ($file->kategori == 'jurnal')
            <p><b>Abstrak :</b> {{ $file->abstrak }}</p>
        @endif
        <p><b>Created :</b> {{ time_elapsed_string($file->created_at)}}</p>
    </div>

    <div id="main2" class="main2">
        <h2>{{ $file->judul }}</h2>
        <p>Login untuk melihat atau mendownload file ini</p>
        
    </div>

@else
    <div>
        <h2>Tidak ada buku</h2>
    </div>
@endif

  
</div>

<script>
function view( url ) {
    window.open(url, "_self");
}
</script>


@endsection('content')

