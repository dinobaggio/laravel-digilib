<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="javascript:void(0)" onclick="halaman('{{ route('non_user.homepage') }}')">Digilib</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="javascript:void(0)" onclick="halaman('{{ route('non_user.homepage') }}')">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="javascript:void(0)" onclick="halaman('{{ route('login') }}')">Login <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<!-- <button onclick="halaman('{{ route('non_user.homepage') }}')">Home</button>
<button onclick="halaman('{{ route('login') }}')">Login</button>
@auth
<button onclick="event.preventDefault();document.getElementById('logout-form').submit()" >Logout</button>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endauth -->
