<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\Post;

class MahasiswaController extends Controller
{
    public function index() {
        return view('index', [
            'data' => DB::table('mahasiswas')->orderBy('id', 'desc')->paginate(10)
        ]);
    }

    public function delete($nim) {
        $deleted = DB::table('mahasiswas')->where('nim','=', $nim)->delete();
        return redirect()->to('')->send()->with('success', 'Data berhasil dihapus');
    }

    public function tambah(Request $request){
        $request->validate([
            'nim'=>'required|unique:mahasiswas',
            'nama'=>'required',
            'alamat'=>'required',
            'fakultas'=>'required'
        ]);
        
        $query = DB::table('mahasiswas')->insert([
            'nim'=>$request->input('nim'),
            'nama'=>$request->input('nama'),
            'alamat'=>$request->input('alamat'),
            'fakultas'=>$request->input('fakultas')
        ]);

        if($query){
            return redirect()->to('')->send()->with('success', 'Data mahasiswa berhasil ditambah');
        } 
    }
    public function edit(Request $request, $nim){
        
        $request->validate([
            'nim'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'fakultas'=>'required'
        ]);

        try {

            $query = DB::table('mahasiswas')->where('nim', $nim)->update([
                'nim'=>$request->input('nim'),
                'nama'=>$request->input('nama'),
                'alamat'=>$request->input('alamat'),
                'fakultas'=>$request->input('fakultas')
            ]);
            return redirect()->to('')->send()->with('success', 'Data berhasil diedit');
        
        } 
        catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->to('')->send()->with('exist', 'NIM sudah ada');
            }
        }
    }
}
