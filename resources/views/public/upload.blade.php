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
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="login-container">
          <div class="header-banner">
            <h6 class="fw-semibold mb-0">Silahkan masukan Nomor Penugasan dan NRP untuk upload file</h6>
          </div>
          
          <div class="logo-container">
            <img src="{{ asset('assets/images/logo/dalmas.png') }}" alt="Logo OPS POLRI" />
            <img src="{{ asset('assets/images/logo/logopolda.png') }}" alt="Logo Sumsel" />
          </div>
          
          @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Akses Gagal!</strong> Periksa kembali nomor dan nrp Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
      
          <form method="POST" action="{{ route('public.sprint.upload-akses') }}">
            @csrf
            <div class="mb-3">
              <label for="nomor" class="form-label fw-semibold">Nomor</label>
              <div class="input-group">
                <input id="nomor" type="text" class="form-control @error('email') is-invalid @enderror" name="nomor"
                  value="{{ old('nomor') }}" required placeholder="Masukkan nomor penugasan anda ...">
              </div>
              @error('nomor')
              <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-4">
              <label for="nrp" class="form-label fw-semibold">NRP</label>
              <div class="input-group">
                <input id="nrp" type="nrp" class="form-control @error('nrp') is-invalid @enderror" name="nrp"
                  required placeholder="Masukkan nrp anda ...">
              </div>
              @error('nrp')
              <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-lg" style="background-color: #4d0f10; color: white;">
                <i class="bi bi-box-arrow-in-right me-2"></i>Submit
              </button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection