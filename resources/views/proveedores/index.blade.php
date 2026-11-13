@extends('layouts.app')

@section('titulo', 'Fabricantes y Proveedores Agrícolas - Agrovalle Honduras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="page-title mb-1">Fabricantes y Proveedores Agrícolas</h2>
    <p class="page-subtitle mb-0">Gestión de fabricantes e importadores, condiciones de crédito y estado comercial.</p>
  </div>
  <a href="{{ route('proveedores.create') }}" class="btn btn-success d-flex align-items-center gap-2">
    <i class="bi bi-plus-circle"></i>
    <span>Nuevo Proveedor</span>
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="table-card-custom">
  <!-- Controles superiores: Buscador por empresa o RTN -->
  <div class="table-header-control">
    <form action="{{ route('proveedores.index') }}" method="GET" class="d-flex flex-wrap gap-2 w-100 justify-content-between">
      <div class="table-search-box">
        <i class="bi bi-search table-search-icon"></i>
        <input type="text" name="search" class="table-search-input"
               placeholder="Buscar por empresa o RTN..."
               value="{{ request('search') }}">
      </div>
      <div class="table-filter-group">
        <button type="submit" class="btn-table-action">
          <i class="bi bi-search"></i> Buscar
        </button>
        @if(request('search'))
          <a href="{{ route('proveedores.index') }}" class="btn-table-action text-decoration-none">
            <i class="bi bi-x-circle"></i> Limpiar
          </a>
        @endif
      </div>
    </form>
  </div>

  <!-- Tabla Responsiva -->
  <div class="table-responsive">
    <table class="table-custom">
      <thead>
        <tr>
          <th>Empresa</th>
          <th>RTN</th>
          <th>Contacto / Teléfono</th>
          <th>Categoría</th>
          <th>Límite de Crédito</th>
          <th>Plazo de Crédito</th>
          <th>Estado</th>
          <th>Registro</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($proveedores as $proveedor)
          <tr>
            <!-- Empresa -->
            <td>
              <div class="table-user-name">{{ $proveedor->empresa }}</div>
            </td>

            <!-- RTN -->
            <td>{{ $proveedor->rtn }}</td>

            <!-- Contacto y teléfono -->
            <td>
              <div>{{ $proveedor->contacto }}</div>
              <small class="text-muted">Tel: {{ $proveedor->telefono }}</small>
            </td>

            <!-- Categoría -->
            <td>{{ $proveedor->categoria }}</td>

            <!-- Límite de crédito -->
            <td>
              <div class="table-amount">L {{ number_format($proveedor->limite_credito, 2) }}</div>
            </td>

            <!-- Badge de plazo crediticio -->
            <td>
              <span class="badge-table pending">{{ $proveedor->dias_credito }} días</span>
            </td>

            <!-- Badge de estado: Activo (verde) / Inactivo (gris) -->
            <td>
              @if($proveedor->estado === 'Activo')
                <span class="badge-table success">Activo</span>
              @else
                <span class="badge-table" style="background-color: #e9ecef; color: #6c757d;">Inactivo</span>
              @endif
            </td>

            <!-- Fecha de registro -->
            <td>
              {{ $proveedor->fecha_registro ? \Carbon\Carbon::parse($proveedor->fecha_registro)->format('d/m/Y') : 'N/A' }}
            </td>

            <!-- Acciones: Editar y Eliminar con confirmación JS -->
            <td>
              <div class="d-flex justify-content-center gap-1">
                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="table-btn-action" title="Editar proveedor">
                  <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar al proveedor {{ $proveedor->empresa }} (RTN {{ $proveedor->rtn }})? Esta acción no se puede deshacer.');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="table-btn-action delete border-0" title="Eliminar proveedor">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center py-4 text-muted">
              No se encontraron proveedores registrados.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Paginación con links() -->
  <div class="table-footer-control">
    <span class="table-pagination-info">
      Mostrando {{ $proveedores->firstItem() ?? 0 }} a {{ $proveedores->lastItem() ?? 0 }} de {{ $proveedores->total() }} registros
    </span>
    <div>
      {{ $proveedores->appends(request()->query())->links() }}
    </div>
  </div>
</div>
@endsection