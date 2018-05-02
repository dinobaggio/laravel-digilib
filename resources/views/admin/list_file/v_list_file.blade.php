@extends('base.v_master')
@section('title', 'List File')

@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')

<div id="input_cari">
    <form action="{{ route('admin.list_file') }}" style="display:inline;">
        @if ($cari != '')
            <input type="text" name="cari" value="{{ $cari }}" /> <input type="submit" value="cari">
        @else
            <input type="text" name="cari" /> <input type="submit" value="cari">
        @endif
    </form>
</div>

<div id='list_buku'>
    @if ($files->total() != 0)
        <table>
        <tr>
            <th>Judul</th>
            <th>Size</th>
            <th>Kategori</th>
            <th>View</th>
        </tr>
        @foreach($files as $file)
        <tr>
            <td>{{ $file->judul }}</td>
            <td>{{ human_filesize($file->size) }}</td>
            <td>{{ $file->kategori }}</td>
            <td><button onclick="view('{{ route('admin.file', ['file_id'=> $file->id_file]) }}')" >Detail</button></td>
        </tr>

        @endforeach
        <tr>
            <td colspan="5" class="paginator" align="center">{{ $files->appends(request()->query())->links() }}</td>
        </tr>
        </table>
    @endif
</div>

<script>
function view( url ) {
    window.open(url, "_self");
}
</script>


@endsection('content')

