@extends('layouts.app')

@section('titulo', 'Recursos Humanos y Personal Técnico - Agrovalle Honduras')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="page-title mb-1">Recursos Humanos y Personal Técnico</h2>
    <p class="page-subtitle mb-0">Nómina y gestión del personal: cargos, salarios y estado laboral.</p>
  </div>
  <a href="{{ route('recursoshumanos.create') }}" class="btn btn-success d-flex align-items-center gap-2">
    <i class="bi bi-plus-circle"></i>
    <span>Nuevo Empleado</span>
  </a>
</div>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@php
  // Estilo del badge distintivo según el cargo desempeñado
  $coloresCargo = [
    'Ingeniero Agrónomo'      => 'background-color:#d1e7dd; color:#0f5132;',
    'Asesor Técnico de Campo' => 'background-color:#cff4fc; color:#055160;',
    'Jefe de Bodega Central'  => 'background-color:#fff3cd; color:#664d03;',
    'Operador de Maquinaria'  => 'background-color:#e2d9f3; color:#432874;',
    'Cajero'                  => 'background-color:#f8d7da; color:#842029;',
  ];
@endphp

<div class="table-card-custom">
  <!-- Controles superiores: Buscador por nombre, apellido o identidad -->
  <div class="table-header-control">
    <form action="{{ route('recursoshumanos.index') }}" method="GET" class="d-flex flex-wrap gap-2 w-100 justify-content-between">
      <div class="table-search-box">
        <i class="bi bi-search table-search-icon"></i>
        <input type="text" name="search" class="table-search-input"
               placeholder="Buscar por nombre, apellido o identidad..."
               value="{{ request('search') }}">
      </div>
      <div class="table-filter-group">
        <button type="submit" class="btn-table-action">
          <i class="bi bi-search"></i> Buscar
        </button>
        @if(request('search'))
          <a href="{{ route('empleados.index') }}" class="btn-table-action text-decoration-none">
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
          <th>Colaborador</th>
          <th>Identidad</th>
          <th>Cargo</th>
          <th>Salario Base</th>
          <th>Fecha de Ingreso</th>
          <th>Estado</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($empleados as $empleado)
          <tr>
            <!-- Nombre completo + correo -->
            <td>
              <div class="table-user-name">{{ $empleado->nombre }} {{ $empleado->apellido }}</div>
              <div class="table-user-sub">{{ $empleado->correo }}</div>
            </td>

            <!-- Identidad (DNI) -->
            <td>{{ $empleado->identidad }}</td>

            <!-- Badge distintivo según el cargo -->
            <td>
              <span class="badge-table" style="{{ $coloresCargo[$empleado->cargo] ?? 'background-color:#e9ecef; color:#6c757d;' }}">
                {{ $empleado->cargo }}
              </span>
            </td>

            <!-- Salario en formato L. XX,XXX.XX -->
            <td>
              <div class="table-amount">L. {{ number_format($empleado->salario, 2, '.', ',') }}</div>
            </td>

            <!-- Fecha de ingreso formateada -->
            <td>
              {{ $empleado->fecha_ingreso ? \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') : 'N/A' }}
            </td>

            <!-- Estado -->
            <td>
              @if($empleado->estado === 'Activo')
                <span class="badge-table success">Activo</span>
              @else
                <span class="badge-table" style="background-color: #e9ecef; color: #6c757d;">Inactivo</span>
              @endif
            </td>

            <!-- Acciones: Editar y Eliminar con confirmación JS -->
            <td>
              <div class="d-flex justify-content-center gap-1">
                <a href="{{ route('recursoshumanos.edit', $empleado->id) }}" class="table-btn-action" title="Editar empleado">
                  <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('recursoshumanos.destroy', $empleado->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $empleado->nombre }} {{ $empleado->apellido }} (Identidad {{ $empleado->identidad }})? Esta acción no se puede deshacer.');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="table-btn-action delete border-0" title="Eliminar empleado">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">
              No se encontraron empleados registrados.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Paginación con links() -->
  <div class="table-footer-control">
    <span class="table-pagination-info">
      Mostrando {{ $empleados->firstItem() ?? 0 }} a {{ $empleados->lastItem() ?? 0 }} de {{ $empleados->total() }} registros
    </span>
    <div>
      {{ $empleados->appends(request()->query())->links() }}
    </div>
  </div>
</div>
@endsection