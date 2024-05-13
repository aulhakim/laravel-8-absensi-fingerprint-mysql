
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
                <h5 class="card-title fw-semibold mb-4">ORANG TUA</h5>
            </div>
            <div class="col ">
                <a href="{{ url('user/orang-tua/add') }}" class="btn btn-primary float-end">Tambah</a>
            </div>
        </div>


          <table id="example"  class="table ">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="100px">Action</th>
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
        orderable: false,
        ajax: "{{ route('user.orangtua') }}",

        columns: [
            { 
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
             },
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action',  searchable: false},
        ]
       
    });
        
    function deleteData(id) {
            if (confirm('Hapus? ')) {
                $.ajax({
                    url: "{{ url('user/orang-tua/delete') }}/" + id,
                    type: "GET",
                    success: function(data) {
                        table.draw();
                    },
                });
            }
    }
</script>

          
@endsection




