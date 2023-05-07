@extends('mahasiswas.layout')
@section('content')
<div class="container mt-5">
<div class="row justify-content-center align-items-center">
<div class="card" style="width: 24rem;">
<div class="card-header">
Edit Mahasiswa
</div>
<div class="card-body">
@if ($errors->any())
<div class="alert alert-danger">
<strong>Whoops!</strong> There were some problems with your input.<br><br>
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form method="post" action="{{ route('mahasiswas.update', $Mahasiswa->Nim) }}" enctype="multipart/form-data" id="myForm">
@csrf
@method('PUT')
<div class="form-group">
<label for="Nim">Nim</label>
<input type="text" name="Nim" class="form-control" id="Nim" value="{{ $Mahasiswa->Nim }}" ariadescribedby="Nim" >
</div>
<div class="form-group">
<label for="Nama">Nama</label>
<input type="text" name="Nama" class="form-control" id="Nama" value="{{ $Mahasiswa->Nama }}" ariadescribedby="Nama" >
</div>
<div class="form-group">
<label for="Kelas">Kelas</label>
<select name="Kelas" class="form-control">
    @foreach ($kelas as $Kelas)
    <option value="{{$Kelas->id}}">{{$Kelas->nama_kelas}}</option>
    @endforeach
</select>
</div>
<div class="form-group">
<label for="Jurusan">Jurusan</label>
<input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan" value="{{ $Mahasiswa->Jurusan }}" ariadescribedby="Jurusan" >
</div>
<div class="form-group">
<label for="No_Handphone">No_Handphone</label>
<input type="No_Handphone" name="No_Handphone" class="form-control" id="No_Handphone" value="{{ $Mahasiswa->No_Handphone }}" ariadescribedby="No_Handphone" >
</div>
<div class="form-group">
<label for="Email">Email</label>
<input type="Email" name="Email" class="form-control" id="Email" value="{{ $Mahasiswa->Email }}" aria-describedby="Email" >
</div>
<div class="form-group">
<label for="Tanggal_Lahir">Tanggal Lahir</label>
<input type="Tanggal_Lahir" name="Tanggal_Lahir" class="form-control" id="Tanggal_Lahir" value="{{ $Mahasiswa->Tanggal_Lahir }}" aria-describedby="Tanggal_Lahir" >
</div>
<div class="form-group">
<label for="Foto_Mhs">Foto Mahasiswa</label>
<input type="file" name="Foto_Mhs" class="form-control" id="Foto_Mhs" value="{{ $Mahasiswa->Foto_Mhs }}" aria-describedby="Foto_Mhs" >
</div>
<img width="100px" src="{{asset('storage/'.$Mahasiswa->Foto_Mhs)}}">
<br><br><br>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
@endsection