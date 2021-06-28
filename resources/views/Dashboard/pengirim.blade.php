@extends('layouts.DsTemplate')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
          <div class="small">
            @if (session('status'))
                <div class="alert alert-success mt-2">
                    {{ session('status') }}
                </div>
            @endif
          </div>
          <div class="card-header">
            <h4>Data Pengirim</h4>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No.Hp</th>
                            <th>Barang</th>
                            <th>Berat</th>
                            <th>Jumlah</th>
                            <th>Created at</th>
                            <th>Deleted at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <th>{{$d->nama}}</th>
                            <th>{{$d->alamat}}</th>
                            <th>{{$d->hp}}</th>
                            <th>{{$d->barang}}</th>
                            <th>{{$d->berat}} Kg</th>
                            <th>{{$d->jumlah}}</th>
                            <th>{{date('d-m-Y', strtotime($d->created_at))}}</th>
                            <th>{{date('d-m-Y', strtotime($d->updated_at))}}</th>
                            <th>
                                <button type="button" data-id="{{$d->id}}" class="md-edit btn btn-icon btn-info">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                <button type="button" data-id="{{$d->id}}" class="md-hapus btn btn-icon btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No.Hp</th>
                            <th>Barang</th>
                            <th>Berat</th>
                            <th>Jumlah</th>
                            <th>Created at</th>
                            <th>Deleted at</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="col-12">
                    <form action="{{route('pengirim.insert')}}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                              <h4>BUat data baru</h4>
                            </div>
                            <div class="card-body">
                              <form class="wizard-content mt-2">
                                <div class="wizard-pane">
                                  <div class="form-group row align-items-center">
                                    @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="col-md-4 text-md-right text-left">Nama Pengirim</label>
                                    <div class="col-lg-6 col-md-6">
                                      <input type="text" name="nama" class="form-control">
                                    </div>
                                  </div>
                                  <div class="form-group row align-items-center">
                                      @error('hp')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                    <label class="col-md-4 text-md-right text-left">Nomor Hp</label>
                                    <div class="col-lg-6 col-md-6">
                                      <input type="text" name="hp" class="form-control">
                                    </div>
                                  </div>
                                  <div class="form-group row align-items-center">
                                      @error('barang')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                    <label class="col-md-4 text-md-right text-left">Barang</label>
                                    <div class="col-lg-6 col-md-6">
                                      <input type="text" name="barang" class="form-control">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                      @error('alamat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                    <label class="col-md-4 text-md-right text-left mt-2">Alamat</label>
                                    <div class="col-lg-6 col-md-6">
                                      <textarea class="form-control" name="alamat"></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row align-items-center">
                                      @error('berat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                      <label class="col-md-4 text-md-right text-left">Berat</label>
                                      <div class="col-lg-6 col-md-6">
                                        <input type="number" name="berat" class="form-control">
                                      </div>
                                      <span><p>Kg</p></span>
                                  </div>
                                  <div class="form-group row align-items-center">
                                      @error('jumlah')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                      <label class="col-md-4 text-md-right text-left">jumlah</label>
                                      <div class="col-lg-6 col-md-6">
                                        <input type="number" name="jumlah" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-lg-6 col-md-6 text-right">
                                      <button type="submit" class="btn btn-icon icon-right btn-primary">Next <i class="fas fa-arrow-right"></i></button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
{{-- JS --}}
@section('js')
<script>
    $(document).ready( function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $('#myTable').DataTable();
    });
</script>
<script>
   $(document).ready(function () {
     $('body').on('click', '.md-edit', function () {
       let dataId = $(this).data('id');
       $.get('edit/' + dataId , function (data) {
          $('#modal-title').html("Edit Post");
          $('#myModal').modal('show');
          $('#modal-body').html('');
          $('#modal-body').append(`
            <div class="wizard-pane">
              <div class="form-group row align-items-center">
                @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label class="col-md-4 text-md-right text-left">Nama Pengirim</label>
                <div class="col-lg-6 col-md-6">
                  <input type="hidden" value="`+ data.id +`" name="nama" class="form-control">
                  <input type="text" value="`+ data.nama +`" name="nama" class="form-control">
                </div>
              </div>
              <div class="form-group row align-items-center">
                  @error('hp')
                <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                <label class="col-md-4 text-md-right text-left">Nomor Hp</label>
                <div class="col-lg-6 col-md-6">
                  <input type="text" value="`+ data.hp +`" name="hp" class="form-control">
                </div>
              </div>
              <div class="form-group row align-items-center">
                  @error('barang')
                <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                <label class="col-md-4 text-md-right text-left">Barang</label>
                <div class="col-lg-6 col-md-6">
                  <input type="text" value="`+ data.barang +`" name="barang" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                  @error('alamat')
                <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                <label class="col-md-4 text-md-right text-left mt-2">Alamat</label>
                <div class="col-lg-6 col-md-6">
                  <textarea class="form-control" id="modal-alamat" name="alamat"></textarea>
                </div>
              </div>
              <div class="form-group row align-items-center">
                  @error('berat')
                <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <label class="col-md-4 text-md-right text-left">Berat</label>
                  <div class="col-lg-6 col-md-6">
                    <input type="number" value="`+ data.berat +`" name="berat" class="form-control">
                  </div>
                  <span><p>Kg</p></span>
              </div>
              <div class="form-group row align-items-center">
                  @error('jumlah')
                <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <label class="col-md-4 text-md-right text-left">jumlah</label>
                  <div class="col-lg-6 col-md-6">
                    <input type="number" value="`+ data.jumlah +`" name="jumlah" class="form-control">
                  </div>
              </div>
            </div>
           `);
          $('#modal-alamat').val(data.alamat);
        })
     });
   });
</script>
@endsection
@endsection