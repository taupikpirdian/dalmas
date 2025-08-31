@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        @if($is_edit)
            <div class="col-sm-6"><h3 class="mb-0">Edit Personil</h3></div>
        @else
            <div class="col-sm-6"><h3 class="mb-0">Tambah Personil</h3></div>
        @endif
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.personil.index') }}">Personil</a></li>
            @if($is_edit)
            <li class="breadcrumb-item"><a href="{{ route('dashboard.personil.edit', $data->id) }}">Edit Personil</a></li>
            @else
            <li class="breadcrumb-item active" aria-current="page">Tambah Personil</li>
            @endif
            </ol>
        </div>
    </div>
    <!--end::Row-->
  </div>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        @if($is_edit)
                        <h3 class="card-title m-0">Form Edit Personil</h3>
                        @else
                        <h3 class="card-title m-0">Form Tambah Personil</h3>
                        @endif
                        <a href="{{ route('dashboard.personil.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan!</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($is_edit)
                        <form action="{{ route('dashboard.personil.update', $data->id) }}" method="POST">
                        @method('PUT')
                    @else
                        <form action="{{ route('dashboard.personil.store') }}" method="POST">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nrp" class="form-label">NRP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nrp') is-invalid @enderror" 
                                           id="nrp" name="nrp" 
                                           value="{{ old('nrp', $data->nrp ?? '') }}" 
                                           placeholder="Masukkan NRP" 
                                           required
                                           >
                                    @error('nrp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" 
                                           value="{{ old('name', $data->name ?? '') }}" 
                                           placeholder="Masukkan Nama" 
                                           required
                                           >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="pangkat" class="form-label">Pangkat </label>
                                    <input type="text" class="form-control @error('pangkat') is-invalid @enderror" 
                                           id="pangkat" name="pangkat" 
                                           value="{{ old('pangkat', $data->pangkat ?? '') }}" 
                                           placeholder="Masukkan Pangkat" 
                                           >
                                    @error('pangkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan </label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                                           id="jabatan" name="jabatan" 
                                           value="{{ old('jabatan', $data->jabatan ?? '') }}" 
                                           placeholder="Masukkan Jabatan" 
                                           >
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan </label>
                                    <input type="text" class="form-control @error('satuan') is-invalid @enderror" 
                                           id="satuan" name="satuan" 
                                           value="{{ old('satuan', $data->satuan ?? '') }}" 
                                           placeholder="Masukkan Satuan" 
                                           >
                                    @error('satuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.personil.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0"><i class="fas fa-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-lightbulb"></i> Petunjuk Pengisian:</h6>
                        <ul class="mb-0 small">
                            <li>NRP wajib diisi</li>
                            <li>Nama wajib diisi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endsection