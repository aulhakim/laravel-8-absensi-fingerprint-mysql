
@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')

<div class="row">

  <div class="card card-primary">
    <div class="card-body">

        <div class="row py-2">
            <div class="col">
                <h5 class="card-title fw-semibold mb-4">Absensi | <small class="fs-13 judul">Kirim Surat</small></h5>
            </div>
            <div class="col ">
            </div>
        </div>
        <form method="POST" action="{{ route('absensi.kirim-surat') }}"  enctype="multipart/form-data">
          @csrf
        <div class="row">
                <div class="col-md-6">

                  <div class="mb-3">
                    <label for="" class="form-label">Pilih Siswa</label>
                    <select id=""  class="form-select" name="student_id">
                      @foreach ($murid as $val)
                      <option value="{{ $val->id }}">{{ $val->full_name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Alasan Tidak Masuk</label>
                    <select id=""  class="form-select" name="alasan">
                      <option value="2">Izin</option>
                      <option value="3">Sakit</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">File Surat</label>
                    <input type="file" name="file_surat" class="form-control" id="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Keterangan</label>
                    <textarea id="" class="form-control"  name="keterangan" cols="30" rows="6">{{ old('keterangan') }}</textarea>
                  </div>
                  <button type="submit" class="btn btn-primary submit">Kirim Surat </button>
                </div>
        </div>

               
      </form>
         
    </div>
  </div>
</div>


<script>
</script>

          
@endsection




