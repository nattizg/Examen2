@extends('layouts.app')

@section('titulo', 'Registrar Insumo - Agrovalle Honduras')

@section('content')
<div class="page-header mb-4">
  <div>
    <h1 class="page-title">Registrar Nuevo Insumo</h1>
    <p class="page-subtitle">Ingrese los detalles del producto agropecuario para registrarlo en el inventario.</p>
  </div>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted-green">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('insumos.index') }}" class="text-decoration-none text-muted-green">Insumos</a></li>
      <li class="breadcrumb-item active text-main" aria-current="page">Nuevo</li>
    </ol>
  </nav>
</div>

<form action="{{ route('insumos.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row g-4 mb-4">
    <!-- Columna Izquierda: Datos Generales -->
    <div class="col-12 col-lg-6">
      <div class="card border-light shadow-sm p-4 h-100">
        <h5 class="card-title mb-4">Identificación y Categorización</h5>

        <!-- Código SKU -->
        <div class="mb-3">
          <label for="codigo" class="form-label-custom">Código (SKU único) <span class="text-danger">*</span></label>
          <input type="text" name="codigo" id="codigo"
                 class="form-control-custom @error('codigo') is-invalid-custom @enderror"
                 placeholder="Ej. FERT-001" value="{{ old('codigo') }}" required>
          @error('codigo')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Nombre -->
        <div class="mb-3">
          <label for="nombre" class="form-label-custom">Nombre del Insumo <span class="text-danger">*</span></label>
          <input type="text" name="nombre" id="nombre"
                 class="form-control-custom @error('nombre') is-invalid-custom @enderror"
                 placeholder="Ej. Fertilizante Triple 15 (Saco 45kg)" value="{{ old('nombre') }}" required>
          @error('nombre')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Categoría -->
        <div class="mb-3">
          <label for="categoria" class="form-label-custom">Categoría <span class="text-danger">*</span></label>
          <select name="categoria" id="categoria"
                  class="form-select-custom @error('categoria') is-invalid-custom @enderror" required>
            <option value="" disabled {{ old('categoria') ? '' : 'selected' }}>Seleccione una categoría...</option>
            <option value="Fertilizantes" {{ old('categoria') == 'Fertilizantes' ? 'selected' : '' }}>Fertilizantes</option>
            <option value="Semillas Certificadas" {{ old('categoria') == 'Semillas Certificadas' ? 'selected' : '' }}>Semillas Certificadas</option>
            <option value="Agroquímicos" {{ old('categoria') == 'Agroquímicos' ? 'selected' : '' }}>Agroquímicos</option>
            <option value="Herramientas" {{ old('categoria') == 'Herramientas' ? 'selected' : '' }}>Herramientas</option>
            <option value="Sistemas de Riego" {{ old('categoria') == 'Sistemas de Riego' ? 'selected' : '' }}>Sistemas de Riego</option>
          </select>
          @error('categoria')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Fabricante -->
        <div class="mb-3">
          <label for="fabricante" class="form-label-custom">Fabricante <span class="text-danger">*</span></label>
          <input type="text" name="fabricante" id="fabricante"
                 class="form-control-custom @error('fabricante') is-invalid-custom @enderror"
                 placeholder="Ej. Yara, Bayer, Truper" value="{{ old('fabricante') }}" required>
          @error('fabricante')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Número de Lote -->
        <div class="mb-0">
          <label for="numero_lote" class="form-label-custom">Número de Lote <span class="text-danger">*</span></label>
          <input type="text" name="numero_lote" id="numero_lote"
                 class="form-control-custom @error('numero_lote') is-invalid-custom @enderror"
                 placeholder="Ej. LOT-2026-884" value="{{ old('numero_lote') }}" required>
          @error('numero_lote')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
      </div>
    </div>

    <!-- Columna Derecha: Costos, Stock, Fechas e Imagen -->
    <div class="col-12 col-lg-6">
      <div class="card border-light shadow-sm p-4 h-100">
        <h5 class="card-title mb-4">Precios, Inventario y Empaque</h5>

        <div class="row g-3 mb-3">
          <!-- Costo -->
          <div class="col-md-6">
            <label for="costo" class="form-label-custom">Costo Unitario (L) <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="0" name="costo" id="costo"
                   class="form-control-custom @error('costo') is-invalid-custom @enderror"
                   placeholder="0.00" value="{{ old('costo') }}" required>
            @error('costo')
              <div class="form-feedback-custom invalid-custom">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
              </div>
            @enderror
          </div>

          <!-- Precio -->
          <div class="col-md-6">
            <label for="precio" class="form-label-custom">Precio de Venta (L) <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="0.01" name="precio" id="precio"
                   class="form-control-custom @error('precio') is-invalid-custom @enderror"
                   placeholder="0.00" value="{{ old('precio') }}" required>
            @error('precio')
              <div class="form-feedback-custom invalid-custom">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
              </div>
            @enderror
          </div>
        </div>

        <!-- Inventario -->
        <div class="mb-3">
          <label for="inventario" class="form-label-custom">Existencias en Inventario (Stock) <span class="text-danger">*</span></label>
          <input type="number" step="1" min="0" name="inventario" id="inventario"
                 class="form-control-custom @error('inventario') is-invalid-custom @enderror"
                 placeholder="Ej. 50" value="{{ old('inventario', 0) }}" required>
          @error('inventario')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>

        <div class="row g-3 mb-3">
          <!-- Fecha de Registro -->
          <div class="col-md-6">
            <label for="fecha_registro" class="form-label-custom">Fecha de Registro <span class="text-danger">*</span></label>
            <input type="date" name="fecha_registro" id="fecha_registro"
                   class="form-control-custom @error('fecha_registro') is-invalid-custom @enderror"
                   value="{{ old('fecha_registro', date('Y-m-d')) }}" required>
            @error('fecha_registro')
              <div class="form-feedback-custom invalid-custom">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
              </div>
            @enderror
          </div>

          <!-- Fecha de Vencimiento -->
          <div class="col-md-6">
            <label for="fecha_vencimiento" class="form-label-custom">Fecha de Vencimiento</label>
            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                   class="form-control-custom @error('fecha_vencimiento') is-invalid-custom @enderror"
                   value="{{ old('fecha_vencimiento') }}">
            @error('fecha_vencimiento')
              <div class="form-feedback-custom invalid-custom">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
              </div>
            @enderror
          </div>
        </div>

        <!-- Imagen del Empaque -->
        <div class="mb-0">
          <label for="imagen" class="form-label-custom">Fotografía del Empaque (Opcional)</label>
          <input type="file" name="imagen" id="imagen" accept=".jpg,.jpeg,.png,.webp"
                 class="form-control-custom @error('imagen') is-invalid-custom @enderror"
                 onchange="previewImage(event, 'preview-create')">
          <small class="text-muted d-block mt-1">Formatos permitidos: JPG, PNG, WEBP (Máximo 5MB).</small>
          <div class="mt-2">
            <img id="preview-create" src="#" alt="Vista previa" class="d-none border rounded"
                 style="width: 80px; height: 80px; object-fit: cover;">
          </div>
          @error('imagen')
            <div class="form-feedback-custom invalid-custom">
              <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
          @enderror
        </div>
      </div>
    </div>
  </div>

  <!-- Botones de Acción -->
  <div class="d-flex justify-content-end gap-2 mb-4">
    <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-success px-4">
      <i class="bi bi-save me-1"></i> Guardar Insumo
    </button>
  </div>
</form>

<script>
  function previewImage(event, previewId) {
    const reader = new FileReader();
    const imgElement = document.getElementById(previewId);
    reader.onload = function() {
      if (reader.readyState === 2) {
        imgElement.src = reader.result;
        imgElement.classList.remove('d-none');
      }
    };
    if (event.target.files[0]) {
      reader.readAsDataURL(event.target.files[0]);
    }
  }
</script>
@endsection