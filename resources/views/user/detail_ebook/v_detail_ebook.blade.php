@extends('base.v_master')
@section('title', 'Detail Book')

@section('content')


<div id="detail_book" style="overflow:auto">
@if ($book)
    
    <div id="main1" class="main1">
        
            <b>Judul :</b> {{ $book->judul }} <br>
            <b>Kategori :</b> {{ $book->kategori }} <br>        
            <b>Size :</b> {{ human_filesize($book->size) }} <br> 
            <b>Mime Type :</b> {{ $book->mime_file }} <br>
            <b>Nama Asli :</b> {{ $book->nama_asli }} <br>
            <b>Hash Name :</b> {{ $book->hash_name }} <br>
            <b>Extension :</b> {{ $book->extension }} <br>
            <b>ID Book :</b> #{{ $book->id_book }} <br>
            <b>ID File :</b> #{{ $book->id_file }} <br>                   
            <b>Path :</b> <a  href="{{ Storage::url($book->path) }}">{{ $book->path }}</a> <hr>
            <form id="form_delete" method="post" action="{{route('admin.delete_file', ['file_id'=>$book->id_file])}}" style="display:inline;">
                @method('delete')
                @csrf
                <button onclick="form_delete_submit()" formaction="javascript:void(0)">delete</button>
            </form>
            <button onclick="view('{{ route('admin.edit_file', array('file_id'=>$book->id_file)) }}')" >edit</button>
    </div>

    <div id="main2" class="main2">
        <h2>{{ $book->judul }}</h2>
        <button onclick="lihat_ebook('{{ Storage::url($book->path) }}', '{{ $book->extension }}')">lihat ebook</button>
        <form id="form_download" method="post" action="{{ route('admin.download_file') }}" target="_blank" style="display:inline;">
            @csrf
            <input type="hidden" name="path" value="{{ $book->path }}">
            <input type="hidden" name="nama_asli" value="{{ $book->nama_asli }}">
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

function lihat_ebook (path, extension) {
    let ebook_iframe = document.getElementById('ebook_iframe');
    if (ebook_iframe == null && extension == 'pdf') {
        let tutup = document.createElement('button');
        let text_tutup = document.createTextNode('tutup');
        let full = document.createElement('button');
        let text_full = document.createTextNode('baca fullscreen');
        let iframe = document.createElement('iframe');
        let main2 = document.getElementById('main2');

        tutup.appendChild(text_tutup);
        tutup.setAttribute('onclick', 'tutup_ebook()');
        tutup.setAttribute('id', 'tutup_button');
        tutup.setAttribute('style', 'margin-bottom:10px');

        full.appendChild(text_full);
        full.setAttribute('onclick', 'full_ebook()');
        full.setAttribute('id', 'full_button');
        full.setAttribute('style', 'margin-bottom:10px');

        iframe.setAttribute('id', 'ebook_iframe');
        iframe.setAttribute('style', 'width:100%;height:650px;');
        iframe.setAttribute('src', "{{ Storage::url($book->path) }}");
        
        main2.appendChild(tutup);
        main2.appendChild(full);
        main2.appendChild(iframe);
    } else {
        if (extension != 'pdf') {
            alert('maaf file tidak bisa ditampilkan \nformat extension bukan pdf');
        }
    }
    

}

function tutup_ebook () {
    let main1 = document.getElementById('main1');
    let main2 = document.getElementById('main2');
    let tutup = document.getElementById('tutup_button');
    let full = document.getElementById('full_button');
    let iframe = document.getElementById('ebook_iframe');

    main2.removeChild(tutup);
    main2.removeChild(full);
    main2.removeChild(iframe);
    main1.style.display = '';
    main2.style.width = '';
}

function full_ebook () {
    let main1 = document.getElementById('main1');
    let main2 = document.getElementById('main2');
    let iframe = document.getElementById('ebook_iframe');
    let full = document.getElementById('full_button');

    full.innerHTML = "minimize";
    full.setAttribute('onclick', 'minimize_ebook()');
    main2.style.width = '100%';
    main1.style.display = 'none';
}

function minimize_ebook() {
    let main1 = document.getElementById('main1');
    let main2 = document.getElementById('main2');
    let iframe = document.getElementById('ebook_iframe');
    let full = document.getElementById('full_button');
    
    full.innerHTML = "baca fullscreen";
    full.setAttribute('onclick', 'full_ebook()');
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

