
@extends('layouts.app')

<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@section('content')

<div class="row">

  <div class="card card-primary">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">NOTIFIKASI</h5>
            <table id="example"  class="table ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status </th>
                        <th>Tanggal</th>
                        <th>Dibuat Oleh</th>
                        {{-- <th width="100px">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </div>
  </div>
</div>


<script>
    
    var table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('notifikasi') }}",
        columns: [
            { 
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
             },
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'created_by', name: 'created_by'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
</script>

          
@endsection




