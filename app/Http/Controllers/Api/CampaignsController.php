<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Campaign;

class CampaignsController extends Controller
{
    public function dashboard(){

        $total = Campaign::count();

        $presupuestoAcumulado = Campaign::sum('presupuesto');

        $distribucion = [
            'activas' => Campaign::where('active', true)->count(),
            'inactivas' => Campaign::where('active', false)->count(),
        ];

        return response()->json([
            'total' => $total,
            'presupuesto_acumulado' => $presupuestoAcumulado,
            'distribucion' => $distribucion,
        ]);
    }

    public function landig( $campaignId ){
        
        // Buscar la campaña
        $campaign = Campaign::where('id', $campaignId)->first();

        // Validar si existe
        if (!$campaign) {
            return response()->json(['error' => 'Campaña no encontrada'], 404);
        }

        // Métricas dummy (puedes adaptarlas o hacerlas aleatorias si lo prefieres)
        $metrics = [
            'alcance_estimado' => 15000,
            'clics' => 1200,
            'conversiones' => 240,
            'presupuesto_utilizado' => 3200.50,
            'engagement' => [
                'likes' => 430,
                'comentarios' => 78,
                'compartidos' => 35,
            ],
        ];

        return response()->json([
            'campaign' => $campaign,
            'metrics' => $metrics,
        ]);
    }
}