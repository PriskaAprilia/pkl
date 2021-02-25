<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Validator;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::latest()->get();
        $res = [
            'succes' => true,
            'data'  =>$provinsi,
            'message' => 'Data Berhasil Ditampilkan'
        ];
        return response()->json($res,200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $provinsi = Provinsi::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //success save to database
        if($provinsi) {

            return response()->json([
                'success' => true,
                'message' => 'provinsi Created',
                'data'    => $provinsi  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'provinsi Failed to Save',
        ], 409);
    }

    public function show($id)
    {
        $provinsi = Provinsi::whereId($id)->first();

        if ($provinsi) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Provinsi!',
                'data'    => $provinsi
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi Tidak Ditemukan !',
                'data'    => ''
            ], 404);
        } 
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find provinsi by ID
        $provinsi = Provinsi::findOrFail($provinsi->id);

        if($provinsi) {

            //update provinsi
            $provinsi->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

            return response()->json([
                'success' => true,
                'message' => 'provinsi Updated',
                'data'    => $provinsi  
            ], 200);

        }

        //data provinsi not found
        return response()->json([
            'success' => false,
            'message' => 'provinsi Not Found',
        ], 404);
    }

    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        if ($provinsi) {
            return response()->json([
                'success' => true,
                'message' => 'Provinsi Berhasil Dihapus !',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi Gagal Dihapus !',
            ], 500);
        }

    }
}