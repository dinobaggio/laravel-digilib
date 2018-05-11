<style>
  .wrapper {
    display:grid;
    grid-template-columns: 70% 30%;
  }
</style>

<nav class="col-md-2 d-none d-md-block bg-dark sidebar pt-3 ">
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
            <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.list_ebook') }}')">
              Ebook
            </a>
            <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.list_jurnal') }}')">
              Jurnal
            </a>
            <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.list_artikel') }}')">
              Artikel
            </a>
            <a class="nav-link text-light" href="javascript:halaman('{{ route('admin.list_skripsi') }}')">
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
    plus.toggle('slow');
    minus.toggle('slow');
    kategori.toggle('slow');
  }

  function show_kategori () {
    let plus = $('#plus');
    let minus = $('#minus');
    let kategori = $('#kategori');
    plus.hide();
    minus.show();
    kategori.show();
  }
  
  </script>