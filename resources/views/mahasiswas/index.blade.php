@extends('mahasiswas.layout')
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left mt-2">
<h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
</div>
<div class="float-right my-2">
<a class="btn btnsuccess" href="{{ route('mahasiswas.create') }}"> Input Mahasiswa</a>
</div>
</div>

</div>
<div class="row justify-content-between">
    <div class="col-md-3">
        <form action="{{ route('mahasiswas.index') }}" method="GET" role="search">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama Mahasiswa">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </span>
            </div>
        </form>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>Nim</th>
<th>Nama</th>
<th>Foto</th>
<th>Kelas</th>
<th>Jurusan</th>
<th>No_Handphone</th>
<th>Email</th>
<th>Tanggal_Lahir</th>
<th width="280px">Action</th>
</tr>
@foreach ($posts as $Mahasiswa)
<tr>
<td>{{ $Mahasiswa->Nim }}</td>
<td>{{ $Mahasiswa->Nama }}</td>
<td><img width="100px" height="100px" src="{{asset('storage/'.$Mahasiswa->Foto_Mhs)}}"></td>
<td>{{ $Mahasiswa->kelas->nama_kelas }}</td>
<td>{{ $Mahasiswa->Jurusan }}</td>
<td>{{ $Mahasiswa->No_Handphone }}</td>
<td>{{ $Mahasiswa->Email }}</td>
<td>{{ $Mahasiswa->Tanggal_Lahir }}</td>
<td>
<form action="{{ route('mahasiswas.destroy',$Mahasiswa->Nim) }}" method="POST">
<a class="btn btn-info" href="{{ route('mahasiswas.show',$Mahasiswa->Nim) }}">Show</a>
<a class="btn btn-primary" href="{{ route('mahasiswas.edit',$Mahasiswa->Nim) }}">Edit</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
<a class="btn btn-warning" href="{{ route('mahasiswas.nilai', $Mahasiswa->Nim) }}">Nilai</a>
</form>
</td>
</tr>
@endforeach
</table>
@if(isset($posts))
   @if($posts->currentPage() > 1)
      <a class="btn btn-primary" href="{{ $posts->previousPageUrl() }}">Previous</a>
   @endif
 
   @if($posts->hasMorePages())
      <a class="btn btn-primary" href="{{ $posts->nextPageUrl() }}">Next</a>
   @endif
@endif
@endsection