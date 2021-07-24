<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Siswa;
use Validator;

class SiswaController extends Controller
{

public function __construct()
    {
        $this->middleware('auth:api', ['except'=>['index','show']]);

    }

     public function index(){
        $siswas = Siswa::all();
        return response()->json($siswas);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'alamat' => 'required',
            'nama_orangtua' => 'required',
            'no_hp' => 'required'
        ]);
        if ($validate->passes()){

            $siswas = Siswa::create($request->all());
            return response()->json([
                'message' => 'Data Telah Disimpan',
                'data' => $siswas
            ]);
        }
        return response()->json([
            'message' => 'Data Tidak Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($siswas)
    {
        $data = Siswa::where('id_nis', $siswas)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function update(Request $request, $siswas)
    {
        $data = Siswa::where('id_nis', $siswas)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
             'nama_siswa' => 'required',
            'alamat' => 'required',
            'nama_orangtua' => 'required',
            'no_hp' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Telah Disimpan',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Tidak Disimpan',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
    public function destroy($siswas)
    {
        $data = Siswa::where('id_nis', $siswas)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
            # code...
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Telah Dihapus'
        ], 200);
    }
}
