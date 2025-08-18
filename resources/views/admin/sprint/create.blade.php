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
                                <label class="form-label">Nomor Tugas <span class="text-danger">*</span></label>
                                <input type="number" name="age" class="form-control" placeholder="Contoh: SKM/03440xxxxx" value="{{ old('nomor',$data->nomor ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="name" class="form-control" placeholder="Masukan Nama Pasien" value="{{ old('name',$data->name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="name" class="form-control" placeholder="Masukan Nama Pasien" value="{{ old('name',$data->name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Pasien" value="{{ old('name',$data->name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pangkat <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: AKP"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NRP/NIP <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: Islam"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: PAUR KESMAPTA"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kesatuan <span class="text-danger">*</span></label>
                                <input type="text" name="religion" class="form-control" placeholder="Contoh: BIDDOKKES"  value="{{ old('religion',$data->religion ?? '') }}" required>
                            </div>
                        </div>
                        
                        <!-- SARAN -->
                        <div class="mb-3">
                            <label class="form-label">Pertimbangan</label>
                            <textarea name="recommendation" rows="3" class="form-control">{{ old('recommendation',$data->recommendation ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dasar</label>
                            <textarea name="recommendation" rows="3" class="form-control">{{ old('recommendation',$data->recommendation ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tugas</label>
                            <textarea name="recommendation" rows="3" class="form-control">{{ old('recommendation',$data->recommendation ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tembusan</label>
                            <textarea name="recommendation" rows="3" class="form-control">{{ old('recommendation',$data->recommendation ?? '') }}</textarea>
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
        // when $is_edit == true, remove required on password and confirmation_password
        if (is_edit) {
            $('#password-label').text('Password');
            $('#password-confirmation-label').text('Konfirmasi Password');
            $('#password').attr('required', false);
            $('#password_confirmation').attr('required', false);
        }
    });
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Password dan konfirmasi password tidak sama!');
            return false;
        }
        
        if (password.length < 8) {
            e.preventDefault();
            alert('Password minimal 8 karakter!');
            return false;
        }
    });
</script>
@endsection