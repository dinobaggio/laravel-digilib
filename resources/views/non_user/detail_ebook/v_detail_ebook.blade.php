@extends('base.v_master')
@section('title', 'Detail Book')


@section('nav_bar')
    @include('base.nav_non_user')
@endsection('nav_bar')

@section('content')


<div id="detail_book" style="overflow:auto">
@if ($book)
    
    <div id="main1" class="main1">
        <b>Judul :</b> {{ $book->judul }} <br>
        <b>Kategori :</b> {{ $book->kategori }} <br>
    </div>

    <div id="main2" class="main2">
        <h2>{{ $book->judul }}</h2>
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

