@extends('Layouts.DsTemplate')
@section('content')
<div class="row">
  <div class="col-12 mb-4">
    <div class="hero bg-primary text-white">
      <div class="hero-inner">
        <h2>Welcome Back, {{ Auth::user()->name }}!</h2>
        <p class="lead">This page is a place to manage posts, categories and more.</p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4>Invoices</h4>
        <div class="card-header-action">
          <a href="{{route('kirim.index')}}" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive table-invoice">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th>Resi</th>
                <th>Pengirim</th>
                <th>Asal</th>
                <th>Tujuan</th>
              </tr>
              @foreach ($data['proses'] as $d)
              <tr>
                <td><a href="#">{{$d->no_resi}}</a></td>
                <td class="font-weight-600">{{$d->pengirim_rol->nama}}</td>
                <td>
                  <div class="badge badge-warning">{{$d->asal_rol->cabang}}</div>
                </td>
                <td>{{$d->tujuan_rol->cabang}}</td>
              </tr>
              @endforeach
            </tbody>
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