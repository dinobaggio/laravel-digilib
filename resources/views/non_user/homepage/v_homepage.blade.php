@extends('base.v_master_non')
@section('title', 'Selamat datang di digilib')

@section('nav_bar')
    @include('base.nav_non_user')
@endsection('nav_bar')

@section('content')

<style>
.wrapper {
    padding:1em;
    display:grid;
    /*grid-template-columns: 50% 50%;*/
    grid-template-columns: repeat(3, 1fr);
    grid-gap:1em;
    grid-auto-rows: minmax(50px, auto);
}
.wrapper > div {
    background: #eee;
    padding: 1em;
}

.wrapper > div:nth-child(odd) {
    background:#ddd;
}
</style>

<div id="input_cari">
    <form action="{{ route('non_user.homepage') }}" style="display:inline;">
        @if ($cari != '')
            <input type="text" name="cari" value="{{ $cari }}" /> <input type="submit" value="cari">
        @else
            <input type="text" name="cari" /> <input type="submit" value="cari">
        @endif
    </form>
</div>

@if ($files)
<div class="wrapper">
    @foreach ($files as $file)
        <div>
            <h3><a href="{{ route('non_user.file', ['file_id'=> $file->id_file]) }}">{{$file->judul}}</a></h3>
            <center>
                <div style="font-size:3em;" ><i class="fas fa-book"></i></div>
            </center>
            <p><b>Kategori :</b> {{$file->kategori}}</p>
        </div>
    @endforeach
</div>
<div class="paginator" align="center">{{ $files->appends(request()->query())->links() }}</div> 
@else

<div>
    <h2>Tidak ada file</h2>
</div>
@endif
@endsection('content')
