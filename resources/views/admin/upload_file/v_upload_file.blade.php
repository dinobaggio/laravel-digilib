@extends('base.v_master')
@section('title', 'Upload File')

@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')

<div id="form_upload_file">
    <form method="POST" action="{{ route('admin.upload_proses') }}" id="form_upload" enctype="multipart/form-data">
    {{csrf_field()}}
        <table>
            <tr><td>Judul: </td><td><input type="text" name="judul" placeholder="Judul ..." /></td></tr>
            <tr><td>kategori: </td><td>
                <select id="kategori" name="kategori"> 
                    <option value=""  >Masukan Kategori ...</option>
                    <option value="ebook">E-Book</option>
                    <!-- <option value="jurnal">Jurnal</option>
                    <option value="artikel">Artikel</option>
                    <option value="skripsi">Skripsi</option> -->
                </select>
            </td></tr>
            <!-- 
            <tr><td>Pengarang: </td><td><input type="text" name="pengarang" placeholder="Pengarang ..." /></td></tr>
            <tr><td>Bahasa: </td><td><input type="text" name="bahasa" placeholder="Bahasa ..." /></td></tr>
            <tr><td>Penerbit: </td><td><input type="text" name="penerbit" placeholder="Penerbit ..." /></td></tr>
            <tr><td>Tahun Penerbit: </td><td><input type="text" name="tahun_penerbit" placeholder="Tahun Penerbit ..." /></td></tr>
            <tr><td>Tempat Penerbit: </td><td><input type="text" name="tempat_penerbit" placeholder="Tempat Penerbit ..." /></td></tr>
            <tr><td>Info Detail Spesifik: </td><td><textarea name="info_detail" placeholder="Info dan Detail ..." rows='4' cols='30'></textarea></td></tr> -->
            <input type="hidden" name="MAX_FILE_SIZE" value="500000000">
            <tr><td>Lampiran Berkas: </td><td><input type="file" name="file_data"/></td></tr>
            <tr><td colspan='2'><input type="submit" onclick="upload_proses()" formaction="javascript:void(0)" value="Simpan"></td></tr>
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
function upload_proses () {
    let form_upload = document.getElementById('form_upload');
    let yakin = confirm('yakin ingin proses upload file?');
    if (yakin) {
        form_upload.submit();
    }
}
</script>

@endsection('content')
