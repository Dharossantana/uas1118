<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Nilai;
use Validator;

class NilaiController extends Controller
{

public function __construct()
    {
        $this->middleware('auth:api', ['except'=>['index','show']]);

    }


   public function index(){
        $nilais = Nilai::with('Siswa', 'Mapel')->get();
        return response()->json($nilais);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id_nis' => 'required',
            'id_mapel' => 'required',
            'nilai_akhir' => 'required',
            'keterangan' => 'required'
        ]);
        if ($validate->passes()){

            $nilais = Nilai::create($request->all());
            return response()->json([
                'message' => 'Data Telah Disimpan',
                'data' => $nilais
            ]);
        }
        return response()->json([
            'message' => 'Data Tidak Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($nilais)
    {
        $data = Nilai::where('id_nilai', $nilais)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function update(Request $request, $nilais)
    {
        $data = Nilai::where('id_nilai', $nilais)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
              'id_nis' => 'required',
            'id_mapel' => 'required',
            'nilai_akhir' => 'required',
            'keterangan' => 'required'
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
    public function destroy($nilais)
    {
        $data = Nilai::where('id_nilai', $nilais)->first();
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
