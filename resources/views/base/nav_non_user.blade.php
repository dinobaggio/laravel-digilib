<button onclick="halaman('{{ route('non_user.homepage') }}')">Home</button>
<button onclick="halaman('{{ route('login') }}')">Login</button>
@auth
<button onclick="event.preventDefault();document.getElementById('logout-form').submit()" >Logout</button>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endauth
