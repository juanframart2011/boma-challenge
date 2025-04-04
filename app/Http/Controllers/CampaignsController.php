<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;

use App\Models\Campaign;

class CampaignsController extends Controller
{
    /**
     * Muestra la lista de campañas.
     */
    public function index()
    {
        $campaigns = Campaign::OrderBy('created_at', 'desc')->get();
        return view('campaign.index', compact('campaigns'));
    }

    /**
     * Muestra el formulario para crear un nuevo campaña.
     */
    public function create()
    {
        return view( 'campaign.create' );
    }

    /**
     * Muestra el formulario de edición para un campaña existente.
     */
    public function detail($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('campaign.detail', compact('campaign' ));
    }

    /**
     * Muestra el formulario de edición para un campaña existente.
     */
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Guardar un nuevo campaña con carga de imágenes.
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:campaigns,name',
            'description' => 'nullable',
            'presupuesto' => 'required|numeric|min:0',
            'active' => 'boolean',
            'fecha' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            // Guardar campaña
            $campaign = new campaign();
            $campaign->name = $request->name;
            $campaign->fecha = $request->fecha;
            $campaign->description = $request->description;
            $campaign->presupuesto = $request->presupuesto;
            $campaign->active = $request->active;
            $campaign->created_by = Crypt::decryptString( session( env( "APP_CODE" ) . '1d' ) );

            $url = Str::slug( $request->name . date( "Ymd His" ) );

            if( !file_exists( getcwd() . '/img/campaign/' . $url ) ){

                mkdir( getcwd() . '/img/campaign/' . $url, 0777, true );
            }

            if( env( 'APP_ENV' ) == 'local' ){

                $rutacampaign = public_path( 'img/campaign/' );
            }
            else{

                $rutacampaign = getcwd() . '/img/campaign/';
            }

            // Guardar imagen principal
            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $imageExt = '.' . $request->file( 'image' )->getClientOriginalExtension();

                $imageName = $url . $imageExt;
                $image->move( $rutacampaign, $imageName );
                $campaign->image = 'img/campaign/' . $imageName;
            }

            $campaign->url = $url;
            $campaign->save();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'campaña guardada correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Actualiza un campaña existente con carga de imágenes.
     */
    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        if( !$campaign ){
            return response()->json(['errors' => ['No existe la campaña']], 422);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'presupuesto' => 'required|numeric|min:0',
            'fecha' => 'required',
            'active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {

            $url = Str::slug( $campaign->category_id . $campaign->name );

            if( !file_exists( getcwd() . '/img/campaign/' . $url ) ){

                mkdir( getcwd() . '/img/campaign/' . $url, 0777, true );
            }

            $campaign->name = $request->name;
            $campaign->description = $request->description;
            $campaign->presupuesto = $request->presupuesto;
            $campaign->fecha = $request->fecha;
            $campaign->active = $request->active;
            $campaign->created_by = Crypt::decryptString( session( env( "APP_CODE" ) . '1d' ) );

            if( env( 'APP_ENV' ) == 'local' ){

                $rutacampaign = public_path( 'img/campaign/' );
            }
            else{

                $rutacampaign = getcwd() . '/img/campaign/';
            }

            $campaign->save();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'campaña actualizada correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Eliminar un campaña (SoftDelete).
     */
    public function delete(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);
        $campaign->delete();
        return response()->json(['success' => true, 'message' => 'campaña eliminada correctamente.']);
    }
}