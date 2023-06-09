<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mahasiswa_Matakuliah;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Mahasiswa::where([
            ['Nama', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('Nama', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])->paginate(5);
        
        $mahasiswas = Mahasiswa::all();
        // $posts = Mahasiswa::orderBy('Nim','desc')->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas', 'posts'))->with('i', (request()->input('page', 1) -1) *5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_Lahir' => 'required',
            'Foto_Mhs' => 'required',
        ]);

        $mahasiswas = new Mahasiswa;
        $mahasiswas->Nim = $request->get('Nim');
        $mahasiswas->Nama = $request->get('Nama');
        $mahasiswas->Jurusan = $request->get('Jurusan');
        $mahasiswas->No_Handphone = $request->get('No_Handphone');
        $mahasiswas->Email = $request->get('Email');
        $mahasiswas->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        if($request->file('Foto_Mhs')){
            $image = $request->file('Foto_Mhs')->store('images', 'public');
        }
        $mahasiswas->Foto_Mhs = $image;

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();

        // Mahasiswa::create($mahasiswas->all());

        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        $Kelas = Kelas::all();
        return view('mahasiswas.edit', ['kelas' => $Kelas], compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_Lahir' => 'required',
            'Foto_Mhs' => 'required',
        ]);

        $mahasiswas = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $mahasiswas->Nim = $request->get('Nim');
        $mahasiswas->Nama = $request->get('Nama');
        $mahasiswas->Jurusan = $request->get('Jurusan');
        $mahasiswas->No_Handphone = $request->get('No_Handphone');
        $mahasiswas->Email = $request->get('Email');
        $mahasiswas->Tanggal_Lahir = $request->get('Tanggal_Lahir');

        if ($mahasiswas->Foto_Mhs && file_exists(storage_path('app/public/' . $mahasiswas->Foto_Mhs))) {
            Storage::delete('public/' . $mahasiswas->Foto_Mhs);
        }
        $image = $request->file('Foto_Mhs')->store('images', 'public');
        $mahasiswas->Foto_Mhs = $image;

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();
        


        // Mahasiswa::find($Nim)->update($request->all());

        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        $mhs = Mahasiswa::find($Nim);
        if ($mhs->Foto_Mhs && file_exists(storage_path('app/public/' . $mhs->Foto_Mhs))) {
            Storage::delete('public/' . $mhs->Foto_Mhs);
        }
        $mhs->mataKuliah()->detach();
        $mhs->delete();
        

        
        return redirect()->route('mahasiswas.index')->with('success','Mahasiswa Berhasil Dihapus');
    }

    public function nilai($Nim){
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswas.nilai', compact('Mahasiswa'));
    }

    public function cetak($Nim){
        $Mahasiswa = Mahasiswa::find($Nim);
        $pdf = PDF::loadView('mahasiswas.cetak', ['Mahasiswa'=> $Mahasiswa]);
        return $pdf->stream();
    }
}
