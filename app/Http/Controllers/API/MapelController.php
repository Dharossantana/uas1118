<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mapel;
use Validator;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except'=>['index','show']]);

    }

    public function index(){
        $mapels = Mapel::all();
        return response()->json($mapels);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'guru' => 'required',
            'kelas' => 'required',
            'remidial' => 'required',
            'nama_mapel' => 'required'
        ]);
        if ($validate->passes()){

            $mapels = Mapel::create($request->all());
            return response()->json([
                'message' => 'Data Telah Disimpan',
                'data' => $mapels
            ]);
        }
        return response()->json([
            'message' => 'Data Tidak Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($mapels)
    {
        $data = Mapel::where('id_mapel', $mapels)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    public function update(Request $request, $mapels)
    {
        $data = Mapel::where('id_mapel', $mapels)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
             'guru' => 'required',
            'kelas' => 'required',
            'remidial' => 'required',
            'nama_mapel' => 'required'
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
    public function destroy($mapels)
    {
        $data = Mapel::where('id_mapel', $mapels)->first();
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
