<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $search = $request->get('search');

    $insumos = Insumo::when($search, function ($query, $search) {
            return $query->where('id', $search) // Busca por ID exacto
                         ->orWhere('codigo', 'like', "%{$search}%") // Busca por SKU/Código
                         ->orWhere('nombre', 'like', "%{$search}%"); // Busca por Nombre
        })
        ->latest()
        ->paginate(10);

    return view('insumos.index', compact('insumos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('insumos.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'codigo'            => 'required|string|unique:insumos,codigo|max:50',
            'nombre'            => 'required|string|max:150',
            'categoria'         => 'required|string|in:Fertilizantes,Semillas Certificadas,Agroquímicos,Herramientas,Sistemas de Riego',
            'precio'            => 'required|numeric|min:0.01',
            'costo'             => 'required|numeric|min:0',
            'inventario'        => 'required|integer|min:0',
            'fabricante'        => 'required|string|max:100',
            'fecha_registro'    => 'required|date',
            'fecha_vencimiento' => 'nullable|date',
            'numero_lote'       => 'required|string|max:50',
            'imagen'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // Máximo 5MB
        ]);
 
        $data = $request->all();
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Asegurar que la carpeta uploads/insumos/ exista dentro de public
            $destinationPath = public_path('uploads/insumos');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $data['imagen'] = $filename;
        }

        Insumo::create($data);

        return redirect()->route('insumos.index')->with('success', 'Insumo registrado exitosamente en el inventario.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insumo $insumo)
    {
        return view('insumos.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insumo $insumo)
    {
        $request->validate([
            'codigo'            => 'required|string|max:50|unique:insumos,codigo,' . $insumo->id,
            'nombre'            => 'required|string|max:150',
            'categoria'         => 'required|string|in:Fertilizantes,Semillas Certificadas,Agroquímicos,Herramientas,Sistemas de Riego',
            'precio'            => 'required|numeric|min:0.01',
            'costo'             => 'required|numeric|min:0',
            'inventario'        => 'required|integer|min:0',
            'fabricante'        => 'required|string|max:100',
            'fecha_registro'    => 'required|date',
            'fecha_vencimiento' => 'nullable|date',
            'numero_lote'       => 'required|string|max:50',
            'imagen'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // Máximo 5MB
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($insumo->imagen && File::exists(public_path('uploads/insumos/' . $insumo->imagen))) {
                    File::delete(public_path('uploads/insumos/' . $insumo->imagen));
                }

                $file = $request->file('imagen');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/insumos');
                
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
            $file->move($destinationPath, $filename);
            $data['imagen'] = $filename;
        } else {
            $data['imagen'] = $insumo->imagen;
        }

        $insumo->update($data);


        return redirect()->route('insumos.index', $insumo)->with('success', '¡Insumo actualizado exitosamente en el inventario!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insumo $insumo)
    {
        $insumo = Insumo::findOrFail($insumo->id);

        // Borrar imagen física si existe
        if ($insumo->imagen && File::exists(public_path('uploads/insumos/' . $insumo->imagen))) {
            File::delete(public_path('uploads/insumos/' . $insumo->imagen));
        }

        $insumo->delete();

        return redirect()->route('insumos.index')->with('success', 'Insumo eliminado del inventario.');
    }
}
