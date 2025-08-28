@extends('layouts.admin')
@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        @if($is_edit)
            <div class="col-sm-6"><h3 class="mb-0">Edit Sprint</h3></div>
        @else
            <div class="col-sm-6"><h3 class="mb-0">Tambah Data</h3></div>
        @endif
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.sprint.index') }}">Sprint</a></li>
            @if($is_edit)
            <li class="breadcrumb-item"><a href="{{ route('dashboard.sprint.edit', $data->id) }}">Edit Sprint</a></li>
            @else
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
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
                        <h3 class="card-title m-0">Form Edit Data</h3>
                        @else
                        <h3 class="card-title m-0">Form Tambah Data</h3>
                        @endif
                        <a href="{{ route('dashboard.sprint.index') }}" class="btn btn-sm btn-secondary">
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
                        <form action="{{ route('dashboard.sprint.update', $data->id) }}" method="POST">
                        @method('PUT')
                    @else
                        <form action="{{ route('dashboard.sprint.store') }}" method="POST">
                    @endif
                        @csrf
                        <!-- IDENTITAS PASIEN -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Personil <span class="text-danger">*</span></label>
                                <select class="form-select select2 @error('role') is-invalid @enderror" 
                                        id="user_id" name="user_id" required>
                                    <option value="">Pilih Personil</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $data?->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Tugas <span class="text-danger">*</span></label>
                                <input type="text" name="nomor" class="form-control" placeholder="Contoh: SKM/03440xxxxx" value="{{ old('nomor',$data->nomor ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="text" name="start_date" class="form-control datepicker" placeholder="Masukan tanggal mulai" value="{{ old('start_date',$data->start_date ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="text" name="end_date" class="form-control datepicker" placeholder="Masukan tanggal selesai" value="{{ old('end_date',$data->end_date ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pangkat <span class="text-danger">*</span></label>
                                <input type="text" name="pangkat" class="form-control" placeholder="Contoh: AKP"  value="{{ old('pangkat',$data->pangkat ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NRP/NIP <span class="text-danger">*</span></label>
                                <input type="text" name="nrp" class="form-control" placeholder="Contoh: 42142141"  value="{{ old('nrp',$data->nrp ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="jabatan" class="form-control" placeholder="Contoh: PAUR KESMAPTA"  value="{{ old('jabatan',$data->jabatan ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kesatuan <span class="text-danger">*</span></label>
                                <input type="text" name="satuan" class="form-control" placeholder="Contoh: BIDDOKKES"  value="{{ old('satuan',$data->satuan ?? '') }}" required>
                            </div>
                        </div>
                        
                        <!-- SARAN -->
                        <div class="mb-3">
                            <label class="form-label">Pertimbangan</label>
                            <textarea name="pertimbangan" rows="3" class="form-control">{{ old('pertimbangan',$data->pertimbangan ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dasar</label>
                            <textarea name="dasar" rows="3" class="form-control">{{ old('dasar',$data->dasar ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tugas</label>
                            <textarea name="tugas" rows="3" class="form-control">{{ old('tugas',$data->tugas ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tembusan</label>
                            <textarea name="tembusan" rows="3" class="form-control">{{ old('tembusan',$data->tembusan ?? '') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.sprint.index') }}" class="btn btn-secondary">
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
                            <li><strong>Nomor Tugas</strong> wajib diisi sesuai format surat tugas (contoh: SKM/03440xxxxx).</li>
                            <li><strong>Tanggal Mulai</strong> dan <strong>Tanggal Selesai</strong> diisi berdasarkan periode pelaksanaan tugas.</li>
                            <li><strong>Nama</strong>, <strong>Pangkat</strong>, <strong>NRP/NIP</strong>, <strong>Jabatan</strong>, dan <strong>Kesatuan</strong> diisi sesuai identitas personel yang akan ditugaskan.</li>
                            <li><strong>Pertimbangan</strong> diisi dengan alasan atau latar belakang ditugaskannya personel.</li>
                            <li><strong>Dasar</strong> diisi dengan dasar hukum/peraturan atau surat lain yang digunakan sebagai acuan penerbitan surat tugas.</li>
                            <li><strong>Tugas</strong> diisi secara singkat mengenai uraian tugas yang akan dilaksanakan.</li>
                            <li><strong>Tembusan</strong> diisi apabila ada pihak lain yang perlu mendapatkan salinan surat tugas. Jika tidak ada, kolom dapat dikosongkan.</li>
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
        var is_edit = {!! json_encode($is_edit) !!};
    });
</script>
@endsection