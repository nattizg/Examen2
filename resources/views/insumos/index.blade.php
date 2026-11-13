@extends('layouts.app')

@section('titulo', 'Insumos Agropecuarios e Inventario - Agrovalle Honduras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="page-title mb-1">Insumos Agropecuarios e Inventario</h2>
    <p class="page-subtitle mb-0">Gestión del catálogo de productos, existencias, lotes y precios.</p>
  </div>
  <a href="{{ route('insumos.create') }}" class="btn btn-success d-flex align-items-center gap-2">
    <i class="bi bi-plus-circle"></i>
    <span>Nuevo Insumo</span>
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="table-card-custom">
  <!-- Controles superiores: Buscador por nombre o SKU -->
  <div class="table-header-control">
    <form action="{{ route('insumos.index') }}" method="GET" class="d-flex flex-wrap gap-2 w-100 justify-content-between">
      <div class="table-search-box">
        <i class="bi bi-search table-search-icon"></i>
        <input type="text" name="search" class="table-search-input"
               placeholder="Buscar por nombre o código SKU..."
               value="{{ request('search') }}">
      </div>
      <div class="table-filter-group">
        <button type="submit" class="btn-table-action">
          <i class="bi bi-search"></i> Buscar
        </button>
        @if(request('search'))
          <a href="{{ route('insumos.index') }}" class="btn-table-action text-decoration-none">
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
          <th>Insumo</th>
          <th>Categoría</th>
          <th>Fabricante / Lote</th>
          <th>Costo / Precio</th>
          <th>Inventario</th>
          <th>Estado Existencias</th>
          <th>Vencimiento</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($insumos as $insumo)
          <tr>
            <!-- Miniatura de foto + Nombre + SKU -->
            <td>
              <div class="table-user-cell">
                <img src="{{ $insumo->imagen ? asset('uploads/insumos/' . $insumo->imagen) : asset('spark/assets/images/avatar.png') }}"
                     alt="{{ $insumo->nombre }}"
                     class="table-user-avatar"
                     style="object-fit: cover; border-radius: 8px;"
                     onerror="this.src='{{ asset('spark/assets/images/avatar.png') }}'">
                <div>
                  <div class="table-user-name">{{ $insumo->nombre }}</div>
                  <div class="table-user-sub">SKU: <strong>{{ $insumo->codigo }}</strong></div>
                </div>
              </div>
            </td>

            <!-- Categoría -->
            <td>{{ $insumo->categoria }}</td>

            <!-- Fabricante y Número de Lote -->
            <td>
              <div>{{ $insumo->fabricante }}</div>
              <small class="text-muted">Lote: {{ $insumo->numero_lote }}</small>
            </td>

            <!-- Costo y Precio -->
            <td>
              <div class="table-amount">L {{ number_format($insumo->precio, 2) }}</div>
              <small class="text-muted">Costo: L {{ number_format($insumo->costo, 2) }}</small>
            </td>

            <!-- Cantidad en Inventario -->
            <td>
              <strong>{{ $insumo->inventario }}</strong> uds.
            </td>

            <!-- Badges semánticos de existencias -->
            <td>
              @if($insumo->inventario > 20)
                <span class="badge-table success">Óptimo</span>
              @elseif($insumo->inventario >= 10 && $insumo->inventario <= 20)
                <span class="badge-table pending">Moderado</span>
              @else
                <span class="badge-table failed">¡Desabastecimiento!</span>
              @endif
            </td>

            <!-- Fecha de Vencimiento -->
            <td>
              {{ $insumo->fecha_vencimiento ? \Carbon\Carbon::parse($insumo->fecha_vencimiento)->format('d/m/Y') : 'N/A' }}
            </td>

            <!-- Acciones: Editar y Eliminar con confirmación JS -->
            <td>
              <div class="d-flex justify-content-center gap-1">
                <a href="{{ route('insumos.edit', $insumo->id) }}" class="table-btn-action" title="Editar insumo">
                  <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('insumos.destroy', $insumo->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar el insumo {{ $insumo->nombre }} ({{ $insumo->codigo }})? Esta acción no se puede deshacer.');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="table-btn-action delete border-0" title="Eliminar insumo">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center py-4 text-muted">
              No se encontraron insumos registrados en el inventario.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Paginación con links() -->
  <div class="table-footer-control">
    <span class="table-pagination-info">
      Mostrando {{ $insumos->firstItem() ?? 0 }} a {{ $insumos->lastItem() ?? 0 }} de {{ $insumos->total() }} registros
    </span>
    <div>
      {{ $insumos->appends(request()->query())->links() }}
    </div>
  </div>
</div>
@endsection