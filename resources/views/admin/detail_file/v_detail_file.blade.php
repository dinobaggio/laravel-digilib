@extends('base.v_master')
@section('title', 'Detail Book')


@section('nav_bar')
    @include('base.nav_admin')
@endsection('nav_bar')

@section('content')


<div id="detail_book" style="overflow:auto">
@if ($file)
    <div id="main1" class="card main1">
        <div class="card-body">
            <h5 class="card-title">{{ $file->judul }}</h5>
            <p class="card-text"></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <b>Uploader :</b><br>
                {{ $file->name }}
            </li>
            <li class="list-group-item">
                <b>Kategori :</b><br>
                {{ $file->kategori }}
            </li>
            @if($file->kategori == 'jurnal')
            <li class="list-group-item">
                <b>Abstrak :</b><br>
                {{$file->abstrak}}
            </li>
            @endif
            <li class="list-group-item">
                <b>Size :</b><br>
                {{ human_filesize($file->size) }}
            </li>
            <li class="list-group-item">
                <b>Mime Type :</b><br>
                {{ $file->mime_file }}
            </li>
            <li class="list-group-item">
                <b>Nama Asli :</b><br>
                {{ $file->nama_asli }}
            </li>
            <li class="list-group-item">
                <b>Hash Name :</b><br>
                {{ $file->hash_name }}
            </li>
            <li class="list-group-item">
                <b>Extension :</b><br>
                {{ $file->extension }}
            </li>
            @if($file->kategori == 'jurnal')
                <li class="list-group-item">
                    <b>ID Jurnal :</b><br>
                    #{{$file->id_jurnal}}
                </li>
            @elseif($file->kategori == 'ebook')
                <li class="list-group-item">
                    <b>ID Book :</b><br>
                    #{{$file->id_book}}
                </li>
            @elseif($file->kategori == 'artikel')
                <li class="list-group-item">
                    <b>ID Artikel :</b><br>
                    #{{$file->id_artikel}}
                </li>
            @elseif($file->kategori == 'skripsi')
                <li class="list-group-item">
                    <b>ID Skripsi :</b><br>
                    #{{$file->id_skripsi}}
                </li>
            @endif 
            <li class="list-group-item">
                <b>ID File :</b><br>
                #{{$file->id_file}}
            </li>
            <li class="list-group-item">
                <b>Path :</b><br>
                <a  href="{{ Storage::url($file->path) }}">{{ $file->path }}</a>
            </li>
        </ul>
        <div class="card-body">
            <a href="javascript:void(0)" onclick="form_delete_submit()" class="btn btn-danger" role="button">Delete</a>
            <a href="javascript:void(0)" onclick="view('{{ route('admin.edit_file', array('file_id'=>$file->id_file)) }}')" class="btn btn-primary">Edit</a>
        </div>
        <form id="form_delete" method="post" action="{{route('admin.delete_file', ['file_id'=>$file->id_file])}}" style="display:inline;">
            @method('delete')
            @csrf
        </form>
    </div>

    <div id="main2" class="main2">
        <h2>{{ $file->judul }}</h2>
        <div id="div_button" >
            <button onclick="lihat_file('{{ Storage::url($file->path) }}', '{{ $file->extension }}')" class="btn btn-primary">lihat file</button>
            <form id="form_download" method="post" action="{{ route('admin.download_file') }}" target="_blank" style="display:inline;">
                @csrf
                <input type="hidden" name="path" value="{{ $file->path }}">
                <input type="hidden" name="nama_asli" value="{{ $file->nama_asli }}">
                <button type="submit" class="btn btn-success">download</button>
            </form> 
        </div>
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
        let div_button = document.getElementById('div_button');
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
        tutup.setAttribute('class', 'btn btn-danger');

        full.appendChild(text_full);
        full.setAttribute('onclick', 'full_file()');
        full.setAttribute('id', 'full_button');
        full.setAttribute('style', 'margin-bottom:10px');
        full.setAttribute('class', 'btn btn-primary');

        iframe.setAttribute('id', 'file_iframe');
        iframe.setAttribute('style', 'width:100%;height:650px;');
        iframe.setAttribute('src', "{{ Storage::url($file->path) }}");
        
        main2.appendChild(tutup);
        main2.appendChild(full);
        main2.appendChild(iframe);

        div_button.style.display = 'none';
    } else {
        if (extension != 'pdf') {
            alert('maaf file tidak bisa ditampilkan \nformat extension bukan pdf');
        }
    }
    

}

function tutup_file () {
    let div_button = document.getElementById('div_button');
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

    div_button.style.display = '';
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

