<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $search = $request->get('search');
 
        $empleados = Empleado::when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('identidad', 'like', "%{$search}%")
                      ->orWhere('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%")
                      ->orWhere('cargo', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);
 
        return view('recursoshumanos.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recursoshumanos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'identidad'     => 'required|digits:13|unique:empleados,identidad',
            'nombre'        => 'required|string|max:100',
            'apellido'      => 'required|string|max:100',
            'correo'        => 'required|email|max:150',
            'cargo'         => 'required|string|in:Ingeniero Agrónomo,Asesor Técnico de Campo,Jefe de Bodega Central,Operador de Maquinaria,Cajero',
            'salario'       => 'required|numeric|gt:0',
            'fecha_ingreso' => 'required|date|before_or_equal:today',
            'estado'        => 'required|string|in:Activo,Inactivo',
        ], [
            'identidad.digits'              => 'El DNI debe tener exactamente 13 dígitos numéricos, sin guiones.',
            'identidad.unique'              => 'Este número de identidad ya está registrado.',
            'cargo.required'                => 'El cargo es obligatorio.',
            'cargo.in'                      => 'El cargo seleccionado no es válido.',
            'salario.gt'                    => 'El salario debe ser mayor a 0.',
            'fecha_ingreso.date'            => 'La fecha de ingreso no es válida.',
            'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',
        ]);
 
        Empleado::create($request->all());
 
        return redirect()->route('recursoshumanos.index')->with('success', 'Empleado registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('recursoshumanos.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'identidad'     => 'required|digits:13|unique:empleados,identidad,' . $empleado->id,
            'nombre'        => 'required|string|max:100',
            'apellido'      => 'required|string|max:100',
            'correo'        => 'required|email|max:150',
            'cargo'         => 'required|string|in:Ingeniero Agrónomo,Asesor Técnico de Campo,Jefe de Bodega Central,Operador de Maquinaria,Cajero',
            'salario'       => 'required|numeric|gt:0',
            'fecha_ingreso' => 'required|date|before_or_equal:today',
            'estado'        => 'required|string|in:Activo,Inactivo',
        ], [
            'identidad.digits'              => 'El DNI debe tener exactamente 13 dígitos numéricos, sin guiones.',
            'identidad.unique'              => 'Este número de identidad ya está registrado por otro empleado.',
            'cargo.required'                => 'El cargo es obligatorio.',
            'cargo.in'                      => 'El cargo seleccionado no es válido.',
            'salario.gt'                    => 'El salario debe ser mayor a 0.',
            'fecha_ingreso.date'            => 'La fecha de ingreso no es válida.',
            'fecha_ingreso.before_or_equal' => 'La fecha de ingreso no puede ser futura.',
        ]);
 
        $empleado->update($request->all());
 
        return redirect()->route('recursoshumanos.index')->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
       $empleado->delete();
 
        return redirect()->route('recursoshumanos.index')->with('success', 'Empleado eliminado del sistema.');
    }
}
