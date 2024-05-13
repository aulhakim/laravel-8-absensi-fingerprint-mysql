
@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')

<div class="row">

  <div class="card card-primary">
    <div class="card-body">

        <div class="row py-2">
            <div class="col">
                <h5 class="card-title fw-semibold mb-4">SISWA | <small class="fs-13 judul">Tambah Data</small></h5>
            </div>
            <div class="col ">
            </div>
        </div>
        <form method="POST" action="{{ route('user.murid.store') }}">
          @csrf

          <div class="row">
            @if($errors->any())
                {{ implode('', $errors->all(':message')) }}
            @endif
          </div>
        <div class="row">
        
                <div class="col-6">

                  <div class="mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="" >
                    <input type="hidden" value="" name="id" >
                  </div>
               
                  <div class="mb-3">
                    <div class="row">
                    <div class="col">
                      <label for="" class="form-label">Tempat Lahir</label>
                      <input type="text"  class="form-control" value="{{ old('born') }}" name="born" id="" >
                    </div>
                    <div class="col">
                      <label for="" class="form-label">Tanggal Lahir</label>
                      <input type="date"  class="form-control" value="{{ old('date_birth') }}" name="date_birth" id="" >
                    </div>
                  </div>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Jenis Kelamin</label>
                    <select id=""  class="form-select" name="gender">
                      <option value="L">Laki-Laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Agama</label>
                    <select id=""  class="form-select" name="religion_id">
                      <option value="1">ISLAM</option>
                      <option value="2">KRISTEN</option>
                      <option value="3">HINDU</option>
                      <option value="4">BUDHA</option>
                      <option value="5">KHATOLIK</option>
                      <option value="6">KHONGHUCU</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Alamat</label>
                    <textarea id="" class="form-control"  name="address" cols="30" rows="5">{{ old('address') }}</textarea>
                  </div>
                

                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Kelas </label>
                    <select id=""  class="form-select" name="class_id">
                      @foreach ($kelas as $val)
                      <option value="{{ $val->id }}">{{ $val->name }}</option>
                      @endforeach
                    
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">NIS </label>
                    <input type="text" class="form-control" value="{{ old('nis') }}" name="nis" id="" >
                  </div>

                  <div class="mb-3">
                    <div class="row">
                    <div class="col-8">
                      <label for="" class="form-label">Orang Tua </label>
                      <select id="parent_id"  class="form-select" name="parent_id">
                        @foreach ($parent as $val)
                        <option value="{{ $val->id }}">{{ $val->full_name }}</option>
                        @endforeach
                      
                      </select>
                    </div>
                    <div class="col-4 pt-2">
                      {{-- <label for="" class="form-label"></label> --}}
                      <a href="{{ url('user/orang-tua/add') }}" class="btn btn-success mt-4 ortu">Tambah Ortu</a>

                    </div>
                  </div>
                  </div>

                  {{-- <div class="mb-3">
                   
                  </div> --}}
                  {{-- <div class="mb-3">
                    <label for="" class="form-label">Email </label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" >
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">No HP</label>
                    <input type="number" maxlength="13" class="form-control" value="{{ old('phone_number') }}" name="phone_number" id="" >
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Password </label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}"  id="" >
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Konfirmasi Password </label>
                    <input type="password" class="form-control" name="confirm_password"  value="{{ old('confirm_password') }}" id="" >
                  </div> --}}
                  <button type="submit" class="btn btn-primary submit">Simpan Siswa</button>


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
      $('[name="born"]').val("{{$user->born}}");
      $('[name="date_birth"]').val("{{$user->date_birth}}");
      $('[name="gender"]').val("{{$user->gender}}");
      $('[name="religion_id"]').val("{{$user->religion_id}}");
      $('[name="parent_id"]').val("{{$user->parent_id}}");
      var address = @json($user->address);
      $('[name="address"]').text(address);
      $('[name="class_id"]').val("{{$user->class_id}}");
      $('[name="nis"]').val("{{$user->nis}}");
      // $('[name="email"]').val("{{$user->email}}");
      // $('[name="phone_number"]').val("{{$user->phone_number}}");
  @endif

  @if (auth()->user()->user_type == 3)
      $('.judul').attr("readonly", true);
      $('.submit').attr("readonly", true);
      $('[name="id"]').attr("readonly", true);
      $('[name="name"]').attr("readonly", true);
      $('[name="born"]').attr("readonly", true);
      $('[name="date_birth"]').attr("readonly", true);
      $('[name="gender"]').prop("disabled", true);
      $('[name="religion_id"]').prop("disabled", true);
      $('[name="parent_id"]').prop("disabled", true);
      var address = @json($user->address);
      $('[name="address"]').attr("readonly", true);
      $('[name="class_id"]').prop("disabled", true);
      $('[name="nis"]').attr("readonly", true);
      $('.submit').css("display", "none");
      $('.ortu').css("display", "none");
  @endif
</script>

          
@endsection




