@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h2>DEFINIÇÕES</h2>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#profile" id="perfil-btn">ATUALIZAR PERFIL</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#password" id="senha-btn">MUDAR SENHA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#socialnetwork" id="socialnetwork-btn">ADICIONAR REDES SOCIAIS</a>
              </li>
            </ul>
  
            <div class="tab-content">
              <div class="tab-pane fade show active" id="profile">
                <form action="{{ route('profile.update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
  
                  <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" class="form-control" placeholder="Digite seu Nome" name="name" value="{{ Auth::user()->name }}">
                  </div>
  
                  <div class="form-group">
                    <label for="name">User Name:</label>
                    <input type="text" id="username" class="form-control" placeholder="Digite seu Nome" name="username" value="{{ Auth::user()->username }}">
                  </div>
  
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" class="form-control" placeholder="Digite seu Endereço de E-mail" name="email" value="{{ Auth::user()->email }}">
                  </div>
  
                  <div class="form-group">
                    <label for="image">Perfil de Imagem:</label>
                    <input type="file" name="image" id="image">
                  </div>
  
                  <div class="form-group">
                    <label for="about">Sobre:</label>
                    <textarea rows="5" name="about" class="form-control">{{ Auth::user()->about }}</textarea>
                  </div>
  
                  <button type="submit" class="btn btn-primary">ALTERAR</button>
                </form>
              </div>
  
              <div class="tab-pane fade" id="password">
                <form action="{{ route('password.update') }}" method="POST" class="form-horizontal">
                  @csrf
                  @method('PUT')
  
                  <div class="form-group">
                    <label for="old_password">Antiga Senha:</label>
                    <input type="password" id="old_password" class="form-control" placeholder="Digite sua Senha Antiga" name="old_password">
                  </div>
  
                  <div class="form-group">
                    <label for="password">Nova Senha:</label>
                    <input type="password" id="password" class="form-control" placeholder="Digite sua Nova Senha" name="password">
                  </div>
  
                  <div class="form-group">
                    <label for="confirm_password">Confirmar Senha:</label>
                    <input type="password" id="confirm_password" class="form-control" placeholder="Digite sua Nova Senha Novamente"
                    name="password_confirmation">
                  </div>

                  <button type="submit" class="btn btn-primary">ALTERAR</button>
                </form>
              </div>
  
              <div class="tab-pane fade" id="socialnetwork">
                <form action="{{ route('socialnetwork.update') }}" method="POST" class="form-horizontal">
                  @csrf
                  @method('PUT')
  
                  <div class="form-group">
                    <label for="linkedin">LinkedIn:</label>
                    <input type="text" id="linkedin" class="form-control" placeholder="Digite seu perfil do LinkedIn" name="linkedin" value="{{ Auth::user()->linkedin }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="instagram">Instagram:</label>
                    <input type="text" id="instagram" class="form-control" placeholder="Digite seu perfil do Instagram" name="instagram" value="{{ Auth::user()->instagram }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="twitter">Twitter:</label>
                    <input type="text" id="twitter" class="form-control" placeholder="Digite seu perfil do Twitter" name="twitter" value="{{ Auth::user()->twitter }}">
                  </div>
                  
                  <div class="form-group">
                    <label for="facebook">Facebook:</label>
                    <input type="text" id="Facebook" class="form-control" placeholder="Digite seu perfil do Facebook" name="facebook" value="{{ Auth::user()->twitter }}">
                  </div>

                  <button type="submit" class="btn btn-primary">ALTERAR</button>
                </form>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>

<style>
   
.card {
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-header {
    padding: 15px;
    background-color: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-header h2 {
    margin: 0;
}

.dropdown-toggle {
    color: #000;
}

.card-body {
    padding: 15px;
}

.nav-tabs {
    margin-bottom: 15px;
}

.nav-link {
    color: #000;
}

.tab-content {
    padding-top: 15px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0069d9;
}

</style>

<script>
// Capturar os elementos dos botões
const perfilBtn = document.querySelector('#perfil-btn');
const senhaBtn = document.querySelector('#senha-btn');
const senhaBtn = document.querySelector('#socialnetwork-btn');

// Capturar as guias correspondentes
const perfilTab = document.querySelector('#profile');
const senhaTab = document.querySelector('#password');
const senhaTab = document.querySelector('#socialnetwork');

// Adicionar os ouvintes de evento aos botões
perfilBtn.addEventListener('click', function() {
  perfilTab.classList.add('show', 'active');
  senhaTab.classList.remove('show', 'active');
});

senhaBtn.addEventListener('click', function() {
  perfilTab.classList.remove('show', 'active');
  senhaTab.classList.add('show', 'active');
});
</script>

@endsection
