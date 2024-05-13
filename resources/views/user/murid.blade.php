
@extends('layouts.app')

<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@section('content')

<div class="row">

  <div class="card card-primary">
    <div class="card-body">
        <div class="row py-2">
            <div class="col">
                <h5 class="card-title fw-semibold mb-4">SISWA</h5>
            </div>
            <div class="col ">

                @if(auth()->user()->user_type == 0 OR auth()->user()->user_type == 1 )

                <a href="{{ url('user/murid/add') }}" class="btn btn-primary float-end">Tambah</a>
    
                @endif

                
            </div>
        </div>

          <table id="example"  class="table ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Name</th>
                    <th>Kelas</th>
                    <th>Nomor Orang Tua</th>
                    <th>Status Fp</th>
                    <th width="120px">Action</th>
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
        ajax: "{{ route('user.murid') }}",
        columns: [
            { 
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
             },
            {data: 'nis', name: 'nis', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'class', name: 'class', orderable: false, searchable: false},
            {data: 'number_ortu', name: 'number_ortu', orderable: false, searchable: false},
            {data: 'isconnect', name: 'isconnect'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
    function deleteData(id) {
            if (confirm('Hapus? ')) {
                $.ajax({
                    url: "{{ url('user/murid/delete') }}/" + id,
                    type: "GET",
                    success: function(data) {
                        table.draw();
                    },
                });
            }
    }
</script>

          
@endsection




