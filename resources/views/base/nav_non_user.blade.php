<nav class="navbar navbar-expand-lg navbar-light bg-dark mb-4">
  <a class="navbar-brand text-light" href="javascript:void(0)" onclick="halaman('{{ route('non_user.homepage') }}')">Digilib</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light" href="javascript:void(0)" onclick="halaman('{{ route('non_user.homepage') }}')">Home</a>
      </li>
      <li class="nav-item active">
        <a href="javascript:void(0)" class="nav-link text-light" data-toggle="modal" data-target="#modalLogin">
          Login
        </a>
      </li>
    </ul>
  </div>

  
</nav>

<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-light" id="modalLoginTitle">Form Login</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="form-login" class="modal-body">
        
      </div>
      <div class="modal-footer bg-dark">
        
      </div>
    </div>
  </div>
</div>

<script>
let formLogin = $("#form-login");
$.get("{{ route('login') }}", function(data) {
  formLogin.html(data);
});

</script>