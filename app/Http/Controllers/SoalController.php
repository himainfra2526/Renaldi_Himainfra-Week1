<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;

class SoalController extends Controller
{
    public function index(){
        $query = Soal::query();

        if(request('matkul')){
            $query->where('matkul',request('matkul'));
        }

        if(request('tipe')){
            $query->where('tipe', request('tipe'));
        }

        if(request('tahun')){
            $query->where('tahun', request('tahun'));
        }

        $data = $query->paginate(5)->withQueryString();

        if(request()->wantsJson()){
            return response()->json($data);
        }

        return view('soal',compact('data'));
    }

    public function store(Request $request){
        $validasi = $request->validate([
            'matkul' => 'required|min:3',
            'tahun' => 'required|numeric',
            'tipe' => 'required' 
        ]);
        
        $soal = Soal::create($validasi);

        if($request->wantsJson()){
            return response()->json($soal);
        }

        return redirect()->route('soal.index')->with('success','Soal berhasil ditambahkan');
    }

    public function destroy(string $id){
        Soal::destroy($id);

        if(request()->wantsJson()){
            return response()->json(['message'=>'deleted']);
        }

        return redirect()->route('soal.index')->with('success','Soal berhasil dihapus');
    }

    public function edit($id){
        $data = Soal::all();
        $soalDetail = Soal::findOrFail($id);

        return view('soal',compact('data','soalDetail'));
    }

    public function update(Request $request, $id){
        $validasi = $request->validate([
            'matkul' => 'required|min:3',
            'tahun' => 'required',
            'tipe' => 'required'
        ]);

        $soal = Soal::findOrFail($id);
        $soal->update($validasi);

        if($request()->wantsJson()){
            return response()->json($soal);
        }

        return redirect()->route('soal.index')->with('success','Soal berhasil diperbarui');
    }
}
