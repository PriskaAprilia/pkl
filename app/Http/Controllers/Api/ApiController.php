<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;   
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tracking;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    
    public $data = [];
    public function global()
    {
        
        $response = Http::get( 'https://api.kawalcorona.com/global/' )->json();
        foreach ($response as $data => $val){
            $raw =$val['attributes'];
            $res = [
                'Negara' => $raw['Country_Region'],
                'Positif' => $raw ['Confirmed'],
                'Sembuh' => $raw ['Recovered'],
                'meninggal' => $raw ['Deaths']
            ];
            array_push($this->data, $res);
         }
            $data = [
                'success' => true,
                'data' => $this->data,
                'message' => 'berhasil'
            ];
            return response()->json($data,200);

    }
    
    public function index()
    {
        $positif = DB::table('rws')
                ->select('trackings.positif','trackings.sembuh','trackings.meninggal')
                ->join('trackings','rws.id','=','trackings.id_rw')
                ->sum('trackings.positif');

        $sembuh = DB::table('rws')
                ->select('trackings.positif','trackings.sembuh','trackings.meninggal')
                ->join('trackings','rws.id','=','trackings.id_rw')
                ->sum('trackings.sembuh');
         
        $meninggal = DB::table('rws')
                ->select('trackings.positif','trackings.sembuh','trackings.meninggal')
                ->join('trackings','rws.id','=','trackings.id_rw')
                ->sum('trackings.meninggal');         
                
        $res = [
            'succes' => true,
            'Data'   => 'Data Kasus Indonesia',
            'Jumlah Positif' => $positif,
            'Jumlah Sembuh'  => $sembuh,
            'Jumlah Meninggal' => $meninggal,
            'message' => "Data Ditampilkan"
        ];
        
            return response()->json($res,200);

    }

    public function provinsi()
    {
        $test = DB::table('trackings')
        ->select(DB::raw('provinsis.nama_provinsi as provinsi'),
                 DB::raw('SUM(trackings.positif) as positif'), 
                 DB::raw('SUM(trackings.sembuh) as sembuh'),
                 DB::raw('SUM(trackings.meninggal) as meninggal'))
        ->join('rws','rws.id','=','trackings.id_rw')
        ->join('kelurahans','kelurahans.id','=','rws.id_kelurahan')
        ->join('kecamatans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->join('kotas','kotas.id','=','kecamatans.id_kota')
        ->join('provinsis','provinsis.id','=','kotas.id_provinsi')
        ->groupBy('provinsis.nama_provinsi')
        ->get();

        $res = [
            'Success'   => true,
            'Data'      => $test,
            'Message'   => 'Berhasil Menampilkan Berdasarkan Provinsi!'
        ];
    return response()->json($res, 200);
    }

    public function provinsi2($id){

        $positif = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('trackings','trackings.id_rw','=','rws.id')
        ->select('trackings.positif')
        ->where('provinsis.id',$id)
        ->sum('trackings.positif');

        $sembuh = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('trackings','trackings.id_rw','=','rws.id')
        ->select('trackings.sembuh')
        ->where('provinsis.id',$id)
        ->sum('trackings.sembuh');

        $meninggal = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('trackings','trackings.id_rw','=','rws.id')
        ->select('trackings.meninggal')
        ->where('provinsis.id',$id)
        ->sum('trackings.meninggal');

        $provinsi = Provinsi::whereId($id)->first();
        $data = [
            'success' => true,
            'Kode Provinsi' => $provinsi['kode_provinsi'],
            'Nama Provinsi' => $provinsi['nama_provinsi'],
            'Jumlah Positif' => $positif,
            'Jumlah Sembuh' => $sembuh,
            'Jumlah Meninggal' => $meninggal,
            'message' => 'Data Kasus Ditampilkan'
        ];

        return response()->json($data,200);
    }

    public function kota()
    {
        $test = DB::table('trackings')
        ->select(DB::raw('kotas.nama_kota as kota'),
                 DB::raw('SUM(trackings.positif) as positif'), 
                 DB::raw('SUM(trackings.sembuh) as sembuh'),
                 DB::raw('SUM(trackings.meninggal) as meninggal'))
        ->join('rws','rws.id','=','trackings.id_rw')
        ->join('kelurahans','kelurahans.id','=','rws.id_kelurahan')
        ->join('kecamatans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->join('kotas','kotas.id','=','kecamatans.id_kota')
        ->groupBy('kotas.nama_kota')
        ->get();

        $res = [
            'Success'   => true,
            'Data'      => $test,
            'Message'   => 'Berhasil Menampilkan Berdasarkan Kota!'
        ];
    return response()->json($res, 200);
    }

    public function kecamatan()
    {
        $test = DB::table('trackings')
        ->select(DB::raw('kecamatans.nama_kecamatan as kecamatan'),
                 DB::raw('SUM(trackings.positif) as positif'), 
                 DB::raw('SUM(trackings.sembuh) as sembuh'),
                 DB::raw('SUM(trackings.meninggal) as meninggal'))
        ->join('rws','rws.id','=','trackings.id_rw')
        ->join('kelurahans','kelurahans.id','=','rws.id_kelurahan')
        ->join('kecamatans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->groupBy('kecamatans.nama_kecamatan')
        ->get();

        $res = [
            'Success'   => true,
            'Data'      => $test,
            'Message'   => 'Berhasil Menampilkan Berdasarkan Kecamatan!'
        ];
    return response()->json($res, 200);
    }

    public function kelurahan()
    {
        $test = DB::table('trackings')
        ->select(DB::raw('kelurahans.nama_kelurahan as kelurahan'),
                 DB::raw('SUM(trackings.positif) as positif'), 
                 DB::raw('SUM(trackings.sembuh) as sembuh'),
                 DB::raw('SUM(trackings.meninggal) as meninggal'))
        ->join('rws','rws.id','=','trackings.id_rw')
        ->join('kelurahans','kelurahans.id','=','rws.id_kelurahan')
        ->groupBy('kelurahans.nama_kelurahan')
        ->get();

        $res = [
            'Success'   => true,
            'Data'      => $test,
            'Message'   => 'Berhasil Menampilkan Berdasarkan Kelurahan!'
        ];
    return response()->json($res, 200);
    }
    public function store(Request $request)
    {
        
    }

 
    public function show($id)
    {
          
    }


  
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}