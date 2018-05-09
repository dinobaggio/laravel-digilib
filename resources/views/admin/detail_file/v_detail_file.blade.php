@extends('base.v_master')
@section('title', 'Detail Book')


@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')


<div id="detail_book" style="overflow:auto">
@if ($file)
    <div id="main1" class="main1">
        
            <p><b>Judul :</b> {{ $file->judul }}</p>
            <p><b>Kategori :</b> {{ $file->kategori }}</p>
            
            @if($file->kategori == 'jurnal')
                <p><b>Abstrak :</b> {{$file->abstrak}}</p>
            @endif

            <p><b>Size :</b> {{ human_filesize($file->size) }}</p> 
            <p><b>Mime Type :</b> {{ $file->mime_file }}</p>
            <p><b>Nama Asli :</b> {{ $file->nama_asli }}</p>
            <p><b>Hash Name :</b> {{ $file->hash_name }}</p>
            <p><b>Extension :</b> {{ $file->extension }}</p>

            @if($file->kategori == 'jurnal')
                <p><b>ID Jurnal :</b> #{{$file->id_jurnal}}</p>
            @elseif($file->kategori == 'ebook')
                <p><b>ID Book :</b> #{{ $file->id_book }}</p>
            @elseif($file->kategori == 'artikel')
                <p><b>ID Artikel :</b> #{{ $file->id_artikel }}</p>
            @elseif($file->kategori == 'skripsi')
                <p><b>ID Skripsi :</b> #{{ $file->id_skripsi }}</p>
            @endif 
            
            <p><b>ID File :</b> #{{ $file->id_file }}</p>                   
            <p><b>Path :</b> <a  href="{{ Storage::url($file->path) }}">{{ $file->path }}</a></p> <hr>
            <form id="form_delete" method="post" action="{{route('admin.delete_file', ['file_id'=>$file->id_file])}}" style="display:inline;">
                @method('delete')
                @csrf
                <button onclick="form_delete_submit()" formaction="javascript:void(0)">delete</button>
            </form>
            <button onclick="view('{{ route('admin.edit_file', array('file_id'=>$file->id_file)) }}')" >edit</button>
    </div>

    <div id="main2" class="main2">
        <h2>{{ $file->judul }}</h2>
        <button onclick="lihat_file('{{ Storage::url($file->path) }}', '{{ $file->extension }}')">lihat file</button>
        <form id="form_download" method="post" action="{{ route('admin.download_file') }}" target="_blank" style="display:inline;">
            @csrf
            <input type="hidden" name="path" value="{{ $file->path }}">
            <input type="hidden" name="nama_asli" value="{{ $file->nama_asli }}">
            <button type="submit" >download</button>
        </form> 
        <br/>
        <br/>
        
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

function lihat_file (path, extension) {
    let file_iframe = document.getElementById('file_iframe');
    if (file_iframe == null && extension == 'pdf') {
        let tutup = document.createElement('button');
        let text_tutup = document.createTextNode('tutup');
        let full = document.createElement('button');
        let text_full = document.createTextNode('baca fullscreen');
        let iframe = document.createElement('iframe');
        let main2 = document.getElementById('main2');

        tutup.appendChild(text_tutup);
        tutup.setAttribute('onclick', 'tutup_file()');
        tutup.setAttribute('id', 'tutup_button');
        tutup.setAttribute('style', 'margin-bottom:10px');

        full.appendChild(text_full);
        full.setAttribute('onclick', 'full_file()');
        full.setAttribute('id', 'full_button');
        full.setAttribute('style', 'margin-bottom:10px');

        iframe.setAttribute('id', 'file_iframe');
        iframe.setAttribute('style', 'width:100%;height:650px;');
        iframe.setAttribute('src', "{{ Storage::url($file->path) }}");
        
        main2.appendChild(tutup);
        main2.appendChild(full);
        main2.appendChild(iframe);
    } else {
        if (extension != 'pdf') {
            alert('maaf file tidak bisa ditampilkan \nformat extension bukan pdf');
        }
    }
    

}

function tutup_file () {
    let main1 = document.getElementById('main1');
    let main2 = document.getElementById('main2');
    let tutup = document.getElementById('tutup_button');
    let full = document.getElementById('full_button');
    let iframe = document.getElementById('file_iframe');

    main2.removeChild(tutup);
    main2.removeChild(full);
    main2.removeChild(iframe);
    main1.style.display = '';
    main2.style.width = '';
}

function full_file () {
    let main1 = document.getElementById('main1');
    let main2 = document.getElementById('main2');
    let iframe = document.getElementById('file_iframe');
    let full = document.getElementById('full_button');

    full.innerHTML = "minimize";
    full.setAttribute('onclick', 'minimize_file()');
    main2.style.width = '100%';
    main1.style.display = 'none';
}

function minimize_file() {
    let main1 = document.getElementById('main1');
    let main2 = document.getElementById('main2');
    let iframe = document.getElementById('file_iframe');
    let full = document.getElementById('full_button');
    
    full.innerHTML = "baca fullscreen";
    full.setAttribute('onclick', 'full_file()');
    main2.style.width = '';
    main1.style.display = '';

}

function form_delete_submit() {
    let form_delete = document.getElementById('form_delete');
    let yakin = confirm('yakin ingin men-delete file ini?');
    if (yakin) {
        form_delete.submit();
    }
}
</script>


@endsection('content')

