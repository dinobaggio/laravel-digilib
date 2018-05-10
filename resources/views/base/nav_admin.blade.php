
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="javascript:halaman('{{ route('admin.homepage') }}')">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:halaman('{{ route('admin.list_file') }}')">List File</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:halaman('{{ route('admin.form_upload') }}')">Upload</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:halaman('{{ route('admin.form_tambah_user') }}')">Tambah User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit()">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
        </form>
      </li>
    </ul>
    
  </div>
</nav> -->



<nav class="col-md-2 d-none d-md-block bg-secondary sidebar pt-3">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.homepage') }}')">
            <span data-feather="home"></span>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.list_file') }}')">
            <span data-feather="file"></span>
            List File
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.form_upload') }}')">
            <span data-feather="shopping-cart"></span>
            Upload
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.form_tambah_user') }}')">
            <span data-feather="users"></span>
            Tambah User
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
            <span data-feather="bar-chart-2"></span>
            Logout
          </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
            </form>
        </li>
      </ul>
      
    </div>
  </nav>