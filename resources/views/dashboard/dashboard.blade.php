
@extends('layouts.app')

@section('content')

<div class="row">
  <h4 class="py-4 fw-bold">DASHBOARD</h4>
</div>
<div class="row">

  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="row alig n-items-start">
          <div class="col-8">
            <h5 class="card-title mb-9 fw-semibold"> Jumlah Siswa </h5>
            <h4 class="fw-semibold mb-3">{{ $jml_siswa }}</h4>
            {{-- <h6>2022/2023</h6> --}}
           
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-users fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="row alig n-items-start">
          <div class="col-8">
            <h5 class="card-title mb-9 fw-semibold"> Jumlah Guru </h5>
            <h4 class="fw-semibold mb-3">{{ $jml_siswa }}</h4>
            {{-- <h6>2022/2023</h6> --}}
           
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-users fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <div class="row alig n-items-start">
          <div class="col-8">
            <h5 class="card-title mb-9 fw-semibold">   Hadir</h5>
            <h4 class="fw-semibold mb-3">{{ $hadir }} </h4>
            <h6>Hari Ini</h6>
           
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-users fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>

  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <div class="row alig n-items-start">
          <div class="col-8">
            <h5 class="card-title mb-9 fw-semibold">  Izin</h5>
            <h4 class="fw-semibold mb-3">{{ $izin }} </h4>
            <h6>Hari Ini</h6>
           
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-users fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>
  
  
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <div class="row alig n-items-start">
          <div class="col-8">
            <h5 class="card-title mb-9 fw-semibold">  Sakit</h5>
            <h4 class="fw-semibold mb-3">{{ $sakit }} </h4>
            <h6>Hari Ini</h6>
           
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-users fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>

  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <div class="row alig n-items-start">
          <div class="col-8">
            <h5 class="card-title mb-9 fw-semibold">Tidak Hadir</h5>
            <h4 class="fw-semibold mb-3">{{ $alfa }} </h4>
            <h6>Hari Ini</h6>
           
          </div>
          <div class="col-4">
            <div class="d-flex justify-content-end">
              <div
                class="text-white bg-black rounded-circle p-6 d-flex align-items-center justify-content-center">
                <i class="ti ti-users fs-6"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>
 

    <div class="col-lg-12 d-flex ">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Report Absensi Bulanan</h5>
            </div>
            <div>
              <select class="form-select">
                <option value="1">2023</option>
              </select>
            </div>
          </div>
          <div id="chart"></div>
        </div>
      </div>
    </div>
    
  </div> 

  
@endsection

<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>


<script>

$(function () {


var options = {
          series: @json($series),
     
          chart: {
          height: 350,
          type: 'line',
        },
        stroke: {
          curve: 'smooth'
        },
        fill: {
          type:'solid',
          opacity: [0.35, 1],
        },
        labels: @json($categories),
        markers: {
          size: 0
        },
        yaxis: [
          {
            title: {
              text: 'Jumlah Siswa',
            },
          },
        ],
        tooltip: {
          shared: true,
          intersect: false,
          y: {
            formatter: function (y) {
              if(typeof y !== "undefined") {
                return  y.toFixed(0) + " Orang";
              }
              return y;
            }
          }
        }
        };

        
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


// var chart = new ApexCharts(document.querySelector("#chart"), chart);
// chart.render();






})

</script>
{{-- <script src="../assets/js/dashboard.js"></script> --}}

