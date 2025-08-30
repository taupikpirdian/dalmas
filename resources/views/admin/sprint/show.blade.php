@extends('layouts.admin')

@section('content-header')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Detail Sprint</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.sprint.index') }}">Sprint</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h3 class="card-title m-0">Informasi Sprint</h3>
                        <div>
                            <a href="{{ route('dashboard.sprint.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Personil <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nomor',$data->nama ?? '') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Tugas <span class="text-danger">*</span></label>
                            <input type="text" name="nomor" class="form-control" placeholder="-" value="{{ old('nomor',$data->nomor ?? '') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="text" name="start_date" class="form-control datepicker" placeholder="-" value="{{ old('start_date',$data->start_date ?? '') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="text" name="end_date" class="form-control datepicker" placeholder="-" value="{{ old('end_date',$data->end_date ?? '') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pangkat <span class="text-danger">*</span></label>
                            <input type="text" name="pangkat" class="form-control" placeholder="-"  value="{{ old('pangkat',$data->pangkat ?? '') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NRP/NIP <span class="text-danger">*</span></label>
                            <input type="text" name="nrp" class="form-control" placeholder="-"  value="{{ old('nrp',$data->nrp ?? '') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control" placeholder="-"  value="{{ old('jabatan',$data->jabatan ?? '') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Tugas <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_tugas" class="form-control" placeholder="-"  value="{{ old('jenis_tugas',$data->jenis_tugas ?? '') }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Tugas</label>
                            <textarea name="tugas" rows="3" class="form-control" readonly>{{ old('tugas',$data->tugas ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tembusan</label>
                            <textarea name="tembusan" rows="3" class="form-control" readonly>{{ old('tembusan',$data->tembusan ?? '') }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="fw-bold">📷 Bukti Pelaksanaan</h5>
                        </div>
                    
                        @forelse($data->files as $index => $file)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="ratio ratio-4x3">
                                        <img src="{{ url('file/' . $data->id . '/' . $file->name) }}" 
                                             class="card-img-top rounded object-fit-cover img-clickable"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal"
                                             data-img-src="{{ url('file/' . $data->id . '/' . $file->name) }}"
                                             alt="Bukti Pelaksanaan">
                                    </div>
                                    <div class="card-body p-2 text-center">
                                        <small class="text-muted text-truncate d-block">
                                            {{ $file->original_name ?? $file->name }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Belum ada bukti pelaksanaan yang diunggah.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- User Statistics Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title m-0">Statistik</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Dibuat Oleh:</span>
                        <span class="text-muted">{{ $data->user->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Terakhir Update:</span>
                        <span class="text-muted">{{ $data->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Actions Card -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title m-0">Aksi</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.sprint.edit', $data->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit Sprint
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $data->id }})">
                            <i class="fas fa-trash"></i> Hapus Sprint
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body p-0 text-center">
          <img id="modalImage" src="" class="img-fluid rounded shadow-lg" alt="Preview">
        </div>
      </div>
    </div>
</div>

<!-- Delete Confirmation Form -->
<form id="delete-form-{{ $data->id }}" action="{{ route('dashboard.sprint.destroy', $data->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data user akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const imageModal = document.getElementById("imageModal");
        const modalImage = document.getElementById("modalImage");

        imageModal.addEventListener("show.bs.modal", function (event) {
            let img = event.relatedTarget;
            let src = img.getAttribute("data-img-src");
            modalImage.setAttribute("src", src);
        });
    });
</script>
@endsection