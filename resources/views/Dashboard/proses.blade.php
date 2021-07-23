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
                @if ($errors->any())
                <div class="alert alert-danger">
                    Data tidak sesuai, Periksa kembali formulir anda !
                </div>
                @endif
            </div>
            <div class="card-header">
                <h4>Data Proses Kirim</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Tabel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Tambah Data</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No. Resi</th>
                                    <th>Pengirim</th>
                                    <th>Tujuan</th>
                                    <th>Hp</th>
                                    <th>Keterangan</th>
                                    <th>Created at</th>
                                    <th>Deleted at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['proses'] as $d)
                                <tr>
                                    <th>{{$d->no_resi}}</th>
                                    <th>{{$d->pengirim_rol->nama}}</th>
                                    <th>{{$d->tujuan_rol->cabang}}</th>
                                    <th>{{$d->no_hp}}</th>
                                    <th>{{$d->ket}}</th>
                                    <th>{{date('d-m-Y', strtotime($d->created_at))}}</th>
                                    <th>{{date('d-m-Y', strtotime($d->updated_at))}}</th>
                                    <th>
                                        <button type="button" data-id="{{$d->id}}"
                                            class="md-detail btn btn-icon btn-info">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button type="button" data-id="{{$d->id}}"
                                            class="md-hapus btn btn-icon btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No. Resi</th>
                                    <th>Pengirim</th>
                                    <th>Tujuan</th>
                                    <th>Hp</th>
                                    <th>Keterangan</th>
                                    <th>Created at</th>
                                    <th>Deleted at</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-12">
                            <form action="{{ Route('kirim.insert') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Buat data baru</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="wizard-content mt-2">
                                            <div class="wizard-pane">
                                                <div class="form-group row align-items-center">

                                                    <label class="col-md-4 text-md-right text-left">Nama
                                                        Pengirim</label>
                                                    <select name="pengirim_id" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['pengirim'] as $d)
                                                        <option value="{{$d->id}}" @if (old('pengirim_id')==$d->id)
                                                            selected="selected" @endif>{{$d->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6">
                                                        @error('pengirim_id')
                                                        <span class="text-danger">{{ $message }} !</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="col-md-4 text-md-right text-left">Asal</label>
                                                    <select name="asal_id" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['lokasi'] as $d)
                                                        <option value="{{$d->id}}" @if (old('asal_id')==$d->id)
                                                            selected=" selected" @endif">{{$d->cabang}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6">
                                                        @error('asal_id')
                                                        <span class="text-danger">{{ $message }} !</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="col-md-4 text-md-right text-left">Tujuan</label>
                                                    <select name="tujuan_id" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['lokasi'] as $d)
                                                        <option value="{{$d->id}}" @if (old('tujuan_id')==$d->id)
                                                            selected="selected" @endif>{{$d->cabang}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6">
                                                        @error('tujuan_id')
                                                        <span class="text-danger">{{ $message }} !</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="col-md-4 text-md-right text-left">Nomor Hp</label>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" name="no_hp" value="{{old('no_hp')}}"
                                                            class="form-control">
                                                        @error('no_hp')
                                                        <span class="text-danger">{{ $message }} !</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        class="col-md-4 text-md-right text-left mt-2">Keterangan</label>
                                                    <div class="col-lg-6 col-md-6">
                                                        <textarea class="form-control" id="ket-ms"
                                                            name="ket"></textarea>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6">
                                                        @error('ket')
                                                        <span class="text-danger">{{ $message }} !</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="col-md-4 text-md-right text-left">Supir</label>
                                                    <select name="supir_id" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['supir'] as $d)
                                                        <option value="{{$d->id}}" @if (old('supir_id')==$d->id)
                                                            selected="selected" @endif>{{$d->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6">
                                                        @error('supir_id')
                                                        <span class="text-danger">{{ $message }} !</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <label class="col-md-4 text-md-right text-left">Mobil</label>
                                                    <select name="mobil_id" class="col-lg-6 col-md-6 form-control">
                                                        <option selected disabled>Pilih</option>
                                                        @foreach ($data['mobil'] as $d)
                                                        <option value="{{$d->id}}" @if (old('mobil_id')==$d->id)
                                                            selected="selected" @endif>{{$d->plat}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6">
                                                        @error('mobil_id')
                                                        <span class="text-danger">{{ $message }} !</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-lg-6 col-md-6 text-right">
                                                        <button type="submit"
                                                            class="btn btn-icon icon-right btn-primary">Next <i
                                                                class="fas fa-arrow-right"></i></button>
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
@endsection
@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title">Modal title</h5>
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <form id="form_edit">
                    @csrf
                    <div>
                        <form class="wizard-content mt-2">
                            <div class="wizard-pane">
                                <input type="hidden" name="id" id="data_id">
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Nama
                                        Pengirim</label>
                                    <select name="pengirim_id" id="pengirim_id" class="col-lg-6 col-md-6 form-control">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($data['pengirim'] as $d)
                                        <option value="{{$d->id}}">{{$d->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Asal</label>
                                    <select name="asal_id" id="asal_id" class="col-lg-6 col-md-6 form-control">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($data['lokasi'] as $d)
                                        <option value="{{$d->id}}">{{$d->cabang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Tujuan</label>
                                    <select name="tujuan_id" id="tujuan_id" class="col-lg-6 col-md-6 form-control">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($data['lokasi'] as $d)
                                        <option value="{{$d->id}}">{{$d->cabang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Nomor Hp</label>
                                    <div class="col-lg-6 col-md-6">
                                        <input type="text" name="no_hp" id="no_hp" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left mt-2">Keterangan</label>
                                    <div class="col-lg-6 col-md-6">
                                        <textarea class="form-control" name="ket" id="ket"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Supir</label>
                                    <select name="supir_id" id="supir_id" class="col-lg-6 col-md-6 form-control">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($data['supir'] as $d)
                                        <option value="{{$d->id}}">{{$d->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="col-md-4 text-md-right text-left">Mobil</label>
                                    <select name="mobil_id" id="mobil_id" class="col-lg-6 col-md-6 form-control">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($data['mobil'] as $d)
                                        <option value="{{$d->id}}">{{$d->plat}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="md-update btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function()
    {
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
        $('#ket-ms').val('{{old('ket')}}');
        $('body').on('click', '.md-detail', function () {
            let dataId = $(this).data('id');
            $.get('edit/' + dataId, function (data) {
                $('#data_id').val(data.id);
                $('#modal-title').html("Edit Post");
                $('#myModal').modal('show');
                $('#pengirim_id').val(data.pengirim_id);
                $('#asal_id').val(data.asal_id);
                $('#tujuan_id').val(data.tujuan_id);
                $('#no_hp').val(data.no_hp);
                $('#ket').val(data.ket);
                $('#supir_id').val(data.supir_id);
                $('#mobil_id').val(data.mobil_id);
            })
        });
    });

    $('body').on('click', '.md-update', function () {
       let id = $('#form_edit').find('#data_id').val();
       let formData = $('#form_edit').serialize();
       $.ajax({
           url: 'update/'+id,
           method: 'PATCH',
           data: formData,
           success: function (data) {
               $('#myModal').modal('hide');
               Swal.fire(
                'Update!',
                'Data berhasl di update.',
                'success'
                );
                setTimeout(function(){
                location.reload();
                },1000);
           },
           error: function () {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
                });
                setTimeout(function(){
                location.reload();
                },1000);
            }
       })
    });

    $(document).on('click', '.md-hapus', function () {
        let dataId = $(this).data('id');
        Swal.fire({
        title: 'Anda Yakin?',
        text: "Data ini mungkin terhubung ke tabel yang lain!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "delete/" + dataId, //eksekusi ajax ke url ini
                    type: 'delete',
                    success: function () {
                        Swal.fire(
                        'Terhapus!',
                        'Data Dihapus Secara Permanen.',
                        'success'
                        );
                        setTimeout(function(){
                        location.reload();
                        },1000);
                    },
                    error: function () {
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                        });
                        setTimeout(function(){
                        location.reload();
                        },1000);
                    }
                })
            }
        })
    });
</script>
@endsection