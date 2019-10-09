<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Domain;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats() : Response
    {
        $dom = Domain::all();
    
        $stats = [
            'active' => $dom->sum('is_active'),
            'trash' => $dom->count() - $dom->sum('is_active'),
            'internationalized' => $dom->sum('is_idn'),
            'imprinted' => $dom->sum('is_imprinted')
        ];
        // Create HTTP response, 200 ok.
        $response = new Response($stats, Response::HTTP_OK);
        // Return HTTP response.
        return $response;
    }
}
