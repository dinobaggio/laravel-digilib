@extends('base.v_master')
@section('title', 'Selamat datang di digilib')

@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')

<style>
.centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

<div id="input_cari">
    <form action="{{ route('admin.homepage') }}" style="display:inline;">
        @if ($cari != '')
            <input type="text" name="cari" value="{{ $cari }}" /> <input type="submit" value="cari">
        @else
            <input type="text" name="cari" /> <input type="submit" value="cari">
        @endif
    </form>
</div>
<br>
@if ($files)
<div class="row">
    @foreach ($files as $file)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow" >
                <div class="container">
                    <center><div style="font-size:3em;" ><i class="fas fa-book"></i></div></center>
                </div>
                
                    <div class="card-body" >
                        <h3>{{$file->judul}}<a href="{{ route('admin.file', ['file_id'=> $file->id_file]) }}"></a></h3>
                        <p></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="halaman('{{ route('admin.file', ['file_id'=> $file->id_file]) }}')">View</button>
                            </div>
                            <small class="text-muted"><b>Kategori :</b> {{$file->kategori}}</small>
                        </div>
                    </div>
            </div>
        </div>
    @endforeach
</div>
<div class="pagination justify-content-center" >{{ $files->appends(request()->query())->links() }}</div> 
@else

<div>
    <h2>Tidak ada file</h2>
</div>
@endif
@endsection('content')
