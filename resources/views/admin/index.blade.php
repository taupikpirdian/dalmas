@extends('layouts.admin')

@section('content-header')
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </div>
    </div>
    <!--end::Row-->
  </div>
@endsection

@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-lg-4 col-4">
        <!--begin::Small Box Widget 1-->
        <div class="small-box text-bg-info">
          <div class="inner">
            <h3>{{ $personelOnprogress }}</h3>
            <p>Jumlah Personel Bertugas</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
            ></path>
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
            ></path>
          </svg>
        </div>
        <!--end::Small Box Widget 1-->
      </div>
      <div class="col-lg-4 col-4">
        <!--begin::Small Box Widget 1-->
        <div class="small-box text-bg-warning">
          <div class="inner">
            <h3>{{ $countIdlePersonel }}</h3>
            <p>Jumlah Personel Tidak Bertugas</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
            ></path>
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
            ></path>
          </svg>
        </div>
        <!--end::Small Box Widget 1-->
      </div>
      <div class="col-lg-4 col-4">
        <!--begin::Small Box Widget 1-->
        <div class="small-box text-bg-success">
          <div class="inner">
            <h3>{{ $countUsers }}</h3>
            <p>Jumlah Personel Aktif</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
            ></path>
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
            ></path>
          </svg>
        </div>
        <!--end::Small Box Widget 1-->
      </div>
      <!--begin::Col-->
      <div class="col-lg-6 col-6">
        <!--begin::Small Box Widget 1-->
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h3>{{ $countPerkaras }}</h3>
            <p>Jumlah Data Sprint</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
            ></path>
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
            ></path>
          </svg>
        </div>
        <!--end::Small Box Widget 1-->
      </div>
      <!--end::Col-->
      <div class="col-lg-6 col-6">
        <!--begin::Small Box Widget 2-->
        <div class="small-box text-bg-success">
          <div class="inner">
            <h3>{{ $countFinishSprint }}</h3>
            <p>Jumlah Data Sprint Selesai</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >
            <path
              d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
            ></path>
          </svg>
        </div>
        <!--end::Small Box Widget 2-->
      </div>
    </div>
    <!--end::Row-->

    <div class="row">
        <h2 class="card-title m-0 mb-3">Data Personil</h2>
        <table id="example" class="table table-bordered table-striped">
          <thead>
          <tr>
              <th>No</th>
              <th>NRP</th>
              <th>Nama</th>
              <th>Pangkat</th>
              <th>Jabatan</th>
              <th>Satuan</th>
              <th>Status</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($personils as $key=>$item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nrp }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->pangkat }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->satuan }}</td>
                <td>
                  {!! $item->status_text == "process" 
                      ? '<span class="badge bg-info">Sedang bertugas</span>' 
                      : '<span class="badge bg-success">Idle</span>' !!}
                </td>
            </tr>
          @endforeach
          </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<!-- apexcharts -->
<script
    src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
    crossorigin="anonymous"
></script>
<!-- ChartJS -->
<script>
    $(document).ready(function () {
      $('#example').DataTable();
    });
    // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
    // IT'S ALL JUST JUNK FOR DEMO
    // ++++++++++++++++++++++++++++++++++++++++++

    const sales_chart_options = {
    series: [
        {
        name: 'Digital Goods',
        data: [28, 48, 40, 19, 86, 27, 90],
        },
        {
        name: 'Electronics',
        data: [65, 59, 80, 81, 56, 55, 40],
        },
    ],
    chart: {
        height: 300,
        type: 'area',
        toolbar: {
        show: false,
        },
    },
    legend: {
        show: false,
    },
    colors: ['#0d6efd', '#20c997'],
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: 'smooth',
    },
    xaxis: {
        type: 'datetime',
        categories: [
        '2023-01-01',
        '2023-02-01',
        '2023-03-01',
        '2023-04-01',
        '2023-05-01',
        '2023-06-01',
        '2023-07-01',
        ],
    },
    tooltip: {
        x: {
        format: 'MMMM yyyy',
        },
    },
    };

    const sales_chart = new ApexCharts(
    document.querySelector('#revenue-chart'),
    sales_chart_options,
    );
    sales_chart.render();
</script>
@endsection
