@extends('base.v_master')
@section('title', $file->judul)

@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')

<div id="form_edit_file">
    <form method="POST" action="{{ route('admin.edit_proses') }}" id="form_edit" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" value="{{ $file->id_file }}" name="id_file">
        <table>
            <tr><td>Judul: </td><td><input type="text" name="judul" value="{{ $file->judul }}" placeholder="Judul ..." /></td></tr>
            <tr><td>Kategori: </td><td> <input type="hidden" name="kategori" value="{{ $file->kategori }}">
                <b>{{ $file->kategori }}</b>
            </td></tr>
            @if ($file->kategori == 'jurnal') 
            <tr id="abstrak">
                <td>Abstrak</td>
                <td><textarea name="abstrak" placeholder="Abstrak jurnal ..." rows='4' cols='30'>{{$file->abstrak}}</textarea></td>
            </tr>
            @endif
            <!-- 
            <tr><td>Pengarang: </td><td><input type="text" name="pengarang" placeholder="Pengarang ..." /></td></tr>
            <tr><td>Bahasa: </td><td><input type="text" name="bahasa" placeholder="Bahasa ..." /></td></tr>
            <tr><td>Penerbit: </td><td><input type="text" name="penerbit" placeholder="Penerbit ..." /></td></tr>
            <tr><td>Tahun Penerbit: </td><td><input type="text" name="tahun_penerbit" placeholder="Tahun Penerbit ..." /></td></tr>
            <tr><td>Tempat Penerbit: </td><td><input type="text" name="tempat_penerbit" placeholder="Tempat Penerbit ..." /></td></tr>
            <tr><td>Info Detail Spesifik: </td><td><textarea name="info_detail" placeholder="Info dan Detail ..." rows='4' cols='30'></textarea></td></tr> -->
            <input type="hidden" name="MAX_FILE_SIZE" value="500000000">
            <tr><td>Lampiran Berkas: </td><td><input type="file" name="file_data"/></td></tr>
            <tr><td colspan='2'><input onclick="edit_proses()" formaction="javascript:void(0)" type="submit" value="Simpan"></td></tr>
        </table>
    </form>
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
