<nav class="navbar navbar-expand-lg navbar-light bg-dark mb-4">
    <a class="navbar-brand text-light" href="javascript:void(0)" onclick="halaman('{{ route('non_user.homepage') }}')">Digilib</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link text-light" href="javascript:void(0)" onclick="halaman('{{ route('dosen.homepage') }}')">Home</a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link text-light" onclick="halaman('{{ route('dosen.upload_jurnal') }}')" >
            Upload Jurnal
          </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link text-light" onclick="halaman('{{ route('dosen.my_jurnal') }}')">
              My Jurnal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
            </form>
        </li>
      </ul>
    </div>
  </nav>



