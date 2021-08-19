@extends('Layouts.DsTemplate')
@section('content')
<div class="row">
  <div class="col-12 mb-4">
    <div class="hero bg-primary text-white">
      <div class="hero-inner">
        <h2>Welcome Back, <span class="text-uppercase">{{ Auth::user()->role }}!</span></h2>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4>Invoices</h4>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive table-invoice">
          <table id="table_status" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Resi</th>
                <th>Pengirim</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Update</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data['proses'] as $d)
              <tr>
                <th>{{$d->no_resi}}</th>
                <th class="font-weight-600">{{$d->pengirim_rol->nama}}</th>
                <th>
                  <div class="badge badge-success">{{$d->asal_rol->cabang}}</div>
                </th>
                <th>
                  <div class="badge badge-warning">{{$d->tujuan_rol->cabang}}</div>
                </th>
                <th>
                  <div class="badge badge-info">{{$d->status_rol->status_pengiriman}}</div>
                </th>
                <th>
                  <div class=""><button type="button" data-id="{{$d->id}}"
                      class="btn_update btn-sm btn btn-icon btn-success">
                      <i class="fas fa-info-circle"></i> Update
                    </button></div>
                </th>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Resi</th>
                <th>Pengirim</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Update</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-hero">
      <div class="card-header">
        <div class="card-icon">
          <i class="far fa-question-circle"></i>
        </div>
        <h4 style="font-size: 25px;">{{$data['date']}}</h4>
        <div class="card-description">Pengiriman Hari Ini</div>
      </div>
      <div class="card-body p-0">
        <div class="tickets-list">
          @foreach ($data['today'] as $d)
          <a href="#" class="ticket-item">
            <div class="ticket-title">
              <h4>{{$d->no_resi}}</h4>
            </div>
            <div class="ticket-info">
              <div>{{$d->pengirim_rol->nama}}</div>
              <div class="bullet"></div>
              <div class="text-primary">{{$d->tujuan_rol->cabang}}</div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#table_status').DataTable();
      $(document).on('click', '.btn_update', function () {
        let dataId = $(this).data('id');
        Swal.fire({
        title: 'Update Status?',
        text: "Konfirmasi barang telah di terima oleh kantor?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "update/" + dataId, //eksekusi ajax ke url ini
                    type: 'PATCH',
                    success: function () {
                        Swal.fire(
                        'Update!',
                        'Data berhasl di update dan pesan berhasil terkirim.',
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
                        // setTimeout(function(){
                        // location.reload();
                        // },1000);
                    }
                })
            }
        })
    });
  });
</script>
@endsection