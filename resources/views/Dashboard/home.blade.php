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
          <table id="myTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Resi</th>
                <th>Pengirim</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Status</th>
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
      $('#myTable').DataTable();
  });
</script>
@endsection