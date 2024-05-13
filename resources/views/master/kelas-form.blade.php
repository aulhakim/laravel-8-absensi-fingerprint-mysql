
@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')

<div class="row">

  <div class="card card-primary">
    <div class="card-body">

        <div class="row py-2">
            <div class="col">
                <h5 class="card-title fw-semibold mb-4">KELAS | <small class="fs-13 judul">Tambah Data</small></h5>
            </div>
            <div class="col ">
            </div>
        </div>
        <form method="POST" action="{{ route('user.kelas.store') }}">
          @csrf

          
        <div class="row">
        
                <div class="col-6">

                  <div class="mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="" >
                    <input type="hidden" value="" name="id" >
                  </div>
               
                
                

                </div>
                <div class="col-6">
                 
                  <div class="mb-3">
                    <label for="" class="form-label"></label>
                    <button type="submit" class="btn btn-primary submit mt-4">Simpan </button>

                  </div>
            


                </div>
            
        </div>

               
      </form>
         
    </div>
  </div>
</div>


<script>
  @if ($user != null)
      $('.judul').text("Edit Data");
      $('.submit').text("Update");
      $('[name="id"]').val("{{$user->id}}");
      $('[name="name"]').val("{{$user->name}}");
   
  @endif
</script>

          
@endsection




