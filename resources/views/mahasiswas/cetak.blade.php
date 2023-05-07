@extends('mahasiswas.layout')
@section('content')
<div class="container mt-5">
<center>
<div class="card-header">
JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG

<h1>KARTU HASIL STUDI (KHS)</h1>
</div>
</center>
<div class="identity">
<ol><b>Nama: </b>{{$Mahasiswa->Nama}}</ol>
<ol><b>Nim: </b>{{$Mahasiswa->Nim}}</ol>
<ol><b>Kelas: </b>{{$Mahasiswa->kelas->nama_kelas}}</ol>
</div>
<div class="row justify-content-center align-items-center">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Mata Kuliah</th>
      <th scope="col">SKS</th>
      <th scope="col">Semester</th>
      <th scope="col">Nilai</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($Mahasiswa->mataKuliah as $list)
    <tr>
      <td>{{$list->nama_matkul}}</td>
      <td>{{$list->sks}}</td>
      <td>{{$list->semester}}</td>
      <td>{{$list->pivot->nilai}}</td>
    </tr>
    @endforeach
  </tbody>
  
</table>
</div>
</div>
@endsection