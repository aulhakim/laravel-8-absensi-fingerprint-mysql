
@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@section('content')

<div class="row">

  <div class="card card-primary">
    <div class="card-body">
        <div class="row py-2">
            <div class="col-md-6">
                <h5 class="card-title fw-semibold mb-4">ABSENSI</h5>
            </div>
          
            <div class="col-md-6 ">
                <div class="row">
                    <div class="col-md-8"> 
                        <a href="javascript:void(0)" class="btn btn-primary float-end sync">Sync</a>
                        <a href="{{ url('/absensi/download') }}" onClick="downloadData()" class="btn btn-secondary float-end mx-2">Download Absensi</a>
                        {{-- <a href="#" onClick="downloadData()" class="btn btn-secondary float-end mx-2">Download Absensi</a> --}}
                        <a href="{{ url('/absensi/kirim-surat') }}" class="btn btn-success float-end mx-2">Kirim Surat</a>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <form action="" method="get" id="frmFilterPeriode">
                                <div class="input-group filter-search">
                                   <span class="input-group-text bg-white border-end-0"> <i class="ti ti-calendar"></i> </span>
                                   <input type="text" id="periode" name="periode" class="form-control date-range bg-white " value="{{ old('periode') }}" placeholder="@lang('all.periode')">
                                </div>
                             </form>
                        </div>
                    </div>
                </div>
               
               
                
               
               
            </div>
        </div>

            <table id="example"  class="table ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Status Check</th>
                        <th>Status Absen</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>File</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>

    

const defaultStartDate = new Date();
   defaultStartDate.setDate(1);
   const defaultEndDate = new Date(); 
   $("#periode").flatpickr({
       mode: "range",
       dateFormat: "d/m/Y",
       defaultDate: [defaultEndDate, defaultEndDate], 
       onChange: function(selectedDates, dateStr, instance) {
           instance.element.value = dateStr.replace('to', '-');
          
       },
       onReady: function(selectedDates, dateStr, instance) {
           instance.element.value = dateStr.replace('to', '-');
       },
       onClose: function(selectedDates, dateStr, instance) {
           instance.element.value = dateStr.replace('to', '-');
                if (selectedDates.length === 2) {
                    function formatDate(date) {
                    return new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
               }
               table.draw();
             
           }
       },
   }); 

   function downloadData(){
    var dates = $('#periode').val();
    // window.location.href="{{ url('absensi/download/') }}/"+dates;
    $.ajax({
            url: "{{ url('absensi/download') }}" ,
            type: "POST",
            // dataType: "JSON",
            data:{periode:dates},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) { 
                console.log(data);
                // table.draw();
            },
        });


   }

    
    var table = $('#example').DataTable({
        processing: true,
        serverSide: true,

        paging: true,
        ordering: false,
        serverSide: true,
        processing: true,
        destroy: true,
        bDestroy: true,
        // destroy: true,
        // bDestroy: true,
        // ordering: false,
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        // ajax: "{{ route('absensi') }}",
        ajax: {
                url: "{{ route('absensi') }}",
                data: function(e) {
                    e.periode = $('#periode').val();
                }
            },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'nis', name: 'nis'},
            {data: 'siswa', name: 'siswa', orderable: false, searchable: false},
            {data: 'status_check', name: 'status_check'},
            {data: 'status_attend', name: 'status_attend'},
            {data: 'date', name: 'date'},
            {data: 'hour', name: 'hour'},
            // {data: 'file', name: 'file'},
            { data: 'file',
            name: 'file',
            render: function(data, type, full, meta) {
                if(data == null){
                    return  '-';
                }
                return "<a id=\"single_image\"/ href=\"uploads/"+ data +"\" class=\"btn btn-primary btn-sm\" target=\"__blank\"> <i class=\"ti ti-download\"></i> File</a>";
            }},
            {data: 'keterangan', name: 'keterangan'},
        ],
    });



    $('.sync').click(function(){
        $.ajax({
            url: "{{ url('absensi/sync-data-absensi') }}" ,
            type: "GET",
            dataType: "JSON",
            success: function(data) { 
                console.log(data);
                table.draw();
            },
        });
    });
    
</script>

          
@endsection




