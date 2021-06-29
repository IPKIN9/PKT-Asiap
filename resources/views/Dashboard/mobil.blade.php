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
                <h4>Data Mobil</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.DN</th>
                                    <th>Type</th>
                                    <th>Created at</th>
                                    <th>Deleted at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <th>{{$d->plat}}</th>
                                    <th>{{$d->type}}</th>
                                    <th>{{date('d-m-Y', strtotime($d->created_at))}}</th>
                                    <th>{{date('d-m-Y', strtotime($d->updated_at))}}</th>
                                    <th>
                                        <button type="button" data-id="{{$d->id}}"
                                            class="md-edit btn btn-icon btn-info">
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
                                    <th>No.DN</th>
                                    <th>type</th>
                                    <th>Created at</th>
                                    <th>Deleted at/th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col-12">
                            <form action="{{route('mobil.insert')}}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Buat data baru</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="wizard-content mt-2">
                                            <div class="wizard-pane">
                                                <div class="form-group row align-items-center">
                                                    @error('plat')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">No.DN</label>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" name="plat" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    @error('type')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <label class="col-md-4 text-md-right text-left">Type</label>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" name="type" class="form-control">
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
{{-- Modal --}}
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
                <form id="form-edit">
                    @csrf
                    <div id="modalContent">

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
{{-- JS --}}
@section('js')
<script>
    $(document).ready(function () {
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
            $.get('edit/' + dataId, function (data) {
                $('#modal-title').html("Edit Post");
                $('#myModal').modal('show');
                $('#modalContent').html('');
                $('#modalContent').append(`
            <div class="wizard-pane">
              <div class="form-group row align-items-center">
                @error('plat')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label class="col-md-4 text-md-right text-left">No.DN</label>
                <div class="col-lg-6 col-md-6">
                  <input type="hidden" id="data_id" value="` + data.id + `" name="id" class="form-control">
                  <input type="text" value="` + data.plat + `" name="plat" class="form-control">
                </div>
              </div>
              <div class="form-group row align-items-center">
                  @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                <label class="col-md-4 text-md-right text-left">Type</label>
                <div class="col-lg-6 col-md-6">
                  <input type="text" value="` + data.type + `" name="type" class="form-control">
                </div>
              </div>
            </div>
           `);
            })
        });
    });

    $('body').on('click', '.md-update', function () {
       let id = $('#form-edit').find('#data_id').val();
       let formData = $('#form-edit').serialize();
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
@endsection