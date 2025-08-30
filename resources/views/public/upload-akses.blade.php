@extends('layouts.app')
@section('styles')
<style>
  html, body {
    height: 100%;
    background-color: #f8f9fa;
    font-family: 'Segoe UI', sans-serif;
  }
  body {
    display: flex;
    flex-direction: column;
    position: relative;
  }
  body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: -1;
  }
  .login-container {
    max-width: 450px;
    margin: 50px auto;
    padding: 2rem;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 10;
  }
  .header-banner {
    background-color: #4d0f10;
    color: white;
    padding: 1rem;
    border-radius: 8px 8px 0 0;
    margin: -2rem -2rem 1.5rem -2rem;
    text-align: center;
  }
  .logo-container {
    text-align: center;
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.5rem;
  }
  .logo-container img {
    height: 80px;
  }
  .title {
    font-weight: 600;
    text-align: center;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
  }
  .title .text-warning {
    color: #ffc107 !important;
  }
  .footer-link {
    font-size: 0.9rem;
    text-align: center;
    margin-top: 2rem;
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0 0 8px 8px;
    margin: 2rem -2rem -2rem -2rem;
    border-top: 1px solid #dee2e6;
  }
  .input-group-text {
    background-color: #4d0f10;
    color: white;
    border-color: #4d0f10;
  }
</style>
@endsection

@section('content')
<div class="row justify-content-center mt-1 mb-4">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white d-flex align-items-center" style="background-color: #4d0f10;">
                <i class="bi bi-clipboard-check-fill me-2 fs-4"></i>
                <h6 class="mb-0">Form Pelaporan Penugasan</h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(isset($expires_at))
                    <div class="alert alert-warning d-flex align-items-center">
                        <i class="bi bi-clock-history me-2"></i>
                        <span>
                            Token akan kadaluarsa dalam <span id="countdown" class="fw-bold text-danger"></span>, harap segera upload data!
                        </span>
                    </div>
                @endif

                <form id="uploadForm" method="POST" action="{{ route('public.sprint.upload-page-store', $id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pelapor" class="form-label fw-semibold">Nomor Penugasan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $nomor }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp_pelapor" class="form-label fw-semibold">NRP <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $nrp }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3 d-none">
                        <label for="no_hp_pelapor" class="form-label fw-semibold">Token <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="token" value="{{ $token }}" required readonly>
                        </div>
                    </div>

                    <!-- Upload Multiple File -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload File <span class="text-danger">*</span></label>
                        <div id="file-upload-wrapper">
                          <div class="input-group mb-2 file-row">
                            <input type="file" name="files[]" class="form-control file-input" accept="image/*" required>
                            <button type="button" class="btn btn-danger remove-file">Hapus</button>
                            <div class="invalid-feedback">
                              Hanya gambar (JPG, JPEG, PNG, GIF, SVG, WEBP) maksimal 2MB.
                            </div>
                          </div>
                        </div>
                      
                        <button type="button" class="btn btn-sm btn-secondary" id="add-file">
                          <i class="bi bi-plus-circle"></i> Tambah File
                        </button>
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn text-white fw-semibold" style="background-color: #4d0f10;">
                            <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(isset($expires_at))
            // Ambil expired dari controller (format Laravel: Y-m-d H:i:s)
            let expiresAt = new Date("{{ $expires_at }}").getTime();

            let countdownEl = document.getElementById("countdown");
            
            let timer = setInterval(function() {
                let now = new Date().getTime();
                let distance = expiresAt - now;

                if (distance <= 0) {
                    clearInterval(timer);
                    countdownEl.innerHTML = "Expired";
                    countdownEl.classList.remove("text-danger");
                    countdownEl.classList.add("text-muted");
                } else {
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownEl.innerHTML = minutes + "m " + seconds + "s";
                }
            }, 1000);
        @endif
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
      const wrapper   = document.getElementById('file-upload-wrapper');
      const addBtn    = document.getElementById('add-file');
    
      // Aturan validasi FE
      const MAX_SIZE       = 2 * 1024 * 1024; // 2MB
      const ALLOWED_TYPES  = ['image/jpeg','image/png','image/gif','image/svg+xml','image/webp'];
    
      function validateFileInput(input) {
        // reset state
        input.classList.remove('is-invalid', 'is-valid');
    
        const file = input.files && input.files[0];
        if (!file) return; // tidak ada file, biarkan required yang handle
    
        // Cek mime type
        if (!ALLOWED_TYPES.includes(file.type)) {
          setInvalid(input, 'File bukan gambar yang diizinkan.');
          input.value = ''; // reset pilihan file
          return;
        }
    
        // Cek ukuran
        if (file.size > MAX_SIZE) {
          setInvalid(input, 'Ukuran gambar melebihi 2MB.');
          input.value = '';
          return;
        }
    
        input.classList.add('is-valid');
        // optional: hapus pesan error kalau ada
        const feedback = input.parentElement.querySelector('.invalid-feedback');
        if (feedback) feedback.textContent = 'Hanya gambar (JPG, JPEG, PNG, GIF, SVG, WEBP) maksimal 2MB.';
      }
    
      function setInvalid(input, message) {
        input.classList.add('is-invalid');
        const feedback = input.parentElement.querySelector('.invalid-feedback');
        if (feedback) feedback.textContent = message;
      }
    
      // Event delegation: validasi setiap kali ada perubahan pada input yang bertipe .file-input
      wrapper.addEventListener('change', function (e) {
        if (e.target && e.target.classList.contains('file-input')) {
          validateFileInput(e.target);
        }
      });
    
      // Tambah input baru
      addBtn.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'input-group mb-2 file-row';
        row.innerHTML = `
          <input type="file" name="files[]" class="form-control file-input" accept="image/*" required>
          <button type="button" class="btn btn-danger remove-file">Hapus</button>
          <div class="invalid-feedback">
            Hanya gambar (JPG, JPEG, PNG, GIF, SVG, WEBP) maksimal 2MB.
          </div>
        `;
        wrapper.appendChild(row);
      });
    
      // Hapus input
      wrapper.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-file')) {
          e.target.closest('.file-row').remove();
        }
      });
    
      // Cek ulang semua sebelum submit (pastikan semua valid)
      const form = document.querySelector('form');
      if (form) {
        form.addEventListener('submit', function (e) {
          const inputs = wrapper.querySelectorAll('.file-input');
          let hasError = false;
    
          // Minimal 1 file dipilih
          const anyFileChosen = Array.from(inputs).some(inp => (inp.files && inp.files.length > 0));
          if (!anyFileChosen) {
            alert('Harap pilih minimal 1 gambar.');
            e.preventDefault();
            return;
          }
    
          inputs.forEach(inp => {
            if (inp.files && inp.files.length > 0) {
              validateFileInput(inp);
              if (inp.classList.contains('is-invalid')) hasError = true;
            }
          });
    
          if (hasError) {
            e.preventDefault();
            // scroll ke error pertama
            const firstInvalid = wrapper.querySelector('.file-input.is-invalid');
            if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        });
      }
    });
</script>
@endsection
