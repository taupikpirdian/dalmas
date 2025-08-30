@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
      <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="card-title m-0">Data Laporan Penugasan Personil</h3>
            </div>
        </div>
        <div class="card-body">
        <table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>  
      </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
      $('#example').DataTable();
    });

    var dataTable = $("#example").DataTable({
        //   "scrollX": true,
          processing: true,
          serverSide: true,
          autoWidth: true,
          orderCellsTop: true,
          fixedHeader: true,
        //   sDom: 'lrtip',
          fixedColumns: {
              right: 1,
              left: 0,
          },
          ajax: "{{ route('public.sprint.index') }}",
          columns: [
              {
                  data: 'DT_RowIndex',
                  orderable: false
              },
              {
                  data: 'nomor',
                  name: 'nomor'
              },
              {
                  data: 'start_date',
                  name: 'start_date'
              },
              {
                  data: 'end_date',
                  name: 'end_date'
              },
              {
                  data: 'name',
                  name: 'name'
              },
              {
                  data: 'jabatan',
                  name: 'jabatan'
              },
              {
                  data: 'status',
                  name: 'status'
              },
          ],
          order: [
              [6, 'desc']
          ]
    });
</script>
@endsection