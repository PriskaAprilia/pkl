<?php

namespace App\Http\Controllers;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\rw;
use App\Models\Tracking;
use App\Models\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
      public function index()
    {
        
        $provinsi = DB::table('provinsis')
          ->select('provinsis.nama_provinsi',
          DB::raw('SUM(trackings.positif) as positif'),
          DB::raw('SUM(trackings.sembuh) as sembuh'),
          DB::raw('SUM(trackings.meninggal) as meninggal'))
              ->join('kotas','provinsis.id','=','kotas.id_provinsi')
              ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
              ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
              ->join('rws','kelurahans.id','=','rws.id_kelurahan')
              ->join('trackings','rws.id','=','trackings.id_rw')               
              ->groupBy('provinsis.id')->get();

            $global = file_get_contents('https://api.kawalcorona.com/positif');
            $posglobal = json_decode($global, TRUE);         
            $datadunia= file_get_contents("https://api.kawalcorona.com/");
            $dunia = json_decode($datadunia, TRUE);

        $positif = DB::table('rws')
              ->select('trackings.positif',
              'trackings.sembuh', 'trackings.meninggal')
              ->join('trackings','rws.id','=','trackings.id_rw')
              ->sum('trackings.positif'); 
        $sembuh = DB::table('rws')
              ->select('trackings.positif',
              'trackings.sembuh','trackings.meninggal')
              ->join('trackings','rws.id','=','trackings.id_rw')
              ->sum('trackings.sembuh');
        $meninggal = DB::table('rws')
              ->select('trackings.positif',
              'trackings.sembuh','trackings.meninggal')
              ->join('trackings','rws.id','=','trackings.id_rw')
              ->sum('trackings.meninggal');
          
        return view('Frontend.index', compact('positif','sembuh','meninggal','posglobal','provinsi','dunia'));

    }
}