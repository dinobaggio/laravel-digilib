@extends('base.v_master')
@section('title', 'Selamat datang di digilib')

@section('content')
<div id="input_cari">
    <form action="{{ route('admin.homepage') }}" style="display:inline;">
        @if ($cari != '')
            <input type="text" name="cari" value="{{ $cari }}" /> <input type="submit" value="cari">
        @else
            <input type="text" name="cari" /> <input type="submit" value="cari">
        @endif
    </form>
</div>

@if ($files)
<div class="flex-container">
    @foreach ($files as $file)
        <div>
            <center><h3><a href="{{ route('admin.file', ['file_id'=> $file->id_file]) }}">{{$file->judul}}</a></h3></center>
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
