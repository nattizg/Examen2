@extends('layouts.app')

@section('titulo', 'Registrar Empleado - Agrovalle Honduras')

@section('content')
<div class="page-header mb-4">
  <div>
    <h1 class="page-title">Registrar Nuevo Empleado</h1>
    <p class="page-subtitle">Ingrese los datos del colaborador para registrarlo en el módulo de recursos humanos.</p>
  </div>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted-green">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('recursoshumanos.index') }}" class="text-decoration-none text-muted-green">Empleados</a></li>
      <li class="breadcrumb-item active text-main" aria-current="page">Nuevo</li>
    </ol>
  </nav>
</div>

<form action="{{ route('recursoshumanos.store') }}" method="POST">
  @csrf

  <div class="row g-4 mb-4">
    <!-- Columna Izquierda -->
    <div class="col-12 col-lg-6">
      <div class="card border-light shadow-sm p-4 h-100">
        <h5 class="card-title mb-4">Datos Personales</h5>

        <div class="mb-3">
          <label for="identidad" class="form-label-custom">Identidad (DNI, 13 dígitos, único) <span class="text-danger">*</span></label>
          <input type="text" name="identidad" id="identidad"
                 class="form-control-custom @error('identidad') is-invalid-custom @enderror"
               placeholder="Ej. 0801199912345"
               maxlength="13" minlength="13" pattern="[0-9]{13}" inputmode="numeric"
                 value="{{ old('identidad') }}" required>
        <small class="text-muted d-block mt-1">Solo números, sin guiones (exactamente 13 dígitos).</small>
          @error('identidad')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="nombre" class="form-label-custom">Nombre <span class="text-danger">*</span></label>
          <input type="text" name="nombre" id="nombre"
                 class="form-control-custom @error('nombre') is-invalid-custom @enderror"
               placeholder="Ej. María José"
                 value="{{ old('nombre') }}" required>
          @error('nombre')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="apellido" class="form-label-custom">Apellido <span class="text-danger">*</span></label>
          <input type="text" name="apellido" id="apellido"
                 class="form-control-custom @error('apellido') is-invalid-custom @enderror"
               placeholder="Ej. Hernández Flores"
                 value="{{ old('apellido') }}" required>
          @error('apellido')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-0">
          <label for="correo" class="form-label-custom">Correo Electrónico <span class="text-danger">*</span></label>
          <input type="email" name="correo" id="correo"
                 class="form-control-custom @error('correo') is-invalid-custom @enderror"
               placeholder="Ej. mhernandez@agrovalle.hn"
                 value="{{ old('correo') }}" required>
          @error('correo')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
      </div>
    </div>

    <!-- Columna Derecha -->
    <div class="col-12 col-lg-6">
      <div class="card border-light shadow-sm p-4 h-100">
        <h5 class="card-title mb-4">Información Laboral</h5>

        <div class="mb-3">
          <label for="cargo" class="form-label-custom">Cargo <span class="text-danger">*</span></label>
          <select name="cargo" id="cargo"
                  class="form-select-custom @error('cargo') is-invalid-custom @enderror" required>
            @php $sel_cargo = old('cargo'); @endphp
            <option value="" disabled {{ $sel_cargo ? '' : 'selected' }}>Seleccione un cargo...</option>
            <option value="Ingeniero Agrónomo" {{ $sel_cargo == 'Ingeniero Agrónomo' ? 'selected' : '' }}>Ingeniero Agrónomo</option>
            <option value="Asesor Técnico de Campo" {{ $sel_cargo == 'Asesor Técnico de Campo' ? 'selected' : '' }}>Asesor Técnico de Campo</option>
            <option value="Jefe de Bodega Central" {{ $sel_cargo == 'Jefe de Bodega Central' ? 'selected' : '' }}>Jefe de Bodega Central</option>
            <option value="Operador de Maquinaria" {{ $sel_cargo == 'Operador de Maquinaria' ? 'selected' : '' }}>Operador de Maquinaria</option>
            <option value="Cajero" {{ $sel_cargo == 'Cajero' ? 'selected' : '' }}>Cajero</option>
          </select>
          @error('cargo')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="salario" class="form-label-custom">Salario Base Mensual (L) <span class="text-danger">*</span></label>
          <input type="number" name="salario" id="salario"
                 class="form-control-custom @error('salario') is-invalid-custom @enderror"
               placeholder="0.00"
               step="0.01" min="0.01"
                 value="{{ old('salario') }}" required>
          @error('salario')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="row g-3 mb-0">
          <div class="col-md-6">
            <label for="fecha_ingreso" class="form-label-custom">Fecha de Ingreso <span class="text-danger">*</span></label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                   class="form-control-custom @error('fecha_ingreso') is-invalid-custom @enderror"
                   value="{{ old('fecha_ingreso', date('Y-m-d')) }}" required>
            @error('fecha_ingreso')
              <div class="form-feedback-custom invalid-custom">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
              </div>
            @enderror
          </div>
          <div class="col-md-6">
          <label for="estado" class="form-label-custom">Estado <span class="text-danger">*</span></label>
          <select name="estado" id="estado"
                  class="form-select-custom @error('estado') is-invalid-custom @enderror" required>
            @php $sel_estado = old('estado'); @endphp
            <option value="" disabled {{ $sel_estado ? '' : 'selected' }}>Seleccione...</option>
            <option value="Activo" {{ $sel_estado == 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Inactivo" {{ $sel_estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
          </select>
          @error('estado')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Botones de Acción -->
  <div class="d-flex justify-content-end gap-2 mb-4">
    <a href="{{ route('recursoshumanos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-success px-4">
      <i class="bi bi-save me-1"></i> Guardar Empleado
    </button>
  </div>
</form>
@endsection