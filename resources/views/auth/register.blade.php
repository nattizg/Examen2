<form method="POST" action="{{ route('login') }}">
  @csrf

  <div class="row g-4 justify-content-center mb-4">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card border-light shadow-sm p-4 h-100">
        <h5 class="card-title mb-4 text-center">Iniciar Sesión - AGROVALLE Honduras</h5>

        <!-- Nombre -->
        <div class="mb-3">
          <label for="text" class="form-label-custom">Nombre</label>
          <input type="text" 
            id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
        </div>

        <!-- Correo electrónico institucional -->
        <div class="mb-3">
          <label for="email" class="form-label-custom">Correo electrónico institucional</label>
          <input type="email" class="form-control-custom @error('email') is-invalid-custom @enderror"
            id="email" name="email" value="{{ old('email') }}" placeholder="usuario@agrovalle.hn" required>
          @error('email')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
          <label for="password" class="form-label-custom">Contraseña</label>
          <input type="password" class="form-control-custom @error('password') is-invalid-custom @enderror"
            id="password" name="password" placeholder="Ingrese su contraseña" required>
          @error('password')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Casilla de verificación: Recordar mi sesión -->
        <div class="mb-4">
          <div class="form-check-custom">
            <input class="form-check-input-custom" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Recordar mi sesión</label>
          </div>
        </div>

        <!-- Botón de envío -->
        <div class="d-grid">
          <button type="submit" class="btn-custom btn-custom-primary">
            <i class="bi bi-box-arrow-in-right"></i> Ingresar
          </button>
        </div>

      </div>
    </div>
  </div>
</form>