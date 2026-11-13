@extends('layouts.app')

@section('titulo', 'Inicio - Agrovalle Honduras')

@section('content')

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<!--bienvenida -->
<div class="card border-0 mb-4" style="background-color: var(--brand-forest-dark); color: #fff;">
  <div class="row align-items-center g-4">
    <div class="col-12 col-lg-8">
      <span class="d-inline-flex align-items-center gap-2 mb-3 px-3 py-1 rounded-pill small fw-semibold"
            style="background-color: var(--brand-lime-translucent); color: var(--brand-lime);">
        <i class="bi bi-flower1"></i> Agrovalle Honduras
      </span>
      <h1 class="mb-3 fw-bold" style="color: #fff; font-size: 2rem;">
        ¡Bienvenido{{ Auth::check() ? ', ' . Auth::user()->name : '' }}!
      </h1>
      <p class="mb-0" style="color: var(--text-sidebar-muted); max-width: 640px;">
        Agrovalle Honduras es una empresa dedicada a la distribución de insumos agropecuarios:
        fertilizantes, semillas certificadas, agroquímicos, herramientas y sistemas de riego para
        el productor hondureño. Desde este sistema gestionas el catálogo de productos, la red de
        proveedores que nos abastece y el personal técnico y administrativo que atiende al campo.
      </p>
    </div>
    <div class="col-12 col-lg-4 d-none d-lg-flex justify-content-center">
      <i class="bi bi-flower1" style="font-size: 7rem; color: var(--brand-lime); opacity: .9;"></i>
    </div>
  </div>
</div>

<div class="mb-3">
  <h2 class="page-title mb-1">Catálogos del sistema</h2>
  <p class="page-subtitle">Accede directamente a cada módulo de administración.</p>
</div>

<!-- 
     Módulos en catálogo -->
<div class="row g-4">

  <!-- Insumos -->
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card card-stat h-100">
      <div class="d-flex align-items-center justify-content-center rounded-circle mb-3"
           style="width: 56px; height: 56px; background-color: var(--sys-green-bg); color: var(--sys-green); font-size: 1.6rem;">
        <i class="bi bi-box-seam"></i>
      </div>
      <h5 class="card-title mb-2">Total de Insumos en Catálogo</h5>
      <div class="stat-value text-break mb-2" style="font-size: 1.75rem;">{{ number_format($totalInsumos) }}</div>
      <p class="stat-label mb-4">
        Fertilizantes, semillas certificadas, agroquímicos, herramientas y sistemas de riego,
        con su inventario, lotes, precios y fechas de vencimiento.
      </p>
      <a href="{{ route('insumos.index') }}" class="btn btn-success mt-auto d-inline-flex align-items-center justify-content-center gap-2">
        <span>Ver insumos</span> <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>

  <!-- Proveedores -->
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card card-stat h-100">
      <div class="d-flex align-items-center justify-content-center rounded-circle mb-3"
           style="width: 56px; height: 56px; background-color: var(--sys-orange-bg); color: var(--sys-orange); font-size: 1.6rem;">
        <i class="bi bi-truck"></i>
      </div>
      <h5 class="card-title mb-2">Total de Proveedores Activos</h5>
      <div class="stat-value text-break mb-2" style="font-size: 1.75rem;">{{ number_format($proveedoresActivos) }}</div>
      <p class="stat-label mb-4">
        Fabricantes e importadores agrícolas de químicos, semilleros y maquinaria, con sus
        condiciones de crédito, contacto y estado comercial.
      </p>
      <a href="{{ route('proveedores.index') }}" class="btn btn-success mt-auto d-inline-flex align-items-center justify-content-center gap-2">
        <span>Ver proveedores</span> <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>

  <!-- Empleados -->
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card card-stat h-100">
      <div class="d-flex align-items-center justify-content-center rounded-circle mb-3"
           style="width: 56px; height: 56px; background-color: var(--brand-lime-translucent); color: var(--brand-forest-light); font-size: 1.6rem;">
        <i class="bi bi-people"></i>
      </div>
      <h5 class="card-title mb-2">Total de Empleados en Nómina</h5>
      <div class="stat-value text-break mb-2" style="font-size: 1.75rem;">{{ number_format($totalEmpleados) }}</div>
      <p class="stat-label mb-4">
        Personal técnico y administrativo: ingenieros agrónomos, asesores de campo, bodega,
        maquinaria y caja, con su cargo, salario y fecha de ingreso.
      </p>
      <a href="{{ route('recursoshumanos.index') }}" class="btn btn-success mt-auto d-inline-flex align-items-center justify-content-center gap-2">
        <span>Ver empleados</span> <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>

  <!-- Valor Total del Inventario -->
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card card-stat h-100">
      <div class="d-flex align-items-center justify-content-center rounded-circle mb-3"
           style="width: 56px; height: 56px; background-color: #E0F2FE; color: #0284C7; font-size: 1.6rem;">
        <i class="bi bi-cash-stack"></i>
      </div>
      <h5 class="card-title mb-2">Valor Total del Inventario</h5>
      <div class="stat-value text-break mb-2" style="font-size: 1.75rem;">L. {{ number_format($valorInventario, 2, '.', ',') }}</div>
      <p class="stat-label mb-4">
        Suma de existencias × precio de venta de todos los insumos del catálogo.
      </p>
      <a href="{{ route('insumos.index') }}" class="btn btn-success mt-auto d-inline-flex align-items-center justify-content-center gap-2">
        <span>Ver inventario</span> <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>

</div>
@endsection