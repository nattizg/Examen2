<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $proveedores = Proveedor::when($search, function ($query, $search) {
                return $query->where('empresa', 'like', "%{$search}%")
                             ->orWhere('rtn', 'like', "%{$search}%")
                             ->orWhere('contacto', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rtn'            => 'required|string|size:14|unique:proveedores,rtn',
            'empresa'        => 'required|string|max:150',
            'contacto'       => 'required|string|max:100',
            'telefono'       => ['required', 'string', 'size:8', 'regex:/^[2389]\d{7}$/'],
            'categoria'      => 'required|string|in:Químicos,Semilleros,Maquinaria',
            'limite_credito' => 'required|numeric|min:0',
            'dias_credito'   => 'required|integer|in:15,30,45,60',
            'estado'         => 'required|string|in:Activo,Inactivo',
            'fecha_registro' => 'required|date',
        ], [
            'rtn.size'       => 'El RTN debe tener exactamente 14 caracteres.',
            'telefono.regex' => 'El teléfono debe ser un número válido de 8 dígitos en Honduras (iniciando en 2, 3, 8 o 9).',
            'telefono.size'  => 'El teléfono debe tener exactamente 8 dígitos.',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'rtn'            => 'required|string|size:14|unique:proveedores,rtn,' . $proveedor->id,
            'empresa'        => 'required|string|max:150',
            'contacto'       => 'required|string|max:100',
            'telefono'       => ['required', 'string', 'size:8', 'regex:/^[2389]\d{7}$/'],
            'categoria'      => 'required|string|in:Químicos,Semilleros,Maquinaria',
            'limite_credito' => 'required|numeric|min:0',
            'dias_credito'   => 'required|integer|in:15,30,45,60',
            'estado'         => 'required|string|in:Activo,Inactivo',
            'fecha_registro' => 'required|date',
        ], [
            'rtn.size'       => 'El RTN debe tener exactamente 14 caracteres.',
            'telefono.regex' => 'El teléfono debe ser un número válido de 8 dígitos en Honduras (iniciando en 2, 3, 8 o 9).',
            'telefono.size'  => 'El teléfono debe tener exactamente 8 dígitos.',
        ]);

        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado del sistema.');
    }
}
