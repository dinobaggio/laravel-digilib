<button onclick="halaman('{{ route('admin.homepage') }}')">Home</button>
<button onclick="halaman('{{ route('admin.list_file') }}')">List File</button>
<button onclick="halaman('{{ route('admin.form_upload') }}')" >Upload</button>
<button onclick="halaman('{{ route('admin.form_tambah_user') }}')">Tambah User</button>
<button onclick="event.preventDefault();document.getElementById('logout-form').submit()" >Logout</button>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
