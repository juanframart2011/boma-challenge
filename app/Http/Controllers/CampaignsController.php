<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;

use App\Models\Campaign;

class CampaignsController extends Controller
{
    /**
     * Muestra la lista de Categoría.
     */
    public function index()
    {
        #$categories = Campaign::OrderBy('created_at', 'desc')->get();
        $categories = array();
        return view('campaign.index', compact('categories'));
    }

    /**
     * Muestra el formulario para crear un nuevo categoría.
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Muestra el formulario de edición para un categoría existente.
     */
    public function detail($id)
    {
        $Campaign = Campaign::findOrFail($id);
        return view('campaign.detail', compact('Campaign' ));
    }

    /**
     * Muestra el formulario de edición para un categoría existente.
     */
    public function edit($id)
    {
        $Campaign = Campaign::findOrFail($id);
        return view('campaign.edit', compact('Campaign'));
    }

    /**
     * Guardar un nuevo categoría con carga de imágenes.
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'code' => 'required|string|max:20|unique:categories,code',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            // Guardar categoría
            $Campaign = new Campaign();
            $Campaign->name = $request->name;
            $Campaign->code = $request->code;
            $Campaign->description = $request->description;
            $Campaign->url = Str::slug( $request->name );

            $Campaign->save();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Categoría guardado correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Actualiza un categoría existente con carga de imágenes.
     */
    public function update(Request $request, $id)
    {
        $Campaign = Campaign::findOrFail($id);

        if( !$Campaign ){
            return response()->json(['errors' => ['No existe la categoría']], 422);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:categories,code,' . $Campaign->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {

            $Campaign->name = $request->name;
            $Campaign->code = $request->code;
            $Campaign->description = $request->description;
            
            $Campaign->save();

            
            DB::commit();
            return response()->json(['success' => true, 'message' => 'categoría actualizado correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Eliminar un categoría (SoftDelete).
     */
    public function delete(Request $request)
    {
        $Campaign = Campaign::findOrFail($request->id);
        $Campaign->delete();
        return response()->json(['success' => true, 'message' => 'Categoría eliminada correctamente.']);
    }
}