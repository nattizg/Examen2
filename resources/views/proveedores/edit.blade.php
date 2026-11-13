@extends('layouts.app')

@section('titulo', 'Editar Proveedor - Agrovalle Honduras')

@section('content')
<div class="page-header mb-4">
  <div>
    <h1 class="page-title">Editar Proveedor: {{ $proveedor->empresa }}</h1>
    <p class="page-subtitle">Modifique los datos comerciales, el límite de crédito o el estado del proveedor seleccionado.</p>
  </div>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted-green">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}" class="text-decoration-none text-muted-green">Proveedores</a></li>
      <li class="breadcrumb-item active text-main" aria-current="page">Editar</li>
    </ol>
  </nav>
</div>

<form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="row g-4 mb-4">
    <!-- Columna Izquierda -->
    <div class="col-12 col-lg-6">
      <div class="card border-light shadow-sm p-4 h-100">
        <h5 class="card-title mb-4">Datos de la Empresa</h5>

        <div class="mb-3">
          <label for="rtn" class="form-label-custom">RTN (14 dígitos, único) <span class="text-danger">*</span></label>
          <input type="text" name="rtn" id="rtn"
                 class="form-control-custom @error('rtn') is-invalid-custom @enderror"
               maxlength="14" minlength="14" pattern="[0-9]{14}" inputmode="numeric"
                 value="{{ old('rtn', $proveedor->rtn) }}" required>
        <small class="text-muted d-block mt-1">Solo números, sin guiones (exactamente 14 dígitos).</small>
          @error('rtn')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="empresa" class="form-label-custom">Empresa (Razón Social) <span class="text-danger">*</span></label>
          <input type="text" name="empresa" id="empresa"
                 class="form-control-custom @error('empresa') is-invalid-custom @enderror"
                 value="{{ old('empresa', $proveedor->empresa) }}" required>
          @error('empresa')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="contacto" class="form-label-custom">Contacto (Asesor Comercial) <span class="text-danger">*</span></label>
          <input type="text" name="contacto" id="contacto"
                 class="form-control-custom @error('contacto') is-invalid-custom @enderror"
                 value="{{ old('contacto', $proveedor->contacto) }}" required>
          @error('contacto')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-0">
          <label for="telefono" class="form-label-custom">Teléfono (8 dígitos) <span class="text-danger">*</span></label>
          <input type="text" name="telefono" id="telefono"
                 class="form-control-custom @error('telefono') is-invalid-custom @enderror"
               maxlength="8" minlength="8" pattern="[2389][0-9]{7}" inputmode="numeric"
                 value="{{ old('telefono', $proveedor->telefono) }}" required>
        <small class="text-muted d-block mt-1">Debe iniciar en 2, 3, 8 o 9.</small>
          @error('telefono')
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
        <h5 class="card-title mb-4">Condiciones Comerciales</h5>

        <div class="mb-3">
          <label for="categoria" class="form-label-custom">Categoría <span class="text-danger">*</span></label>
          <select name="categoria" id="categoria"
                  class="form-select-custom @error('categoria') is-invalid-custom @enderror" required>
            @php $sel_categoria = old('categoria', $proveedor->categoria); @endphp
            <option value="" disabled {{ $sel_categoria ? '' : 'selected' }}>Seleccione una categoría...</option>
            <option value="Químicos" {{ $sel_categoria == 'Químicos' ? 'selected' : '' }}>Químicos</option>
            <option value="Semilleros" {{ $sel_categoria == 'Semilleros' ? 'selected' : '' }}>Semilleros</option>
            <option value="Maquinaria" {{ $sel_categoria == 'Maquinaria' ? 'selected' : '' }}>Maquinaria</option>
          </select>
          @error('categoria')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="limite_credito" class="form-label-custom">Límite de Crédito (L) <span class="text-danger">*</span></label>
          <input type="number" name="limite_credito" id="limite_credito"
                 class="form-control-custom @error('limite_credito') is-invalid-custom @enderror"
               step="0.01" min="0"
                 value="{{ old('limite_credito', $proveedor->limite_credito) }}" required>
          @error('limite_credito')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="dias_credito" class="form-label-custom">Días de Crédito <span class="text-danger">*</span></label>
          <select name="dias_credito" id="dias_credito"
                  class="form-select-custom @error('dias_credito') is-invalid-custom @enderror" required>
            @php $sel_dias_credito = old('dias_credito', $proveedor->dias_credito); @endphp
            <option value="" disabled {{ $sel_dias_credito ? '' : 'selected' }}>Seleccione el plazo...</option>
            <option value="15" {{ $sel_dias_credito == '15' ? 'selected' : '' }}>15 días</option>
            <option value="30" {{ $sel_dias_credito == '30' ? 'selected' : '' }}>30 días</option>
            <option value="45" {{ $sel_dias_credito == '45' ? 'selected' : '' }}>45 días</option>
            <option value="60" {{ $sel_dias_credito == '60' ? 'selected' : '' }}>60 días</option>
          </select>
          @error('dias_credito')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
        <div class="row g-3 mb-0">
          <div class="col-md-6">
          <label for="estado" class="form-label-custom">Estado <span class="text-danger">*</span></label>
          <select name="estado" id="estado"
                  class="form-select-custom @error('estado') is-invalid-custom @enderror" required>
            @php $sel_estado = old('estado', $proveedor->estado); @endphp
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
          <div class="col-md-6">
            <label for="fecha_registro" class="form-label-custom">Fecha de Registro <span class="text-danger">*</span></label>
            <input type="date" name="fecha_registro" id="fecha_registro"
                   class="form-control-custom @error('fecha_registro') is-invalid-custom @enderror"
                   value="{{ old('fecha_registro', $proveedor->fecha_registro ? \Carbon\Carbon::parse($proveedor->fecha_registro)->format('Y-m-d') : '') }}" required>
            @error('fecha_registro')
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
    <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-success px-4">
      <i class="bi bi-check2-circle me-1"></i> Actualizar Proveedor
    </button>
  </div>
</form>
@endsection