
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

<style>
  .wrapper {
    display:grid;
    grid-template-columns: 70% 30%;
  }
</style>

<nav class="col-md-2 d-none d-md-block bg-secondary sidebar pt-3">
    <div class="sidebar-sticky" style="margin:-1em">
      <ul class="nav flex-column">
        <li class="nav-item border-bottom border-light">
          <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.homepage') }}')">
            Home
          </a>
        </li>
        <li class="nav-item border-bottom border-light ">
          <div class="wrapper">
            <a class="nav-link text-light border-right" href="javascript:halaman('{{ route('admin.list_file') }}')">
              List File
            </a>
            <a class="nav-link text-light" href="javascript:void(0)" onclick="list_file()">
              <center>
                <i id="plus" class="fas fa-plus"></i>
                <i id="minus" class="fas fa-minus" style="display:none;"></i>
              </center>
            </a>
          </div>

          <div id="kategori" class="pl-3" style="display:none">
            <a class="nav-link text-light border-right" href="javascript:void(0)">
              Ebook
            </a>
            <a class="nav-link text-light border-right" href="javascript:void(0)">
              Jurnal
            </a>
            <a class="nav-link text-light border-right" href="javascript:void(0)">
              Artikel
            </a>
            <a class="nav-link text-light border-right" href="javascript:void(0)">
              Skripsi
            </a>
          </div>
          
        </li>
        <li class="nav-item border-bottom border-light">
          <a  class="nav-link text-light" href="javascript:halaman('{{ route('admin.form_upload') }}')">
            Upload
          </a>
        </li>
        <li class="nav-item border-bottom border-light">
          <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.form_tambah_user') }}')">
            Tambah User
          </a>
        </li>
        <li class="nav-item border-bottom border-light">
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


  <script>
  function list_file () {
    let plus = $('#plus');
    let minus = $('#minus');
    let kategori = $('#kategori');
    plus.toggle();
    minus.toggle();
    kategori.toggle('slow');
  }

  console.log(postRequest("http://localhost:8000/admin"));

  function postRequest (url) {
    var data = null;
    var http = new XMLHttpRequest();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var value = this.response;
        data = value;
      }
    }
    http.open("GET", url);
    http.send();

    return data;
    
  }
  </script>