@extends('base.v_master_non')
@section('title', 'Selamat Datang di Digilib')

@section('nav_bar')
    @include('base.nav_non_user')
@endsection('nav_bar')


@section('jumbotron')

<div class="container-fluid mb-4">
  <div class="jumbotron bg-secondary">
    <h1 class="text-light">@yield('title')</h1> 
    <p></p> 
  </div>
</div>

@endsection('jumbotron')



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
@if ($files)
<div class="row">
    @foreach ($files as $file)
        <div class="col-md-4 ">
            <div class="card mb-4 box-shadow" >
                <div class="container bg-dark" style="height:100px;">
                    <center><div class="text-light" style="font-size:3em;padding-top:5%" ><i class="fas fa-book"></i></div></center>
                </div>
                
                    <div class="card-body" >
                        <h4><a class="nav-link" href="{{ route('non_user.file', ['file_id'=> $file->id_file]) }}">{{$file->judul}}</a></h4>
                        <p><b>Kategori :</b> {{ $file->kategori }} </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="halaman('{{ route('non_user.file', ['file_id'=> $file->id_file]) }}')">View</button>
                            </div>
                            <small class="text-muted">{{ time_elapsed_string($file->created_at)}}</small>
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

